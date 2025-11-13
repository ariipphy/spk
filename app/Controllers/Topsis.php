<?php

namespace App\Controllers;

use App\Models\PelanggaranModel;
use App\Models\SubkriteriaModel;
use App\Models\SiswaModel;
use CodeIgniter\Controller;

class Topsis extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();

        $alternatif = $db->table('pelanggaran')
            ->select('pelanggaran.id, pelanggaran.tanggal, pelanggaran.nama_pelanggaran, siswa.nis, siswa.nama, 
                      tingkat.nama_subkriteria AS tingkat, 
                      frekuensi.nama_subkriteria AS frekuensi, 
                      dampak.nama_subkriteria AS dampak, 
                      kesengajaan.nama_subkriteria AS kesengajaan')
            ->join('siswa', 'siswa.id = pelanggaran.id_siswa')
            ->join('subkriteria AS tingkat', 'tingkat.id = pelanggaran.id_subkriteria_tingkat')
            ->join('subkriteria AS frekuensi', 'frekuensi.id = pelanggaran.id_subkriteria_frekuensi')
            ->join('subkriteria AS dampak', 'dampak.id = pelanggaran.id_subkriteria_dampak')
            ->join('subkriteria AS kesengajaan', 'kesengajaan.id = pelanggaran.id_subkriteria_kesengajaan')
            ->get()->getResultArray();

        return view('topsis_index', ['alternatif' => $alternatif]);
    }

    public function proses()
    {
        $db = \Config\Database::connect();

        $data = $db->table('pelanggaran')
            ->select('pelanggaran.id, pelanggaran.tanggal, pelanggaran.nama_pelanggaran, siswa.nis, siswa.nama, 
                      tingkat.nilai AS nilai_tingkat, 
                      frekuensi.nilai AS nilai_frekuensi, 
                      dampak.nilai AS nilai_dampak, 
                      kesengajaan.nilai AS nilai_kesengajaan')
            ->join('siswa', 'siswa.id = pelanggaran.id_siswa')
            ->join('subkriteria AS tingkat', 'tingkat.id = pelanggaran.id_subkriteria_tingkat')
            ->join('subkriteria AS frekuensi', 'frekuensi.id = pelanggaran.id_subkriteria_frekuensi')
            ->join('subkriteria AS dampak', 'dampak.id = pelanggaran.id_subkriteria_dampak')
            ->join('subkriteria AS kesengajaan', 'kesengajaan.id = pelanggaran.id_subkriteria_kesengajaan')
            ->get()->getResultArray();

        if (empty($data)) {
            return redirect()->back()->with('errors', ['Tidak ada data pelanggaran untuk diproses.']);
        }

        // Matriks awal
        $matrix = [];
        foreach ($data as $row) {
            $matrix[] = [
                'id' => $row['id'],
                'nis' => $row['nis'],
                'nama' => $row['nama'],
                'tanggal' => $row['tanggal'],
                'nama_pelanggaran' => $row['nama_pelanggaran'],
                'tingkat' => $row['nilai_tingkat'],
                'frekuensi' => $row['nilai_frekuensi'],
                'dampak' => $row['nilai_dampak'],
                'kesengajaan' => $row['nilai_kesengajaan'],
            ];
        }

        // Kriteria & BOBOT yang diperbarui sesuai inputmu
        $kriteria = ['tingkat', 'frekuensi', 'dampak', 'kesengajaan'];
        $bobot = [
            'tingkat' => 0.5423,
            'frekuensi' => 0.2333,
            'dampak' => 0.1397,
            'kesengajaan' => 0.0847
        ];

        // Normalisasi (hitung pembagi) — tambah keamanan kalau total = 0
        $pembagi = [];
        foreach ($kriteria as $k) {
            $total = 0;
            foreach ($matrix as $m) {
                $total += pow($m[$k], 2);
            }
            $pembagi[$k] = $total > 0 ? sqrt($total) : 1; // jika 0, pakai 1 agar tidak dibagi 0
        }

        $normal = [];
        foreach ($matrix as $m) {
            $n = [
                'id' => $m['id'],
                'nis' => $m['nis'],
                'nama' => $m['nama'],
                'tanggal' => $m['tanggal'],
                'nama_pelanggaran' => $m['nama_pelanggaran']
            ];
            foreach ($kriteria as $k) {
                // jika pembagi = 0 (sudah ditangani di atas), hasil normal = 0
                $n[$k] = $pembagi[$k] != 0 ? ($m[$k] / $pembagi[$k]) : 0;
            }
            $normal[] = $n;
        }

        // Normalisasi terbobot
        $terbobot = [];
        foreach ($normal as $n) {
            $t = [
                'id' => $n['id'],
                'nis' => $n['nis'],
                'nama' => $n['nama'],
                'tanggal' => $n['tanggal'],
                'nama_pelanggaran' => $n['nama_pelanggaran']
            ];
            foreach ($kriteria as $k) {
                $t[$k] = $n[$k] * $bobot[$k];
            }
            $terbobot[] = $t;
        }

        // Solusi ideal
        $A_plus = $A_min = [];
        foreach ($kriteria as $k) {
            $values = array_column($terbobot, $k);
            $A_plus[$k] = !empty($values) ? max($values) : 0;
            $A_min[$k] = !empty($values) ? min($values) : 0;
        }

        // Hitung preferensi & update ke DB
        $hasil = [];
        foreach ($terbobot as $t) {
            $d_plus = 0;
            $d_min = 0;
            foreach ($kriteria as $k) {
                $d_plus += pow($t[$k] - $A_plus[$k], 2);
                $d_min += pow($t[$k] - $A_min[$k], 2);
            }
            $d_plus = sqrt($d_plus);
            $d_min = sqrt($d_min);

            // hindari pembagian 0
            $preferensi = ($d_plus + $d_min) > 0 ? ($d_min / ($d_plus + $d_min)) : 0;

            // Tentukan rekomendasi sanksi
            $sanksi = $this->rekomendasiSanksi($preferensi);

            // Update langsung ke tabel pelanggaran
            $db->table('pelanggaran')
                ->where('id', $t['id'])
                ->update(['rekomendasi_sanksi' => $sanksi]);

            $hasil[] = [
                'id' => $t['id'],
                'nis' => $t['nis'],
                'nama' => $t['nama'],
                'tanggal' => $t['tanggal'],
                'nama_pelanggaran' => $t['nama_pelanggaran'],
                'nilai_preferensi' => round($preferensi, 4),
                'rekomendasi_sanksi' => $sanksi
            ];
        }

        // Urutkan hasil
        usort($hasil, fn($a, $b) => $b['nilai_preferensi'] <=> $a['nilai_preferensi']);

        return view('topsis_hasil', ['hasil' => $hasil]);
    }

    public function laporan()
{
    $db = \Config\Database::connect();
    $builder = $db->table('pelanggaran')
        ->select('pelanggaran.*, siswa.nama, siswa.nis')
        ->join('siswa', 'siswa.id = pelanggaran.id_siswa')
        ->orderBy('pelanggaran.id', 'DESC'); 

    $data['hasil'] = $builder->get()->getResultArray();

    return view('laporan_hasil', $data);
}
public function laporanSiswa($id_siswa)
{
    $db = \Config\Database::connect();

    // Ambil data siswa berdasarkan ID
    $siswa = $db->table('siswa')->where('id', $id_siswa)->get()->getRowArray();

    // Ambil data pelanggaran siswa (langsung dari tabel pelanggaran)
    $pelanggaran = $db->table('pelanggaran')
        ->select('tanggal, nama_pelanggaran, rekomendasi_sanksi')
        ->where('id_siswa', $id_siswa)
        ->orderBy('tanggal', 'DESC')
        ->get()->getResultArray();

    // Kirim ke view
    return view('laporan_per_siswa', [
        'siswa' => $siswa,
        'pelanggaran' => $pelanggaran
    ]);
}


public function pilihSiswa()
{
    $siswaModel = new \App\Models\SiswaModel();
    $data['siswa'] = $siswaModel->findAll();
    return view('laporan_pilih_siswa', $data);
}


    public function laporanMingguan()
{
    $db = \Config\Database::connect();

    // Ambil data pelanggaran dalam 7 hari terakhir
    $laporan = $db->table('pelanggaran')
        ->select('siswa.nama AS nama_siswa, siswa.kelas, pelanggaran.tanggal, pelanggaran.nama_pelanggaran AS jenis_pelanggaran, pelanggaran.rekomendasi_sanksi')
        ->join('siswa', 'siswa.id = pelanggaran.id_siswa')
        ->where('pelanggaran.tanggal >=', date('Y-m-d', strtotime('-7 days')))
        ->orderBy('pelanggaran.tanggal', 'DESC')
        ->get()
        ->getResultArray();

    $periode = [
        'tanggal_awal' => date('d-m-Y', strtotime('-7 days')),
        'tanggal_akhir' => date('d-m-Y'),
    ];

    return view('laporan_per_minggu', [
        'laporan' => $laporan,
        'periode' => $periode
    ]);
}



    private function rekomendasiSanksi($nilai)
    {
        if ($nilai >= 0.8) return 'Dikeluarkan dari Sekolah';
        if ($nilai >= 0.6) return 'Skorsing';
        if ($nilai >= 0.4) return 'Pemanggilan Orang Tua';
        if ($nilai >= 0.2) return 'Penugasan';
        return 'Teguran';
    }
}

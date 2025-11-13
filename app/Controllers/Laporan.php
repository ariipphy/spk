<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Dompdf\Dompdf;

class Laporan extends BaseController
{
    public function perMinggu()
    {
        $db = \Config\Database::connect();
        $request = service('request');

        // Ambil tanggal dari input
        $input_awal = $request->getPost('tanggal_awal');
        $input_akhir = $request->getPost('tanggal_akhir');

        // Jika kosong, default minggu ini
        if (!empty($input_awal) && !empty($input_akhir)) {
            $tanggal_awal = date('Y-m-d', strtotime($input_awal));
            $tanggal_akhir = date('Y-m-d', strtotime($input_akhir));
        } else {
            $tanggal_akhir = date('Y-m-d');
            $tanggal_awal = date('Y-m-d', strtotime('-7 days'));
        }

        // Agar tanggal akhir mencakup hari terakhir penuh
        $tanggal_akhir_plus = date('Y-m-d', strtotime($tanggal_akhir . ' +1 day'));

        // Ambil data pelanggaran
        $sql = "
            SELECT 
                s.id AS id_siswa,
                s.nama AS nama_siswa,
                s.kelas,
                p.tanggal,
                p.nama_pelanggaran AS jenis_pelanggaran,
                p.rekomendasi_sanksi
            FROM pelanggaran p
            LEFT JOIN siswa s ON s.id = p.id_siswa
            WHERE p.tanggal >= ? AND p.tanggal < ?
              AND p.tanggal IS NOT NULL
              AND p.tanggal != '0000-00-00'
            ORDER BY p.tanggal DESC
        ";

        $query = $db->query($sql, [$tanggal_awal, $tanggal_akhir_plus]);
        $dataLaporan = $query->getResultArray();

        // Hitung metrik tambahan
        $totalKasus = count($dataLaporan);
        $totalSiswaTerlibat = 0;
        $pelanggaranTerbanyak = 'Nihil';
        $kelasTerlibatTerbanyak = 'Nihil';

        if (!empty($dataLaporan)) {
            // Siswa unik
            $siswaTerlibatIds = array_column($dataLaporan, 'id_siswa');
            $totalSiswaTerlibat = count(array_unique($siswaTerlibatIds));

            // Jenis pelanggaran terbanyak
            $jenisPelanggaran = array_column($dataLaporan, 'jenis_pelanggaran');
            if (!empty($jenisPelanggaran)) {
                $hitungPelanggaran = array_count_values($jenisPelanggaran);
                arsort($hitungPelanggaran);
                $pelanggaranTerbanyak = key($hitungPelanggaran) . ' (' . current($hitungPelanggaran) . 'x)';
            }

            // Kelas dengan kasus terbanyak
            $kelasTerlibat = array_column($dataLaporan, 'kelas');
            if (!empty($kelasTerlibat)) {
                $hitungKelas = array_count_values($kelasTerlibat);
                arsort($hitungKelas);
                $kelasTerlibatTerbanyak = 'Kelas ' . key($hitungKelas) . ' (' . current($hitungKelas) . ' kasus)';
            }
        }

        // Kirim data ke view
        $data = [
            'laporan' => $dataLaporan,
            'metrik' => [
                'total_siswa_terlibat' => $totalSiswaTerlibat,
                'total_kasus' => $totalKasus,
                'pelanggaran_terbanyak' => $pelanggaranTerbanyak,
                'kelas_terlibat_terbanyak' => $kelasTerlibatTerbanyak,
            ],
            'periode' => [
                'tanggal_awal' => date('d-m-Y', strtotime($tanggal_awal)),
                'tanggal_akhir' => date('d-m-Y', strtotime($tanggal_akhir)),
            ],
            'filter_tgl_awal' => $tanggal_awal,
            'filter_tgl_akhir' => $tanggal_akhir,
        ];

        return view('laporan_per_minggu', $data);
    }

    public function cetakPdf()
    {
        $db = \Config\Database::connect();
        $request = service('request');

        // Ambil tanggal dari POST
        $input_awal = $request->getPost('tanggal_awal');
        $input_akhir = $request->getPost('tanggal_akhir');

        // Jika kosong, default ke minggu ini
        if (!empty($input_awal) && !empty($input_akhir)) {
            $tanggal_awal = date('Y-m-d', strtotime($input_awal));
            $tanggal_akhir = date('Y-m-d', strtotime($input_akhir));
        } else {
            $tanggal_akhir = date('Y-m-d');
            $tanggal_awal = date('Y-m-d', strtotime('-7 days'));
        }

        $tanggal_akhir_plus = date('Y-m-d', strtotime($tanggal_akhir . ' +1 day'));

        // Query data sesuai rentang tanggal
        $sql = "
            SELECT 
                s.nama AS nama_siswa, 
                s.kelas, 
                p.tanggal, 
                p.nama_pelanggaran AS jenis_pelanggaran, 
                p.rekomendasi_sanksi
            FROM pelanggaran p
            LEFT JOIN siswa s ON s.id = p.id_siswa
            WHERE p.tanggal >= ? AND p.tanggal < ?
            ORDER BY p.tanggal DESC
        ";
        $query = $db->query($sql, [$tanggal_awal, $tanggal_akhir_plus]);
        $dataLaporan = $query->getResultArray();

        // === LOGO SEKOLAH ===
        // Pastikan file logo ada di folder: /public/assets/images/logo_sekolah.png
        $pathLogo = FCPATH . 'public/img/logo_sekolah.png';
        if (!file_exists($pathLogo)) {
            // Jika tidak ditemukan, gunakan logo default
            $pathLogo = FCPATH . 'public/img/logo sekolah.jpeg';
        }

        // === NAMA GURU BK ===
        // Bisa ambil dari database jika ada tabel guru, sementara pakai manual dulu
        $guruBK = 'Ibu Anggri Silfia, S.Pd.';

        // Kirim data ke view PDF
        $data = [
            'laporan' => $dataLaporan,
            'periode' => [
                'tanggal_awal' => date('d-m-Y', strtotime($tanggal_awal)),
                'tanggal_akhir' => date('d-m-Y', strtotime($tanggal_akhir)),
            ],
            'logo' => $pathLogo,
            'guru_bk' => $guruBK
        ];

        // === CETAK PDF ===
        $html = view('laporan_pelanggaran_pdf', $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Laporan_Pelanggaran.pdf', ["Attachment" => false]);
    }
}

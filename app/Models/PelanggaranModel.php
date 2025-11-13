<?php

namespace App\Models;

use CodeIgniter\Model;

class PelanggaranModel extends Model
{
    protected $table = 'pelanggaran';
    protected $primaryKey = 'id';
    
    // ✅ semua field yang boleh diisi (wajib tambahkan 'tanggal')
    protected $allowedFields = [
        'id_siswa',
        'nama_pelanggaran',
        'tanggal',
        'id_subkriteria_tingkat',
        'id_subkriteria_frekuensi',
        'id_subkriteria_dampak',
        'id_subkriteria_kesengajaan'
    ];

    /**
     * Ambil data pelanggaran dengan nilai subkriteria (untuk proses TOPSIS)
     */
    public function getPelanggaranWithSubkriteria()
    {
        return $this->select('pelanggaran.*, siswa.nama, 
                tingkat.nilai as nilai_tingkat, 
                frekuensi.nilai as nilai_frekuensi, 
                dampak.nilai as nilai_dampak, 
                kesengajaan.nilai as nilai_kesengajaan')
            ->join('siswa', 'siswa.id = pelanggaran.id_siswa')
            ->join('subkriteria as tingkat', 'tingkat.id = pelanggaran.id_subkriteria_tingkat')
            ->join('subkriteria as frekuensi', 'frekuensi.id = pelanggaran.id_subkriteria_frekuensi')
            ->join('subkriteria as dampak', 'dampak.id = pelanggaran.id_subkriteria_dampak')
            ->join('subkriteria as kesengajaan', 'kesengajaan.id = pelanggaran.id_subkriteria_kesengajaan')
            ->findAll();
    }

    /**
     * Ambil data pelanggaran dengan nama subkriteria (untuk laporan / tampilan tabel)
     */
    public function getFullData()
    {
        return $this->db->table($this->table)
            ->select('pelanggaran.*, siswa.nama, 
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
    }

    /**
     * Ambil data pelanggaran berdasarkan ID siswa
     */
    public function getBySiswa($id_siswa)
    {
        return $this->where('id_siswa', $id_siswa)
            ->orderBy('tanggal', 'DESC')
            ->findAll();
    }

    /**
     * Ambil ringkasan mingguan (misalnya untuk laporan per minggu)
     */
    public function getWeeklySummary()
    {
        return $this->db->table($this->table)
            ->select('YEARWEEK(tanggal, 1) as minggu, COUNT(*) as total_pelanggaran')
            ->groupBy('minggu')
            ->orderBy('minggu', 'ASC')
            ->get()->getResultArray();
    }

    /**
     * Simpan data pelanggaran dengan default tanggal hari ini
     */
    public function savePelanggaran($data)
    {
        if (!isset($data['tanggal']) || empty($data['tanggal'])) {
            $data['tanggal'] = date('Y-m-d'); // ✅ default tanggal hari ini
        }

        return $this->save($data);
    }
}

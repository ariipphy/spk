<?php

namespace App\Models;

use CodeIgniter\Model;

class TopsisModel extends Model
{
    protected $table = 'topsis_hasil'; // nama tabel hasil topsis kamu
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_siswa', 'nilai_preferensi', 'rekomendasi_sanksi', 'tanggal'];

    // ambil semua hasil
    public function getAllHasil()
    {
        return $this->select('topsis_hasil.*, siswa.nama as nama_siswa, siswa.kelas')
                    ->join('siswa', 'siswa.id = topsis_hasil.id_siswa')
                    ->orderBy('topsis_hasil.nilai_preferensi', 'DESC')
                    ->findAll();
    }

    // ambil hasil per siswa
    public function getHasilBySiswa($id_siswa)
    {
        return $this->select('topsis_hasil.*, siswa.nama as nama_siswa, siswa.kelas')
                    ->join('siswa', 'siswa.id = topsis_hasil.id_siswa')
                    ->where('topsis_hasil.id_siswa', $id_siswa)
                    ->first();
    }
}

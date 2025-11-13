<?php

namespace App\Models;
use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'nis', 'nama', 'kelas', 'jenis_kelamin'];
}
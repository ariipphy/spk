<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiKriteriaModel extends Model
{
    protected $table = 'nilai_kriteria';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pelanggaran', 'id_kriteria', 'nilai'];
}

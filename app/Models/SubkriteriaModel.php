<?php

namespace App\Models;

use CodeIgniter\Model;

class SubkriteriaModel extends Model
{
    protected $table = 'subkriteria';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_kriteria', 'nama_subkriteria', 'nilai'];
}

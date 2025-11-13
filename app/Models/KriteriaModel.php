<?php

namespace App\Models;

use CodeIgniter\Model;
namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table = 'kriteria';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_kriteria', 'nama_kriteria', 'bobot'];
}

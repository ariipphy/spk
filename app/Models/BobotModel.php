<?php

namespace App\Models;
use CodeIgniter\Model;

class BobotModel extends Model
{
    protected $table = 'bobot_kriteria';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_kriteria', 'nama_kriteria', 'bobot'];
}

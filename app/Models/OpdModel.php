<?php

namespace App\Models;

use CodeIgniter\Model;

class OpdModel extends Model
{
    protected $table = 'opd';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama'];
    protected $useTimestamps = false;

    // Ambil semua data OPD
    public function getAllOpd()
    {
        return $this->findAll();
    }
}

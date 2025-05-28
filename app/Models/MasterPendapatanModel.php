<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterPendapatanModel extends Model
{
    protected $table = 'master_pendapatan';
    protected $primaryKey = 'kode';
    
    protected $allowedFields = ['kode', 'uraian', 'id_opd', 'jumlah', 'tahun', 'created_at'];

    // Mendapatkan data pendapatan dengan nama OPD
    public function getPendapatanWithOPD()
    {
        return $this->select('master_pendapatan.*, opd.nama AS nama_opd')
                    ->join('opd', 'opd.id = master_pendapatan.id_opd', 'left')
                    ->findAll();
    }
    public function deleteData($kode)
    {
        return $this->where('kode', $kode)->delete(); 
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class PendapatanModel extends Model
{
    protected $table      = 'pendapatan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_users','id_opd','master_pendapatan_kode', 'uraian','tanggal', 'jumlah_pendapatan', 'keterangan', 'no_bukti', 'kategori'];

    public function getPendapatan($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuBesarModel extends Model
{
    protected $table = 'pendapatan';
    protected $primaryKey = 'id';

    public function getBukuBesar($id_opd = null)
    {
        $builder = $this->db->table('pendapatan');
        $builder->select('
            pendapatan.tanggal,
            pendapatan.uraian,
            pendapatan.no_bukti,
            pendapatan.jumlah_pendapatan AS penerimaan,
            master_pendapatan.jumlah AS saldo,
            master_pendapatan.kode
        ');
        $builder->join('master_pendapatan', 'pendapatan.master_pendapatan_kode = master_pendapatan.kode', 'left');

        // Filter hanya data pendapatan milik OPD yang login
        if ($id_opd) {
            $builder->where('pendapatan.id_opd', $id_opd);
        }

        $builder->orderBy('pendapatan.tanggal', 'ASC');
        return $builder->get()->getResultArray();
    }
}
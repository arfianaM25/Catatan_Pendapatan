<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanRealisasiModel extends Model
{
    protected $table = 'master_pendapatan';
    protected $primaryKey = 'id';

    // Ambil data anggaran dan realisasi per kode rekening, filter OPD jika ada
    public function getRealisasi($id_opd = null)
    {
        $builder = $this->select('
                master_pendapatan.kode,
                master_pendapatan.uraian,
                master_pendapatan.jumlah AS anggaran,
                COALESCE(SUM(pendapatan.jumlah_pendapatan), 0) AS realisasi
            ')
            ->join('pendapatan', 'pendapatan.master_pendapatan_kode = master_pendapatan.kode', 'left')
            ->groupBy('master_pendapatan.kode, master_pendapatan.uraian, master_pendapatan.jumlah');

        if ($id_opd) {
            $builder->where('master_pendapatan.id_opd', $id_opd);
        }

        return $builder->findAll();
    }
}
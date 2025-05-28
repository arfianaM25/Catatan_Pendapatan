<?php

namespace App\Models;

use CodeIgniter\Model;

class RekonsiliasiModel extends Model
{
    protected $table = 'master_pendapatan';
    protected $primaryKey = 'id';

    // Ambil data rekonsiliasi: uraian, anggaran, realisasi BPKAD, realisasi OPD, selisih
    public function getRekonsiliasi($id_opd = null)
    {
        if ($id_opd === null) {
            // Untuk admin/BUD: tampilkan semua, realisasi_opd dikosongkan
            $builder = $this->select('
                master_pendapatan.kode,
                master_pendapatan.uraian,
                master_pendapatan.jumlah AS anggaran,
                (SELECT COALESCE(SUM(jumlah_pendapatan),0) FROM pendapatan WHERE master_pendapatan_kode = master_pendapatan.kode) AS realisasi_bpkad,
                NULL AS realisasi_opd
            ');
        } else {
            // Untuk user OPD: filter data OPD, realisasi_opd hanya milik sendiri
            $builder = $this->select('
                master_pendapatan.kode,
                master_pendapatan.uraian,
                master_pendapatan.jumlah AS anggaran,
                (SELECT COALESCE(SUM(jumlah_pendapatan),0) FROM pendapatan WHERE master_pendapatan_kode = master_pendapatan.kode) AS realisasi_bpkad,
                (SELECT COALESCE(SUM(jumlah_pendapatan),0) FROM pendapatan WHERE master_pendapatan_kode = master_pendapatan.kode AND id_opd = '.$this->db->escape($id_opd).') AS realisasi_opd
            ')
            ->where('master_pendapatan.id_opd', $id_opd);
        }
        return $builder->findAll();
    }
}
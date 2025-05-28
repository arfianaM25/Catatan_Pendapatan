<?php

namespace App\Controllers;

use App\Models\PendapatanModel;
use App\Models\MasterPendapatanModel;

class Dashboard extends BaseController
{
    protected $pendapatanModel;
    protected $masterPendapatanModel;

    public function __construct()
    {
        $this->pendapatanModel = new PendapatanModel();
        $this->masterPendapatanModel = new MasterPendapatanModel();
    }

    public function index()
    {
        $id_opd = session()->get('id_opd'); // ID OPD dari user yang login

        // Total Anggaran untuk OPD yang login
        $total_anggaran = $this->masterPendapatanModel
            ->where('id_opd', $id_opd)
            ->selectSum('jumlah')
            ->first()['jumlah'] ?? 0;

        // Total Realisasi untuk OPD yang login
        $total_realisasi = $this->pendapatanModel
            ->where('id_opd', $id_opd)
            ->selectSum('jumlah_pendapatan')
            ->first()['jumlah_pendapatan'] ?? 0;

        // Total Selisih
        $total_selisih = $total_anggaran - $total_realisasi;

        // 5 Pendapatan terakhir untuk OPD yang login
        $pendapatan_terakhir = $this->pendapatanModel
            ->where('id_opd', $id_opd)
            ->orderBy('tanggal', 'DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'total_anggaran' => $total_anggaran,
            'total_realisasi' => $total_realisasi,
            'total_selisih' => $total_selisih,
            'pendapatan_terakhir' => $pendapatan_terakhir
        ];

        return view('dashboard/index', $data);
    }
}
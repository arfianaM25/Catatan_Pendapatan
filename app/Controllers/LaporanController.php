<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaporanRealisasiModel;
use App\Models\OpdModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\BukuBesarModel;

class LaporanController extends BaseController
{
    protected $laporanRealisasiModel;
    protected $opdModel;

    public function __construct()
    {
        $this->laporanRealisasiModel = new LaporanRealisasiModel();
        $this->opdModel = new OpdModel();
    }

public function realisasi()
{
    $role = session()->get('role');
    $id_opd = session()->get('id_opd');

    // Jika BUD/admin, tampilkan semua OPD
    $filter_opd = ($role === 'BPKAD' || $role === 'admin') ? null : $id_opd;

    $opd = $this->opdModel->find($id_opd);
    $data['pendapatan'] = $this->laporanRealisasiModel->getRealisasi($filter_opd);
    $data['opd_nama'] = ($role === 'BPKAD' || $role === 'admin') 
    ? 'Semua OPD' 
    : (isset($opd['nama']) ? $opd['nama'] : '-');

    return view('laporan/realisasi', $data);
}

public function realisasiPdf()
{
    $role = session()->get('role');
    $id_opd = session()->get('id_opd');

    $filter_opd = ($role === 'BPKAD' || $role === 'admin') ? null : $id_opd;

    $opd = $this->opdModel->find($id_opd);
    $data['pendapatan'] = $this->laporanRealisasiModel->getRealisasi($filter_opd);
    $data['opd_nama'] = ($opd && isset($opd['nama'])) ? $opd['nama'] : '-';

    $html = view('laporan/realisasi_pdf', $data);

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    $dompdf->stream('laporan_realisasi.pdf', ['Attachment' => false]);
    exit();
}

public function bukuBesar()
{
    $role = session()->get('role');
    $id_opd = session()->get('id_opd');

    // Hanya tampilkan data pendapatan sesuai OPD user yang login
    $filter_opd = $id_opd;

    $bukuBesarModel = new BukuBesarModel();
    $data['buku_besar'] = $bukuBesarModel->getBukuBesar($filter_opd);

    $opd = $this->opdModel->find($id_opd);
    $data['opd_nama'] = ($opd && isset($opd['nama'])) ? $opd['nama'] : '-';

    return view('laporan/buku_besar', $data);
}

public function bukuBesarPdf()
{
    $role = session()->get('role');
    $id_opd = session()->get('id_opd');

    $filter_opd = ($role === 'BPKAD' || $role === 'admin') ? null : $id_opd;

    $bukuBesarModel = new BukuBesarModel();
    $data['buku_besar'] = $bukuBesarModel->getBukuBesar($filter_opd);

    $opd = $this->opdModel->find($id_opd);
    $data['opd_nama'] = ($opd && isset($opd['nama'])) ? $opd['nama'] : '-';

    $html = view('laporan/buku_besar_pdf', $data);

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    $dompdf->stream('buku_besar.pdf', ['Attachment' => false]);
    exit();
}
}
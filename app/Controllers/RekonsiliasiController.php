<?php

namespace App\Controllers;

use App\Models\RekonsiliasiModel;
use App\Models\OpdModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class RekonsiliasiController extends BaseController
{
// filepath: [RekonsiliasiController.php](http://_vscodecontentref_/0)
public function index()
{
    $rekonsiliasiModel = new RekonsiliasiModel();
    $opdModel = new OpdModel();

    $role = session()->get('role');
    $id_opd = session()->get('id_opd');

    // Jika BUD/admin, tampilkan semua rekonsiliasi
    $filter_opd = ($role === 'BPKAD' || $role === 'admin') ? null : $id_opd;

    $data['rekonsiliasi'] = $rekonsiliasiModel->getRekonsiliasi($filter_opd);

    // Nama OPD yang login
    if ($role === 'BPKAD' || $role === 'admin') {
        $data['opd_nama'] = 'Semua OPD';
    } else {
        $opd = $opdModel->find($id_opd);
        if (is_array($opd)) {
            $data['opd_nama'] = $opd['nama'] ?? '-';
        } elseif (is_object($opd)) {
            $data['opd_nama'] = $opd->nama ?? '-';
        } else {
            $data['opd_nama'] = '-';
        }
    }
    return view('rekonsiliasi/index', $data);
}

public function pdf()
{
    $rekonsiliasiModel = new RekonsiliasiModel();
    $opdModel = new OpdModel();

    $role = session()->get('role');
    $id_opd = session()->get('id_opd');

    $filter_opd = ($role === 'BPKAD' || $role === 'admin') ? null : $id_opd;

    $data['rekonsiliasi'] = $rekonsiliasiModel->getRekonsiliasi($filter_opd);

    if ($role === 'BPKAD' || $role === 'admin') {
        $data['opd_nama'] = 'Semua OPD';
    } else {
        $opd = $opdModel->find($id_opd);
        if (is_array($opd)) {
            $data['opd_nama'] = $opd['nama'] ?? '-';
        } elseif (is_object($opd)) {
            $data['opd_nama'] = $opd->nama ?? '-';
        } else {
            $data['opd_nama'] = '-';
        }
    }

    $html = view('rekonsiliasi/pdf', $data);

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream('berita_acara_rekonsiliasi.pdf', ['Attachment' => false]);
    exit();
}
}
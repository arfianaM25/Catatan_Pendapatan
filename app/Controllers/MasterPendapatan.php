<?php

namespace App\Controllers;

use App\Models\MasterPendapatanModel;
use CodeIgniter\Controller;
use App\Models\OpdModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MasterPendapatan extends Controller
{
    protected $masterPendapatanModel;

    public function __construct()
    {
        $this->masterPendapatanModel = new MasterPendapatanModel();
        
        // dd(session()->get('role'));
        // Cek apakah user sudah login dan role user adalah admin atau bendahara
        if (!session()->get('isLoggedIn') || !in_array(session()->get('role'), ['administrator', 'bendahara'])) {
            return redirect()->to('/')->with('error', 'Akses tidak diizinkan');
        }
    }

    // Menampilkan daftar pendapatan daerah
    public function index()
    {
        $tahun = $this->request->getPost('filterTahun') ?? date('Y');  // Mengambil tahun dari form atau default ke tahun sekarang
        $data['pendapatan'] = $this->masterPendapatanModel->getPendapatanWithOPD();

        $data['master_pendapatan'] = $this->masterPendapatanModel->findAll(); // Added this line to pass data for dropdown
        $opdModel = new \App\Models\OPDModel();
        $data['opd'] = $opdModel->findAll();
        return view('master_pendapatan/index', $data);
    }

    public function rekening()
    {
        $data['pendapatan'] = $this->masterPendapatanModel->getPendapatanWithOPD();
        $data['master_pendapatan'] = $this->masterPendapatanModel->findAll(); // Tambahkan ini
        $opdModel = new \App\Models\OPDModel();
        $data['opd'] = $opdModel->findAll();
        return view('master_pendapatan/rekening_pendapatan', $data);
    }

    public function opd()
    {
        $model = new OpdModel(); // Pakai model khusus untuk tabel OPD
        $data['opd'] = $model->findAll(); // Ambil semua data OPD
        return view('master_pendapatan/opd', $data); // Kirim ke view
    }
    
    // Form tambah pendapatan daerah
    public function create()
    {
        $data['master_pendapatan'] = $this->masterPendapatanModel->findAll();
        return view('master_pendapatan/rekening_pendapatan', $data);
    }

    // Simpan data pendapatan daerah
    public function store()
    {
        // Ambil data dari form
        $data = [
            'kode'   => $this->request->getPost('kode'),
            'uraian' => $this->request->getPost('uraian'),
            'id_opd' => $this->request->getPost('id_opd'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];

        // Simpan data ke model
        $this->masterPendapatanModel->save($data);

        return redirect()->to('/master_pendapatan')->with('message', 'Data berhasil ditambahkan');
    }

    // Menampilkan form upload
    public function upload()
    {
        return view('master_pendapatan/upload');
    }
    
    // Import data dari file
    public function import()
    {
        $file = $this->request->getFile('file');

        if (!$file->isValid() || $file->getExtension() !== 'xlsx') {
            return redirect()->to('/master_pendapatan')->with('error', 'File tidak valid! Harus dalam format .xlsx');
        }

        // Load model OPD
        $opdModel = new \App\Models\OpdModel();
        
        // Ambil semua data OPD untuk mapping nama ke ID
        $opdList = $opdModel->findAll();
        $opdMapping = [];
        
        // Buat mapping nama OPD ke ID
        foreach ($opdList as $opd) {
            $opdMapping[strtolower($opd['nama'])] = $opd['id'];
        }

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getTempName());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        foreach ($rows as $index => $row) {
            if ($index == 0) continue; // Skip header

            // Pastikan kolom 'kode' tidak kosong
            if (empty($row[0])) {
                continue; // Skip row jika kode kosong
            }

            // Ambil nama OPD dari file (asumsi kolom ke-3 berisi nama OPD)
            $opdName = trim($row[2] ?? '');
            $id_opd = null;
            
            // Cari ID OPD berdasarkan nama
            if (!empty($opdName)) {
                $id_opd = $opdMapping[strtolower($opdName)] ?? null;
                
                // Jika OPD tidak ditemukan, bisa tambahkan OPD baru
                if ($id_opd === null) {
                    // Opsi 1: Tambahkan OPD baru
                    $newOpdId = $opdModel->insert(['nama' => $opdName]);
                    $id_opd = $newOpdId;
                    $opdMapping[strtolower($opdName)] = $id_opd; // Update mapping
                    
                    // Opsi 2: Atau skip dan laporkan
                    // continue; // Skip row jika OPD tidak ditemukan
                }
            }

            $data = [
                'kode'   => trim($row[0]),  // Trim untuk menghapus spasi kosong
                'uraian' => $row[1] ?? '',
                'id_opd' => $id_opd,  // Gunakan ID OPD yang sudah dicari
                'jumlah' => !empty($row[3]) ? (float) str_replace(['.', ','], ['', '.'], $row[3]) : 0.00,
                'tahun'  => $row[5] ?? date('Y')  // Asumsi kolom ke-6 adalah tahun
            ];

            $this->masterPendapatanModel->insert($data);
        }

        return redirect()->to('/master_pendapatan/rekening')->with('message', 'Data berhasil diimport!');
    }

    public function update($kode)
    {
        $data = [
            'uraian' => $this->request->getPost('uraian'),
            'id_opd' => $this->request->getPost('id_opd'), // This correctly captures the OPD ID
            'jumlah' => $this->request->getPost('jumlah'),
        ];
    
        // Update record based on kode
        $this->masterPendapatanModel
            ->where('kode', $kode)
            ->set($data)
            ->update();
    
        // Redirect to 'rekening' page after update
        return redirect()->to('/master_pendapatan/rekening')->with('success', 'Data berhasil diperbarui!');
    }    

    public function destroy($kode)
    {
        // Validasi: pastikan data dengan kode tersebut ada
        $pendapatan = $this->masterPendapatanModel->find($kode);

        if (!$pendapatan) {
            return redirect()->to('/master_pendapatan/rekening')->with('error', 'Data tidak ditemukan.');
        }

        // Hapus data
        $this->masterPendapatanModel->delete($kode);

        // Redirect to 'rekening' page after deletion
        return redirect()->to('/master_pendapatan/rekening')->with('success', 'Data berhasil dihapus.');
    }
}
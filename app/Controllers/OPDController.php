<?php

namespace App\Controllers;

use App\Models\OPDModel;

class OPDController extends BaseController
{
    protected $opdModel;

    public function __construct()
    {
        $this->opdModel = new OPDModel();
    }

    // Tampilkan halaman utama data OPD
    public function index()
    {
        $data['opd'] = $this->opdModel->findAll();
        return view('master_opd/index', $data); // Pastikan view ini ada
    }

    // In OPDController.php, update the store() method:

public function store()
{
    $nama = $this->request->getPost('nama'); // Ambil input nama OPD

    // Cek apakah nama OPD sudah ada di database
    $existingOpd = $this->opdModel->where('nama', $nama)->first();

    if ($existingOpd) {
        // Set flashdata error jika OPD sudah ada
        session()->setFlashdata('duplicate_error', 'Nama OPD sudah ada. Silakan coba nama lain.');
        return redirect()->back()->withInput();  // Kembalikan input yang sama
    }

    // Jika tidak ada duplikat, simpan OPD baru
    $this->opdModel->save([
        'nama' => $nama
    ]);

    // Redirect atau tampilkan halaman success
    return redirect()->to('/opd')->with('success', 'Data OPD berhasil ditambahkan.');
}
    
public function update($id)
{
    $nama = $this->request->getPost('nama');

    // Cek apakah nama OPD sudah digunakan oleh entri lain (kecuali dirinya sendiri)
    $existingOpd = $this->opdModel
        ->where('nama', $nama)
        ->where('id !=', $id) // Jangan cek diri sendiri
        ->first();

    if ($existingOpd) {
        session()->setFlashdata('duplicate_error', 'Nama OPD sudah digunakan. Silakan pilih nama lain.');
        return redirect()->back()->withInput(); // Kembalikan ke form dengan input sebelumnya
    }

    // Jika valid, update data
    $this->opdModel->update($id, [
        'nama' => $nama
    ]);

    return redirect()->to('/opd')->with('success', 'Data OPD berhasil diubah.');
}
public function delete()
{
    $id = $this->request->getPost('id');

    if ($id) {
        $opdModel = new \App\Models\OpdModel(); // Pastikan modelnya benar
        $opd = $opdModel->find($id);

        if ($opd) {
            $opdModel->delete($id);
            return redirect()->to(base_url('opd'))->with('success', 'Data OPD berhasil dihapus.');
        } else {
            return redirect()->to(base_url('opd'))->with('error', 'Data OPD tidak ditemukan.');
        }
    }

    return redirect()->to(base_url('opd'))->with('error', 'ID OPD tidak valid.');
}
}
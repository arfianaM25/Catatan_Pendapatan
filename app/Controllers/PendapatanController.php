<?php

namespace App\Controllers;

use App\Models\PendapatanModel;
use App\Models\MasterPendapatanModel;
use App\Models\OpdModel;
use CodeIgniter\Controller;

class PendapatanController extends Controller
{
    protected $pendapatanModel;
    protected $masterPendapatanModel;
    protected $opdModel;

    public function __construct()
    {
        $this->pendapatanModel = new PendapatanModel();
        $this->masterPendapatanModel = new MasterPendapatanModel();
        $this->opdModel = new OpdModel();
    }

    public function index()
    {
        $role = session()->get('role');
        $idOpd = session()->get('id_opd');

        if ($role === 'Bendahara' || $role === 'BPKAD' || $role === 'DISKOMINFO') {
            $data['pendapatan'] = $this->pendapatanModel
                ->select('pendapatan.*, opd.nama')
                ->join('master_pendapatan', 'master_pendapatan.kode = pendapatan.master_pendapatan_kode')
                ->join('opd', 'opd.id = pendapatan.id_opd', 'left')
                ->where('pendapatan.id_opd', $idOpd)
                ->findAll();
        } else {
            $data['pendapatan'] = $this->pendapatanModel
                ->select('pendapatan.*, opd.nama')
                ->join('master_pendapatan', 'master_pendapatan.kode = pendapatan.master_pendapatan_kode')
                ->join('opd', 'opd.id = pendapatan.id_opd', 'left')
                ->findAll();
        }

        return view('pendapatan/index', $data);
    }

    public function create()
    {
        $role = session()->get('role');
        $idOpd = session()->get('id_opd');

        if ($role === 'Bendahara') {
            $data['master_pendapatan'] = $this->masterPendapatanModel->where('id_opd', $idOpd)->findAll();
        } else {
            $data['master_pendapatan'] = $this->masterPendapatanModel->findAll();
        }

        return view('pendapatan/create', $data);
    }

    public function store()
    {
        $kode = $this->request->getPost('master_pendapatan_kode');
        $masterData = $this->masterPendapatanModel->where('kode', $kode)->first();

        if (!$masterData) {
            return redirect()->back()->with('error', 'Data Master Pendapatan tidak ditemukan.');
        }

        $idOpd = (int) session()->get('id_opd');
        $opdData = $this->opdModel->find($idOpd);
        $role = session()->get('role');
        $roleOpd = session()->get('role_opd');
       
        $jumlahPendapatan = $this->request->getPost('jumlah_pendapatan');
        $jumlahPendapatan = floatval(str_replace(',', '.', $jumlahPendapatan));

        $kategori = $idOpd ? $roleOpd : $role;
        
        $save_data = [
            'master_pendapatan_kode' => $kode,
            'uraian' => $masterData['uraian'],
            'tanggal' => $this->request->getPost('tanggal'),
            'jumlah_pendapatan' => $jumlahPendapatan,
            'no_bukti' => $this->request->getPost('no_bukti'),
            'keterangan' => $this->request->getPost('keterangan'),
            'id_users' => (int) session()->get('user_id'),
            'id_opd' => $idOpd,
            'kategori' => $kategori
        ];

        $this->pendapatanModel->insert($save_data);

        return redirect()->to('/pendapatan')->with('message', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['pendapatan'] = $this->pendapatanModel->find($id);
        $data['master_pendapatan'] = $this->masterPendapatanModel->findAll();
        return view('pendapatan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'master_pendapatan_kode' => $this->request->getPost('kode'),
            'uraian' => $this->request->getPost('uraian'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jumlah_pendapatan' => $this->request->getPost('jumlah_pendapatan'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        $this->pendapatanModel->update($id, $data);

        return redirect()->to('/pendapatan')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $this->pendapatanModel->delete($id);
        return redirect()->to('/pendapatan')->with('success', 'Data berhasil dihapus.');
    }

    public function import()
    {
        // Check if user has permission to import
        $role = session()->get('role');
        if (!in_array(strtolower($role), ['administrator', 'bud'])) {
            return redirect()->to('/pendapatan')->with('error', 'Anda tidak memiliki akses untuk mengimport data.');
        }

        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $filePath = WRITEPATH . 'uploads/' . $fileName;
            $file->move(WRITEPATH . 'uploads', $fileName);

            try {
                if ($file->getClientExtension() == 'csv') {
                    $result = $this->importCsv($filePath);
                } elseif (in_array($file->getClientExtension(), ['xls', 'xlsx'])) {
                    $result = $this->importExcel($filePath);
                } else {
                    return redirect()->to('/pendapatan')->with('error', 'Format file tidak didukung. Gunakan .csv, .xls, atau .xlsx');
                }

                // Clean up uploaded file
                unlink($filePath);

                if ($result['success']) {
                    return redirect()->to('/pendapatan')->with('success', 
                        "Data berhasil diimport. {$result['imported']} data berhasil, {$result['skipped']} data dilewati.");
                } else {
                    return redirect()->to('/pendapatan')->with('error', 'Gagal mengimport data: ' . $result['message']);
                }

            } catch (\Exception $e) {
                // Clean up uploaded file on error
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                return redirect()->to('/pendapatan')->with('error', 'Error saat import: ' . $e->getMessage());
            }
        } else {
            return redirect()->to('/pendapatan')->with('error', 'Gagal mengunggah file.');
        }
    }

    private function importCsv($filePath)
    {
        $csv = array_map('str_getcsv', file($filePath));
        $imported = 0;
        $skipped = 0;
        $errors = [];

        // Skip header row if exists
        $startRow = 0;
        if (count($csv) > 0 && !is_numeric($csv[0][0])) {
            $startRow = 1;
        }

        for ($i = $startRow; $i < count($csv); $i++) {
            $row = $csv[$i];
            
            try {
                // Skip empty rows
                if (empty(array_filter($row))) {
                    $skipped++;
                    continue;
                }

                // Map columns according to format: KODE | URAIAN | Tanggal | JUMLAH (Rp) | Keterangan | No Bukti | nama_opd
                $kode = trim($row[0] ?? '');
                $uraian = trim($row[1] ?? '');
                $tanggal = $this->parseDate($row[2] ?? '');
                $jumlah = $this->parseAmount($row[3] ?? '');
                $keterangan = trim($row[4] ?? '');
                $noBukti = trim($row[5] ?? '');
                $namaOpd = trim($row[6] ?? '');

                // Validate required fields
                if (empty($kode) || empty($uraian) || empty($tanggal)) {
                    $skipped++;
                    $errors[] = "Row " . ($i + 1) . ": Data tidak lengkap (kode, uraian, atau tanggal kosong)";
                    continue;
                }

                // Find OPD ID
                $idOpd = null;
                if (!empty($namaOpd)) {
                    $opd = $this->opdModel->where('nama', $namaOpd)->first();
                    $idOpd = $opd ? $opd['id'] : null;
                }

                $data = [
                    'master_pendapatan_kode' => $kode,
                    'uraian' => $uraian,
                    'tanggal' => $tanggal,
                    'jumlah_pendapatan' => $jumlah,
                    'keterangan' => $keterangan,
                    'no_bukti' => $noBukti,
                    'id_users' => session()->get('user_id'),
                    'id_opd' => $idOpd,
                    'kategori' => $namaOpd ?: session()->get('role')
                ];

                $this->pendapatanModel->insert($data);
                $imported++;

            } catch (\Exception $e) {
                $skipped++;
                $errors[] = "Row " . ($i + 1) . ": " . $e->getMessage();
            }
        }

        return [
            'success' => true,
            'imported' => $imported,
            'skipped' => $skipped,
            'errors' => $errors
        ];
    }

    private function importExcel($filePath)
    {
        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();
            
            $imported = 0;
            $skipped = 0;
            $errors = [];

            // Start from row 2 (assuming row 1 is header)
            for ($row = 2; $row <= $highestRow; $row++) {
                try {
                    // Map columns according to format: KODE | URAIAN | Tanggal | JUMLAH (Rp) | Keterangan | No Bukti | nama_opd
                    $kode = trim($worksheet->getCell('A' . $row)->getCalculatedValue() ?? '');
                    $uraian = trim($worksheet->getCell('B' . $row)->getCalculatedValue() ?? '');
                    $tanggal = $this->parseExcelDate($worksheet->getCell('C' . $row));
                    $jumlah = $this->parseAmount($worksheet->getCell('D' . $row)->getCalculatedValue() ?? '');
                    $keterangan = trim($worksheet->getCell('E' . $row)->getCalculatedValue() ?? '');
                    $noBukti = trim($worksheet->getCell('F' . $row)->getCalculatedValue() ?? '');
                    $namaOpd = trim($worksheet->getCell('G' . $row)->getCalculatedValue() ?? '');

                    // Skip empty rows
                    if (empty($kode) && empty($uraian) && empty($tanggal)) {
                        $skipped++;
                        continue;
                    }

                    // Validate required fields
                    if (empty($kode) || empty($uraian) || empty($tanggal)) {
                        $skipped++;
                        $errors[] = "Row $row: Data tidak lengkap (kode, uraian, atau tanggal kosong)";
                        continue;
                    }

                    // Find OPD ID
                    $idOpd = null;
                    if (!empty($namaOpd)) {
                        $opd = $this->opdModel->where('nama', $namaOpd)->first();
                        $idOpd = $opd ? $opd['id'] : null;
                        
                        if (!$idOpd) {
                            $errors[] = "Row $row: OPD '$namaOpd' tidak ditemukan";
                        }
                    }

                    $data = [
                        'master_pendapatan_kode' => $kode,
                        'uraian' => $uraian,
                        'tanggal' => $tanggal,
                        'jumlah_pendapatan' => $jumlah,
                        'keterangan' => $keterangan,
                        'no_bukti' => $noBukti,
                        'id_users' => session()->get('user_id'),
                        'id_opd' => $idOpd,
                        'kategori' => $namaOpd ?: session()->get('role')
                    ];

                    $this->pendapatanModel->insert($data);
                    $imported++;

                } catch (\Exception $e) {
                    $skipped++;
                    $errors[] = "Row $row: " . $e->getMessage();
                }
            }

            return [
                'success' => true,
                'imported' => $imported,
                'skipped' => $skipped,
                'errors' => $errors
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'imported' => 0,
                'skipped' => 0
            ];
        }
    }

    /**
     * Parse date from various formats
     */
    private function parseDate($dateString)
    {
        if (empty($dateString)) {
            return null;
        }

        // Try different date formats
        $formats = [
            'Y-m-d',
            'd/m/Y',
            'd-m-Y',
            'm/d/Y',
            'm-d-Y',
            'd F Y',
            'j F Y'
        ];

        foreach ($formats as $format) {
            $date = \DateTime::createFromFormat($format, $dateString);
            if ($date !== false) {
                return $date->format('Y-m-d');
            }
        }

        // If all formats fail, try strtotime
        $timestamp = strtotime($dateString);
        if ($timestamp !== false) {
            return date('Y-m-d', $timestamp);
        }

        return null;
    }

    /**
     * Parse Excel date (handles both string and numeric dates)
     */
    private function parseExcelDate($cell)
    {
        $value = $cell->getCalculatedValue();
        
        if (empty($value)) {
            return null;
        }

        // If it's a numeric value (Excel date serial)
        if (is_numeric($value)) {
            try {
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
                return $date->format('Y-m-d');
            } catch (\Exception $e) {
                // Fall back to string parsing
                return $this->parseDate($value);
            }
        }

        // If it's a string, parse it
        return $this->parseDate($value);
    }

    /**
     * Parse amount from various formats
     */
    private function parseAmount($amountString)
    {
        if (empty($amountString)) {
            return 0.00;
        }

        // Remove currency symbols and spaces
        $cleaned = preg_replace('/[Rp\s\.]/', '', $amountString);
        
        // Replace comma with dot for decimal
        $cleaned = str_replace(',', '.', $cleaned);
        
        // Convert to float
        return floatval($cleaned);
    }
}
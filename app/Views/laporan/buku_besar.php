<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Besar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
    <style>
        .judul {
            text-align: center;
            margin-bottom: 0;
        }
        .subjudul {
            text-align: center;
            margin-top: 0;
            margin-bottom: 0;
        }
        .tahun {
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .periode {
            text-align: center;
            margin-bottom: 10px;
            font-size: 1rem;
        }
        .keterangan {
            margin-bottom: 20px;
        }
        .tte-box {
            width: 100%;
            margin-top: 60px;
        }
        .tte-box .tte-right {
            float: right;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?= $this->include('layouts/header'); ?>

    <div class="container-dashboard">
        <!-- Sidebar -->
        <?= $this->include('layouts/sidebar'); ?>

        <?php
        // Inisialisasi variabel tahun dan tanggal
        $tahun = date('Y');
        $tanggal_awal = "01-01-$tahun";
        $tanggal_akhir = "31-12-$tahun";
        // Inisialisasi rekening dan anggaran agar tidak error
        $rekening = isset($buku_besar[0]['uraian']) ? $buku_besar[0]['uraian'] : '-';
        $anggaran = isset($buku_besar[0]['saldo']) ? $buku_besar[0]['saldo'] : 0;
    ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Judul Laporan -->
            <div class="mb-2 text-center">
                <h2 class="judul" style="font-weight:700; letter-spacing:1px;">Buku Besar</h2>
                <div class="periode">Tanggal <?= $tanggal_awal ?> s/d <?= $tanggal_akhir ?></div>
            </div>

            <!-- Keterangan Laporan -->
            <div class="mb-3">
                <table style="width:100%; border:none;">
                    <tr>
                        <td style="width:150px;"><strong>OPD</strong></td>
                        <td style="width:10px;">:</td>
                        <td><?= esc($opd_nama) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Kegiatan</strong></td>
                        <td>:</td>
                        <td>Pendapatan</td>
                    </tr>
                    <tr>
                        <td><strong>Rekening</strong></td>
                        <td>:</td>
                        <td><?= esc($rekening) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Anggaran</strong></td>
                        <td>:</td>
                        <td><?= number_format($anggaran, 0, ',', '.') ?></td>
                    </tr>
                </table>
            </div>

            <!-- Tombol Ekspor PDF -->
            <div class="d-flex justify-content-end mb-3">
                <a href="<?= base_url('laporan/buku_besar/pdf') ?>" target="_blank" class="btn btn-danger shadow">
                    <i class="bi bi-file-earmark-pdf"></i> Ekspor PDF
                </a>
            </div>

            <!-- Tabel Buku Besar -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Uraian</th>
                                    <th>No. Bukti</th>
                                    <th class="text-end">Penerimaan</th>
                                    <th class="text-end">Saldo</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <!-- Baris Saldo Awal -->
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><b>Saldo Awal</b></td>
                                        <td></td>
                                        <td class="text-end"></td>
                                        <td class="text-end">0</td>
                                    </tr>
                                    <?php
                                        $no = 1;
                                        $total_penerimaan = 0;
                                        $saldo_awal = 0;
                                        $saldo_berjalan = $saldo_awal;
                                        foreach ($buku_besar as $index => $row):
                                            $penerimaan = $row['penerimaan'];
                                            $total_penerimaan += $penerimaan;
                                            $saldo_sebelum = $saldo_berjalan;
                                            $saldo_berjalan += $penerimaan; // Tambah saldo berjalan dengan penerimaan
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                                        <td><?= esc($row['uraian']) ?></td>
                                        <td><?= esc($row['no_bukti'] ?? '-') ?></td>
                                        <td class="text-end"><?= number_format($penerimaan, 0, ',', '.') ?></td>
                                        <td class="text-end"><?= number_format($saldo_berjalan, 0, ',', '.') ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-end"><?= number_format($total_penerimaan, 0, ',', '.') ?></th>
                                    <th class="text-end"><?= number_format(abs($saldo_berjalan), 0, ',', '.') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tanda Tangan Elektronik -->
            <div class="row mt-5">
                <div class="col-6"></div>
                <div class="col-6 text-center">
                    <div class="mb-5"></div>
                    <b>Pengguna Anggaran</b><br>
                    <span style="display:inline-block; height:60px;"></span><br>
                    <u><?= esc($nama_pengguna_anggaran ?? '................................') ?></u><br>
                    <span>NIP. <?= esc($nip_pengguna_anggaran ?? '.........................') ?></span>
                </div>
            </div>
        </div>

    <!-- Modal Profil -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Profil Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h6><?= session()->get('username'); ?></h6>
                        <p>Login Terakhir: <?= date('l, d F Y, H:i:s', strtotime(session()->get('last_login'))); ?></p>
                        <p>Role: <?= session()->get('role'); ?></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
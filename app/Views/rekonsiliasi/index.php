<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekonsiliasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css'); ?>">
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
    // Inisialisasi variabel tanggal jika belum ada
    $tanggal_sekarang = date('Y-m-d');
    $tgl = isset($tgl) ? $tgl : date('d', strtotime($tanggal_sekarang));
    $bln_angka = isset($bln_angka) ? $bln_angka : date('m', strtotime($tanggal_sekarang));
    $bln = isset($bln) ? $bln : date('F', strtotime($tanggal_sekarang));
    $thn = isset($thn) ? $thn : date('Y', strtotime($tanggal_sekarang));
?>

        <!-- Main Content -->
        <div class="main-content">
        <!-- Judul Laporan -->
        <div class="mb-2 text-center">
            <h2 class="mb-1" style="font-weight:700; letter-spacing:1px;">Berita Acara Rekonsiliasi</h2>
            <div>
                <strong>Nomor.973/2.<?= $tgl . '/' . $bln_angka . '/' . $thn ?></strong>
            </div>
            <div class="mb-3">
                <strong>TENTANG DATA PENERIMAAN PENDAPATAN <?= strtoupper(esc($opd_nama)) ?></strong>
            </div>
        </div>

        <p class="mt-4">
            Pada tanggal <?= $tgl . ' ' . $bln . ' ' . $thn ?> telah dilaksanakan rekonsiliasi Data Penerimaan Pendapatan sampai dengan Triwulan IV tahun 1014 antara BPKAD dan <?= esc($opd_nama) ?>, dimana dalam rekonsiliasi dimaksud telah dicapai kesepakatan antara kedua belah pihak sebagai berikut :
        </p>

        <!-- Tombol Ekspor PDF -->
        <div class="d-flex justify-content-end mb-2">
            <a href="<?= base_url('rekonsiliasi/pdf') ?>" target="_blank" class="btn btn-danger shadow">
                <i class="fa fa-file-pdf"></i> Ekspor PDF
            </a>
        </div>

        <!-- Tabel Rekonsiliasi -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th rowspan="2" class="text-center align-middle">No</th>
                                <th rowspan="2" class="text-center align-middle">Kode</th>
                                <th rowspan="2" class="text-center align-middle">Uraian</th>
                                <th rowspan="2" class="text-center align-middle">Anggaran</th>
                                <th colspan="2" class="text-center align-middle">Realisasi</th>
                                <th rowspan="2" class="text-center align-middle">Selisih</th>
                            </tr>
                            <tr>
                                <th class="text-center align-middle">BPKAD</th>
                                <th class="text-center align-middle">OPD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach ($rekonsiliasi as $row): 
                                $selisih = $row['realisasi_bpkad'] - $row['realisasi_opd'];
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($row['kode']) ?></td>
                                <td><?= esc($row['uraian']) ?></td>
                                <td class="text-end"><?= number_format($row['anggaran'], 0, ',', '.') ?></td>
                                <td class="text-end"><?= number_format($row['realisasi_bpkad'], 0, ',', '.') ?></td>
                                <td class="text-end"><?= number_format($row['realisasi_opd'], 0, ',', '.') ?></td>
                                <td class="text-end"><?= number_format($selisih, 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Jumlah</th>
                                <th class="text-end">
                                    <?= number_format(array_sum(array_column($rekonsiliasi, 'anggaran')), 0, ',', '.') ?>
                                </th>
                                <th class="text-end">
                                    <?= number_format(array_sum(array_column($rekonsiliasi, 'realisasi_bpkad')), 0, ',', '.') ?>
                                </th>
                                <th class="text-end">
                                    <?= number_format(array_sum(array_column($rekonsiliasi, 'realisasi_opd')), 0, ',', '.') ?>
                                </th>
                                <th class="text-end">
                                    <?php
                                        $total_selisih = 0;
                                        foreach ($rekonsiliasi as $row) {
                                            $total_selisih += $row['realisasi_bpkad'] - $row['realisasi_opd'];
                                        }
                                        echo number_format($total_selisih, 0, ',', '.');
                                    ?>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-start">
                                    <em>Keterangan Selisih:</em>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <p class="mt-4">
            Demikian berita acara ini dibuat untuk dilaksanakan sebagai perbaikan data-data.
        </p>

        <?php
            $tempat = "Jepara";
            // Format tanggal Indonesia: 27 Mei 2025
            $bulan = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
                7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            $tanggal_ttd = date('d') . ' ' . $bulan[(int)date('m')] . ' ' . date('Y');
        ?>
        <div style="width:100%; margin-top:40px;">
            <div style="width:45%; float:left; text-align:center;">
                <!-- Kosongkan kiri untuk tanggal -->
            </div>
            <div style="width:55%; float:right; text-align:right;">
                <?= $tempat ?>, <?= $tanggal_ttd ?>
            </div>
            <div style="clear:both"></div>
            <br><br><br>
            <div style="width:45%; float:left; text-align:center;">
                <b>KEPALA BIDANG PENDAPATAN<br>BPKAD KABUPATEN JEPARA</b><br><br>
                <img src="<?= base_url('barcode/barcode_kabid.png') ?>" alt="Barcode Kabid" style="width:90px;height:90px;"><br><br>
                <b>KARUMATITI., SE., M.M</b><br>
                NIP. 197210042004043001
            </div>
            <div style="width:45%; float:right; text-align:center;">
                <b>BENDAHARA PENERIMAAN<br>DPUPR KABUPATEN JEPARA</b><br><br>
                <img src="<?= base_url('barcode/barcode_bendahara.png') ?>" alt="Barcode Bendahara" style="width:90px;height:90px;"><br><br>
                <b>ARIF DARMAWAN</b><br>
                NIP. 197510272009011004
            </div>
            <div style="clear:both"></div>
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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Realisasi Pendapatan</title>
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

        <!-- Main Content -->
        <div class="main-content">
            <!-- Judul Laporan -->
           <div class="mb-4 text-center">
                <h2 class="mb-1" style="font-weight:700; letter-spacing:1px;">
                    <?php if (in_array(strtolower(session()->get('role')), ['administrator', 'bud'])): ?>
                        Laporan Realisasi Pendapatan SKPKD (Kabupaten Jepara)
                    <?php else: ?>
                        Laporan Realisasi Pendapatan
                    <?php endif; ?>
                </h2>
                <h4 class="mb-0"><?= esc($opd_nama) ?></h4>
                <div style="font-size:1.1rem;">Tahun : 2025</div>
            </div>

            <!-- Tombol Ekspor PDF -->
            <div class="d-flex justify-content-end mb-3">
                <a href="<?= base_url('laporan/realisasi/pdf') ?>" target="_blank" class="btn btn-danger shadow">
                    <i class="fa fa-file-pdf"></i> Ekspor PDF
                </a>
            </div>

            <!-- Tabel Realisasi -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th rowspan="2" class="align-middle text-center">Kode</th>
                                    <th rowspan="2" class="align-middle text-center">Uraian</th>
                                    <th rowspan="2" class="align-middle text-center">Anggaran</th>
                                    <th class="text-center" colspan="2">Realisasi</th>
                                    <th rowspan="2" class="align-middle text-center">Selisih (Lebih/Kurang)</th>
                                </tr>
                                <tr>
                                    <th class="align-middle text-center">Rupiah</th>
                                    <th class="align-middle text-center">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pendapatan as $row): 
                                    $selisih = $row['realisasi'] - $row['anggaran'];
                                    $presentase = ($row['anggaran'] != 0) ? ($row['realisasi'] / $row['anggaran']) * 100 : 0;
                                ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            <i class="fa fa-barcode"></i> <?= esc($row['kode']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <i class="fa fa-file-alt text-secondary"></i>
                                        <?= esc($row['uraian']) ?>
                                    </td>
                                    <td><?= number_format($row['anggaran'], 0, ',', '.') ?></td>
                                    <td>
                                        <span class="badge bg-success">
                                            <?= number_format($row['realisasi'], 0, ',', '.') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold"><?= number_format($presentase, 2, ',', '.') ?>%</span>
                                        <div class="progress mt-1" style="height: 8px; width: 80px;">
                                            <div class="progress-bar <?= $presentase >= 100 ? 'bg-success' : 'bg-primary' ?>" role="progressbar" style="width: <?= min($presentase, 100) ?>%;" aria-valuenow="<?= $presentase ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            <?= $selisih > 0 ? 'bg-warning text-dark' : ($selisih < 0 ? 'bg-danger' : 'bg-secondary') ?>">
                                            <?= number_format(abs($selisih), 0, ',', '.') ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
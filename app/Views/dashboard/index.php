<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard pengguna untuk PDP.">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css'); ?>">
    <style>
        body {
            background: #f6f8fb;
        }
        .dashboard-header {
            background: linear-gradient(90deg, #4e73df 0%, #1cc88a 100%);
            color: #fff;
            border-radius: 12px;
            padding: 32px 24px 24px 24px;
            margin-bottom: 32px;
            box-shadow: 0 4px 16px rgba(78,115,223,0.08);
        }
        .dashboard-header h2 {
            font-weight: 600;
            margin-bottom: 8px;
        }
        .dashboard-header p {
            margin-bottom: 0;
            font-size: 1.1rem;
        }
        .dashboard-card {
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 24px 20px;
            margin-bottom: 24px;
            background: #fff;
            transition: box-shadow 0.2s;
        }
        .dashboard-card:hover {
            box-shadow: 0 4px 16px rgba(78,115,223,0.13);
        }
        .dashboard-icon {
            font-size: 2.5rem;
            margin-right: 16px;
        }
        .dashboard-table th, .dashboard-table td {
            font-size: 0.98rem;
        }
        .dashboard-table th {
            background: #f1f3fa;
        }
        .btn-profile {
            position: absolute;
            top: 32px;
            right: 32px;
            z-index: 10;
        }
        @media (max-width: 767px) {
            .dashboard-header {
                padding: 24px 12px;
            }
            .btn-profile {
                top: 16px;
                right: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?= $this->include('layouts/header'); ?>

    <div class="container-dashboard position-relative">
        <?= $this->include('layouts/sidebar');?>

        <!-- Main Content -->
        <div class="main-content">
            <div class="dashboard-header mb-4 position-relative">
                <h2>Dashboard Catatan Pendapatan</h2>
                <p>Selamat datang, <b><?= esc(session()->get('username')) ?></b>!  
                <span class="d-block mt-1">Gunakan menu di samping untuk mengelola data pendapatan Anda.</span></p>
            </div>
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="dashboard-card d-flex align-items-center">
                        <span class="dashboard-icon text-primary"><i class="fa fa-wallet"></i></span>
                        <div>
                            <div class="fw-semibold text-secondary">Total Anggaran</div>
                            <h4 class="mb-0"><?= isset($total_anggaran) ? number_format($total_anggaran,0,',','.') : '0' ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="dashboard-card d-flex align-items-center">
                        <span class="dashboard-icon text-success"><i class="fa fa-money-bill-wave"></i></span>
                        <div>
                            <div class="fw-semibold text-secondary">Total Realisasi</div>
                            <h4 class="mb-0"><?= isset($total_realisasi) ? number_format($total_realisasi,0,',','.') : '0' ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="dashboard-card d-flex align-items-center">
                        <span class="dashboard-icon text-danger"><i class="fa fa-balance-scale"></i></span>
                        <div>
                            <div class="fw-semibold text-secondary">Total Selisih</div>
                            <h4 class="mb-0"><?= isset($total_selisih) ? number_format($total_selisih,0,',','.') : '0' ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-card">
                <h5 class="mb-3"><i class="fa fa-history text-info"></i> Pendapatan Terakhir</h5>
                <div class="table-responsive">
                    <table class="table table-bordered dashboard-table mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Uraian</th>
                                <th>No. Bukti</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($pendapatan_terakhir) && count($pendapatan_terakhir) > 0): ?>
                                <?php foreach($pendapatan_terakhir as $i => $row): ?>
                                <tr class="<?= $i % 2 == 0 ? 'table-light' : '' ?>">
                                    <td>
                                        <i class="fa fa-calendar-alt text-primary"></i>
                                        <?= esc($row['tanggal']) ?>
                                    </td>
                                    <td>
                                        <i class="fa fa-file-alt text-secondary"></i>
                                        <?= esc($row['uraian']) ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            <i class="fa fa-receipt"></i> <?= esc($row['no_bukti']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge <?= $row['jumlah_pendapatan'] >= 0 ? 'bg-success' : 'bg-danger' ?>">
                                            <i class="fa fa-money-bill-wave"></i>
                                            <?= number_format($row['jumlah_pendapatan'],0,',','.') ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data.</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
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
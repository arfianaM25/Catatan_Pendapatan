<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data OPD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            font-family: 'Poppins', serif;
            background-color: #f8f9fa;
        }
        .header {
            height: 60px;
            background-color: #003366;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }
        .nav-menu {
            display: flex;
            align-items: center;
        }
        .profile-btn {
            background: white;
            color: #003366;
            border-radius: 6px;
            padding: 6px 12px; /* Adjusted padding for a slightly smaller button */
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px; /* Adjusted gap for consistency */
            cursor: pointer;
            border: none;
            font-size: 15px; /* Slightly smaller font size */
        }
        .profile-btn:hover {
            background: #e6e6e6;
        }
        .container-dashboard {
            display: flex;
            height: calc(100vh - 60px);
        }
        .sidebar {
            width: 200px; /* Set sidebar width */
            background: #f0f0f0;
            padding: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            border-right: 1px solid #ddd;
        }
        .sidebar a {
            color: #003366;
            text-decoration: none;
            font-weight: 500;
            padding: 8px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }
        .sidebar a:hover {
            background: rgba(0, 51, 102, 0.1);
        }
        .main-content {
            flex-grow: 1;
            padding: 25px; /* Adjusted padding */
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center; /* Center content horizontally */
        }
        .modal-header {
            background-color: #003366;
            color: white;
        }
        .btn-close {
            filter: invert(1); /* Change close button color to white */
        }
        .button-group {
            display: flex;
            justify-content: flex-start;
            gap: 15px;
            width: 100%; /* Full width for button group */
        }
        .btn-tambah {
            background-color: #28a745; /* Green color */
            color: white;
            padding: 8px 16px; /* Adjusted padding for consistency with Pendapatan */
            border-radius: 5px;
            font-size: 15px; /* Font size to match */
        }
        .btn-tambah:hover {
            background-color: #28a745; /* Darker green on hover */
        }
        .hidden {
            display: none;
        }
        .footer {
            background-color: #003366;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: auto;
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    <div class="header-title" style="font-size: 28px; font-weight: bold;">PBP</div>
    <div class="nav-menu">
        <div class="dropdown">
            <button class="profile-btn dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i> <span id="selectedUser"><?= session()->get('username'); ?></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profileModal"><i class="fa-solid fa-user-circle"></i> Lihat Profil</button>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="<?= base_url('auth/logout'); ?>"><i class="fa-solid fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Tombol Toggle Sidebar untuk mobile -->
<button class="sidebar-toggle d-md-none" onclick="toggleSidebar()">&#9776;</button>

<!-- Container Dashboard -->
<div class="container-dashboard">

    <!-- Sidebar -->
    <?= view('layouts/sidebar') ?>

    <!-- Main Content -->
    <div class="main-content">
   
    <!-- Accordion Judul dan Deskripsi -->
    <div class="accordion mb-4 w-100" id="accordionHeaderOPD">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOPD">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOPD" aria-expanded="true" aria-controls="collapseOPD"
                    style="background: linear-gradient(90deg, #4e73df 0%, #1cc88a 100%); color: #fff; font-size:1.3rem; font-weight:700;">
                    <i class="fa fa-building me-2"></i> Master Data OPD
                </button>
            </h2>
            <div id="collapseOPD" class="accordion-collapse collapse show" aria-labelledby="headingOPD" data-bs-parent="#accordionHeaderOPD">
                <div class="accordion-body" style="background: #f8f9fa;">
                    <span class="fs-6 text-dark">Kelola data Organisasi Perangkat Daerah (OPD) dengan mudah dan cepat.</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Tombol Tambah -->
    <div class="button-group mb-3 w-100 d-flex justify-content-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahOPD">
            <i class="fa fa-plus"></i> Tambah OPD
        </button>
    </div>

    <!-- Tabel Data OPD -->
    <div class="card shadow-sm w-100">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 10%;">ID</th>
                            <th>Nama OPD</th>
                            <th style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($opd) && is_array($opd)) : ?>
                            <?php foreach ($opd as $i => $row): ?>
                                <tr class="<?= $i % 2 == 0 ? 'table-light' : '' ?>">
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            <i class="fa fa-hashtag"></i> <?= esc($row['id']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <i class="fa fa-building text-secondary"></i>
                                        <span class="fw-semibold"><?= esc($row['nama']) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <button class="btn btn-warning btn-sm" onclick="openEditModal(<?= esc($row['id']) ?>, '<?= esc($row['nama']) ?>')">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm" onclick="openHapusModal(<?= esc($row['id']) ?>, '<?= esc($row['nama']) ?>')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center">Data OPD belum tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah OPD -->
<div class="modal fade" id="modalTambahOPD" tabindex="-1" aria-labelledby="modalTambahOPDLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('opd/store'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahOPDLabel"><i class="fa fa-plus-circle"></i> Tambah OPD</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_opd" class="form-label">Nama OPD</label>
                        <input type="text" class="form-control" id="nama_opd" name="nama" value="<?= old('nama'); ?>" placeholder="Contoh: Diskominfo" required>
                        <small class="form-text text-muted">Masukkan nama OPD secara singkat.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Duplikat -->
<div class="modal fade" id="modalDuplikat" tabindex="-1" aria-labelledby="modalDuplikatLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalDuplikatLabel"><i class="fa fa-exclamation-triangle"></i> Duplikat OPD</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
    </div>
    <div class="modal-body">
        Nama OPD yang kamu masukkan sudah ada. Silakan gunakan nama yang berbeda.
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
    </div>
    </div>
</div>
</div>

<!-- Modal Edit OPD -->
<div class="modal fade" id="modalEditOPD" tabindex="-1" aria-labelledby="modalEditOPDLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditOPD" method="post">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #003366; color: white;">
                    <h5 class="modal-title" id="modalEditOPDLabel"><i class="fa fa-edit"></i> Edit OPD</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id_opd">
                    <div class="mb-3">
                        <label for="edit_nama_opd" class="form-label">Nama OPD</label>
                        <input type="text" class="form-control" id="edit_nama_opd" name="nama" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus OPD -->
<div class="modal fade" id="modalHapusOPD" tabindex="-1" aria-labelledby="modalHapusOPDLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formHapusOPD" method="post">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #003366; color: white;">
                    <h5 class="modal-title" id="modalHapusOPDLabel"><i class="fa fa-trash"></i> Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah kamu yakin ingin menghapus data OPD <strong id="hapus_nama_opd"></strong>?</p>
                    <input type="hidden" name="id" id="hapus_id_opd">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Profil -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Profil Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Replace the existing script for showing the duplicate modal with this one -->
<?php if (session()->getFlashdata('duplicate_error')) : ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show the duplicate modal only if there's a duplicate error
        const errorModal = new bootstrap.Modal(document.getElementById('modalDuplikat'));
        errorModal.show();
    });
</script>

<?php endif; ?>
<script>
    function openEditModal(id, nama) {
        document.getElementById('edit_id_opd').value = id;
        document.getElementById('edit_nama_opd').value = nama;
        document.getElementById('formEditOPD').action = "<?= base_url('opd/update'); ?>/" + id;
        var editModal = new bootstrap.Modal(document.getElementById('modalEditOPD'));
        editModal.show();
    }

    function openHapusModal(id, nama) {
        document.getElementById('hapus_id_opd').value = id;
        document.getElementById('hapus_nama_opd').textContent = nama;
        document.getElementById('formHapusOPD').action = "<?= base_url('opd/delete'); ?>/" + id;
        var hapusModal = new bootstrap.Modal(document.getElementById('modalHapusOPD'));
        hapusModal.show();
    }
</script>

</body>
</html>
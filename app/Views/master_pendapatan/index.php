<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data Pendapatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .modal-header {
            background-color: #003366;
            color: white;
        }
        .btn-close {
            filter: invert(1); 
        }
        .button-group {
            display: flex;
            justify-content: flex-start;
            gap: 15px;
        }
        .btn-tambah {
            background-color: #28a745; 
            color: white;
        }
        .btn-tambah:hover {
            background-color: #218838; 
        }
        .btn-ubah {
            background-color: #007bff; 
            color: white;
        }
        .btn-ubah:hover {
            background-color: #0056b3; 
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
<?= $this->include('layouts/header'); ?>

<div class="container-dashboard">
    <!-- Sidebar -->
    <?= $this->include('layouts/sidebar'); ?>

    <!-- Main Content -->
<div class="main-content">
    <div class="bg-gradient p-4 rounded mb-4" style="background: linear-gradient(90deg, #4e73df 0%, #1cc88a 100%); color: #fff;">
        <h2 class="mb-1"><i class="fa fa-database"></i> Master Data Pendapatan</h2>
        <div>Kelola data master pendapatan dengan mudah dan cepat.</div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="filterTahun" class="form-label fw-semibold">Silahkan Pilih Tahun Data Pendapatan :</label>
            <select id="filterTahun" class="form-select">
                <option value="">-- Pilih Tahun --</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
            </select>
        </div>
        <div class="col-md-6 d-flex align-items-end justify-content-md-end mt-3 mt-md-0">
            <div class="button-group gap-2">
                <a href="#" class="btn btn-tambah" data-bs-toggle="modal" data-bs-target="#tambahPendapatanModal">
                    <i class="fa fa-plus"></i> Tambah Pendapatan
                </a>
                <a href="#" class="btn btn-ubah" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="fa fa-upload"></i> Upload Data
                </a>
            </div>
        </div>
    </div>
    <div id="dataTable" class="hidden">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Kode</th>
                                <th>Uraian</th>
                                <th>OPD</th>
                                <th>Jumlah (Rp)</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pendapatan as $row) : ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            <i class="fa fa-barcode"></i> <?= htmlspecialchars($row['kode']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <i class="fa fa-file-alt text-secondary"></i>
                                        <?= htmlspecialchars($row['uraian']); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            <i class="fa fa-building"></i> <?= htmlspecialchars($row['nama_opd']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">
                                            <i class="fa fa-money-bill-wave"></i>
                                            <?= number_format($row['jumlah'], 2, ',', '.'); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPendapatanModal" 
                                            data-kode="<?= htmlspecialchars($row['kode']); ?>" 
                                            data-uraian="<?= htmlspecialchars($row['uraian']); ?>" 
                                            data-opd="<?= htmlspecialchars($row['id_opd']); ?>" 
                                            data-jumlah="<?= htmlspecialchars($row['jumlah']); ?>">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                            data-kode="<?= htmlspecialchars($row['kode']); ?>" 
                                            data-uraian="<?= htmlspecialchars($row['uraian']); ?>" 
                                            data-opd="<?= htmlspecialchars($row['id_opd']); ?>" 
                                            data-jumlah="<?= htmlspecialchars($row['jumlah']); ?>" 
                                            data-id="<?= htmlspecialchars($row['kode']); ?>">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Tambah Pendapatan -->
<div class="modal fade" id="tambahPendapatanModal" tabindex="-1" aria-labelledby="tambahPendapatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPendapatanModalLabel">Tambah Data Pendapatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/master_pendapatan/store" method="post">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode:</label>
                        <select name="kode" id="kode" class="form-control" required>
                            <option value="">-- Pilih Kode --</option>
                            <?php foreach ($master_pendapatan as $mp) : ?>
                                <option value="<?= $mp['kode'] ?>" data-uraian="<?= htmlspecialchars($mp['uraian'], ENT_QUOTES) ?>">
                                    <?= $mp['kode'] ?> - <?= $mp['uraian'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="uraian" class="form-label">Uraian:</label>
                        <input type="text" name="uraian" id="uraian" class="form-control" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="opd" class="form-label">OPD:</label>
                        <select name="id_opd" class="form-control" required>
                            <option value="">-- Pilih OPD --</option>
                            <?php foreach ($opd as $row) : ?>
                                <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah:</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Upload Data -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload File Master Data Pendapatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master_pendapatan/import') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="file" class="form-label">Pilih File (CSV atau Excel):</label>
                        <input type="file" name="file" class="form-control" accept=".csv, .xls, .xlsx" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Edit Data Pendapatan -->
<div class="modal fade" id="editPendapatanModal" tabindex="-1" aria-labelledby="editPendapatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPendapatanModalLabel">Edit Data Pendapatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master_pendapatan/store') ?>" method="post">
                    <div class="mb-3">
                        <label for="edit_kode" class="form-label">Kode:</label>
                        <input type="text" id="edit_kode" name="kode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_uraian" class="form-label">Uraian:</label>
                        <input type="text" id="edit_uraian" name="uraian" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_opd" class="form-label">OPD:</label>
                        <select name="id_opd" id="edit_opd" class="form-control" required>
                            <option value="">-- Pilih OPD --</option>
                            <?php foreach ($opd as $row) : ?>
                                <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_jumlah" class="form-label">Jumlah:</label>
                        <input type="number" id="edit_jumlah" name="jumlah" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteForm" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah kamu yakin ingin menghapus data dengan kode <strong id="kodeDelete"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const editButtons = document.querySelectorAll('.btn-warning');
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const kode = button.getAttribute('data-kode');
            const uraian = button.getAttribute('data-uraian');
            const opd = button.getAttribute('data-opd');
            const jumlah = button.getAttribute('data-jumlah');

            document.getElementById('edit_kode').value = kode;
            document.getElementById('edit_uraian').value = uraian;
            document.getElementById('edit_jumlah').value = jumlah;

            // Mengatur nilai OPD yang dipilih
            document.getElementById('edit_opd').value = opd;

            const formAction = '<?= base_url('master_pendapatan/update/') ?>' + '/' + kode;
            document.getElementById('editPendapatanForm').setAttribute('action', formAction);
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const selectKode = document.getElementById('kode');
        const inputUraian = document.getElementById('uraian');

        if (selectKode) {
            selectKode.addEventListener('change', function () {
                const selectedOption = selectKode.options[selectKode.selectedIndex];
                inputUraian.value = selectedOption.getAttribute('data-uraian') || '';
            });
        }
    });

    document.querySelectorAll('.btn-danger').forEach(button => {
        button.addEventListener('click', () => {
            const kode = button.getAttribute('data-kode'); // Ambil kode dari data atribut
            const id = button.getAttribute('data-id'); // Ambil ID dari data atribut

            document.getElementById('kodeDelete').textContent = kode;
            document.getElementById('deleteForm').setAttribute('action', '/master_pendapatan/destroy/' + id); // Atur action form
        });
    });

    document.getElementById('filterTahun').addEventListener('change', function() {
        const dataTable = document.getElementById('dataTable');
        if (this.value) {
            dataTable.classList.remove('hidden');
        } else {
            dataTable.classList.add('hidden');
        }
    });
</script>

</body>
</html>
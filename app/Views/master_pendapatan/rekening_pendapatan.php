<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data Pendapatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
    <style>
        .modal-header {
            background-color: #003366;
            color: white;
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
        <!-- Accordion Judul dan Deskripsi -->
        <div class="accordion mb-4" id="accordionHeaderPendapatan">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingPendapatan">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePendapatan" aria-expanded="true" aria-controls="collapsePendapatan"
                        style="background: linear-gradient(90deg, #4e73df 0%, #1cc88a 100%); color: #fff; font-size:1.3rem; font-weight:600;">
                        <i class="fa fa-database me-2"></i> Master Data Pendapatan
                    </button>
                </h2>
                <div id="collapsePendapatan" class="accordion-collapse collapse show" aria-labelledby="headingPendapatan" data-bs-parent="#accordionHeaderPendapatan">
                    <div class="accordion-body" style="background: #f8f9fa;">
                        <span class="fs-6 text-dark">Kelola data rekening pendapatan dengan mudah dan cepat.</span>
                    </div>
                </div>
            </div>
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
                    <a href="#" class="btn btn-upload" data-bs-toggle="modal" data-bs-target="#uploadModal">
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
                                <?php foreach ($pendapatan as $i => $row) : ?>
                                    <tr class="<?= $i % 2 == 0 ? 'table-light' : '' ?>">
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
                <!-- Change the form ID to match the JavaScript reference and point to the update method -->
                <form id="editPendapatanForm" action="" method="post">
                    <div class="mb-3">
                        <label for="edit_kode" class="form-label">Kode:</label>
                        <input type="text" id="edit_kode" name="kode" class="form-control" readonly required>
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
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="deleteForm" method="post">
      <?= csrf_field(); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin menghapus data <strong id="kodeDelete"></strong>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
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

            // Set the selected OPD in the dropdown
            document.getElementById('edit_opd').value = opd;

            // Update the form action to point to the update method with the correct kode
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

    document.querySelectorAll('[data-kode]').forEach(button => {
    button.addEventListener('click', function () {
        const kode = this.getAttribute('data-kode');
        document.getElementById('kodeDelete').textContent = kode;
        document.getElementById('deleteForm').setAttribute('action', '/master_pendapatan/destroy/' + kode);
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
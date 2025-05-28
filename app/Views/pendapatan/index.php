<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendapatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
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
        }.search-bar {
            margin-bottom: 20px;
        }
        .btn-close {
            filter: invert(1); /* Change close button color to white */
        }
    </style>
</head>
<body>

<!-- Header -->
<?= $this->include('layouts/header'); ?>

<div class="container-dashboard">
    <?= $this->include('layouts/sidebar');?>

    <!-- Main Content -->
    <div class="main-content">
    
        <!-- Accordion Judul dan Deskripsi -->
        <div class="accordion mb-4 w-100" id="accordionHeaderPendapatan">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingPendapatan">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePendapatan" aria-expanded="true" aria-controls="collapsePendapatan"
                        style="background: linear-gradient(90deg, #4e73df 0%, #1cc88a 100%); color: #fff; font-size:1.3rem; font-weight:700;">
                        <i class="fa fa-coins me-2"></i> Data Pendapatan
                    </button>
                </h2>
                <div id="collapsePendapatan" class="accordion-collapse collapse show" aria-labelledby="headingPendapatan" data-bs-parent="#accordionHeaderPendapatan">
                    <div class="accordion-body" style="background: #f8f9fa;">
                        <span class="fs-6 text-dark">Kelola dan pantau data penerimaan pendapatan Anda dengan mudah dan cepat.</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="search-bar">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan Kode atau Uraian..." onkeyup="filterTable()">
        </div>

        <table class="table table-bordered table-hover align-middle mt-4" id="pendapatanTable">
            <div class="d-flex mt-3 gap-2 justify-content-start">
                <a href="/pendapatan/create" class="btn btn-success"><i class="fa-solid fa-plus"></i> Input Data Penerimaan</a>
                
                <!-- Import button - only show for Administrator and BUD roles -->
                <?php 
                $userRole = session()->get('role');
                if (in_array(strtolower($userRole), ['administrator', 'bud'])): 
                ?>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="fa-solid fa-file-import"></i> Import Data Penerimaan
                </button>
                <?php endif; ?>
            </div>
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Kode</th>
                    <th>Uraian</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendapatan as $key => $p) : ?>
                    <tr class="<?= $key % 2 == 0 ? 'table-light' : '' ?>">
                        <td><?= $key + 1 ?></td>
                        <td>
                            <span class="badge bg-info text-dark">
                                <i class="fa fa-tag"></i> <?= htmlspecialchars($p['kategori']) ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">
                                <i class="fa fa-barcode"></i> <?= htmlspecialchars($p['master_pendapatan_kode']) ?>
                            </span>
                        </td>
                        <td>
                            <i class="fa fa-file-alt text-secondary"></i>
                            <?= htmlspecialchars($p['uraian']) ?>
                        </td>
                        <td>
                            <i class="fa fa-calendar-alt text-primary"></i>
                            <?= date('d F Y', strtotime($p['tanggal'])) ?>
                        </td>
                        <td>
                            <span class="badge bg-success">
                                <i class="fa fa-money-bill-wave"></i>
                                Rp<?= is_numeric($p['jumlah_pendapatan']) && floor($p['jumlah_pendapatan']) == $p['jumlah_pendapatan'] 
                                    ? number_format($p['jumlah_pendapatan'], 0, ',', '.') 
                                    : number_format($p['jumlah_pendapatan'], 2, ',', '.') 
                                ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($p['keterangan']) ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="#" class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#detailModal"
                                data-id="<?= $p['id'] ?>"
                                data-kode="<?= htmlspecialchars($p['master_pendapatan_kode']) ?>"
                                data-uraian="<?= htmlspecialchars($p['uraian']) ?>"
                                data-tanggal="<?= date('d F Y', strtotime($p['tanggal'])) ?>"
                                data-jumlah_pendapatan="<?= htmlspecialchars($p['jumlah_pendapatan']) ?>"
                                data-no_bukti="<?= htmlspecialchars($p['no_bukti']) ?>"
                                data-keterangan="<?= htmlspecialchars($p['keterangan']) ?>">
                                    <span class="badge bg-info"><i class="fa-solid fa-eye"></i></span>
                                </a>
                                <a href="#" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editModal"
                                data-id="<?= $p['id'] ?>"
                                data-kode="<?= htmlspecialchars($p['master_pendapatan_kode']) ?>"
                                data-uraian="<?= htmlspecialchars($p['uraian']) ?>"
                                data-tanggal="<?= date('Y-m-d', strtotime($p['tanggal'])) ?>"
                                data-jumlah_pendapatan="<?= htmlspecialchars($p['jumlah_pendapatan']) ?>"
                                data-keterangan="<?= htmlspecialchars($p['keterangan']) ?>">
                                    <span class="badge bg-warning text-dark"><i class="fa-solid fa-edit"></i></span>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                data-id="<?= $p['id'] ?>"
                                data-kode="<?= htmlspecialchars($p['master_pendapatan_kode']) ?>">
                                    <span class="badge bg-danger"><i class="fa-solid fa-trash"></i></span>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('pendapatan/store'); ?>" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputModalLabel">Input Data Pendapatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="kode" class="form-label">Kode:</label>
                    <input type="text" id="kode" name="kode" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="uraian" class="form-label">Uraian:</label>
                    <input type="text" id="uraian" name="uraian" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal:</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah:</label>
                    <input type="number" id="jumlah" name="jumlah_pendapatan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan:</label>
                    <input type="text" id="keterangan" name="keterangan" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editForm" action="" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Pendapatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="edit_id">
                <div class="mb-3">
                    <label for="edit_kode" class="form-label">Kode:</label>
                    <input type="text" id="edit_kode" name="kode" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="edit_uraian" class="form-label">Uraian:</label>
                    <input type="text" id="edit_uraian" name="uraian" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="edit_tanggal" class="form-label">Tanggal:</label>
                    <input type="date" id="edit_tanggal" name="tanggal" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="edit_jumlah" class="form-label">Jumlah:</label>
                    <input type="number" id="edit_jumlah" name="jumlah_pendapatan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="edit_keterangan" class="form-label">Keterangan:</label>
                    <input type="text" id="edit_keterangan" name="keterangan" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data Pendapatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Kode:</strong> <span id="detail_kode"></span></li>
                    <li class="list-group-item"><strong>Uraian:</strong> <span id="detail_uraian"></span></li>
                    <li class="list-group-item"><strong>Tanggal:</strong> <span id="detail_tanggal"></span></li>
                    <li class="list-group-item"><strong>Jumlah:</strong> <span id="detail_jumlah_pendapatan"></span></li>
                    <li class="list-group-item"><strong>No Bukti:</strong> <span id="detail_no_bukti"></span></li>
                    <li class="list-group-item"><strong>Keterangan:</strong> <span id="detail_keterangan"></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteForm" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus data dengan kode <strong id="kodeDelete"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Import - Only show for Administrator and BUD roles -->
<?php 
$userRole = session()->get('role');
if (in_array(strtolower($userRole), ['administrator', 'bud'])): 
?>
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('pendapatan/import'); ?>" method="post" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data Pendapatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="file" class="form-label">Pilih File (.xlsx, .xls, .csv):</label>
                    <input type="file" name="file" id="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                </div>
                <p class="text-muted">Pastikan format file sesuai dengan kolom: <code>kode, uraian, tanggal, jumlah_pendapatan, keterangan</code></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

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

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // FILTER FUNCTIONALITY
    function filterTable() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const table = document.getElementById('pendapatanTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;
            for (let j = 1; j < cells.length - 1; j++) { // Skip No and Aksi
                if (cells[j].textContent.toLowerCase().includes(input)) {
                    found = true;
                    break;
                }
            }
            rows[i].style.display = found ? '' : 'none';
        }
    }

    document.getElementById('searchInput').addEventListener('keyup', filterTable);
    
    // EDIT
    document.querySelectorAll('.btn-warning').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;

            document.getElementById('editForm').setAttribute('action', '/pendapatan/update/' + id);
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_kode').value = button.dataset.kode;
            document.getElementById('edit_uraian').value = button.dataset.uraian;
            document.getElementById('edit_tanggal').value = button.dataset.tanggal;
            document.getElementById('edit_jumlah').value = button.dataset.jumlah_pendapatan;
            document.getElementById('edit_keterangan').value = button.dataset.keterangan;
        });
    });

    // DETAIL
    document.querySelectorAll('.btn-info').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('detail_kode').textContent = button.dataset.kode;
            document.getElementById('detail_uraian').textContent = button.dataset.uraian;
            document.getElementById('detail_tanggal').textContent = button.dataset.tanggal;
            document.getElementById('detail_jumlah_pendapatan').textContent = 'Rp' + 
    (Number.isInteger(parseFloat(button.dataset.jumlah_pendapatan)) 
        ? parseFloat(button.dataset.jumlah_pendapatan).toLocaleString('id-ID')
        : parseFloat(button.dataset.jumlah_pendapatan).toLocaleString('id-ID', { minimumFractionDigits: 2 }));
            document.getElementById('detail_no_bukti').textContent = button.dataset.no_bukti;
            document.getElementById('detail_keterangan').textContent = button.dataset.keterangan;
        });
    });

    // Hapus
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const kode = button.getAttribute('data-kode');

            // Isi teks konfirmasi kode
            document.getElementById('kodeDelete').textContent = kode;

            // Isi URL form delete
            const form = document.getElementById('deleteForm');
            form.setAttribute('action', '/pendapatan/delete/' + id);
        });
    });
</script>
</body>
</html>
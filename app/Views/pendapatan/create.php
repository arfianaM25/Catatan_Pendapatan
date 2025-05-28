<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pendapatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
</head>
<body>

<!-- Header -->
<?= $this->include('layouts/header'); ?>

<div class="container-dashboard">
    <?= $this->include('layouts/sidebar');?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="accordion mb-4 w-100" id="accordionHeaderInputPendapatan">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingInputPendapatan">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInputPendapatan" aria-expanded="true" aria-controls="collapseInputPendapatan"
                        style="background: linear-gradient(90deg, #4e73df 0%, #1cc88a 100%); color: #fff; font-size:1.3rem; font-weight:700;">
                        <i class="fa-solid fa-plus me-2"></i> Input Data Penerimaan
                    </button>
                </h2>
                <div id="collapseInputPendapatan" class="accordion-collapse collapse show" aria-labelledby="headingInputPendapatan" data-bs-parent="#accordionHeaderInputPendapatan">
                    <div class="accordion-body" style="background: #f8f9fa;">
                        <span class="fs-6 text-dark">Silakan lengkapi form berikut untuk menambah data penerimaan pendapatan.</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form Tambah Pendapatan -->
        <div class="card p-4 shadow-sm">
            <form action="/pendapatan/store" method="post">
                <div class="mb-3">
                    <label class="form-label">Kode Penerimaan</label>
                    <select name="master_pendapatan_kode" class="form-control select2" required>
                        <option value="" disabled selected>Pilih Kode</option>
                        <?php foreach ($master_pendapatan as $m) : ?>
                            <option value="<?= htmlspecialchars($m['kode']) ?>">
                                <?= htmlspecialchars($m['kode']) ?> - <?= htmlspecialchars($m['uraian']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <!-- Mengubah tipe input dari number menjadi text dengan format mata uang -->
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="jumlah_pendapatan" id="jumlah_pendapatan" class="form-control" 
                               required placeholder="Contoh: 1000000">
                    </div>
                    <div class="form-text">Masukkan angka tanpa titik atau koma sebagai pemisah ribuan</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">No.Bukti</label>
                    <input type="text" name="no_bukti" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/pendapatan" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Cari atau pilih kode...",
            allowClear: true
        });
        
        // Format tampilan nilai saat user mengetik
        $('#jumlah_pendapatan').on('input', function() {
            // Hapus semua karakter non-angka
            let value = $(this).val().replace(/[^0-9]/g, '');
            
            // Format dengan penanda ribuan
            if (value !== '') {
                value = parseInt(value, 10).toLocaleString('id-ID');
            }
            
            $(this).val(value);
        });
        
        // Saat form disubmit, pastikan nilai yang dikirim ke server bersih (tanpa format)
        $('form').on('submit', function() {
            let rawValue = $('#jumlah_pendapatan').val().replace(/\./g, '');
            $('#jumlah_pendapatan').val(rawValue);
            return true;
        });
    });
</script>
</body>
</html>
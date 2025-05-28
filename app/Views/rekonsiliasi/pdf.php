<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Rekonsiliasi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 6px; }
        th { background: #eee; }
        .judul, .subjudul, .tahun { text-align: center; margin: 0; }
        .tte-box { width: 100%; margin-top: 60px; }
        .tte-right { float: right; text-align: center; }
        .tte-left { float: left; text-align: center; }
    </style>
</head>
<body>
    <h2 class="judul">Berita Acara Rekonsiliasi</h2>
    <?php
        $tgl = date('d');
        $bln_indo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $bln = $bln_indo[(int)date('m')];
        $bln_angka = date('m');
        $thn = date('Y');
    ?>
   <div style="text-align:center; margin-bottom:4px;">
        <strong>Nomor.973/2.<?= $tgl . '/' . $bln_angka . '/' . $thn ?></strong>
    </div>
    <div style="text-align:center; margin-bottom:12px;">
        <strong>TENTANG DATA PENERIMAAN PENDAPATAN <?= strtoupper(esc($opd_nama)) ?></strong>
    </div>
    <p>
        Pada tanggal <?= $tgl . ' ' . $bln . ' ' . $thn ?> telah dilaksanakan rekonsiliasi Data Penerimaan Pendapatan sampai dengan Triwulan IV tahun 1014 antara BPKAD dan <?= esc($opd_nama) ?>, dimana dalam rekonsiliasi dimaksud telah dicapai kesepakatan antara kedua belah pihak sebagai berikut :
    </p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Uraian</th>
                <th>Anggaran</th>
                <th>Realisasi (BPKAD)</th>
                <th>Realisasi (OPD)</th>
                <th>Selisih</th>
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
                <td><?= number_format($row['anggaran'], 0, ',', '.') ?></td>
                <td><?= number_format($row['realisasi_bpkad'], 0, ',', '.') ?></td>
                <td><?= number_format($row['realisasi_opd'], 0, ',', '.') ?></td>
                <td><?= number_format($selisih, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Jumlah</th>
                <th><?= number_format(array_sum(array_column($rekonsiliasi, 'anggaran')), 0, ',', '.') ?></th>
                <th><?= number_format(array_sum(array_column($rekonsiliasi, 'realisasi_bpkad')), 0, ',', '.') ?></th>
                <th><?= number_format(array_sum(array_column($rekonsiliasi, 'realisasi_opd')), 0, ',', '.') ?></th>
                <th>
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
                    <em>
                        Keterangan Selisih: Selisih adalah hasil pengurangan antara Realisasi (BPKAD) dan Realisasi (OPD) pada setiap baris, serta total selisih adalah penjumlahan seluruh selisih.
                    </em>
                </td>
            </tr>
        </tfoot>
    </table>
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
        <br><br><br> <!-- Jeda untuk tanda tangan -->
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
</body>
</html>
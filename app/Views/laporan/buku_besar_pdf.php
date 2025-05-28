<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Besar</title>
    <style>
        @page {
            size: A4;
            margin: 20mm 15mm 20mm 15mm;
        }
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 6px; }
        th { background: #eee; }
        .judul, .periode { text-align: center; margin: 0; }
        .keterangan { margin-bottom: 20px; }
        .tte-box { width: 100%; margin-top: 60px; }
        .tte-right { float: right; text-align: center; }
    </style>
</head>
<body>
    <h2 class="judul">Buku Besar</h2>
    <?php
        $tahun = date('Y');
        $tanggal_awal = "01-01-$tahun";
        $tanggal_akhir = "31-12-$tahun";
        $rekening = isset($buku_besar[0]['uraian']) ? $buku_besar[0]['uraian'] : '-';
        $anggaran = isset($buku_besar[0]['saldo']) ? $buku_besar[0]['saldo'] : 0;
    ?>
    <div class="periode">Tanggal <?= $tanggal_awal ?> s/d <?= $tanggal_akhir ?></div>
    <br>
    <br>
    <div class="keterangan" style="margin-bottom:20px;">
        <div>
            <span style="display:inline-block; width:120px;"><strong>OPD</strong></span>
            <span style="display:inline-block; width:10px;">:</span>
            <span style="display:inline-block; min-width:200px;"><?= esc($opd_nama) ?></span>
        </div>
        <div>
            <span style="display:inline-block; width:120px;"><strong>Kegiatan</strong></span>
            <span style="display:inline-block; width:10px;">:</span>
            <span style="display:inline-block; min-width:200px;">Pendapatan</span>
        </div>
        <div>
            <span style="display:inline-block; width:120px;"><strong>Rekening</strong></span>
            <span style="display:inline-block; width:10px;">:</span>
            <span style="display:inline-block; min-width:200px;"><?= esc($rekening) ?></span>
        </div>
        <div>
            <span style="display:inline-block; width:120px;"><strong>Anggaran</strong></span>
            <span style="display:inline-block; width:10px;">:</span>
            <span style="display:inline-block; min-width:200px;"><?= number_format($anggaran, 0, ',', '.') ?></span>
        </div>
    </div>
    <table>
        <thead>
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
                foreach ($buku_besar as $row):
                    $penerimaan = $row['penerimaan'];
                    $total_penerimaan += $penerimaan;
                    $saldo_berjalan += $penerimaan;
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
                <th class="text-end"><?= number_format($saldo_berjalan, 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>
    <div class="tte-box">
        <div class="tte-right">
            <b>Pengguna Anggaran</b><br>
            <span style="display:inline-block; height:60px;"></span><br>
            <u><?= esc($nama_pengguna_anggaran ?? '................................') ?></u><br>
            <span>NIP. <?= esc($nip_pengguna_anggaran ?? '.........................') ?></span>
        </div>
    </div>
</body>
</html>
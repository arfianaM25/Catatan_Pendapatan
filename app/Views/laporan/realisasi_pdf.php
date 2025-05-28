<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Realisasi Pendapatan</title>
    <style>
        @page {
            size: A4;
            margin: 20mm 15mm 20mm 15mm;
        }
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 6px; }
        th { background: #eee; }
        .judul, .subjudul, .tahun { text-align: center; margin: 0; }
        .tte-box { width: 100%; margin-top: 60px; }
        .tte-right { float: right; text-align: center; }
    </style>
</head>
<body>
    <h2 class="judul">Laporan Realisasi Pendapatan</h2>
    <h3 class="subjudul"><?= esc($opd_nama) ?></h3>
    <h4 class="tahun">Tahun : 2025</h4>
    <br>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Uraian</th>
                <th>Anggaran</th>
                <th>Realisasi</th>
                <th>Presentase Realisasi (%)</th>
                <th>Selisih Lebih</th>
                <th>Selisih Kurang</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pendapatan as $row): 
                $selisih = $row['realisasi'] - $row['anggaran'];
                $presentase = ($row['anggaran'] != 0) ? ($row['realisasi'] / $row['anggaran']) * 100 : 0;
            ?>
            <tr>
                <td><?= esc($row['kode']) ?></td>
                <td><?= esc($row['uraian']) ?></td>
                <td><?= number_format($row['anggaran'], 0, ',', '.') ?></td>
                <td><?= number_format($row['realisasi'], 0, ',', '.') ?></td>
                <td><?= number_format($presentase, 2, ',', '.') ?>%</td>
                <td><?= $selisih > 0 ? number_format($selisih, 0, ',', '.') : '-' ?></td>
                <td><?= $selisih < 0 ? number_format(abs($selisih), 0, ',', '.') : '-' ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div class="tte-box">
        <div class="tte-right">
            <b>TTE</b><br>
            Pengguna Anggaran
        </div>
    </div>
</body>
</html>
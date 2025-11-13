<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil TOPSIS - Rekomendasi Sanksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">📊 Hasil Perhitungan TOPSIS</h2>

    <table class="table table-bordered table-striped shadow-sm align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Pelanggaran</th>
                <th>Tanggal</th>
                <th>Nilai Preferensi</th>
                <th>Rekomendasi Sanksi</th>
                
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($hasil)): ?>
                <?php $no = 1; foreach ($hasil as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($row['nis']) ?></td>
                        <td><?= esc($row['nama']) ?></td>
                        <td><?= esc($row['nama_pelanggaran']) ?></td>
                        <td><?= esc($row['tanggal']) ?></td>
                        <td><?= number_format($row['nilai_preferensi'], 4) ?></td>
                        <td><strong><?= esc($row['rekomendasi_sanksi']) ?></strong></td>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center text-danger">Belum ada data hasil TOPSIS</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"></h4>
    <a href="<?= base_url('dashboard_view') ?>" class="btn btn-secondary">Back to Dashboard</a>
</div>
</div>
</body>
</html>

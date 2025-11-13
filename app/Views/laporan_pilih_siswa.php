<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Siswa untuk Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="text-center mb-4">
        <h3 class="fw-bold">👤 Pilih Siswa</h3>
        <p class="text-muted">Klik nama siswa untuk melihat laporan hasil TOPSIS</p>
        <hr>
    </div>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($siswa as $row): ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $row['nis'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td class="text-center">
                    <a href="<?= site_url('topsis/laporanSiswa/'.$row['id']) ?>" class="btn btn-success btn-sm">
                        📄 Lihat Laporan
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="<?= base_url('topsis/laporan') ?>" class="btn btn-secondary">⬅️ Kembali</a>
    </div>
</div>
</body>
</html>

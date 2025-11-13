<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pelanggaran</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #eef2f7;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
            color: #007bff;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 14px;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-primary {
            background: #007bff;
            color: #fff;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .btn-secondary {
            background: #6c757d;
            color: #fff;
        }
        .btn-secondary:hover {
            background: #545b62;
        }
        .top-actions {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f1f7ff;
        }
        .aksi a {
            margin: 0 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .aksi a.edit {
            color: #28a745;
        }
        .aksi a.hapus {
            color: #dc3545;
        }
        .aksi a:hover {
            text-decoration: underline;
        }
        .empty-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #777;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📋 Daftar Pelanggaran Siswa</h2>

    <div class="top-actions">
        <a class="btn btn-secondary" href="<?= base_url('dashboard') ?>">⬅ Kembali ke Dashboard</a>
        <a class="btn btn-primary" href="<?= base_url('pelanggaran/tambah') ?>">+ Tambah Pelanggaran</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Nama Pelanggaran</th>
                <th>Tanggal</th>
                <th>Tingkat</th>
                <th>Frekuensi</th>
                <th>Dampak</th>
                <th>Kesengajaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pelanggaran)): ?>
                <?php $no = 1; foreach ($pelanggaran as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($row['nama']) ?></td>
                        <td><?= esc($row['nama_pelanggaran']) ?></td>
                        <td><?= esc($row['tanggal']) ?></td>
                        <td><?= esc($row['tingkat']) ?></td>
                        <td><?= esc($row['frekuensi']) ?></td>
                        <td><?= esc($row['dampak']) ?></td>
                        <td><?= esc($row['kesengajaan']) ?></td>
                        <td class="aksi">
                            <a class="edit" href="<?= base_url('pelanggaran/edit/'.$row['id']) ?>">Edit</a> |
                            <a class="hapus" href="<?= base_url('pelanggaran/hapus/'.$row['id']) ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="empty-data">Tidak ada data pelanggaran.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>

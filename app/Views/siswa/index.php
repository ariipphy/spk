<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h2>Data Siswa</h2>
<a href="/siswa/tambah" class="btn btn-primary mb-3">+ Tambah Siswa</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($siswa as $row): ?>
            <tr>
                <td><?= esc($row['nis']) ?></td>
                <td><?= esc($row['nama']) ?></td>
                <td><?= esc($row['kelas']) ?></td>
                <td><?= esc($row['jenis_kelamin']) ?></td>
                <td>
                    <a href="/siswa/edit/<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="/siswa/hapus/<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
                
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"></h4>
    <a href="<?= base_url('dashboard_view') ?>" class="btn btn-secondary">Back to Dashboard</a>
</div>


<?= $this->endSection() ?>

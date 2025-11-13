<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4 class="mb-3">Data Kriteria</h4>

    <p><i>(Kriteria yang digunakan dalam pemilihan sanksi siswa)</i></p>

    <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>
    <a href="<?= base_url('kriteria/tambah') ?>" class="btn btn-primary mb-3">+ Tambah Kriteria</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Kriteria</th>
                        <th>Variabel</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($kriteria as $k): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($k['nama_kriteria']) ?></td>
                            <td><?= esc($k['kode_kriteria']) ?></td>
                            <td>
                                <a href="<?= base_url('kriteria/edit/' . $k['id']) ?>" class="btn btn-warning btn-sm">✏️ Update</a>
                                <a href="<?= base_url('kriteria/delete/' . $k['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">🗑️ Delete</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

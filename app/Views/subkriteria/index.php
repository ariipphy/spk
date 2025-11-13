<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4 class="mb-3">Data Sub Kriteria</h4>
    <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="<?= base_url('dashboard_view') ?>" class="btn btn-secondary">Back to Dashboard</a>
</div>

    <?php if (!empty($kriteria)) : ?>
        <?php foreach ($kriteria as $k) : ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <strong><?= esc($k['nama_kriteria']) ?></strong>
                    <a href="<?= base_url('subkriteria/tambah/' . $k['id']) ?>" class="btn btn-sm btn-primary">+ Tambah</a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered m-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50">#</th>
                                <th>Nama Subkriteria</th>
                                <th>Nilai</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($groupedSubkriteria[$k['id']])) : ?>
                                <?php foreach ($groupedSubkriteria[$k['id']] as $index => $sub) : ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= esc($sub['nama_subkriteria']) ?></td>
                                        <td><?= esc($sub['nilai']) ?></td>
                                        <td>
                                            <a href="<?= base_url('subkriteria/edit/' . $sub['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="<?= base_url('subkriteria/delete/' . $sub['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada subkriteria.</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach ?>
    <?php else : ?>
        <p class="text-muted">Belum ada kriteria.</p>
    <?php endif ?>
</div>

<?= $this->endSection() ?>

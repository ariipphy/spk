<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4 class="mb-3">Tambah Sub Kriteria</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="<?= base_url('subkriteria/simpan') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id_kriteria" value="<?= $kriteria['id'] ?>">

                <div class="mb-3">
                    <label for="nama_subkriteria" class="form-label">Nama Sub Kriteria</label>
                    <input type="text" class="form-control" name="nama_subkriteria" required>
                </div>

                <div class="mb-3">
                    <label for="nilai" class="form-label">Nilai</label>
                    <input type="number" step="0.01" class="form-control" name="nilai" required>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="<?= base_url('subkriteria') ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4 class="mb-3">Edit Data Kriteria</h4>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="/kriteria/update/<?= $kriteria['id'] ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                    <input type="text" name="nama_kriteria" value="<?= esc($kriteria['nama_kriteria']) ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="kode_kriteria" class="form-label">Kode (C1, C2, ...)</label>
                    <input type="text" name="kode_kriteria" value="<?= esc($kriteria['kode_kriteria']) ?>" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="/kriteria" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

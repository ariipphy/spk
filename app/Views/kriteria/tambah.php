<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4 class="mb-3">Tambah Data Kriteria</h4>
    <div class="card shadow-sm">
        <div class="card-body">
           <form action="<?= base_url('KriteriaController/simpan') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                    <input type="text" name="nama_kriteria" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="kode_kriteria" class="form-label">Kode (C1, C2, ...)</label>
                    <input type="text" name="kode_kriteria" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/kriteria" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

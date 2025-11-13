<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container mt-4">
    <h4><?= $title ?></h4>
    <form action="/subkriteria/update/<?= $subkriteria['id'] ?>" method="post">
        <div class="mb-3">
            <label>Kriteria</label>
            <select name="kode_kriteria" class="form-control" required>
                <?php foreach ($kriteria as $k): ?>
                    <option value="<?= $k['id'] ?>" <?= $k['id'] == $subkriteria['id_kriteria'] ? 'selected' : '' ?>>
                        <?= esc($k['nama_kriteria']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Nama Subkriteria</label>
            <input type="text" name="nama_subkriteria" class="form-control" value="<?= esc($subkriteria['nama_subkriteria']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Nilai</label>
            <input type="number" name="nilai" class="form-control" step="0.01" value="<?= esc($subkriteria['nilai']) ?>" required>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
<?= $this->endSection() ?>

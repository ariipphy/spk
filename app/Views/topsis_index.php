<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4>Alternatif Pelanggaran</h4>
    <a href="<?= base_url('topsis/proses') ?>" class="btn btn-primary mb-3">Proses TOPSIS</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Nama Pelanggaran</th>
                <th>Tingkat</th>
                <th>Frekuensi</th>
                <th>Dampak</th>
                <th>Kesengajaan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($alternatif as $a): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($a['nama']) ?></td>
                    <td><?= esc($a['nama_pelanggaran']) ?></td>
                    <td><?= esc($a['tingkat']) ?></td>
                    <td><?= esc($a['frekuensi']) ?></td>
                    <td><?= esc($a['dampak']) ?></td>
                    <td><?= esc($a['kesengajaan']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>

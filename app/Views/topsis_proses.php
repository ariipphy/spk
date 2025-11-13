<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4 class="mb-3">Proses Perhitungan TOPSIS</h4>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Nilai Alternatif</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <?php foreach ($alternatif[0]['nilai'] as $i => $n): ?>
                            <th>K<?= $i + 1 ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alternatif as $alt): ?>
                        <tr>
                            <td><?= esc($alt['nama']) ?></td>
                            <?php foreach ($alt['nilai'] as $v): ?>
                                <td><?= esc($v) ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h5>Matriks Ternormalisasi</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <?php foreach ($idealPlus as $i => $v): ?>
                            <th>K<?= $i + 1 ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($normalisasi as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <?php foreach ($row as $val): ?>
                                <td><?= number_format($val, 4) ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h5>Matriks Terbobot</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <?php foreach ($idealPlus as $i => $v): ?>
                            <th>K<?= $i + 1 ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($terbobot as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <?php foreach ($row as $val): ?>
                                <td><?= number_format($val, 4) ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h5>Hasil Preferensi</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Nilai Preferensi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hasil as $h): ?>
                        <tr>
                            <td><?= esc($h['nama']) ?></td>
                            <td><?= esc($h['nilai']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

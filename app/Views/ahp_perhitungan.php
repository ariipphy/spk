<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4 class="mb-4">Perhitungan AHP</h4>

    <!-- Matriks Perbandingan -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            Matriks Perbandingan Kriteria
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm text-center">
                <thead class="table-light">
                    <tr>
                        <th>Kriteria</th>
                        <?php foreach ($kriteria as $k) : ?>
                            <th><?= $k ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($nilai as $i => $baris) : ?>
                        <tr>
                            <th><?= $kriteria[$i] ?></th>
                            <?php foreach ($baris as $val) : ?>
                                <td><?= round($val, 3) ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Matriks Normalisasi -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            Matriks Normalisasi & Bobot Eigen
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm text-center">
                <thead class="table-light">
                    <tr>
                        <th>Kriteria</th>
                        <?php foreach ($kriteria as $k) : ?>
                            <th><?= $k ?></th>
                        <?php endforeach; ?>
                        <th>Bobot</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($normalisasi as $i => $baris) : ?>
                        <tr>
                            <th><?= $kriteria[$i] ?></th>
                            <?php foreach ($baris as $val) : ?>
                                <td><?= round($val, 3) ?></td>
                            <?php endforeach; ?>
                            <td><strong><?= round($eigen[$i], 4) ?></strong></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Hasil Konsistensi -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-warning">
            Konsistensi Perhitungan
        </div>
        <div class="card-body">
            <p><strong>λ maks:</strong> <?= round($lambda_max, 4) ?></p>
            <p><strong>Consistency Index (CI):</strong> <?= round($ci, 4) ?></p>
            <p><strong>Consistency Ratio (CR):</strong> <?= round($cr, 4) ?></p>

            <?php if ($cr <= 0.1) : ?>
                <div class="alert alert-success mt-2">Perbandingan konsisten (CR ≤ 0.1)</div>
            <?php else : ?>
                <div class="alert alert-danger mt-2">Perbandingan tidak konsisten (CR > 0.1)</div>
            <?php endif; ?>
        </div>
        <!-- Tabel Bobot Kriteria -->
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-info text-white">
        Hasil Akhir Bobot Kriteria
    </div>
    <div class="card-body">
        <table class="table table-bordered table-sm text-center">
            <thead class="table-light">
                <tr>
                    <th>Kode</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kriteria as $i => $nama) : ?>
                    <tr>
                        <td>K<?= $i + 1 ?></td>
                        <td><?= $nama ?></td>
                        <td><strong><?= round($eigen[$i], 4) ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<?= $this->endSection() ?>

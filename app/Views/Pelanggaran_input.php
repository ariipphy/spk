<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Pelanggaran</title>
    <!-- Link ke Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Form Tambah Pelanggaran</h4>
        </div>
        <div class="card-body">

            <!-- Tampilkan error jika ada -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <form action="<?= base_url('/pelanggaran/simpan') ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Siswa</label>
                    <select name="id_siswa" class="form-select" required>
                        <option value="">-- Pilih Siswa --</option>
                        <?php foreach ($siswa as $row): ?>
                            <option value="<?= $row['id'] ?>"><?= $row['nis'] ?> - <?= $row['nama'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <!-- Pilihan jenis pelanggaran -->
                <div class="mb-3">
                    <label class="form-label">Nama Pelanggaran</label>
                    <select id="nama_pelanggaran" name="nama_pelanggaran" class="form-select" required>
                        <option value="">-- Pilih Jenis Pelanggaran --</option>
                        <optgroup label="Ringan">
                            <option value="Berbicara kotor dan mengumpat kepada teman">Berbicara kotor dan mengumpat kepada teman</option>
                            <option value="Membuang sampah sembarangan">Membuang sampah sembarangan</option>
                            <option value="Terlambat apel pagi dan upacara bendera">Terlambat apel pagi dan upacara bendera</option>
                            <option value="Terlambat masuk kelas">Terlambat masuk kelas</option>
                            <option value="Berkuku atau rambut panjang/dicat">Berkuku atau rambut panjang/dicat</option>
                            <option value="Menggunakan atribut pakaian bukan aturan sekolah">Menggunakan atribut pakaian bukan aturan sekolah</option>
                            <option value="Memakai pakaian tambahan tidak sesuai (jaket/topi)">Memakai pakaian tambahan tidak sesuai (jaket/topi)</option>
                            <option value="Menggunakan sepatu selain warna hitam">Menggunakan sepatu selain warna hitam</option>
                        </optgroup>

                        <optgroup label="Sedang">
                            <option value="Berbicara kotor dan mengumpat kepada guru">Berbicara kotor dan mengumpat kepada guru</option>
                            <option value="Berpacaran baik sesama siswa ataupun dengan siswa sekolah lain">Berpacaran baik sesama siswa ataupun dengan siswa sekolah lain</option>
                            <option value="Berkelahi antar siswa yang tidak membahayakan">Berkelahi antar siswa yang tidak membahayakan</option>
                            <option value="Merokok">Merokok</option>
                            <option value="Cabut/bolos">Cabut/bolos</option>
                        </optgroup>

                        <optgroup label="Berat">
                            <option value="Membawa HP">Membawa HP</option>
                            <option value="Membawa benda tajam yang membahayakan orang lain">Membawa benda tajam yang membahayakan orang lain</option>
                            <option value="Membawa perhiasan yang membahayakan orang lain">Membawa perhiasan yang membahayakan orang lain</option>
                            <option value="Membawa, membaca, atau menonton hal-hal yang bersifat pornografi">Membawa, membaca, atau menonton hal-hal yang bersifat pornografi</option>
                            <option value="Merusak fasilitas sekolah dalam bentuk apapun">Merusak fasilitas sekolah dalam bentuk apapun</option>
                            <option value="Berkelahi antar siswa yang membahayakan">Berkelahi antar siswa yang membahayakan</option>
                            <option value="Melakukan tindakan bullying">Melakukan tindakan bullying</option>
                            <option value="Mengedarkan atau menggunakan narkoba/obat terlarang">Mengedarkan atau menggunakan narkoba/obat terlarang</option>
                            <option value="Meminum minuman keras">Meminum minuman keras</option>
                        </optgroup>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tingkat Pelanggaran</label>
                    <select id="id_subkriteria_tingkat" name="id_subkriteria_tingkat" class="form-select" required>
                        <option value="">-- Pilih Tingkat --</option>
                        <?php foreach ($tingkat as $t): ?>
                            <option value="<?= $t['id'] ?>"><?= $t['nama_subkriteria'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Frekuensi</label>
                    <select name="id_subkriteria_frekuensi" class="form-select" required>
                        <option value="">-- Pilih Frekuensi --</option>
                        <?php foreach ($frekuensi as $f): ?>
                            <option value="<?= $f['id'] ?>"><?= $f['nama_subkriteria'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Dampak</label>
                    <select name="id_subkriteria_dampak" class="form-select" required>
                        <option value="">-- Pilih Dampak --</option>
                        <?php foreach ($dampak as $d): ?>
                            <option value="<?= $d['id'] ?>"><?= $d['nama_subkriteria'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kesengajaan</label>
                    <select name="id_subkriteria_kesengajaan" class="form-select" required>
                        <option value="">-- Pilih Kesengajaan --</option>
                        <?php foreach ($kesengajaan as $k): ?>
                            <option value="<?= $k['id'] ?>"><?= $k['nama_subkriteria'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="text-end">
                    <a href="<?= base_url('/pelanggaran') ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Script Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script otomatis pilih tingkat berdasarkan jenis pelanggaran -->
<script>
document.getElementById('nama_pelanggaran').addEventListener('change', function() {
    const tingkatSelect = document.getElementById('id_subkriteria_tingkat');
    const selected = this.options[this.selectedIndex].parentNode.label.toLowerCase();

    // reset pilihan tingkat
    tingkatSelect.value = '';

    // otomatis pilih tingkat berdasarkan kategori optgroup
    for (let option of tingkatSelect.options) {
        if (option.text.toLowerCase() === selected) {
            tingkatSelect.value = option.value;
            break;
        }
    }
});
</script>

</body>
</html>

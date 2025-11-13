<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pelanggaran Siswa</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            margin: 30px 50px;
            line-height: 1.5;
        }

        /* === KOP SURAT === */
        .header-kop {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }
        .logo-cell {
            display: table-cell;
            width: 90px;
            vertical-align: middle;
            padding-right: 12px;
        }
        .logo-cell img {
            width: 75px;
            height: 75px;
            object-fit: contain;
            display: block;
        }
        .header-text {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }
        .header-text h3 {
            margin: 0;
            padding: 0;
            font-size: 12pt;
            font-weight: bold;
            line-height: 1.2;
        }
        .header-text p {
            margin: 3px 0 0 0;
            font-size: 9pt;
            line-height: 1.3;
        }
        
        /* === GARIS PEMBATAS === */
        .hr-container {
            margin: 5px 0 12px 0;
        }
        hr.thick {
            border: none;
            border-top: 2.5px solid #000;
            margin: 0 0 1px 0;
        }
        hr.thin {
            border: none;
            border-top: 0.8px solid #000;
            margin: 0;
        }
        
        /* === JUDUL LAPORAN === */
        .title-report {
            font-size: 12pt;
            font-weight: bold;
            text-align: center;
            margin: 12px 0 15px 0;
            text-decoration: underline;
        }
        
        /* === ISI SURAT === */
        .content {
            text-align: justify;
            margin-bottom: 12px;
            font-size: 10pt;
        }
        
        /* === DATA SISWA === */
        .data-siswa {
            margin: 12px 0 12px 35px;
        }
        .data-siswa table {
            border: none;
        }
        .data-siswa td {
            border: none;
            padding: 2px 0;
            font-size: 10pt;
        }
        .data-siswa td:first-child {
            width: 80px;
            vertical-align: top;
        }
        .data-siswa td:nth-child(2) {
            width: 15px;
            vertical-align: top;
        }
        
        /* === TABEL PELANGGARAN === */
        .table-container {
            margin: 15px 0;
        }
        table.pelanggaran {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        table.pelanggaran, 
        table.pelanggaran th, 
        table.pelanggaran td {
            border: 1px solid #000;
        }
        table.pelanggaran th {
            background-color: #f2f2f2;
            padding: 7px 6px;
            font-size: 10pt;
            text-align: center;
            font-weight: bold;
        }
        table.pelanggaran td {
            padding: 6px;
            font-size: 10pt;
            vertical-align: top;
        }
        table.pelanggaran td.center {
            text-align: center;
        }
        
        /* === PENUTUP === */
        .penutup {
            margin-top: 15px;
            text-align: justify;
            font-size: 10pt;
        }

        /* === TANDA TANGAN === */
        .signature {
            margin-top: 30px;
            text-align: right;
            padding-right: 40px;
        }
        .signature p {
            margin: 2px 0;
            font-size: 10pt;
        }
        .signature-space {
            height: 50px;
        }
        .signature .name {
            text-decoration: underline;
            font-weight: bold;
        }

        /* === BUTTONS === */
        @media print {
            .buttons {
                display: none;
            }
        }
        .buttons {
            margin-top: 30px;
            text-align: center;
            padding: 20px;
            border-top: 1px dashed #ccc;
        }
        .buttons button,
        .buttons a {
            background: #007BFF;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            margin: 0 8px;
            cursor: pointer;
            font-size: 11pt;
            transition: all 0.3s;
            display: inline-block;
        }
        .buttons button:hover,
        .buttons a:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .buttons a.secondary {
            background: #6c757d;
        }
        .buttons a.secondary:hover {
            background: #545b62;
        }
    </style>
</head>
<body>

    <!-- KOP SURAT -->
    <div class="header-kop">
        <div class="logo-cell">
            <img src="<?= base_url('img/logo_sekolah.png') ?>" 
                 alt="Logo Sekolah" 
                 onerror="this.onerror=null;this.src='https://placehold.co/75x75/EEEEEE/333333?text=Logo'; this.style.border='1px solid #ccc';">
        </div>
        <div class="header-text">
            <h3>PEMERINTAH KOTA BUKITTINGGI</h3>
            <h3>SMP NEGERI 3 BUKITTINGGI</h3>
            <p>Jl. Jambak No.3, Bukit Apit Puhun, Kec. Guguk Panjang, Kota Bukittinggi, Sumatera Barat<br>
            Telp. 0752-34278 | Email: smpnegeri3bukittinggi@gmail.com</p>
        </div>
    </div>
    
    <div class="hr-container">
        <hr class="thick">
        <hr class="thin">
    </div>

    <!-- JUDUL -->
    <div class="title-report">LAPORAN PELANGGARAN SISWA</div>

    <!-- ISI SURAT -->
    <p class="content">
        Dengan hormat,<br>
        Bersama ini kami sampaikan laporan pelanggaran yang dilakukan oleh siswa:
    </p>

    <!-- DATA SISWA -->
    <div class="data-siswa">
        <table>
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td><?= esc($siswa['nis'] ?? '-') ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= esc($siswa['nama'] ?? '-') ?></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td><?= esc($siswa['kelas'] ?? '-') ?></td>
            </tr>
        </table>
    </div>

    <p class="content">Adapun rincian pelanggaran adalah sebagai berikut:</p>

    <!-- TABEL PELANGGARAN -->
    <div class="table-container">
        <table class="pelanggaran">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Tanggal</th>
                    <th style="width: 45%;">Pelanggaran</th>
                    <th style="width: 35%;">Rekomendasi Sanksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pelanggaran)): ?>
                    <?php $no = 1; foreach($pelanggaran as $row): ?>
                    <tr>
                        <td class="center"><?= $no++ ?></td>
                        <td class="center"><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                        <td><?= esc($row['nama_pelanggaran']) ?></td>
                        <td><?= esc($row['rekomendasi_sanksi']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="center">Tidak ada data pelanggaran.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- PENUTUP -->
    <p class="penutup">
        Demikian laporan ini kami sampaikan untuk dapat dijadikan perhatian sebagaimana mestinya.
    </p>

    <!-- TANDA TANGAN -->
    <div class="signature">
        <p>Bukittinggi, <?= date('d-m-Y') ?></p>
        <p>Guru BK</p>
        <div class="signature-space"></div>
        <p class="name">Bobi Tourist Yarsa, S.Pd.</p>
    </div>

    <!-- TOMBOL AKSI -->
    <div class="buttons">
        <button onclick="window.print()">🖨️ Cetak Laporan</button>
        <a href="<?= base_url('dashboard') ?>" class="secondary">⬅️ Kembali ke Dashboard</a>
    </div>

</body>
</html>
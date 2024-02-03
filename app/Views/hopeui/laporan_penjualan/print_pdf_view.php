<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <style>
        /* CSS untuk cetak */
        @media print {
            /* Sembunyikan tombol cetak */
            .no-print {
                display: none !important;
            }
        }
        .header {
            text-align: center;
            margin-bottom: -60px;
            margin-top: 20px;
        }
        .header img {
            width: 100px; /* Atur ukuran logo sesuai kebutuhan */
            height: auto;
        }
        .judul {
            font-size: 24px;
            font-weight: bold;
        }
        .alamat {
            font-size: 14px;
        }
        table {
            width: 90%;
            border-collapse: collapse;
            margin: 0 auto; /* Membuat tabel berada di tengah */
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        h3 {
            margin-top: 10px; /* Mengurangi margin-top h3 */
        }
        .jumlah-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .jumlah-item {
            flex: 1;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="<?=base_url('logo/logo_pdf/logo_pdf_contoh.svg')?>"> 
        <div class="judul mt-2">GT Kasir</div>
        <div class="alamat">Jl. Raya Pahlawan No. 123, Kel. Sukajadi, Kec. Sukasari, Kota Batam 29424.</div>
        <div class="notel">Telp: (0778) 417852 Fax: (0778) 517523</div>
    </div>

    <h3 class="text-center mb-4"><?= $title ?></h3>
    
    <?php if ($awal && $akhir) : ?>
        <p class="text-center">Laporan detail penjualan dalam rentang tanggal berikut:</p>
        <p class="text-center">Periode : <?= date('d M Y', strtotime($awal)) . ' - ' . date('d M Y', strtotime($akhir))?></p>
    <?php elseif ($tanggal) : ?>
       <p class="text-center">Laporan detail penjualan pada tanggal berikut:</p>
       <p class="text-center">Periode : <?= date('d M Y', strtotime($tanggal))?></p>
   <?php endif; ?>


   <div class="table-responsive">
    <table border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Jumlah Produk</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($penjualan as $riz) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $riz->NamaProduk ?></td>
                    <td><?= $riz->JumlahProduk ?> buah</td>
                    <td>Rp <?= number_format($riz->Subtotal, 2, ',', '.') ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="jumlah-container mt-5">
    <div class="jumlah-item">
        <p>Jumlah penjualan: <?= count($penjualan) ?></p>
    </div>
</div>

</div>
</body>
</html>
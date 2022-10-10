<?php
helper('functions');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Djana</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 12px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <div style="font-size:12px;">Tahun: <?= $tahun; ?></div>
    <div style="font-size:12px;">Bulan: <?= $bulan; ?></div>
    <table>
        <tr>
            <td>No.</td>
            <td>Tgl.</td>
            <td>No. Nota</td>
            <td>Order</td>
            <td>Pj</td>
            <td>Produk</td>
            <td>Harga</td>
            <td>Qty</td>
            <td>Keluar</td>
            <td>Pj</td>
            <td>Masuk</td>
            <td>Pj</td>
            <td>Catatan</td>
            <td>Progres</td>
            <td>Laba</td>
        </tr>
        <?php foreach ($data as $key => $i) : ?>
            <tr>
                <td><?= $key + 1; ?></td>
                <td><?= $i['tgl']; ?></td>
                <td><?= $i['no_nota']; ?></td>
                <td><?= $i['username']; ?></td>
                <td><?= $i['pj_order']; ?></td>
                <td><?= $i['produk']; ?></td>
                <td><?= $i['harga']; ?></td>
                <td><?= $i['qty']; ?></td>
                <td>Rp <?= $i['uang_keluar']; ?></td>
                <td><?= $i['pj_uangkeluar']; ?></td>
                <td>Rp <?= $i['uang_masuk']; ?></td>
                <td><?= $i['penerima_uangmasuk']; ?></td>
                <td><?= $i['catatan']; ?></td>
                <td><?= $i['progres']; ?></td>
                <td>Rp <?= $i['laba']; ?></td>
            </tr>
        <?php endforeach; ?>
        <tr style="border:none;">
            <td style="border:none;">TOTAL</td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;">Rp <?= $keluar; ?></td>
            <td style="border:none;"></td>
            <td style="border:none;">Rp <?= $masuk; ?></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;">Rp <?= $laba; ?></td>
        </tr>
    </table>
</body>

</html>
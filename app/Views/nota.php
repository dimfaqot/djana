<?php
helper('functions');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Djana <?= $judul; ?></title>
    <style>
        small {
            font-size: 10px;
            border-top: 1px solid grey;

        }

        span {
            font-size: 12px;
        }

        table,
        td,
        th {
            border: 1px solid;
            font-size: 12px;
            padding: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>

</head>

<body>
    <div style="float: left; width: 10%;">
        <?= $logo; ?>
    </div>

    <div style="float: left; width: 90%;">
        <span>Desain, Dokumentasi Acara (Foto/Video), Alat Elektronik</span>
        <br>
        <span>Pembayaran Listrik, PDAM, Indihome, Transfer Bank</span>
        <br>
        <small>Sungkul Rt.12 Rw. 05 Plumbungan, Karangmalang, Sragen, Jawa Tengah WA: 0895-3362-86566</small>
    </div>
    <div style="clear: both; margin: 0pt; padding: 0pt; "></div>

    <hr>
    <div style="float: left; width: 50%;">
        <span>Tanggal Transaksi: <?= $data[0]['tgl']; ?></span>
        <br>
        <span>Teller: <?= $data[0]['penerima_order']; ?></span>
    </div>
    <div style="float: left; width: 50%;">
        <span>No. Nota: <?= $data[0]['no_nota']; ?></span>
        <br>
        <span>Pemesan: </span>
    </div>
    <div style="clear: both; margin: 0pt; padding: 0pt; "></div>

    <table style="margin-bottom:20px;">
        <tr>
            <th>No.</th>
            <th>Produk</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Jumlah</th>
        </tr>
        <?php
        $total = 0;
        ?>
        <?php foreach ($data as $key => $i) : ?>
            <?php
            if ($i['uang_masuk'] <= 0) {
                $total = $total + $i['jumlah'];
            } else {
                $total = $total + ($i['uang_masuk']);
            }
            ?>
            <tr>
                <td style="text-align:center"><?= $key + 1; ?></td>
                <td><?= $i['produk']; ?></td>
                <td>Rp <?= ($i['uang_masuk'] <= 0 ? rupiah($i['jumlah']) : rupiah(ceil($i['uang_masuk'] / $i['qty']))); ?></td>
                <td style="text-align:center"><?= $i['qty']; ?></td>
                <td>Rp <?= ($i['uang_masuk'] <= 0 ? rupiah($i['harga']) : rupiah($i['uang_masuk'])); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td style="font-weight: bold" colspan="4">Total</td>
            <td>Rp <?= rupiah($total); ?></td>

        </tr>
    </table>

    <div style="float: left; width: 50%;">
        <span>Tanggal diprint</span>
        <span><?= date('d-m-Y'); ?></span>
        <br>
        <span>Petugas</span>
        <br>
        <br>
        <br>
        <span><?= ucfirst($data[0]['penerima_uangmasuk']); ?></span>
    </div>
</body>

</html>
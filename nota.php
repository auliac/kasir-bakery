<?php

session_start();

if ($_SESSION['role'] !== "petugas" && "admin") {
    header("location:login.php");
    exit;
}

setlocale(LC_TIME, "id_ID");
require "config/functions.php";
$random1 = rand(100, 999);
$random2 = rand(100, 999);

$hargaTotal = 0;
foreach ($dataDibayar as $pesanan) {
    $hargaTotal += $pesanan['subtotal'];
}

if ($hargaTotal >= 75000) {
    $diskon = 15;
} elseif ($hargaTotal >= 50000 && $hargaTotal <= 74999) {
    $diskon = 10;
} elseif ($hargaTotal >= 25000 && $hargaTotal <= 49999) {
    $diskon = 5;
} else {
    $diskon = 0;
}

$hargaAkhir = $hargaTotal - ($hargaTotal * $diskon / 100);


?>
<!doctype html>
<html lang="en">

<head>
    <title>Kasir</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="0; url=index.php">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap');

        * {
            font-family: 'Rubik', sans-serif;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pesanan</h4>

                <p class="text-muted text-small">Kode invoice : <?= $random1 . $random2 ?>
                    <br> tanggal : <?= strftime('%d/%m/%Y') ?>
                </p>
                <hr>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataDibayar as $pesanan) : ?>
                                <tr class="">
                                    <td scope="row"><?= $pesanan['nama_produk'] ?></td>
                                    <td><?= $pesanan['jumlah'] ?></td>
                                    <td><?= number_format($pesanan['subtotal']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div class="h6">Metode Pembayaran : <br>
                            <?php foreach ($metode as $metode) : ?>
                                <div class="h6">
                                    <?= $metode['metode'] ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="h6 text-success">
                            <div class=" text-dark">Total</div>
                            Rp <?= number_format($hargaAkhir) ?><br>
                            <?php if ($diskon > 0) : ?>
                                <div class="text-muted h6 text-small text-center">(Diskon <?= $diskon ?>%)</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        window.print()
    </script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
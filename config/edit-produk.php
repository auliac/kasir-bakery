<?php

require('functions.php');
require('route.php');

session_start();

if ($_SESSION['role'] !== "petugas" && $_SESSION['role'] !== "admin") {
    header("location:../login.php");
    exit;
}

// ambil data di URL
$id = $_GET["id"];

$result = $conn->query("SELECT * FROM produk WHERE id_produk = $id");

if ($result) {
    $dataProduk = $result->fetch_assoc();
} else {
    // Handle the query error, for example:
    die("Error in SQL query: " . $conn->error);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>

<body>

    <!-- edit produk -->
    <div class="section">
        <div class="container">
            <div class="form">
                <h1 style="text-align:center;"><a href="index.php"></a>Toko Roti 17</h1>
                <br>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_produk" value="<?= $dataProduk['id_produk']; ?>">
                    <label for="nama_produk" class="">Nama Produk</label>
                    <input type="text" class="input-control" name="nama_produk" value="<?= $dataProduk['nama_produk']; ?>">
                    <label for="harga" class="">Harga Produk</label>
                    <input type="number" class="input-control" name="harga" min="0" value="<?= $dataProduk['harga']; ?>">
                    <label for="stok">Stok Produk</label>
                    <input type="number" class="input-control" name="stok" min="0" value="<?= $dataProduk['stok']; ?>">
                    <label for="gambar" class="">Gambar Produk</label><br>
                    <div style="text-align: center;">
                        <img src="../assets/img/<?= $dataProduk['gambar'] ?>" alt="Current Image" style="max-width: 100px;">
                    </div>
                    <input type="file" class="input-control" name="foto">


                    <div class>
                        <a href="../index.php" style="text-decoration: none;">
                            <button type="button" class="duabtn" name="btn-cancel">Batal</button>
                        </a>
                        <a href="../index.php" style="text-decoration: none;">
                            <button type="submit" class="duabtn" name="btn-edit">Simpan</button>
                        </a>
                    </div>
                </form>
            </div>
            <br>

        </div>
    </div>

</body>

</html>
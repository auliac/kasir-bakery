<?php

require 'config/functions.php';
require 'config/route.php';

session_start();

if ($_SESSION['role'] == "") {
    header("location:login.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>

    <div class="section">
        <div class="container">

            <form action="" method="post" enctype="multipart/form-data">

                <!-- modal -->
                <div id="myModal" class="modal">

                    <!-- content modal -->
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h4 class="h4">Tambah Produk</h4>
                        <div class="">
                            <label for="" class="input-control">Nama Produk</label>
                            <input type="text" class="input-control" name="nama" id="" placeholder="Nama Produk" autocomplete="off" required>
                            <label for="" class="input-control">Harga Produk</label>
                            <input type="number" class="input-control" name="harga" id="" min="0" placeholder="Harga" autocomplete="off" required>
                            <label for="" class="input-control">Stok</label>
                            <input type="number" class="input-control" name="stok" min="0" placeholder="Stok" autocomplete="off" required>
                            <label for="" class="input-control">Gambar Produk</label>
                            <input type="file" accept="image/*" class=" input-control" name="foto" id="" placeholder="nama produk" required>
                        </div>

                        <div class>
                            <a href="index.php" style="text-decoration: none;">
                                <button type="button" class="duabtn" name="btn-cancel" data-bs-dismiss="modal">Batal</button>
                            </a>
                            <button type="submit" class="duabtn" name="btn-produk">Simpan</button>
                        </div>
                    </div>

                </div>

                <h1><a href="index.php"></a>Toko Roti 17</h1>

                <button id="myBtn" class="btn">TAMBAH PRODUK</button>

                <button type="button" class="btn">
                    <a href="config/logout.php" style="text-decoration: none; color:white;">KELUAR</a>
                </button>

                <script>
                    // mendapatkan modal
                    var modal = document.getElementById("myModal");
                    // mendapatkan button yg membuka modal
                    var btn = document.getElementById("myBtn");
                    // elemen span yg menutup modal
                    var span = document.getElementsByClassName("close")[0];
                    // ketika klik button, modal dibuka
                    btn.onclick = function() {
                        modal.style.display = "block";
                    }
                    // ketika klik (x), modal ditutup
                    span.onclick = function() {
                        modal.style.display = "none";
                    }
                    // ketika klik dimanapun, modal ditutup
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                </script>

                <br><br>

            </form>

            <form action="" method="post">
                <h4>Cari produk</h4>
                <input type="text" name="keyword" class="input-search" size="40" autofocus placeholder="Masukkan nama produk disini.." autocomplete="off" id="keyword">
                <button type="submit" name="btn-cari" class="btn" id="tombol-cari">Cari!</button>
            </form>


            <div class="kiri_produk">
                <div class="box">
                    <?php foreach ($dataProduk as $p) : ?>
                        <div class="col_4">
                            <img src="assets/img/<?= $p['gambar'] ?>">
                            <p class="nama"><?= $p['nama_produk'] ?></p>
                            <p class="harga_produk">Rp. <?= number_format($p['harga']) ?></p>
                            <p class="nama">Stok: <?= $p['stok']; ?></p>
                            <div class="block_edit">
                                <a href="config/hapus-produk.php?id=<?= $p['id_produk']; ?>" onclick=" return confirm('ingin menghapus produk?')" style="text-decoration: none;">
                                    <img src="assets/icon-delete.png" alt="hapus produk" style="width: 30px; height:30px">
                                </a>
                                <a href="config/edit-produk.php?id=<?= $p['id_produk']; ?>" style="text-decoration: none;">
                                    <img src="assets/icon-edit.png" alt="edit produk" style="width: 30px; height:30px">
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
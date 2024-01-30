<?php

require 'config/functions.php';
require 'config/route.php';

$keyword = $_GET['keyword'];

$query = "SELECT * FROM produk
                WHERE
                nama_produk LIKE '%$keyword%'
            ";

    return query($query);

$dataProduk = query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
</head>

<body>
    <!-- tampilan produk -->
    <div class="kiri">
        <div class="box">
            <div id="container">
                <?php foreach ($dataProduk as $p) : ?>
                    <div class="col-4">
                        <img src="assets/img/<?= $p['gambar'] ?>">
                        <p class="nama"><?= $p['nama_produk'] ?></p>
                        <p class="harga">Rp. <?= number_format($p['harga']) ?></p>
                        <p class="nama">Stok: <?= $p['stok']; ?></p>
                        <form action="" method="post">
                            <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">
                            <input type="hidden" name="harga" value="<?= $p['harga'] ?>">
                            <input type="number" name="jumlah" class="input" min="0" placeholder="Jumlah Item" required>
                            <!-- button pesan -->
                            <button type="submit" name="btn-pesan" onclick="pesanProduk(<?= $p['id_produk'] ?>)" class="btn-add">
                                <img src="assets/icon-add.png" alt="pesan" style="width: 20px; height:20px;">
                            </button>
                        </form>
                        <div>
                        </div>

                        </a>
                        <div class="block">
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
</body>

</html>
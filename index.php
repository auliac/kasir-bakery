<?php

require 'config/functions.php';
require 'config/route.php';

session_start();

// cek apakah yang mengakses halaman ini petugas atau bukan
if ($_SESSION['role'] !== "petugas") {
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

    <!-- tambah produk -->
    <div class="section">
        <div class="container">

                <h1><a href="index.php"></a>Toko Roti 17</h1>

                <button type="button" class="btn">
                    <a href="config/logout.php" style="text-decoration: none; color:white;">KELUAR</a>
                </button>

                <button type="button" class="btn">
                    <a href="produk.php" style="text-decoration: none; color:white;">PRODUK</a>
                </button>

                
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
                                    <input type="number" name="jumlah" class="input-control" min="0" placeholder="Jumlah Item" required>
                                    <!-- button pesan -->
                                    <button type="submit" name="btn-pesan" onclick="pesanProduk(<?= $p['id_produk'] ?>)" class="btn-add">
                                        <img src="assets/icon-add.png" alt="pesan" style="width: 20px; height:20px;">
                                    </button>
                                </form>
                                <div>
                                </div>

                                </a>
                                


                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- tampilan box transaksi -->
                <div class="kanan">
                    <form action="" method="post">
                        <h4>Cari produk</h4>
                        <input type="text" name="keyword" class="input-search" size="40" autofocus placeholder="Masukkan nama produk disini.." autocomplete="off" id="keyword">
                        <button type="submit" name="btn-cari" class="btn" id="tombol-cari">Cari!</button>
                    </form>

                    <br>

                    <h4>Pesanan</h4>
                    <div>
                        <table class="pesanan">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataPesanan as $pesanan) : @$hargaTotal += $pesanan['subtotal'];
                                    ($hargaTotal >= 100000) ? $diskon = ($hargaTotal * 5) / 100 : $diskon = 0;
                                    $hargaAkhir = $hargaTotal - $diskon; ?>
                                    <tr>
                                        <td><?= $pesanan['nama_produk']; ?></td>
                                        <td><?= $pesanan['jumlah'] ?></td>
                                        <td><?= number_format($pesanan['subtotal']) ?></td>
                                        <td>
                                            <a href="config/hapus-pesanan.php?id=<?= $pesanan['id_pesanan'] ?>" style="text-decoration: none;">X</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <hr>

                        <div>
                            <div>
                                <h5>Total</h5>
                            </div>
                            <div>
                                <h5>Rp <?= number_format(@$hargaAkhir) ?><br><?= @$diskon ?: '' ?></h5>
                            </div>

                            <br>

                            <?= mysqli_num_rows($dataPesanan) ? '
                                <div>
                                    <div>
                                        <h4>Pembayaran</h4>
                                        <hr>
                                        <div>
                                            <form action="" method="post" onsubmit="return validateForm()">
                                                <label for="" class="">Metode Pembayaran</label>
                                                <select name="metode" class="" id="" required>
                                                    <option value="" disabled selected hidden>Pilih Metode Pembayaran</option>
                                                    <option value="Tunai">Tunai</option>
                                                    <option value="Gopay">Gopay</option>
                                                    <option value="OVO">OVO</option>
                                                    <option value="Qris">Qris</option>
                                                </select>
                                                <button type="submit" class="duabtn" name="btn-bayar">Bayar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            ' : '' ?>

                            <script>
                                function validateForm() {
                                    var metodePembayaran = document.forms[0]["metode"].value;
                                    if (metodePembayaran === "") {
                                        alert("Silakan pilih metode pembayaran!");
                                        return false;
                                    }
                                    // Jika semua validasi lulus, formulir dikirim
                                    return true;
                                }
                            </script>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

</body>

</html>
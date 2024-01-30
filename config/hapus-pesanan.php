<?php
// config/hapus-pesanan.php

require_once("functions.php"); // Adjust this according to your file structure
$id_pesanan = $_GET['id'];

// Retrieve information about the deleted product from the orders table
$query = "SELECT id_produk, jumlah FROM pesanan WHERE id_pesanan = $id_pesanan";
$result = mysqli_query($conn, $query);

if ($result) {
    $dataPesanan = mysqli_fetch_assoc($result);

    // Retrieve the current stock of the product
    $id_produk = $dataPesanan['id_produk'];
    $jumlah = $dataPesanan['jumlah'];

    $queryProduk = "SELECT stok FROM produk WHERE id_produk = $id_produk";
    $resultProduk = mysqli_query($conn, $queryProduk);

    if ($resultProduk) {
        $dataProduk = mysqli_fetch_assoc($resultProduk);

        // Update the stock back to its original value
        $stokAwal = $dataProduk['stok'] + $jumlah;
        $queryUpdateStok = "UPDATE produk SET stok = $stokAwal WHERE id_produk = $id_produk";
        $resultUpdateStok = mysqli_query($conn, $queryUpdateStok);

        if (!$resultUpdateStok) {
            die("Error updating stock: " . mysqli_error($conn));
        }
    } else {
        die("Error retrieving product information: " . mysqli_error($conn));
    }

    // Delete the order from the orders table
    $queryDelete = "DELETE FROM pesanan WHERE id_pesanan = $id_pesanan";
    $resultDelete = mysqli_query($conn, $queryDelete);

    if ($resultDelete) {
        echo "
            <script>
                alert('Pesanan berhasil dihapus!')
                document.location.href = '../index.php'
            </script>";
    } else {
        echo "
            <script>
                alert('Gagal menghapus pesanan!')
                document.location.href = '../index.php'
            </script>";
    }
} else {
    die("Error retrieving order information: " . mysqli_error($conn));
}
?>

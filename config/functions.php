<?php
$conn = mysqli_connect('localhost', 'root', '', 'kasir');


function tambahProduk($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $harga = htmlspecialchars($data['harga']);
    $stok = htmlspecialchars($data['stok']);

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['foto']['name'];
        $tmp_foto = $_FILES['foto']['tmp_name'];
        $dir = 'assets/img/';

        $ekstensiGambar = explode('.', $foto);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        move_uploaded_file($tmp_foto, $dir . $foto);
    } else {
        // Handle error jika file tidak diunggah dengan benar
        echo "Error: File gambar tidak diunggah dengan benar.";
        return 0; // Tandakan bahwa penambahan produk gagal
    }

    $conn->query("INSERT INTO produk VALUES(NULL,'$nama','$harga','$stok','$foto')");
    return mysqli_affected_rows($conn);
}

function tambahPesan($data)
{
    global $conn;
    $id_produk = $data['id_produk'];
    $jumlah = $data['jumlah'];
    $harga = $data['jumlah'] * $data['harga'];
    if ($jumlah <= 0) {
        return false;
    }
    $conn->query("INSERT INTO pesanan VALUES(NULL,'$id_produk','$harga','$jumlah','dipesan',NULL)");
    // Perbarui stok di database
    $queryUpdateStok = "UPDATE produk SET stok = stok - $jumlah WHERE id_produk = $id_produk";
    mysqli_query($conn, $queryUpdateStok);

    return mysqli_affected_rows($conn);
}

function hapusPesanan($id)
{
    global $conn;
    $conn->query("DELETE FROM pesanan WHERE id_pesanan = '$id'");
    return mysqli_affected_rows($conn);
}

function hapusProduk($id)
{
    global $conn;
    $conn->query("DELETE FROM produk WHERE id_produk = '$id'");
    return mysqli_affected_rows($conn);
}

function bayar($data)
{
    global $conn;
    $metode = $data['metode'];
    $conn->query("DELETE FROM pesanan WHERE status='dibayar'");
    $conn->query("UPDATE pesanan SET status='dibayar',metode='$metode'");
    return mysqli_affected_rows($conn);
}

function editProduk($data)
{
    global $conn;
    $id = $data['id_produk'];
    $nama = $data['nama_produk'];
    $harga = $data['harga'];
    $stok = $data['stok'];

    // Check if a new image is uploaded
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['foto']['name'];
        $tmp_foto = $_FILES['foto']['tmp_name'];
        $dir = '../assets/img/';

        $ekstensiGambar = explode('.', $foto);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        move_uploaded_file($tmp_foto, $dir . $foto);

        // Update the product with the new image
        $conn->query("UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok', gambar ='$foto' WHERE id_produk = '$id'");
    } else {
        // Update the product without changing the existing image
        $conn->query("UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok' WHERE id_produk = '$id'");
    }

    return mysqli_affected_rows($conn);
}


function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function cari($keyword)
{
    $query = "SELECT * FROM produk
                WHERE
                nama_produk LIKE '%$keyword%'
            ";

    return query($query);
}

$dataProduk = $conn->query("SELECT * FROM produk");
$dataPesanan = $conn->query("SELECT * FROM pesanan JOIN produk USING(id_produk) WHERE status='dipesan'");
$dataDibayar = $conn->query("SELECT * FROM pesanan JOIN produk USING(id_produk) WHERE status = 'dibayar'");

$metode = $conn->query("SELECT * FROM pesanan JOIN produk USING(id_produk) WHERE status = 'dibayar' GROUP by metode");

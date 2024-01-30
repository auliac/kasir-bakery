<?php

if (isset($_POST["btn-produk"])) {
    if (tambahProduk($_POST) > 0) {
        echo " 
        <script>
            alert('produk berhasil ditambahkan!')
            document.location.href = 'produk.php'
        </script>";
    } else {
        echo "
            <script>
                alert('produk gagal ditambahkan!')
                document.location.href = 'produk.php'
            </script>";
    }
}

if (isset($_POST["btn-pesan"])) {
    $id_produk = $_POST['id_produk'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    // Ambil data produk dari database dan konversi ke dalam bentuk array
    $query = "SELECT * FROM produk";
    $result = mysqli_query($conn, $query);
    $dataProduk = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Cari produk yang sesuai dengan ID
    $produkIndex = array_search($id_produk, array_column($dataProduk, 'id_produk'));

    // Periksa stok
    if ($produkIndex !== false) {
        $stokTersedia = $dataProduk[$produkIndex]['stok'];

        if ($stokTersedia >= $jumlah) {
            // Produk ditemukan dan stok mencukupi
            $totalHarga = $harga * $jumlah;

            // Kurangi stok
            $dataProduk[$produkIndex]['stok'] -= $jumlah;

            // Tambahkan detail pesanan ke dalam fungsi tambahPesan atau lakukan operasi sesuai kebutuhan
            if (tambahPesan($_POST) > 0) {
                echo "
                    <script>
                        alert('Produk berhasil ditambahkan!')
                        document.location.href = 'index.php'
                    </script>";
            } else {
                echo "
                    <script>
                        alert('Produk gagal ditambahkan!')
                        document.location.href = 'index.php'
                    </script>";
            }
        } else {
            // Stok tidak mencukupi
            echo "
                <script>
                    alert('Stok tidak mencukupi! Stok tersedia: $stokTersedia')
                    document.location.href = 'index.php'
                </script>";
        }
    } else {
        // Produk tidak ditemukan
        echo "
            <script>
                alert('Produk tidak ditemukan!')
                document.location.href = 'index.php'
            </script>";
    }
}


if (isset($_POST["btn-edit"])) {
    if (editProduk($_POST) > 0) {
        echo "
            <script>
                alert('produk berhasil diubah!');
                document.location.href = '../produk.php';
            </script>";
    } else {
        echo "
            <script>
                alert('produk gagal diubah!');
                document.location.href = 'edit-produk.php';
            </script>";
    }
}

if (isset($_POST['btn-bayar'])) {
    if (bayar($_POST)) {
        echo "<script>
    document.location.href='nota.php'
    </script>";
    } else {
        echo "<script>
    alert('Produk tidak Berhasil Di pesan')
    document.location.href='nota.php'
    </script>";
    }
}

if (isset($_POST['btn-cari'])) {
    $dataProduk = cari($_POST['keyword']);
}

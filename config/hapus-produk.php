<?php
require 'functions.php';
$id = $_GET['id'];
if (hapusProduk($id)) {
    echo "
        <script>
            document.location.href = '../produk.php';
        </script>
        ";
} else {
    echo "
        <script>
            document.location.href = '../produk.php';
        </script>
        ";
}

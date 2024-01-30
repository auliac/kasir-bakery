<?php

include 'functions.php';

session_start();

// menangkap data yg dikirim dr form login
$username = $_POST['username'];
$password = $_POST['password'];

// seleksi data user dgn username yg sesuai
$query = mysqli_query($conn, "SELECT * FROM registrasi WHERE username = '$username'");

if ($query) {
    $row = mysqli_fetch_assoc($query);

    // verif password
    if (password_verify($password, $row['password'])) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        if ($row['role'] == "admin") {
            header("Location: ../produk.php");
            exit();
        } else if ($row['role'] == "petugas") {
            header("Location: ../index.php");
            exit();
        }
    } else {
        // password tidak cocok
        header("Location: ../login.php");
        exit();
    }
} else {
    // error query
    echo "Error: " . mysqli_error($conn);
}

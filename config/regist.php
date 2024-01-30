<?php

include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // proses form registrasi
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // insert data ke database
    $query = mysqli_query($conn, "INSERT INTO registrasi (id, nama, username, password, role) VALUES
                ('$id', 
                '$nama',
                '$username',
                '$hashed_password',
                '$role')"
    );

    if ($query) {
        echo "
            <script>
                alert('Berhasil registrasi, silahkan login!');
                document.location.href = '../login.php';
            </script>        
        ";
    } else {
        echo "Error:" . mysqli_error($conn);
    }
}

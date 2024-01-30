<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <h1 class="h1_regist">Registrasi</h1>

    <div class="panel_login">

        <form action="config/regist.php" method="post">
            <input type="hidden" name="id" value="id">

            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form_login" placeholder="Nama" autocomplete="off" required>

            <label for="username">Username</label>
            <input type="text" name="username" class="form_login" placeholder="Username" autocomplete="off" required>

            <label for="password">Password</label>
            <input type="password" name="password" class="form_login" placeholder="Password" autocomplete="off" required>

            <label for="role">Role</label>
            <select name="role" class="form_login" required>
                <option></option>
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
            </select>

            <br>

            <input type="submit" class="tombol_login" value="REGISTRASI">

        </form>

    </div>
</body>

</html>
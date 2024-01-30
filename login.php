<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <h1 class="h1_regist">Login</h1>

    <div class="panel_login">

        <p class="tulisan_atas">Silahkan login</p>

        <form action="config/cek_login.php" method="post">

            <label for="username">Username</label>
            <input type="text" name="username" class="form_login" placeholder="Username" autocomplete="off" required>

            <label for="password">Password</label>
            <input type="password" name="password" class="form_login" placeholder="Password" autocomplete="off" required>

            <input type="submit" class="tombol_login" value="LOGIN">
        </form>

    </div>
</body>

</html>
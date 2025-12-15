<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Pengguna</title>
    <link rel="stylesheet" href="assets/style.css?v=1.0">
</head>
<body>
    <h2>Masuk ke Akun</h2>

    <form action="backend/login_process.php" method="POST">

        <label for="email">Email:</label>
        <input id="email" type="email" name="email" required>

        <label for="password">Password:</label>
        <input id="password" type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <div style="text-align:center;margin-top:14px;">
        <a class="link-small" href="index.php">Kembali ke Halaman Utama</a>
    </div>

</body>
</html>
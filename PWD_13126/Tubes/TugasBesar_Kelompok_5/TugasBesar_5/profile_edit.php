<?php
session_start();

// Jika belum login, kembalikan ke login
if (!isset($_SESSION['id_users'])) {
    header("Location: login.php");
    exit;
}

include 'config/db.php';

// Ambil ID user dari session
$id = $_SESSION['id_users'];

// Ambil data user dari database
$query = "SELECT * FROM users WHERE id_users = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="assets/style.css?v=1.0">
</head>
<body>

    <div style="position:absolute; top:40px; right:40px;">
        <a class="link-small" href="profile.php">Kembali ke Profil</a>
    </div>

    <h2>Edit Profil</h2>

    <form method="POST" action="backend/update_profile.php">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($data['email']); ?>" required>

        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" value="<?= htmlspecialchars($data['alamat']); ?>">

        <label for="telepon">No Telepon:</label>
        <input type="text" id="telepon" name="telepon" value="<?= htmlspecialchars($data['telepon']); ?>">

        <button type="submit">Simpan Perubahan</button>
    </form>

</body>
</html>

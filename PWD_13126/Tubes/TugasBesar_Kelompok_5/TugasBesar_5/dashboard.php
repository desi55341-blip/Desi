<?php
session_start();

if (!isset($_SESSION['id_users'])) {
    header("Location: login.php");
    exit;
}

include 'config/db.php';

$id = $_SESSION['id_users'];
$query = "SELECT * FROM users WHERE id_users = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/style.css?v=1.0">
</head>
<body>

    <h2>Dashboard Sistem Rumah Sakit</h2>

    <p>Selamat datang, <strong><?= $data['nama']; ?></strong>!</p>

    <h3>Menu Navigasi</h3>
    <ul>
        <li><a class="btn" href="profile.php">Lihat Profil</a></li>

        <li><a class="btn" href="backend/dokter_read.php">Data Dokter</a></li>

        <li><a class="btn" href="backend/logout.php">Logout</a></li>
    </ul>

</body>
</html>
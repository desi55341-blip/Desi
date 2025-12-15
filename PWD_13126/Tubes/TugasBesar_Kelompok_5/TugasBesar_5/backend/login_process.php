<?php
session_start();
include '../config/db.php';

$email    = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($user) {
    if (password_verify($password, $user['password'])) {

        $_SESSION['id_users'] = $user['id_users'];
        $_SESSION['nama']     = $user['nama'];

        echo "<script>alert('Login berhasil!'); window.location='../dashboard.php';</script>";
    } 
    else {
        echo "<script>alert('Password salah!'); window.location='../login.php';</script>";
    }
} 
else {
    echo "<script>alert('Email tidak ditemukan!'); window.location='../login.php';</script>";
}
?>
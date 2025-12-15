<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['id_users'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_SESSION['id_users'];

// Hanya terima POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash'] = 'Invalid request method.';
    header('Location: ../profile.php');
    exit;
}

$nama    = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$email   = isset($_POST['email']) ? trim($_POST['email']) : '';
$alamat  = isset($_POST['alamat']) ? trim($_POST['alamat']) : '';
$telepon = isset($_POST['telepon']) ? trim($_POST['telepon']) : '';

// Validasi sederhana
if ($nama === '') {
    $_SESSION['flash'] = 'Nama tidak boleh kosong.';
    header('Location: ../profile.php');
    exit;
}

// Validasi email
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['flash'] = 'Email tidak valid.';
    header('Location: ../profile.php');
    exit;
}

// Pastikan email belum dipakai oleh user lain
$check = mysqli_prepare($conn, "SELECT id_users FROM users WHERE email = ? AND id_users != ?");
if ($check) {
    mysqli_stmt_bind_param($check, 'si', $email, $id);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);
    if (mysqli_stmt_num_rows($check) > 0) {
        $_SESSION['flash'] = 'Email sudah digunakan oleh akun lain.';
        mysqli_stmt_close($check);
        header('Location: ../profile.php');
        exit;
    }
    mysqli_stmt_close($check);
} else {
    $_SESSION['flash'] = 'Gagal memeriksa email: ' . mysqli_error($conn);
    header('Location: ../profile.php');
    exit;
}

// Sanitasi nomor telepon: ambil hanya digit, lalu pastikan panjang 13 digit
$telepon_digits = preg_replace('/\D/', '', $telepon);
if (strlen($telepon_digits) != 13) {
    $_SESSION['flash'] = 'Nomor telepon harus berupa 13 digit angka.';
    header('Location: ../profile.php');
    exit;
}
$telepon = $telepon_digits;

// Gunakan prepared statement untuk keamanan
$stmt = mysqli_prepare($conn, "UPDATE users SET nama = ?, email = ?, alamat = ?, telepon = ? WHERE id_users = ?");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ssssi', $nama, $email, $alamat, $telepon, $id);
    $ok = mysqli_stmt_execute($stmt);
    if ($ok) {
        $_SESSION['flash'] = 'Profil berhasil diperbarui.';
        mysqli_stmt_close($stmt);
        header('Location: ../profile.php');
        exit;
    } else {
        $_SESSION['flash'] = 'Gagal memperbarui profil: ' . mysqli_error($conn);
        mysqli_stmt_close($stmt);
        header('Location: ../profile.php');
        exit;
    }
} else {
    $_SESSION['flash'] = 'Gagal menyiapkan query: ' . mysqli_error($conn);
    header('Location: ../profile.php');
    exit;
}

?>
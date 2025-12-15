<?php
include '../config/db.php';

// Ambil data dari form
$nama     = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$email    = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$alamat   = isset($_POST['alamat']) ? trim($_POST['alamat']) : '';
$telepon  = isset($_POST['telepon']) ? trim($_POST['telepon']) : '';

if (strlen($password) < 8) {
    echo "<script>alert('Password harus minimal 8 karakter.'); window.location='../register.php';</script>";
    exit;
}

// Sanitasi nomor telepon: ambil hanya digit, lalu pastikan panjang 13 digit
$telepon_digits = preg_replace('/\D/', '', $telepon);
if (strlen($telepon_digits) != 13) {
    echo "<script>alert('Nomor telepon harus berupa 13 digit angka.'); window.location='../register.php';</script>";
    exit;
}
$telepon = $telepon_digits;

// Cek apakah email sudah terdaftar (untuk mencegah duplikat)
if ($email !== '') {
    $check = mysqli_prepare($conn, "SELECT id_users FROM users WHERE email = ? LIMIT 1");
    if ($check) {
        mysqli_stmt_bind_param($check, 's', $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);
        if (mysqli_stmt_num_rows($check) > 0) {
            echo "<script>alert('Email sudah terdaftar. Gunakan email lain.'); window.location='../register.php';</script>";
            mysqli_stmt_close($check);
            exit;
        }
        mysqli_stmt_close($check);
    } else {
        echo "<script>alert('Gagal memeriksa email.'); window.location='../register.php';</script>";
        exit;
    }
}

// Cek apakah nama sudah dipakai (jika Anda ingin mencegah nama duplikat)
if ($nama !== '') {
    $checkNama = mysqli_prepare($conn, "SELECT id_users FROM users WHERE nama = ? LIMIT 1");
    if ($checkNama) {
        mysqli_stmt_bind_param($checkNama, 's', $nama);
        mysqli_stmt_execute($checkNama);
        mysqli_stmt_store_result($checkNama);
        if (mysqli_stmt_num_rows($checkNama) > 0) {
            echo "<script>alert('Nama sudah digunakan. Gunakan nama lain.'); window.location='../register.php';</script>";
            mysqli_stmt_close($checkNama);
            exit;
        }
        mysqli_stmt_close($checkNama);
    } else {
        echo "<script>alert('Gagal memeriksa nama.'); window.location='../register.php';</script>";
        exit;
    }
}

// username feature removed

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert menggunakan prepared statement (tanpa username)
$stmt = mysqli_prepare($conn, "INSERT INTO users (nama, email, password, alamat, telepon) VALUES (?, ?, ?, ?, ?)");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'sssss', $nama, $email, $hashed_password, $alamat, $telepon);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    if ($ok) {
        echo "<script>alert('Registrasi berhasil!'); window.location='../login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal!'); window.location='../register.php';</script>";
    }
} else {
    echo "<script>alert('Gagal menyiapkan query pendaftaran.'); window.location='../register.php';</script>";
}
?>
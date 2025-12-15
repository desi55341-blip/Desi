<?php
// Konfigurasi database
$host = "localhost"; 
$user = "root";       
$pass = "";           
$db   = "rumah_sakit_db"; 

// Koneksi ke MySQL
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
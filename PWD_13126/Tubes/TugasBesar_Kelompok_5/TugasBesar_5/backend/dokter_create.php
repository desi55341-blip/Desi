<?php
include '../config/db.php';

// Ambil data dari form
$nama      = mysqli_real_escape_string($conn, $_POST['nama_dokter']);
$spesialis = mysqli_real_escape_string($conn, $_POST['spesialis']);
$ruangan   = mysqli_real_escape_string($conn, $_POST['ruangan']);

// Query INSERT ke tabel dokter
$query = "INSERT INTO dokter (nama_dokter, spesialis, ruangan)
          VALUES ('$nama', '$spesialis', '$ruangan')";

if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Data dokter berhasil ditambahkan!');
            window.location='dokter_read.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menambah data dokter!');
            window.location='dokter_form_create.php';
          </script>";
}
?>
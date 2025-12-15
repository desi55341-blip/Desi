<?php
include '../config/db.php';

// Ambil data dari form
$id        = intval($_POST['id_dokter']);
$nama      = mysqli_real_escape_string($conn, $_POST['nama_dokter']);
$spesialis = mysqli_real_escape_string($conn, $_POST['spesialis']);
$ruangan   = mysqli_real_escape_string($conn, $_POST['ruangan']);

$query = "UPDATE dokter 
          SET nama_dokter = '$nama', 
              spesialis   = '$spesialis', 
              ruangan     = '$ruangan'
          WHERE id_dokter = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Data dokter berhasil diperbarui!');
            window.location='dokter_read.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal memperbarui data dokter!');
            window.location='dokter_form_update.php?id=$id';
          </script>";
}
?>
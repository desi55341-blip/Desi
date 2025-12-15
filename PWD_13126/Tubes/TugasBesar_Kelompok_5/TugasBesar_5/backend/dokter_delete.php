<?php
include '../config/db.php';

// Pastikan ID tersedia
if (!isset($_GET['id'])) {
    header("Location: dokter_read.php");
    exit;
}

$id = intval($_GET['id']);

$query = "DELETE FROM dokter WHERE id_dokter = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Data dokter berhasil dihapus!');
            window.location='dokter_read.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus data dokter!');
            window.location='dokter_read.php';
          </script>";
}
?>
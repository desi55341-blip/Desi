<?php
include '../config/db.php';

// Pastikan ada ID pada URL
if (!isset($_GET['id'])) {
    header("Location: dokter_read.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil data dokter berdasarkan ID
$query = "SELECT * FROM dokter WHERE id_dokter = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan
if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Dokter</title>
    <link rel="stylesheet" href="../assets/style.css?v=1.0">
</head>
<body>

    <h2>Edit Data Dokter</h2>

    <form action="dokter_update.php" method="POST">

        <input type="hidden" name="id_dokter" value="<?= $data['id_dokter']; ?>">

        <label for="nama_dokter">Nama Dokter:</label>
        <input id="nama_dokter" type="text" name="nama_dokter" value="<?= htmlspecialchars($data['nama_dokter']); ?>" required>

        <label for="spesialis">Spesialis:</label>
        <input id="spesialis" type="text" name="spesialis" value="<?= htmlspecialchars($data['spesialis']); ?>" required>

        <label for="ruangan">Ruangan:</label>
        <input id="ruangan" type="text" name="ruangan" value="<?= htmlspecialchars($data['ruangan']); ?>">

        <button type="submit">Update</button>
    </form>

    <div style="text-align:center;margin-top:14px;">
        <a class="link-small" href="dokter_read.php">Kembali ke Data Dokter</a>
    </div>

</body>
</html>
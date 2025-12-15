<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Dokter</title>
    <link rel="stylesheet" href="../assets/style.css?v=1.0">
</head>
<body>

    <h2>Tambah Dokter</h2>

    <form action="dokter_create.php" method="POST">

        <label for="nama_dokter">Nama Dokter:</label>
        <input id="nama_dokter" type="text" name="nama_dokter" required>

        <label for="spesialis">Spesialis:</label>
        <input id="spesialis" type="text" name="spesialis" required>

        <label for="ruangan">Ruangan:</label>
        <input id="ruangan" type="text" name="ruangan">

        <button type="submit">Simpan</button>
    </form>

    <div style="text-align:center;margin-top:14px;">
        <a class="link-small" href="dokter_read.php">Kembali ke Data Dokter</a>
    </div>

</body>
</html>
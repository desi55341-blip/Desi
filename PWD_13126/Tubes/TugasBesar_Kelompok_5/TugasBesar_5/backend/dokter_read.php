<?php
include '../config/db.php';

// Ambil semua data dokter
$result = mysqli_query($conn, "SELECT * FROM dokter ORDER BY id_dokter ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Dokter</title>
    <link rel="stylesheet" href="../assets/style.css?v=1.0">
</head>
<body>

<div style="max-width:1100px;margin:40px auto;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">
        <h2>Data Dokter Rumah Sakit</h2>
        <div>
            <a class="btn" href="dokter_form_create.php">Tambah Dokter</a>
            <a class="btn" href="../dashboard.php">Kembali ke Dashboard</a>
        </div>
    </div>

    <div class="doctor-grid">
    <?php while ($row = mysqli_fetch_assoc($result)) : 
        $img = '../assets/images/doctor-placeholder.svg';
        if (!empty($row['foto'])) { $img = '../uploads/'. $row['foto']; }
    ?>
        <div class="doctor-card">
            <img src="<?= $img; ?>" alt="Foto <?= htmlspecialchars($row['nama_dokter']); ?>">
            <div class="doctor-info">
                <h4><?= htmlspecialchars($row['nama_dokter']); ?></h4>
                <p><?= htmlspecialchars($row['spesialis']); ?> &middot; Ruangan: <?= htmlspecialchars($row['ruangan']); ?></p>
            </div>
            <div class="doctor-actions">
                <a class="edit" href="dokter_form_update.php?id=<?= $row['id_dokter']; ?>">Edit</a>
                <a class="del" href="dokter_delete.php?id=<?= $row['id_dokter']; ?>" onclick="return confirm('Yakin ingin menghapus dokter ini?');">Hapus</a>
            </div>
        </div>
    <?php endwhile; ?>
    </div>

</div>

</body>
</html>
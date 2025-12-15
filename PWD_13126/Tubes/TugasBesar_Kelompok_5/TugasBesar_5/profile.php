<?php
session_start();

// Jika belum login, kembalikan ke login
if (!isset($_SESSION['id_users'])) {
    header("Location: login.php");
    exit;
}

include 'config/db.php';

// Ambil ID user dari session
$id = $_SESSION['id_users'];

// Ambil data user dari database
$query = "SELECT * FROM users WHERE id_users = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="assets/style.css?v=1.0">
</head>
<body>

    <h2>Profil Anda</h2>

    <?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
    <?php if (!empty($_SESSION['flash'])): ?>
        <div style="max-width:720px;margin:10px auto;padding:10px;border-radius:8px;background:#ecfdf5;color:#065f46;font-weight:600;"><?= htmlspecialchars($_SESSION['flash']); ?></div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <div class="profile-card compact">
        <?php
            $avatar = 'assets/images/doctor-placeholder.svg';
            if (!empty($data['foto'])) { $avatar = 'uploads/' . $data['foto']; }
        ?>
        <img src="<?= htmlspecialchars($avatar); ?>" alt="Avatar">
        <div class="profile-info">
            <div class="name-row">
                <span class="label">Nama:</span>
                <h3><?= htmlspecialchars($data['nama']); ?></h3>
            </div>

            <?php
                $sp = '';
                if (!empty($data['spesialis'])) { $sp = $data['spesialis']; }
                elseif (!empty($data['jabatan'])) { $sp = $data['jabatan']; }
                elseif (!empty($data['departemen'])) { $sp = $data['departemen']; }

                $ruang = '';
                if (!empty($data['ruangan'])) { $ruang = $data['ruangan']; }
                elseif (!empty($data['room'])) { $ruang = $data['room']; }
                elseif (!empty($data['no_ruangan'])) { $ruang = $data['no_ruangan']; }
            ?>

            <?php if ($sp || $ruang): ?>
                <p class="muted-line"><?php
                    echo $sp ? htmlspecialchars($sp) : '';
                    echo ($sp && $ruang) ? ' · ' : '';
                    echo $ruang ? 'Ruangan: ' . htmlspecialchars($ruang) : '';
                ?></p>
            <?php endif; ?>

            <p><strong>Email:</strong> <?= htmlspecialchars($data['email']); ?></p>
            <p><strong>Alamat:</strong> <?= htmlspecialchars($data['alamat']); ?></p>
            <p><strong>No Telepon:</strong> <?= htmlspecialchars($data['telepon']); ?></p>
        </div>

        <div class="profile-actions">
            <a class="btn" href="profile_edit.php">Edit Profil</a>
            <a class="btn" href="dashboard.php">Dashboard</a>
            <a class="btn" href="backend/logout.php">Logout</a>
        </div>
    </div>

</body>
</html>
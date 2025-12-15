<?php
header('Content-Type: application/json; charset=utf-8');
include '../config/db.php';

$method = $_SERVER['REQUEST_METHOD'];
$email = '';
if ($method === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
} elseif ($method === 'GET') {
    $email = isset($_GET['email']) ? trim($_GET['email']) : '';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['available' => false, 'error' => 'Email tidak valid']);
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT id_users FROM users WHERE email = ? LIMIT 1");
if (!$stmt) {
    echo json_encode(['available' => false, 'error' => 'Database error']);
    exit;
}
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$count = mysqli_stmt_num_rows($stmt);
mysqli_stmt_close($stmt);

if ($count > 0) {
    echo json_encode(['available' => false]);
} else {
    echo json_encode(['available' => true]);
}

exit;
?>

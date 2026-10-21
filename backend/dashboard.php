<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['user']['username'];
$email = $_SESSION['user']['email'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - UTS</title>
</head>
<body>
    <h1>Selamat Datang, <?= htmlspecialchars($username) ?>!</h1>
    <p>Anda berhasil login dengan email: <strong><?= htmlspecialchars($email) ?></strong></p>
    
    <a href="logout.php">Logout</a>
</body>
</html>
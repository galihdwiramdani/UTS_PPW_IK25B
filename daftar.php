<?php
session_start();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($email) || empty($password)) {
        $error = "Semua kolom wajib diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid!";
    } else {
        $file = 'users.json';
        $users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        if (!is_array($users)) $users = [];

        $emailExists = false;
        foreach ($users as $user) {
            if (strtolower($user['email']) === strtolower($email)) {
                $emailExists = true;
                break;
            }
        }

        if ($emailExists) {
            $error = "Email sudah terdaftar!";
        } else {
            $newUser = [
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];

            $users[] = $newUser;
            file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
            $success = "Pendaftaran berhasil! Silakan <a href='login.php'>Login di sini</a>.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran - UTS</title>
</head>
<body>
    <!-- php start -->
    <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p style="color: green;"><?= $success ?></p>
    <?php endif; ?>
    <!-- php end -->

    <form method="POST" action="">
        <label>Username </label>
        <input type="text" name="username" placeholder="galih Dwi Rahmat" required><br>
        <label>Email </label>
        <input type="email" name="email" placeholder="galih@chelsye.heart" required><br>
        <label>Password </label>
        <input type="password" name="password" placeholder="********" required><br>
        <button type="submit">Daftar</button>
        <button type="reset">Reset</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</body>
</html>
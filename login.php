<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Email dan password wajib diisi!";
    } else {
        $file = 'users.json';
        $users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        if (!is_array($users)) $users = [];

        $foundUser = null;
        foreach ($users as $user) {
            if (strtolower($user['email']) === strtolower($email)) {
                $foundUser = $user;
                break;
            }
        }

        if ($foundUser && password_verify($password, $foundUser['password'])) {
            $_SESSION['user'] = [
                'username' => $foundUser['username'],
                'email' => $foundUser['email']
            ];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Email atau password salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UTS</title>
</head>
<body>
    <main>
        <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="galih@chelsye.love"><br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="********"><br>
            <button type="submit">Login</button>
            <button type="reset">Reset</button>
        </form>
        <p>Belum punya akun? <a href="daftar.php">Daftar di sini</a></p>
    </main>
</body>
</html>
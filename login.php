<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: home.php');
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
            header('Location: home.php');
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
  <title>Login - Kumpul</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php if ($error): ?>
  <p style="color: red;">
    <?= $error ?>
  </p>
  <?php endif; ?>

  <main class="halaman-form">
    <a href="index.html" class="logo">
      <span class="logo-ikon">K</span>
      Kumpul
    </a>
    <section class="kartu kartu-form">
      <h1>Selamat datang kembali</h1>
      <p class="sub-judul">Masuk untuk melihat cerita terbaru temanmu</p>
      <form action="" method="POST">
        <div class="grup-input">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="nama@email.com" required>
        </div>
        <div class="grup-input">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn btn-utama btn-penuh">Masuk</button>
      </form>
      <div class="pemisah"></div>
      <p class="teks-bawah-form">
        Belum punya akun? <a href="register.php">Daftar</a>
      </p>
    </section>
    <a href="index.html" class="link-kembali">&larr; Kembali ke halaman awal</a>
  </main>
</body>

</html>
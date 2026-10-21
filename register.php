<?php
session_start();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['konfirmasi_password'] ?? '';

    if (empty($username) || empty($email) || empty($password)) {
        $error = "Semua kolom wajib diisi!";
    } elseif ($password != $confirm_password) {
      $error = "Password tidak sama";
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
  <title>Daftar - Kumpul</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php if ($error): ?>
  <p style="color: red;">
    <?= $error ?>
  </p>
  <?php endif; ?>
  <?php if ($success): ?>
  <p style="color: green;">
    <?= $success ?>
  </p>
  <?php endif; ?>

  <main class="halaman-form">
    <a href="index.html" class="logo">
      <span class="logo-ikon">K</span>
      Kumpul
    </a>

    <section class="kartu kartu-form">
      <h1>Buat akun baru</h1>
      <p class="sub-judul">Gratis dan hanya butuh satu menit.</p>
      <form action="" method="POST">
        <div class="grup-input">
          <label for="nama">Nama lengkap</label>
          <input type="text" id="username" name="username" placeholder="Contoh: Galih Dwi Ramdani" required>
        </div>
        <div class="grup-input">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="galih@chelsye.heart" required>
        </div>
        <div class="grup-input">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" minlength="6" required>
        </div>
        <div class="grup-input">
          <label for="konfirmasi_password">Konfirmasi password</label>
          <input type="password" id="konfirmasi_password" name="konfirmasi_password" placeholder="Ulangi password"
            minlength="6" required>
        </div>
        <button type="submit" class="btn btn-utama btn-penuh">Daftar</button>
      </form>

      <div class="pemisah"></div>
      <p class="teks-bawah-form">
        Sudah punya akun? <a href="login.php">Login</a>
      </p>
    </section>
    <a href="index.html" class="link-kembali">&larr; Kembali ke halaman awal</a>
  </main>
</body>

</html>
<?php
require dirname(__DIR__) . '/includes/login_process.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Kumpul</title>
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <?php if ($error): ?>
  <p style="color: red;">
    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
  </p>
  <?php endif; ?>

  <main class="halaman-form">
    <a href="/" class="logo">
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
    <a href="/" class="link-kembali">&larr; Kembali ke halaman awal</a>
  </main>
</body>

</html>
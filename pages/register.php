<?php
require dirname(__DIR__) . '/includes/register_process.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar - Kumpul</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

  <?php if ($error): ?>
  <p style="color: red;">
    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
  </p>
  <?php endif; ?>
  <?php if ($success): ?>
  <p style="color: green;">
    Pendaftaran berhasil! Silakan <a href="login.php">Login di sini</a>.
  </p>
  <?php endif; ?>

  <main class="halaman-form">
    <a href="../" class="logo">
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
          <input type="email" id="email" name="email" placeholder="galih@example.app" required>
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
    <a href="../" class="link-kembali">&larr; Kembali ke halaman awal</a>
  </main>
</body>

</html>
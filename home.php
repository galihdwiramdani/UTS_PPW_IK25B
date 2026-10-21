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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda - Kumpul</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="navbar">
    <div class="navbar-isi">
      <a href="beranda.html" class="logo">
        <span class="logo-ikon">K</span>
        Kumpul
      </a>
      <nav>
        <ul class="navbar-menu">
          <li><a href="#profil">Profil</a></li>
          <li><a href="logout.php" class="logout">Logout</a></li>
        </ul>
      </nav>

    </div>
  </header>
  <div class="layout-beranda">
    <aside class="kartu sidebar" id="profil">
      <div class="sidebar-sampul"></div>
      <div class="sidebar-isi">
        <div class="avatar-besar">N</div>
        <h2 class="sidebar-nama"><?= htmlspecialchars($username) ?>!</h2>
        <p class="sidebar-email"><?= htmlspecialchars($email) ?>!</p>
        <div class="sidebar-statistik">
          <div><strong>0</strong><span>Postingan</span></div>
          <div><strong>0</strong><span>Teman</span></div>
          <div><strong>0</strong><span>Pengikut</span></div>
        </div>
      </div>
    </aside>
    <main class="feed">
      <section class="kartu buat-status">
        <form action="#" method="POST">
          <div class="buat-status-atas">
            <div class="avatar-kecil">N</div>
            <textarea name="status" placeholder="Apa yang kamu pikirkan hari ini?"></textarea>
          </div>
          <div class="buat-status-bawah">
            <button type="submit" class="btn btn-utama">Posting</button>
          </div>
        </form>
      </section>
      <section class="kartu feed-kosong">
        <div class="feed-kosong-ikon">📭</div>
        <h2>Belum ada postingan</h2>
        <p>Jadilah yang pertama membagikan cerita!</p>
      </section>
    </main>
  </div>
</body>
</html>
<?php
require dirname(__DIR__) . '/includes/auth.php';
require_authenticated_user();

$username = $_SESSION['user']['username'];
$email = $_SESSION['user']['email'];

// --- LOGIKA PENYIMPANAN POSTINGAN ---
// Inisialisasi array postingan di session jika belum ada
if (!isset($_SESSION['semua_postingan'])) {
    $_SESSION['semua_postingan'] = [];
}

// Tangkap data dari form jika ada request POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    $isi_status = trim($_POST['status']);
    
    // Pastikan status tidak kosong sebelum disimpan
    if (!empty($isi_status)) {
        $postingan_baru = [
            'username' => $username,
            'status' => htmlspecialchars($isi_status), // Mencegah XSS
            'waktu' => date('d M Y, H:i')
        ];
        
        // Tambahkan postingan baru ke urutan paling atas array
        array_unshift($_SESSION['semua_postingan'], $postingan_baru);
        
        // Redirect ke halaman yang sama untuk mencegah form terkirim ulang (resubmission) saat di-refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Ambil data postingan untuk ditampilkan
$feed_postingan = $_SESSION['semua_postingan'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda - Kumpul</title>
  <link rel="stylesheet" href="../assets/style.css">
  <style>
    /* Tambahan CSS sederhana untuk kartu postingan, sesuaikan dengan style.css milikmu */
    .postingan-item { margin-top: 15px; padding: 15px; }
    .postingan-header { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
    .postingan-waktu { font-size: 0.8em; color: gray; }
  </style>
</head>
<body>
  <header class="navbar">
    <div class="navbar-isi">
      <a href="../" class="logo">
        <span class="logo-ikon">K</span>
        Kumpul
      </a>
      <nav>
        <ul class="navbar-menu">
          <li><a href="#profil">Profil</a></li>
          <li><a href="../includes/logout_process.php" class="logout">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>
  
  <div class="layout-beranda">
    <aside class="kartu sidebar" id="profil">
      <div class="sidebar-sampul"></div>
      <div class="sidebar-isi">
        <div class="avatar-besar"><?= strtoupper(substr($username, 0, 1)) ?></div>
        <h2 class="sidebar-nama"><?= htmlspecialchars($username) ?>!</h2>
        <p class="sidebar-email"><?= htmlspecialchars($email) ?></p>
        <div class="sidebar-statistik">
          <div><strong><?= count($feed_postingan) ?></strong><span>Postingan</span></div>
          <div><strong>0</strong><span>Teman</span></div>
          <div><strong>0</strong><span>Pengikut</span></div>
        </div>
      </div>
    </aside>
    
    <main class="feed">
      <section class="kartu buat-status">
        <!-- Action dikosongkan agar memproses POST ke halaman ini sendiri -->
        <form action="" method="POST">
          <div class="buat-status-atas">
            <div class="avatar-kecil"><?= strtoupper(substr($username, 0, 1)) ?></div>
            <textarea name="status" placeholder="Apa yang kamu pikirkan hari ini?" required></textarea>
          </div>
          <div class="buat-status-bawah">
            <button type="submit" class="btn btn-utama">Posting</button>
          </div>
        </form>
      </section>

      <!-- BAGIAN MENAMPILKAN FEED -->
      <?php if (empty($feed_postingan)): ?>
        <section class="kartu feed-kosong">
          <div class="feed-kosong-ikon">📭</div>
          <h2>Belum ada postingan</h2>
          <p>Jadilah yang pertama membagikan cerita!</p>
        </section>
      <?php else: ?>
        <?php foreach ($feed_postingan as $post): ?>
          <section class="kartu postingan-item">
            <div class="postingan-header">
              <div class="avatar-kecil"><?= strtoupper(substr($post['username'], 0, 1)) ?></div>
              <div>
                <strong><?= htmlspecialchars($post['username']) ?></strong><br>
                <span class="postingan-waktu"><?= $post['waktu'] ?></span>
              </div>
            </div>
            <div class="postingan-isi">
              <!-- nl2br agar enter (baris baru) di textarea ikut terbaca -->
              <?= nl2br($post['status']) ?>
            </div>
          </section>
        <?php endforeach; ?>
      <?php endif; ?>

    </main>
  </div>
</body>
</html>
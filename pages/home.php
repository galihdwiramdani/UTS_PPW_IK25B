<?php
require dirname(__DIR__) . '/includes/auth.php';
require_authenticated_user();
require dirname(__DIR__) . '/includes/post_process.php';
require_once dirname(__DIR__) . '/includes/post_store.php';

$username = $_SESSION['user']['username'];
$email = $_SESSION['user']['email'];
$posts = array_reverse(load_posts());
$userPostCount = count(array_filter(
    $posts,
    static fn (array $post): bool => isset($post['email']) && $post['email'] === $email
));
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
<<<<<<< HEAD
        <div class="avatar-besar"><?= strtoupper(substr($username, 0, 1)) ?></div>
=======
        <div class="avatar-besar"><?= htmlspecialchars(strtoupper(substr($username, 0, 1)), ENT_QUOTES, 'UTF-8') ?></div>
>>>>>>> 555635e (feat: add new posting feature)
        <h2 class="sidebar-nama"><?= htmlspecialchars($username) ?>!</h2>
        <p class="sidebar-email"><?= htmlspecialchars($email) ?></p>
        <div class="sidebar-statistik">
<<<<<<< HEAD
          <div><strong><?= count($feed_postingan) ?></strong><span>Postingan</span></div>
=======
          <div><strong><?= $userPostCount ?></strong><span>Postingan</span></div>
>>>>>>> 555635e (feat: add new posting feature)
          <div><strong>0</strong><span>Teman</span></div>
          <div><strong>0</strong><span>Pengikut</span></div>
        </div>
      </div>
    </aside>
    
    <main class="feed">
      <?php if ($error !== ''): ?>
      <p class="pesan pesan-error" role="alert">
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
      </p>
      <?php endif; ?>
      <?php if ($success): ?>
      <p class="pesan pesan-sukses" role="status">Postingan berhasil dibagikan!</p>
      <?php endif; ?>
      <section class="kartu buat-status">
<<<<<<< HEAD
        <!-- Action dikosongkan agar memproses POST ke halaman ini sendiri -->
        <form action="" method="POST">
          <div class="buat-status-atas">
            <div class="avatar-kecil"><?= strtoupper(substr($username, 0, 1)) ?></div>
            <textarea name="status" placeholder="Apa yang kamu pikirkan hari ini?" required></textarea>
=======
        <form action="" method="POST">
          <div class="buat-status-atas">
            <div class="avatar-kecil"><?= htmlspecialchars(strtoupper(substr($username, 0, 1)), ENT_QUOTES, 'UTF-8') ?></div>
            <textarea name="status" placeholder="Apa yang kamu pikirkan hari ini?" required><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></textarea>
>>>>>>> 555635e (feat: add new posting feature)
          </div>
          <div class="buat-status-bawah">
            <button type="submit" class="btn btn-utama">Posting</button>
          </div>
        </form>
      </section>
<<<<<<< HEAD

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

=======
      <?php if ($posts !== []): ?>
        <?php foreach ($posts as $post): ?>
      <article class="kartu postingan">
        <div class="postingan-atas">
          <div class="avatar-kecil"><?= htmlspecialchars(strtoupper(substr($post['username'], 0, 1)), ENT_QUOTES, 'UTF-8') ?></div>
          <div>
            <strong><?= htmlspecialchars($post['username'], ENT_QUOTES, 'UTF-8') ?></strong>
            <time datetime="<?= htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8') ?>">
              <?= htmlspecialchars(date('d M Y, H:i', strtotime($post['created_at'])), ENT_QUOTES, 'UTF-8') ?>
            </time>
          </div>
        </div>
        <p class="postingan-konten"><?= nl2br(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8')) ?></p>
      </article>
        <?php endforeach; ?>
      <?php else: ?>
      <section class="kartu feed-kosong">
        <div class="feed-kosong-ikon">📭</div>
        <h2>Belum ada postingan</h2>
        <p>Jadilah yang pertama membagikan cerita!</p>
      </section>
      <?php endif; ?>
>>>>>>> 555635e (feat: add new posting feature)
    </main>
  </div>
</body>
</html>
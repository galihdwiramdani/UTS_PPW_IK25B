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
        <div class="avatar-besar"><?= htmlspecialchars(strtoupper(substr($username, 0, 1)), ENT_QUOTES, 'UTF-8') ?></div>
        <h2 class="sidebar-nama"><?= htmlspecialchars($username) ?>!</h2>
        <p class="sidebar-email"><?= htmlspecialchars($email) ?></p>
        <div class="sidebar-statistik">
          <div><strong><?= $userPostCount ?></strong><span>Postingan</span></div>
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
        <form action="" method="POST">
          <div class="buat-status-atas">
            <div class="avatar-kecil"><?= htmlspecialchars(strtoupper(substr($username, 0, 1)), ENT_QUOTES, 'UTF-8') ?></div>
            <textarea name="status" placeholder="Apa yang kamu pikirkan hari ini?" required><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></textarea>
          </div>
          <div class="buat-status-bawah">
            <button type="submit" class="btn btn-utama">Posting</button>
          </div>
        </form>
      </section>
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
    </main>
  </div>
</body>
</html>
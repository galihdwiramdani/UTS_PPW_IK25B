<?php

require_once __DIR__ . '/post_store.php';

$error = '';
$success = !empty($_SESSION['post_success']);
unset($_SESSION['post_success']);
$status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'] ?? '';
    if (!is_string($status)) {
        $status = '';
    }
    $content = trim($status);

    if ($content === '') {
        $error = 'Postingan tidak boleh kosong!';
    } else {
        $posts = load_posts();
        $posts[] = [
            'username' => $_SESSION['user']['username'],
            'email' => $_SESSION['user']['email'],
            'content' => $content,
            'created_at' => date(DATE_ATOM),
        ];
        save_posts($posts);
        $_SESSION['post_success'] = true;
        header('Location: home.php', true, 303);
        exit;
    }
}

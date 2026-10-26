<?php

function load_posts(): array
{
    $file = dirname(__DIR__) . '/data/posts.php';
    if (!is_file($file)) {
        return [];
    }

    $posts = require $file;
    if (!is_array($posts)) {
        throw new UnexpectedValueException('Format data postingan tidak valid.');
    }

    foreach ($posts as $post) {
        if (
            !is_array($post)
            || !isset($post['username'], $post['email'], $post['content'], $post['created_at'])
            || !is_string($post['username'])
            || !is_string($post['email'])
            || !is_string($post['content'])
            || !is_string($post['created_at'])
            || strtotime($post['created_at']) === false
        ) {
            throw new UnexpectedValueException('Format data postingan tidak valid.');
        }
    }

    return $posts;
}

function save_posts(array $posts): void
{
    $file = dirname(__DIR__) . '/data/posts.php';
    $contents = "<?php\n\nreturn " . var_export($posts, true) . ";\n";
    if (file_put_contents($file, $contents, LOCK_EX) === false) {
        throw new RuntimeException('Data postingan tidak dapat disimpan.');
    }

    clearstatcache(true, $file);
    if (function_exists('opcache_invalidate')) {
        opcache_invalidate($file, true);
    }
}

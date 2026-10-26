<?php

function load_users(): array
{
    $file = dirname(__DIR__) . '/data/users.php';
    if (!is_file($file)) {
        return [];
    }

    $users = require $file;
    if (!is_array($users)) {
        throw new UnexpectedValueException('Format data pengguna tidak valid.');
    }

    return $users;
}

function save_users(array $users): void
{
    $file = dirname(__DIR__) . '/data/users.php';
    $contents = "<?php\n\nreturn " . var_export($users, true) . ";\n";
    if (file_put_contents($file, $contents, LOCK_EX) === false) {
        throw new RuntimeException('Data pengguna tidak dapat disimpan.');
    }
}

function find_user_by_email(array $users, string $email): ?array
{
    foreach ($users as $user) {
        if (
            is_array($user)
            && isset($user['email'])
            && is_string($user['email'])
            && strtolower($user['email']) === strtolower($email)
        ) {
            return $user;
        }
    }

    return null;
}

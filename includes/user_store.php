<?php

function load_users(): array
{
    $file = dirname(__DIR__) . '/data/users.json';
    if (!file_exists($file)) {
        return [];
    }

    $contents = file_get_contents($file);
    if ($contents === false) {
        throw new RuntimeException('Data pengguna tidak dapat dibaca.');
    }

    $users = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($users)) {
        throw new UnexpectedValueException('Format data pengguna tidak valid.');
    }

    return $users;
}

function save_users(array $users): void
{
    $file = dirname(__DIR__) . '/data/users.json';
    $contents = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
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

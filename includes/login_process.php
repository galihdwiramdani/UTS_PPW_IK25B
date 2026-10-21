<?php

require_once __DIR__ . '/session.php';
require_once __DIR__ . '/user_store.php';

if (isset($_SESSION['user'])) {
    header('Location: home.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = 'Email dan password wajib diisi!';
    } else {
        $user = find_user_by_email(load_users(), $email);

        if (
            $user !== null
            && isset($user['password'], $user['username'])
            && is_string($user['password'])
            && is_string($user['username'])
            && password_verify($password, $user['password'])
        ) {
            $_SESSION['user'] = [
                'username' => $user['username'],
                'email' => $user['email'],
            ];
            header('Location: home.php');
            exit;
        }

        $error = 'Email atau password salah!';
    }
}

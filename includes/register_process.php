<?php

require_once __DIR__ . '/session.php';
require_once __DIR__ . '/user_store.php';

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['konfirmasi_password'] ?? '';

    if ($username === '' || $email === '' || $password === '') {
        $error = 'Semua kolom wajib diisi!';
    } elseif ($password !== $confirmPassword) {
        $error = 'Password tidak sama';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    } else {
        $users = load_users();

        if (find_user_by_email($users, $email) !== null) {
            $error = 'Email sudah terdaftar!';
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            if ($passwordHash === false) {
                throw new RuntimeException('Password tidak dapat diproses.');
            }

            $users[] = [
                'username' => $username,
                'email' => $email,
                'password' => $passwordHash,
            ];
            save_users($users);
            $success = true;
        }
    }
}

<?php

require_once __DIR__ . '/session.php';

function require_authenticated_user(): void
{
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    }
}

<?php

require_once __DIR__ . '/session.php';

$_SESSION = [];
session_unset();
session_destroy();

// $scriptDirectory = dirname($_SERVER['SCRIPT_NAME'] ?? '/');
// $baseDirectory = basename($scriptDirectory) === 'includes'
//     ? dirname($scriptDirectory)
//     : $scriptDirectory;

// header('Location: ' . rtrim($baseDirectory, '/') . '/index.php');

header('Location: ../');
exit;

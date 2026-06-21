<?php

require_once __DIR__ . '/../../session.php';

if (empty($_SESSION['logged_in'])) {
    header("Location: https://hukuminfo.id/login");
    exit;
}

$page = $_GET['page'] ?? 'index';

// cegah ../ atau karakter aneh
$page = preg_replace('/[^a-zA-Z0-9_-]/', '', $page);

if ($_SESSION['user_type'] === 'internal') {
    $base = __DIR__ . '/a/';
} else {
    $base = __DIR__ . '/p/';
}

$file = $base . $page . '.php';

if (is_file($file)) {
    require $file;
} else {
    http_response_code(404);
    exit('404 Not Found');
}
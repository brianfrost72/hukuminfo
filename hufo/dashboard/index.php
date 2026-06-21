<?php
require_once __DIR__ . '/../../session.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: ../../login.php");
    exit;
}

if ($_SESSION['user_type'] == 'internal') {

    header("Location: https://hufo.hukuminfo.id/dashboard/a/");
    exit;
} elseif ($_SESSION['user_type'] == 'public') {

    header("Location: https://hufo.hukuminfo.id/dashboard/p/");
    exit;
}

session_destroy();

header("Location: https//hukuminfo.id");
exit;

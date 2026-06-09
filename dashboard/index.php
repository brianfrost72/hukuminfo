<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['user_type'] == 'internal') {

    header("Location: a/");
    exit;
} elseif ($_SESSION['user_type'] == 'public') {

    header("Location: p/");
    exit;
}

session_destroy();

header("Location: ../login.php");
exit;

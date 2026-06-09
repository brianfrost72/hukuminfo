<?php
session_start();
require_once __DIR__ . "/../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../login.php");
    exit;
}

$email    = trim($_POST['email']);
$password = trim($_POST['password']);

$query = mysqli_query(
    $conn,
    "SELECT * FROM users
     WHERE email='$email'
     LIMIT 1"
);

if (!$query || mysqli_num_rows($query) == 0) {
    header("Location: ../login.php?error=1");
    exit;
}

$user = mysqli_fetch_assoc($query);

/*
|--------------------------------------------------------------------------
| PASSWORD
|--------------------------------------------------------------------------
| Jika password database menggunakan password_hash()
*/
if (!password_verify($password, $user['password'])) {

    /*
    |--------------------------------------------------------------------------
    | Jika password masih plaintext
    |--------------------------------------------------------------------------
    | Ganti menjadi:
    |
    | if($password != $user['password'])
    |
    */

    header("Location: ../login.php?error=1");
    exit;
}

/*
|--------------------------------------------------------------------------
| Cek Status Akun
|--------------------------------------------------------------------------
*/
if ($user['account_status'] != 'Active') {
    header("Location: ../login.php?client_admin_block=1");
    exit;
}

/*
|--------------------------------------------------------------------------
| Session Login
|--------------------------------------------------------------------------
*/
$_SESSION['user_id']     = $user['id'];
$_SESSION['email']       = $user['email'];
$_SESSION['role_id']     = $user['role_id'];
$_SESSION['user_type']   = $user['user_type'];
$_SESSION['logged_in']   = true;

/*
|--------------------------------------------------------------------------
| Update Online
|--------------------------------------------------------------------------
*/
mysqli_query(
    $conn,
    "UPDATE users
     SET
        is_online = 1,
        last_seen = NOW()
     WHERE id = {$user['id']}"
);

/*
|--------------------------------------------------------------------------
| Redirect ke Dashboard Utama
|--------------------------------------------------------------------------
*/
header("Location: ../");
exit;
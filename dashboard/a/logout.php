<?php
session_start();

require_once __DIR__ . '/../koneksi.php';

if(isset($_SESSION['user_id'])){

    mysqli_query(
        $conn,
        "UPDATE users
         SET
            is_online = 0,
            logout_at = NOW()
         WHERE id = ".$_SESSION['user_id']
    );
}

session_destroy();

header("Location: /hukuminfo");
exit;
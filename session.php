<?php

if (session_status() === PHP_SESSION_NONE) {

    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '.hukuminfo.id',
        'secure'   => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}
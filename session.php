<?php

if (session_status() !== PHP_SESSION_ACTIVE) {

    session_name('HUFOSESSID');

    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '.hukuminfo.id',
        'secure'   => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();

    session_regenerate_id(true);
}
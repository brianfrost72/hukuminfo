<?php

$host = 'mail.konig.co.id';
$port = 587;

$fp = fsockopen($host, $port, $errno, $errstr, 30);

if (!$fp) {

    echo "ERROR: $errno - $errstr";
} else {

    echo "KONEK SMTP BERHASIL";
    fclose($fp);
}

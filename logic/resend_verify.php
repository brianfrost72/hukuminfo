<?php

require_once __DIR__ . "/../koneksi.php";
require_once __DIR__ . "/../PHPMailer/verify.php";

session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['verification_email'])) {

    echo json_encode([
        'success' => false,
        'message' => 'Session verifikasi tidak ditemukan'
    ]);

    exit;
}

$email = $_SESSION['verification_email'];

/*
|--------------------------------------------------------------------------
| GENERATE OTP BARU
|--------------------------------------------------------------------------
*/

$otp = random_int(100000, 999999);

$expired_at = date(
    'Y-m-d H:i:s',
    strtotime('+2 minutes')
);

/*
|--------------------------------------------------------------------------
| HAPUS OTP LAMA
|--------------------------------------------------------------------------
*/

$delete = $conn->prepare("
    DELETE FROM verification
    WHERE email = ?
");

$delete->bind_param("s", $email);
$delete->execute();
$delete->close();

/*
|--------------------------------------------------------------------------
| SIMPAN OTP BARU
|--------------------------------------------------------------------------
*/

$insert = $conn->prepare("
    INSERT INTO verification
    (
        email,
        code,
        expired_at,
        is_used
    )
    VALUES
    (
        ?, ?, ?, '0'
    )
");

$otp_code = (string)$otp;

$insert->bind_param(
    "sss",
    $email,
    $otp_code,
    $expired_at
);

$insert->execute();
$insert->close();

/*
|--------------------------------------------------------------------------
| KIRIM EMAIL
|--------------------------------------------------------------------------
*/

if (!kirimOTP($email, $otp)) {

    echo json_encode([
        'success' => false,
        'message' => 'Gagal mengirim OTP'
    ]);

    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'OTP berhasil dikirim ulang'
]);
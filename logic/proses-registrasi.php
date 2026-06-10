<?php

require_once __DIR__ . "/../koneksi.php";
require_once __DIR__ ."/../PHPMailer/verify.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../registrasi.php");
    exit;
}

function clean($value)
{
    return trim(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
}

/*
|--------------------------------------------------------------------------
| AMBIL DATA FORM
|--------------------------------------------------------------------------
*/

$full_name       = clean($_POST['fullname'] ?? '');
$phone_number    = clean($_POST['phone_number'] ?? '');
$email           = strtolower(clean($_POST['email'] ?? ''));
$gender          = clean($_POST['gender'] ?? '');
$provinces_id    = (int) ($_POST['provinces_id'] ?? 0);
$regencies_id    = (int) ($_POST['regencies_id'] ?? 0);
$address         = clean($_POST['address'] ?? '');
$password        = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';
$agree_terms     = isset($_POST['agree_terms']);

/*
|--------------------------------------------------------------------------
| VALIDASI
|--------------------------------------------------------------------------
*/

if (
    empty($full_name) ||
    empty($phone_number) ||
    empty($email) ||
    empty($gender) ||
    empty($provinces_id) ||
    empty($regencies_id) ||
    empty($address) ||
    empty($password)
) {

    $_SESSION['reg_error'] = "Semua field wajib diisi";
    header("Location: ../registrasi.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $_SESSION['reg_error'] = "Format email tidak valid";
    header("Location: ../registrasi.php");
    exit;
}

if ($password !== $confirmPassword) {

    $_SESSION['reg_error'] = "Konfirmasi password tidak cocok";
    header("Location: ../registrasi.php");
    exit;
}

if (!$agree_terms) {

    $_SESSION['reg_error'] = "Anda harus menyetujui syarat & ketentuan";
    header("Location: ../registrasi.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| CEK EMAIL
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare("
    SELECT id
    FROM users
    WHERE email = ?
    LIMIT 1
");

$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {

    $_SESSION['reg_error'] = "Email sudah terdaftar";
    header("Location: ../registrasi.php");
    exit;
}

$stmt->close();

/*
|--------------------------------------------------------------------------
| SIMPAN DATA KE SESSION
|--------------------------------------------------------------------------
|
| Data baru akan benar-benar masuk ke tabel users
| dan public_profile setelah OTP berhasil diverifikasi.
|
*/

$_SESSION['register_data'] = [

    'email'          => $email,
    'password_hash'  => password_hash($password, PASSWORD_DEFAULT),

    'role_id'        => 2, // role public
    'user_type'      => 'public',

    'full_name'      => $full_name,
    'phone_number'   => $phone_number,
    'gender'         => $gender,
    'provinces_id'   => $provinces_id,
    'regencies_id'   => $regencies_id,
    'address'        => $address
];

/*
|--------------------------------------------------------------------------
| GENERATE OTP
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
| KIRIM EMAIL OTP
|--------------------------------------------------------------------------
*/

if (!kirimOTP($email, $otp)) {

    $_SESSION['reg_error'] = "Gagal mengirim kode OTP";

    header("Location: ../registrasi.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| SIMPAN EMAIL UNTUK HALAMAN VERIFIKASI
|--------------------------------------------------------------------------
*/

$_SESSION['verification_email'] = $email;

/*
|--------------------------------------------------------------------------
| REDIRECT
|--------------------------------------------------------------------------
*/

header("Location: ../verifikasi-akun.php");
exit;
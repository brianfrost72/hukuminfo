<?php

require_once __DIR__ . "/../koneksi.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../verifikasi-akun.php");
    exit;
}

if (
    !isset($_SESSION['register_data']) ||
    !isset($_SESSION['verification_email'])
) {
    header("Location: ../registrasi.php");
    exit;
}

$email = $_SESSION['verification_email'];

$otp = trim($_POST['kode_verifikasi'] ?? '');

if (strlen($otp) != 6) {

    $_SESSION['verify_error'] = "Kode OTP harus 6 digit";

    header("Location: ../verifikasi-akun.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| CEK OTP
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare("
    SELECT
        id,
        code,
        expired_at,
        is_used
    FROM verification
    WHERE email = ?
    ORDER BY id DESC
    LIMIT 1
");

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {

    $_SESSION['verify_error'] = "OTP tidak ditemukan";

    header("Location: verifikasi-akun.php");
    exit;
}

$row = $result->fetch_assoc();

/*
|--------------------------------------------------------------------------
| SUDAH DIGUNAKAN
|--------------------------------------------------------------------------
*/

if ($row['is_used'] == '1') {

    $_SESSION['verify_error'] = "OTP sudah digunakan";

    header("Location: ../verifikasi-akun.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| SALAH OTP
|--------------------------------------------------------------------------
*/

if ($row['code'] !== $otp) {

    $_SESSION['verify_error'] = "Kode OTP tidak valid";

    header("Location: ../verifikasi-akun.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| EXPIRED
|--------------------------------------------------------------------------
*/

if (strtotime($row['expired_at']) < time()) {

    $_SESSION['verify_error'] = "Kode OTP telah kedaluwarsa";

    header("Location: ../verifikasi-akun.php");
    exit;
}

$data = $_SESSION['register_data'];

mysqli_begin_transaction($conn);

try {

    /*
    |--------------------------------------------------------------------------
    | INSERT USERS
    |--------------------------------------------------------------------------
    */

    $insertUser = $conn->prepare("
        INSERT INTO users
        (
            email,
            password,
            role_id,
            user_type,
            account_status
        )
        VALUES
        (
            ?, ?, ?, ?, 'Active'
        )
    ");

    $insertUser->bind_param(
        "ssis",
        $data['email'],
        $data['password_hash'],
        $data['role_id'],
        $data['user_type']
    );

    $insertUser->execute();

    $user_id = $conn->insert_id;

    /*
    |--------------------------------------------------------------------------
    | INSERT PUBLIC PROFILE
    |--------------------------------------------------------------------------
    */

    $avatar = $data['gender'] === 'Perempuan'
        ? 'avatar-women.png'
        : 'avatar-men.png';

    $insertProfile = $conn->prepare("
        INSERT INTO public_profile
        (
            user_id,
            full_name,
            birth_place,
            date_birth,
            gender,
            provinces_id,
            regencies_id,
            hobby,
            address,
            phone_number,
            photo_profile,
            status
        )
        VALUES
        (
            ?, ?, '',
            '',
            ?, ?, ?,
            '',
            ?, ?, ?,
            1
        )
    ");

    $insertProfile->bind_param(
        "issiisss",
        $user_id,
        $data['full_name'],
        $data['gender'],
        $data['provinces_id'],
        $data['regencies_id'],
        $data['address'],
        $data['phone_number'],
        $avatar
    );

    $insertProfile->execute();

    /*
    |--------------------------------------------------------------------------
    | UPDATE OTP
    |--------------------------------------------------------------------------
    */

    $update = $conn->prepare("
        UPDATE verification
        SET is_used = '1'
        WHERE id = ?
    ");

    $update->bind_param("i", $row['id']);
    $update->execute();

    mysqli_commit($conn);

} catch (Exception $e) {

    mysqli_rollback($conn);

    $_SESSION['verify_error'] = "Terjadi kesalahan sistem";

    header("Location: ../verifikasi-akun.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| LOGIN OTOMATIS
|--------------------------------------------------------------------------
*/

$_SESSION['user_id'] = $user_id;
$_SESSION['email']   = $data['email'];

unset($_SESSION['register_data']);
unset($_SESSION['verification_email']);

/*
|--------------------------------------------------------------------------
| UPDATE STATUS ONLINE
|--------------------------------------------------------------------------
*/

$online = $conn->prepare("
    UPDATE users
    SET
        is_online = 1,
        last_seen = NOW()
    WHERE id = ?
");

$online->bind_param("i", $user_id);
$online->execute();

/*
|--------------------------------------------------------------------------
| REDIRECT
|--------------------------------------------------------------------------
*/

header("Location: /../hukuminfo/login");
exit;
<?php

require_once __DIR__ . "/../koneksi.php";

session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['verification_email'])) {

    echo json_encode([
        'success' => false,
        'message' => 'Session tidak ditemukan'
    ]);

    exit;
}

$data = json_decode(
    file_get_contents('php://input'),
    true
);

$otp = trim($data['otp'] ?? '');

if (strlen($otp) != 6) {

    echo json_encode([
        'success' => false,
        'message' => 'OTP harus 6 digit'
    ]);

    exit;
}

$email = $_SESSION['verification_email'];

$stmt = $conn->prepare("
    SELECT
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

    echo json_encode([
        'success' => false,
        'message' => 'OTP tidak ditemukan'
    ]);

    exit;
}

$row = $result->fetch_assoc();

if ($row['is_used'] == '1') {

    echo json_encode([
        'success' => false,
        'message' => 'OTP sudah digunakan'
    ]);

    exit;
}

if ($row['code'] != $otp) {

    echo json_encode([
        'success' => false,
        'message' => 'Kode OTP salah'
    ]);

    exit;
}

if (strtotime($row['expired_at']) < time()) {

    echo json_encode([
        'success' => false,
        'message' => 'OTP sudah kedaluwarsa'
    ]);

    exit;
}

echo json_encode([
    'success' => true
]);
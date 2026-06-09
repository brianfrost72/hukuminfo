<?php
require_once __DIR__ . "/../koneksi.php";
require 'autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../reset_password.php");
    exit;
}

$email = trim($_POST['email'] ?? '');

if (empty($email)) {
    $_SESSION['reset_error'] = "Email wajib diisi.";
    header("Location: ../reset_password.php");
    exit;
}

/* =========================
   CEK EMAIL USER
========================= */

$stmt = $conn->prepare("
    SELECT
        id,
        email
    FROM users
    WHERE email = ?
    LIMIT 1
");

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {

    $_SESSION['reset_error'] = "Email tidak terdaftar.";
    header("Location: ../reset-password.php");
    exit;
}

$user = $result->fetch_assoc();

$user_id = $user['id'];

$stmt->close();

/* =========================
   GENERATE TEMP PASSWORD
========================= */

$reset_token = strtoupper(substr(
    str_shuffle(
        'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'
    ),
    0,
    10
));

$hashPassword = password_hash(
    $reset_token,
    PASSWORD_DEFAULT
);

$updateUser = $conn->prepare("
    UPDATE users
    SET
        password = ?,
        updated_at = NOW()
    WHERE id = ?
");

$updateUser->bind_param(
    "si",
    $hashPassword,
    $user_id
);

$updateUser->execute();
$updateUser->close();
/*
|--------------------------------------------------------------------------
| HAPUS TOKEN LAMA USER
|--------------------------------------------------------------------------
*/

$delete = $conn->prepare("
    DELETE FROM reset_token
    WHERE user_id = ?
");

$delete->bind_param("i", $user_id);
$delete->execute();
$delete->close();

/*
|--------------------------------------------------------------------------
| SIMPAN TOKEN
|--------------------------------------------------------------------------
*/

$status = 'terkirim';

$insert = $conn->prepare("
    INSERT INTO reset_token
    (
        user_id,
        email,
        reset_token,
        status
    )
    VALUES
    (
        ?,
        ?,
        ?,
        ?
    )
");

$insert->bind_param(
    "isss",
    $user_id,
    $email,
    $reset_token,
    $status
);

$insert->execute();
$insert->close();


/* =========================
   SMTP SEND
========================= */

$mail = new PHPMailer(true);

$status = "terkirim";

try {

    $mail->isSMTP();
    $mail->Host = 'mail.hukuminfo.id';
    $mail->SMTPAuth = true;
    $mail->Username = 'no-reply@hukuminfo.id';
    $mail->Password = 'Hufo*2026@';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->CharSet = 'UTF-8';

    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer'       => false,
            'verify_peer_name'  => false,
            'allow_self_signed' => true
        ]
    ];

    $mail->setFrom('no-reply@hukuminfo.id', 'HukumInfo');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Password Sementara Akun Anda';

    $mail->Body = '
    <div style="max-width:600px;margin:0 auto;font-family:Arial,Helvetica,sans-serif;background:#ffffff;border:1px solid #e5e5e5;border-radius:8px;overflow:hidden">

    <!-- HEADER -->
    <div style="display:flex;align-items:center;padding:16px 20px;border-bottom:1px solid #e5e5e5;background:#f9fafb">
        <img src="https://hukuminfo.id/images/placeholder/logo.jpg" alt="Logo-email" style="height:50px;margin-right:15px">
        <div style="font-size:13px;color:#555">
            <strong style="font-size:15px;color:#111">HukumInfo</strong><br>
            Puri Botanical Blok H9 No.11, Jakarta - Indonesia.<br>
            Telp:
            <a href="tel:08111902759" style="color:#2563eb;text-decoration:none">
                0811 1902 759
            </a>
        </div>
    </div>

    <!-- CONTENT -->
    <div style="padding:30px 20px;text-align:center">
        <h2 style="margin:0 0 10px;color:#111">Reset Password Sementara</h2>
        <p style="margin:0 0 15px;color:#111;font-size:14px">
            Yth. Pengguna,
        </p>

        <p style="margin:0 0 15px;color:#555;font-size:14px">
            Permintaan reset password Anda telah diproses.
        </p>

        <p style="margin:20px 0 8px;color:#111;font-size:14px">
            <strong>Password sementara:</strong>
        </p>

        <div style="display:inline-block;padding:14px 25px;font-size:22px;font-weight:bold;letter-spacing:2px;background:#f1f5f9;color:#111;border-radius:6px">
            ' . $reset_token . '
        </div>

        <p style="margin-top:20px;color:#555;font-size:14px">
            Silakan <strong>copy-paste</strong> password sementara tersebut untuk login.
            Demi keamanan akun Anda, mohon segera mengganti password setelah berhasil masuk.
        </p>

        <p style="margin-top:25px;color:#555;font-size:14px">
            Hormat kami,<br>
            <strong>HukumInfo</strong>
        </p>
    </div>

    <!-- FOOTER -->
    <div style="padding:15px 20px;background:#f9fafb;border-top:1px solid #e5e5e5;font-size:12px;color:#777;text-align:center">
        Email ini dikirim secara otomatis. Mohon <strong>tidak membalas</strong> email ini.
    </div>

</div>
';

   $mail->send();

    $_SESSION['reset_success'] = true;
}
catch (Exception $e) {

    $update = $conn->prepare("
        UPDATE reset_token
        SET status = 'gagal'
        WHERE user_id = ?
        ORDER BY id DESC
        LIMIT 1
    ");

    $update->bind_param("i", $user_id);
    $update->execute();
    $update->close();

    $_SESSION['reset_error'] =
        "Gagal mengirim email reset password.";
}

header("Location: ../reset-password.php");
exit;


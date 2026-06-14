<?php

require_once __DIR__ . "/../koneksi.php";
require 'autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/src/Exception.php';
require_once __DIR__ . '/src/PHPMailer.php';
require_once __DIR__ . '/src/SMTP.php';

function sendCommentHiddenEmail(
    $email,
    $fullName,
    $comment,
    $reasonStatus,
    $hideDescription
) {

    $mail = new PHPMailer(true);

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
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ];

    $mail->setFrom(
        'no-reply@hukuminfo.id',
        'HukumInfo'
    );

    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject =
        'Komentar Anda Disembunyikan';

    $mail->Body = '

<div style="max-width:700px;margin:auto;background:#fff;border:1px solid #e5e5e5;border-radius:10px;overflow:hidden;font-family:Arial">

<div style="background:#dc2626;padding:20px;text-align:center">

<h2 style="color:#fff;margin:0">
Komentar Disembunyikan
</h2>

</div>

<div style="padding:25px">

<p>Halo <b>' . htmlspecialchars($fullName) . '</b>,</p>

<p>
Komentar Anda telah disembunyikan oleh moderator HukumInfo.
</p>

<div style="background:#f8fafc;padding:15px;border-left:4px solid #2563eb;margin-top:15px">

<b>Komentar Anda</b>

<p>
' . nl2br(htmlspecialchars($comment)) . '
</p>

</div>

<div style="background:#fff7ed;padding:15px;border-left:4px solid #f59e0b;margin-top:15px">

<b>Alasan</b>

<p>
' . htmlspecialchars($reasonStatus) . '
</p>

</div>

<div style="background:#fef2f2;padding:15px;border-left:4px solid #dc2626;margin-top:15px">

<b>Penjelasan Moderator</b>

<p>
' . nl2br(htmlspecialchars($hideDescription)) . '
</p>

</div>

</div>

</div>

';

    return $mail->send();
}

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";

function kirimOTP($email, $otp)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = "mail.konig.co.id";
        $mail->SMTPAuth   = true;
        $mail->Username   = "no-reply@konig.co.id";
        $mail->Password   = "Konig*2025@";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom("no-reply@konig.co.id", "Konig Guard Bureau");
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Kode OTP Verifikasi";
        $mail->Body = '
        <div style="max-width:600px;margin:0 auto;font-family:Arial,Helvetica,sans-serif;background:#ffffff;border:1px solid #e5e5e5;border-radius:8px;overflow:hidden">

            <!-- HEADER -->
            <div style="display:flex;align-items:center;padding:16px 20px;border-bottom:1px solid #e5e5e5;background:#f9fafb">
                <img src="https://konig.co.id/assets/images/logo/logo.png" alt="Logo-email" style="height:50px;margin-right:15px">
                <div style="font-size:13px;color:#555">
                    <strong style="font-size:15px;color:#111">Konig Guard Bureau</strong><br>
                    Puri Botanical Blok H9 No.11, Jakarta - Indonesia.<br>
                    Telp:
                        <a href="tel:08111902759" style="color:#2563eb;text-decoration:none">
                        0811 1902 759
                        </a>
                </div>
            </div>

            <!-- CONTENT -->
            <div style="padding:30px 20px;text-align:center">
                <h2 style="margin:0 0 10px;color:#111">Kode Verifikasi OTP</h2>
                <p style="margin:0 0 25px;color:#555;font-size:14px">
                    Gunakan kode di bawah ini untuk menyelesaikan proses verifikasi akun Anda.
                </p>

                <div style="display:inline-block;padding:15px 30px;font-size:28px;font-weight:bold;letter-spacing:6px;background:#f1f5f9;color:#111;border-radius:6px">
                    ' . $otp . '
                </div>

                <p style="margin-top:25px;color:#dc2626;font-size:13px">
                    Kode OTP ini berlaku selama <strong>2 menit</strong>.
                </p>

                <p style="margin-top:10px;color:#666;font-size:13px">
                    Jika Anda tidak merasa melakukan permintaan ini, silakan abaikan email ini.
                </p>
            </div>

                <!-- FOOTER -->
            <div style="padding:15px 20px;background:#f9fafb;border-top:1px solid #e5e5e5;font-size:12px;color:#777;text-align:center">
                Email ini dikirim secara otomatis. Mohon <strong>tidak membalas</strong> email ini.
            </div>

        </div>
        ';
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

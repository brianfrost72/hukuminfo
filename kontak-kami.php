<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

$success = '';
$error = '';

if (isset($_POST['send_message'])) {

    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message'] ?? '');

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = 'mail.hukuminfo.id';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'cs@hukuminfo.id';
        $mail->Password   = 'Hufo*2026@';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        $mail->setFrom('cs@hukuminfo.id', 'Website Hukuminfo');
        $mail->addAddress('cs@hukuminfo.id');

        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);

        $mail->CharSet = 'UTF-8';

        $mail->Subject = '[KELUHAN COSTUMER] ' . $subject;

        $mail->Body = "
        <h3>Pesan Baru Dari Form Kontak</h3>

        <table border='1' cellpadding='10' cellspacing='0'>
            <tr>
                <td><b>Nama</b></td>
                <td>{$name}</td>
            </tr>
            <tr>
                <td><b>Email</b></td>
                <td>{$email}</td>
            </tr>
            <tr>
                <td><b>Topik</b></td>
                <td>{$subject}</td>
            </tr>
            <tr>
                <td><b>Pesan</b></td>
                <td>" . nl2br(htmlspecialchars($message)) . "</td>
            </tr>
        </table>
        ";

        $mail->send();

        $success = "Pesan berhasil dikirim.";
    } catch (Exception $e) {

        $error = "Pesan gagal dikirim. Error: " . $mail->ErrorInfo;
    }
}

// SOCIAL MEDIA
require_once __DIR__ . '/koneksi.php';

$socialMedia = [];

$qSocmed = mysqli_query($conn, "
    SELECT
        sm.account_name,
        sm.link_platform,
        ls.name_platform
    FROM social_media sm
    INNER JOIN list_socmed ls
        ON ls.id = sm.platform_id
    ORDER BY sm.id ASC
");

if ($qSocmed && mysqli_num_rows($qSocmed) > 0) {

    while ($row = mysqli_fetch_assoc($qSocmed)) {
        $socialMedia[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Kontak Kami - Hukuminfo.id</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <!-- favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="icon.png">

    <meta name="theme-color" content="#030303">
    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,300;1,500&family=Poppins:ital,wght@0,300;0,500;0,700;1,300;1,400&display=swap"
        rel="stylesheet">
    <link href="./css/styles.css?537a1bbd0e5129401d28" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/v4-shims.min.css">
</head>

<body>
    <!-- loading -->
    <div class="loading-container">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <ul class="list-unstyled">
                <li>
                    <img src="images/placeholder/loading.png" alt="Alternate Text" height="100" />

                </li>
                <li>

                    <div class="spinner">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
                        <div class="rect4"></div>
                        <div class="rect5"></div>

                    </div>

                </li>
                <li>
                    <p>Loading</p>
                </li>
            </ul>
        </div>
    </div>
    <!-- End loading -->

    <!-- Header  -->
    <header>
        <!-- Navbar  -->
        <div class="topbar d-none d-sm-block">
            <?php include 'includes/top-header.php'; ?>
        </div>
        <!-- Navbar menu  -->
        <div class="navigation-wrap navigation-shadow bg-white">
            <?php include 'includes/navbar.php'; ?>
        </div>
        <!-- End Navbar menu  -->

        <!-- Navbar sidebar menu  -->
        <?php include 'includes/mobile_menu.php'; ?>
        <!-- End Navbar sidebar menu  -->
        <!-- End Navbar  -->
    </header>
    <!-- End Header  -->

    <!-- Breadcrumb  -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Breadcrumb -->
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="/" class="breadcrumbs__url">
                                <i class="fa fa-home"></i> Beranda</a>
                        </li>
                        <li class="breadcrumbs__item breadcrumbs__item--current">
                            Kontak Kami
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb  -->


    <!-- Form contact -->
    <section class="wrap__contact-form">
        <div class="container">
            <div class="row">
                <div class="card-body border-top-1 border-primary rounded-0">
                    <div class="container-fluid">
                        <h3 class="text-center fw-bolder">Kirim Keluhan Anda</h3>
                        <center>
                            <hr class="bg-primary bg-opacity-100 opacity-100 my-1" width="50em">
                        </center>
                        <?php if (!empty($success)) : ?>
                            <div class="alert alert-success">
                                <?= $success ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>
                        <form action="" method="POST" id="contact-form">
                            <input type="hidden" name="id">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group position-relative">
                                        <input type="text" id="userName" name="name" class="form-control form-control-sm rounded-0 form-control-border" required autocomplete="off" placeholder="Masukkan Nama Lengkap Anda disini..." required>
                                        <small class="px-1 field-label">Nama Lengkap Anda</small>
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group position-relative">
                                        <input type="email" id="userEmail" name="email" class="form-control form-control-sm rounded-0 form-control-border" required autocomplete="off" placeholder="Masukkan Email Anda disini..." required>
                                        <small class="px-1 field-label">Email</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group position-relative">
                                        <input type="subject" id="subject" name="subject" class="form-control form-control-sm rounded-0 form-control-border" required autocomplete="off" placeholder="Masukkan Topik Anda disini..." required>
                                        <small class="px-1 field-label">Topik</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control rounded-0" id="message" name="message" rows="4" required placeholder="Apa Keluhan Anda..." required></textarea>
                                        <small class="px-1 field-label">Pesan</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" name="send_message" class="btn btn-primary bg-gradient rounded-pill btn-lg col-md-4"><i class="fa fa-paper-plane"></i> Kirim Pesan Anda</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5>Alamat Kami</h5>
                    <div class="wrap__contact-form-office">
                        <ul class="list-unstyled">
                            <li>
                                <span>
                                    <i class="fa fa-home"></i>
                                </span>

                                Puri Botanical Residence Blok H9 No.11, Jakarta - Indonesia.


                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-phone"></i>
                                    <a href="https://wa.me/628111902759?text=Halo%20Hukuminfo.id!%20saya%20butuh%20bantuan..." target="_blank">(+62) 811 1902 759</a>
                                </span>

                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-envelope"></i>
                                    <a href="mailto:cs@hukuminfo.id" target="_blank">cs@hukuminfo.id</a>
                                </span>

                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-globe"></i>
                                    <a href="https://hukuminfo.id" target="_blank"> Hukuminfo.id</a>
                                </span>
                            </li>
                        </ul>

                        <div class="social__media">
                            <h5>Temukan Kami Di :</h5>

                            <ul class="list-inline">

                                <?php foreach ($socialMedia as $socmed): ?>

                                    <?php

                                    $platform = strtolower(trim($socmed['name_platform'] ?? ''));

                                    $icons = [
                                        'facebook'  => 'fa-brands fa-facebook-f',
                                        'twitter'   => 'fa-brands fa-twitter',
                                        'x'         => 'fa-brands fa-x-twitter',
                                        'instagram' => 'fa-brands fa-instagram',
                                        'youtube'   => 'fa-brands fa-youtube',
                                        'linkedin'  => 'fa-brands fa-linkedin-in',
                                        'tiktok'    => 'fa-brands fa-tiktok',
                                        'telegram'  => 'fa-brands fa-telegram',
                                        'whatsapp'  => 'fa-brands fa-whatsapp'
                                    ];

                                    $btnClass = [
                                        'facebook'  => 'facebook',
                                        'twitter'   => 'twitter',
                                        'x'         => 'twitter',
                                        'instagram' => 'instagram',
                                        'youtube'   => 'youtube',
                                        'linkedin'  => 'linkedin',
                                        'telegram'  => 'telegram',
                                        'whatsapp'  => 'whatsapp',
                                        'tiktok'    => 'tiktok'
                                    ];

                                    $icon  = $icons[$platform] ?? 'fas fa-globe';
                                    $class = $btnClass[$platform] ?? 'secondary';

                                    $link  = htmlspecialchars($socmed['link_platform'] ?? '#');
                                    $title = htmlspecialchars($socmed['account_name'] ?? 'Social Media');

                                    ?>

                                    <li class="list-inline-item">

                                        <a
                                            href="<?= htmlspecialchars($socmed['link_platform'] ?? '#'); ?>"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            title="<?= htmlspecialchars($socmed['account_name'] ?? 'Social Media'); ?>"
                                            class="btn btn-social rounded text-white <?= $class; ?>">

                                            <i class="<?= $icon; ?>"></i>

                                        </a>

                                    </li>

                                <?php endforeach; ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Form contact  -->


    <section class="wrapper__section p-0">
        <div class="wrapper__section__components">
            <?php include 'includes/footer.php'; ?>
        </div>
    </section>


    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript" src="./js/index.bundle.js?537a1bbd0e5129401d28"></script>
</body>

</html>
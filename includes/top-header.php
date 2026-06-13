<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../koneksi.php';

$userName  = '';
$userEmail = '';

if (!empty($_SESSION['logged_in']) && !empty($_SESSION['user_id'])) {

    $user_id = (int) $_SESSION['user_id'];

    $qUser = mysqli_query($conn, "
        SELECT
            id,
            email,
            user_type
        FROM users
        WHERE id = '$user_id'
        LIMIT 1
    ");

    if ($qUser && mysqli_num_rows($qUser) > 0) {

        $user = mysqli_fetch_assoc($qUser);

        $userEmail = $user['email'];

        // ==========================
        // INTERNAL USER
        // ==========================
        if ($user['user_type'] === 'internal') {

            $qProfile = mysqli_query($conn, "
                SELECT full_name
                FROM user_profile
                WHERE user_id = '$user_id'
                LIMIT 1
            ");

            if ($qProfile && mysqli_num_rows($qProfile) > 0) {

                $profile = mysqli_fetch_assoc($qProfile);

                $userName =
                    $profile['full_name'];
            }
        }

        // ==========================
        // PUBLIC USER
        // ==========================
        else {

            $qProfile = mysqli_query($conn, "
                SELECT full_name
                FROM public_profile
                WHERE user_id = '$user_id'
                LIMIT 1
            ");

            if ($qProfile && mysqli_num_rows($qProfile) > 0) {

                $profile = mysqli_fetch_assoc($qProfile);

                $userName =
                    $profile['full_name'];
            }
        }

        // fallback
        if (empty($userName)) {
            $userName = $userEmail;
        }
    }
}

// SOCIAL MEDIA
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

<div class="container ">
    <div class="row">
        <div class="col-sm-12 col-md-5">
            <div class="topbar-left">
                <div class="topbar-text">
                    <?php
                    $hari = [
                        'Sunday' => 'Minggu',
                        'Monday' => 'Senin',
                        'Tuesday' => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu'
                    ];

                    $bulan = [
                        'January' => 'Januari',
                        'February' => 'Februari',
                        'March' => 'Maret',
                        'April' => 'April',
                        'May' => 'Mei',
                        'June' => 'Juni',
                        'July' => 'Juli',
                        'August' => 'Agustus',
                        'September' => 'September',
                        'October' => 'Oktober',
                        'November' => 'November',
                        'December' => 'Desember'
                    ];

                    echo $hari[date('l')] . ', ' . date('d') . ' ' . $bulan[date('F')] . ' ' . date('Y');
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-7">
            <div class="list-unstyled topbar-right">
                <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                ?>

                <ul class="topbar-link">

                    <?php if (!empty($_SESSION['logged_in'])): ?>

                        <li class="user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Hai, <?= htmlspecialchars($userName); ?>
                                <span class="caret"></span>
                            </a>

                            <ul class="user-dropdown">

                                <li>
                                    <a href="dashboard/index">
                                        <i class="fa fa-address-card"></i>
                                        Dashboard
                                    </a>
                                </li>

                                <li>
                                    <a href="logout">
                                        <i class="fa fa-sign-out-alt"></i>
                                        Logout
                                    </a>
                                </li>

                            </ul>
                        </li>

                    <?php else: ?>

                        <li>
                            <a href="login">
                                Login / Register
                            </a>
                        </li>

                    <?php endif; ?>

                </ul>
                <ul class="topbar-sosmed">

                    <?php foreach ($socialMedia as $socmed): ?>

                        <?php

                        $platform = strtolower(trim($socmed['name_platform']));

                        $icons = [
                            'facebook'  => 'fab fa-facebook-f',
                            'twitter'   => 'fab fa-twitter',
                            'x'         => 'fab fa-x-twitter',
                            'instagram' => 'fab fa-instagram',
                            'youtube'   => 'fab fa-youtube',
                            'linkedin'  => 'fab fa-linkedin-in',
                            'tiktok'    => 'fab fa-tiktok',
                            'telegram'  => 'fab fa-telegram-plane',
                            'whatsapp'  => 'fab fa-whatsapp'
                        ];

                        $icon = $icons[$platform] ?? 'fas fa-globe';

                        ?>

                        <li>
                            <a href="<?= htmlspecialchars($socmed['link_platform']); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                title="<?= htmlspecialchars($socmed['account_name']); ?>">
                                <i class="<?= $icon; ?>"></i>
                            </a>
                        </li>

                    <?php endforeach; ?>

                </ul>
            </div>
        </div>
    </div>
</div>
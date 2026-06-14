<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/../../koneksi.php";

$currentPage = basename($_SERVER['PHP_SELF']);
// =========================
// USER PROFILE HEADER
// =========================

$user_id = $_SESSION['user_id'] ?? 0;

$userData = [
    'full_name'     => 'Unknown User',
    'email'         => '-',
    'role_name'     => '-',
    'gender'        => 'Laki-laki',
    'photo_profile' => ''
];

if ($user_id > 0) {

    $queryUser = mysqli_query($conn, "
        SELECT
            u.id,
            u.email,
            r.role_name,
            up.full_name,
            up.gender,
            up.photo_profile
        FROM users u
        LEFT JOIN roles r
            ON r.id = u.role_id
        LEFT JOIN public_profile up
            ON up.user_id = u.id
        WHERE u.id = '$user_id'
        LIMIT 1
    ");

    if (
        $queryUser &&
        mysqli_num_rows($queryUser) > 0
    ) {
        $userData = mysqli_fetch_assoc($queryUser);
    }
}

// =========================
// FOTO PROFILE
// =========================

$baseUrl = '/hukuminfo/dashboard/';

$avatarPath =
    $baseUrl .
    'assets/images/avatar/avatar-men.png';

if (
    ($userData['gender'] ?? '') === 'Perempuan'
) {
    $avatarPath =
        $baseUrl .
        'assets/images/avatar/avatar-women.png';
}

if (!empty($userData['photo_profile'])) {

    $photoFile =
        basename($userData['photo_profile']);

    $photoServerPath =
        $_SERVER['DOCUMENT_ROOT'] .
        '/hukuminfo/dashboard/assets/images/uploads/public_photos/' .
        $photoFile;

    if (file_exists($photoServerPath)) {

        $avatarPath =
            $baseUrl .
            'assets/images/uploads/public_photos/' .
            $photoFile;
    }
}

// =========================
// SOCIAL MEDIA
// =========================

$socialMedia = [];

$qSocmed = mysqli_query($conn, "
    SELECT
        sm.account_name,
        sm.link_platform,
        ls.name_platform
    FROM social_media sm
    INNER JOIN list_socmed ls
        ON ls.id = sm.platform_id
    ORDER BY ls.name_platform ASC
");

if ($qSocmed && mysqli_num_rows($qSocmed) > 0) {
    while ($row = mysqli_fetch_assoc($qSocmed)) {
        $socialMedia[] = $row;
    }
}
?>

<div class="mdk-drawer  js-mdk-drawer"
    id="default-drawer"
    data-align="start">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-left sidebar-p-t"
            data-perfect-scrollbar>
            <div class="text-center px-3 pb-3 border-bottom mb-3">
                <a href="https://hukuminfo.id">
                    <img src="/hukuminfo/dashboard/assets/images/logos/logo.png"
                        alt="Hukuminfo"
                        style="
                max-width:180px;
                width:100%;
                height:auto;
                margin-bottom:10px;
            ">
                </a>
            </div>
            <div class="sidebar-heading">Menu</div>
            <div class="sidebar-block p-0 mb-0">
                <ul class="sidebar-menu"
                    id="components_menu">


                    <li class="sidebar-menu-item <?= ($currentPage == 'index.php' || $currentPage == '') ? 'active' : ''; ?>">
                        <a class="sidebar-menu-button" href="/">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Beranda</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item <?= ($currentPage == 'daftar-bookmark.php') ? 'active' : ''; ?>">
                        <a class="sidebar-menu-button" href="daftar-bookmark.php">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">bookmark</i>
                            <span class="sidebar-menu-text">Bookmark Saya</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item <?= ($currentPage == 'daftar-likes.php') ? 'active' : ''; ?>">
                        <a class="sidebar-menu-button" href="daftar-likes.php">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">favorite</i>
                            <span class="sidebar-menu-text">Artikel Yang Saya Suka</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="d-flex align-items-center sidebar-p-a border-bottom sidebar-account">
                <a href="edit_profile.php"
                    class="flex d-flex align-items-center text-underline-0 text-body">
                    <span class="avatar avatar-sm mr-2">
                        <img src="<?= htmlspecialchars($avatarPath); ?>"
                            alt="<?= htmlspecialchars($userData['full_name']); ?>"
                            class="avatar-img rounded-circle">
                    </span>
                    <span class="flex d-flex flex-column">
                        <strong><?= htmlspecialchars($userData['full_name']); ?></strong>
                    </span>
                </a>
                <div class="dropdown ml-auto">
                    <a href="#"
                        data-toggle="dropdown"
                        data-caret="false"
                        class="text-muted"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-item-text dropdown-item-text--lh">
                            <div><strong><?= htmlspecialchars($userData['full_name']); ?></strong></div>
                            <div><?= htmlspecialchars($userData['email']); ?></div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"
                            href="edit_profile.php">Edit profile</a>
                        <a class="dropdown-item"
                            href="https://hukuminfo.id">Lihat Website</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"
                            href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
            <div class="mt-auto text-center px-3 py-4 border-top">
                <small class="text-muted d-block mb-2">
                    © <?= date('Y'); ?> Hukuminfo
                </small>

                <p style="
        font-size:13px;
        color:#fff;
        margin-bottom:12px;
        line-height:1.5;
    ">
                    Ikuti terus perkembangan berita, hukum, politik,
                    dan informasi terpercaya hanya di Hukuminfo.
                </p>

                <div class="d-flex justify-content-center align-items-center flex-wrap"
                    style="gap:15px;font-size:22px;">

                    <?php foreach ($socialMedia as $socmed): ?>

                        <?php
                        $platform = strtolower(trim($socmed['name_platform']));

                        $icon = 'fa-link';
                        $color = '#6c757d';

                        switch ($platform) {

                            case 'facebook':
                                $icon = 'fa-facebook';
                                $color = '#1877F2';
                                break;

                            case 'instagram':
                                $icon = 'fa-instagram';
                                $color = '#E4405F';
                                break;

                            case 'twitter':
                            case 'x':
                            case 'x twitter':
                                $icon = 'fa-x-twitter';
                                $color = '#000';
                                break;

                            case 'youtube':
                                $icon = 'fa-youtube';
                                $color = '#FF0000';
                                break;

                            case 'tiktok':
                                $icon = 'fa-tiktok';
                                $color = '#111';
                                break;

                            case 'linkedin':
                                $icon = 'fa-linkedin';
                                $color = '#0A66C2';
                                break;

                            case 'telegram':
                                $icon = 'fa-telegram';
                                $color = '#229ED9';
                                break;

                            case 'whatsapp':
                                $icon = 'fa-whatsapp';
                                $color = '#25D366';
                                break;
                        }
                        ?>

                        <a href="<?= htmlspecialchars($socmed['link_platform']); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            title="<?= htmlspecialchars($socmed['account_name']); ?>"
                            style="color:<?= $color; ?>;">

                            <i class="fab <?= $icon; ?>"></i>
                        </a>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>
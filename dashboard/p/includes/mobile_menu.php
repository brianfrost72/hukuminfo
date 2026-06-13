<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/../../koneksi.php";
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

?>

<div class="mdk-drawer  js-mdk-drawer"
    id="default-drawer"
    data-align="start">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-left sidebar-p-t"
            data-perfect-scrollbar>
            <div class="sidebar-heading">Menu</div>
            <div class="sidebar-block p-0 mb-0">
                <ul class="sidebar-menu"
                    id="components_menu">


                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button"
                            href="/">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Beranda</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button"
                            href="daftar-bookmark.php">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">bookmark</i>
                            <span class="sidebar-menu-text">Bookmark Saya</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button"
                            href="daftar-likes.php">
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
        </div>
    </div>
</div>
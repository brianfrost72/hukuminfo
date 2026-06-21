<?php
require_once __DIR__ . '/../../../../session.php';
require_once __DIR__ . "/../../koneksi.php";
$dashboardUrl = '/dashboard/';
// =========================
// USER PROFILE SIDEBAR
// =========================
$user_id = $_SESSION['user_id'] ?? 0;

$userData = [
    'full_name'      => 'Unknown User',
    'email'          => '-',
    'role_name'      => '-',
    'gender'         => 'Laki-laki',
    'photo_profile'  => ''
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
        LEFT JOIN user_profile up 
            ON up.user_id = u.id
        WHERE u.id = '$user_id'
        LIMIT 1
    ");

    if ($queryUser && mysqli_num_rows($queryUser) > 0) {
        $userData = mysqli_fetch_assoc($queryUser);
    }
}

/*
|--------------------------------------------------------------------------
| FOTO PROFILE
|--------------------------------------------------------------------------
| Jika user upload foto:
| hufo/dashboard/assets/images/uploads/user_photos/
|
| Jika tidak upload:
| Laki-laki  => avatar-men.png
| Perempuan => avatar-women.png
|--------------------------------------------------------------------------
*/

$baseUrl = '/hufo/dashboard/';

$avatarPath = $baseUrl . 'assets/images/avatar/avatar-men.png';

if (
    !empty($userData['gender']) &&
    $userData['gender'] === 'Perempuan'
) {
    $avatarPath = $baseUrl . 'assets/images/avatar/avatar-women.png';
}

if (!empty($userData['photo_profile'])) {

    $photoFile = basename($userData['photo_profile']);

    $photoServerPath =
        $_SERVER['DOCUMENT_ROOT'] .
        '/hufo/dashboard/assets/images/uploads/user_photos/' .
        $photoFile;

    if (file_exists($photoServerPath)) {

        $avatarPath =
            $baseUrl .
            'assets/images/uploads/user_photos/' .
            $photoFile;
    }
}

// MENU BERDASARKAN ROLES
$role_id = $_SESSION['role_id'] ?? 0;

function allowRole(array $roles)
{
    global $role_id;
    return in_array($role_id, $roles);
}
?>

<div class="mdk-drawer js-mdk-drawer" id="default-drawer" data-align="end">
    <div class="mdk-drawer__content">
        <div
            class="sidebar sidebar-light sidebar-left sidebar-p-t"
            data-perfect-scrollbar>
            <div class="text-center px-3 pb-3 border-bottom mb-3">
                <a href="https://hukuminfo.id">
                    <img src="/hufo/dashboard/assets/images/logos/logo.png"
                        alt="Hukuminfo"
                        style="
                max-width:180px;
                width:100%;
                height:auto;
                margin-bottom:10px;
            ">
                </a>
            </div>
            <!-- *********************************FIRST MENU********************************* -->

            <div class="sidebar-heading">Menu</div>
            <ul class="sidebar-menu">
                <!-- DASHBOARD_MENU -->
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="/">
                        <i
                            class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>
                <!-- DASHBOARD_MENU END -->

                <!-- ROLE AKSES MENU -->
                <?php if (allowRole([1, 12])) : ?>
                    <li class="sidebar-menu-item">
                        <a
                            class="sidebar-menu-button"
                            data-toggle="collapse"
                            href="#role_menu">
                            <i
                                class="sidebar-menu-icon sidebar-menu-icon--left material-icons">accessibility</i>
                            <span class="sidebar-menu-text">Master Role</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="role_menu">
                            <li class="sidebar-menu-item">
                                <a
                                    class="sidebar-menu-button"
                                    href="<?= $dashboardUrl ?>add_roles">
                                    <span class="sidebar-menu-text">Tambah Role</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?= $dashboardUrl ?>manage_roles">
                                    <span class="sidebar-menu-text">Manage Role</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php endif; ?>
                <!-- ROLE AKSES MENU END -->
            </ul>
            <!-- *********************************FIRST MENU END********************************* -->

            <!-- *********************************CLIENT MENU********************************* -->
            <?php if (allowRole([1, 12])) : ?>
                <div class="sidebar-heading">USER MENU</div>
                <ul class="sidebar-menu" id="components_menu">

                    <!-- MASTER CLIENT MENU -->
                    <li class="sidebar-menu-item">
                        <a
                            class="sidebar-menu-button"
                            data-toggle="collapse"
                            href="#client_menu">
                            <i
                                class="sidebar-menu-icon sidebar-menu-icon--left material-icons">account_circle</i>
                            <span class="sidebar-menu-text">Master User</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="client_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?= $dashboardUrl ?>manage_users">
                                    <span class="sidebar-menu-text">Manage User</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- MASTER CLIENT MENU END -->
                </ul>
            <?php endif; ?>
            <!-- *********************************CONTENT MENU********************************* -->

            <div class="sidebar-heading">CONTENT MENU</div>
            <div class="sidebar-block p-0 mb-0">
                <ul class="sidebar-menu">

                    <!-- BERITA / ARTIKEL MENU -->
                    <li class="sidebar-menu-item">
                        <a
                            class="sidebar-menu-button"
                            data-toggle="collapse"
                            href="#article_menu">
                            <i
                                class="sidebar-menu-icon sidebar-menu-icon--left material-icons">layers</i>
                            <span class="sidebar-menu-text">Berita / Artikel</span>
                            <!-- <span class="badge badge-primary badge-pill ml-1">3</span> -->
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="article_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?= $dashboardUrl ?>manage_post_category">
                                    <span class="sidebar-menu-text">Manage Kategori</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?= $dashboardUrl ?>manage_post_subcategory">
                                    <span class="sidebar-menu-text">Manage Sub-Kategori</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?= $dashboardUrl ?>add_post">
                                    <span class="sidebar-menu-text">Tambah Postingan</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?= $dashboardUrl ?>manage_post">
                                    <span class="sidebar-menu-text">Manage Postingan</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- BERITA / ARTIKEL MENU END -->

                    <!-- MANAGE BERITA / ARTIKEL MENU -->
                    <li class="sidebar-menu-item">
                        <a
                            class="sidebar-menu-button"
                            data-toggle="collapse"
                            href="#manage_article_menu">
                            <i
                                class="sidebar-menu-icon sidebar-menu-icon--left material-icons">layers</i>
                            <span class="sidebar-menu-text">Manage Berita / Artikel</span>
                            <!-- <span class="badge badge-primary badge-pill ml-1">3</span> -->
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="manage_article_menu">
                            <?php if (allowRole([1, 12])) : ?>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="<?= $dashboardUrl ?>manage_comments">
                                        <span class="sidebar-menu-text">Manage Komentar</span>
                                        <!-- <span class="badge badge-primary badge-pill ml-1">3</span> -->
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?= $dashboardUrl ?>list_likes">
                                    <span class="sidebar-menu-text">List Likes</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?= $dashboardUrl ?>list_bookmarks">
                                    <span class="sidebar-menu-text">List Bookmark</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- BERITA / ARTIKEL MENU END -->

                    <!-- SOCIAL MEDIA MENU -->
                    <?php if (allowRole([1, 12])) : ?>
                        <li class="sidebar-menu-item">
                            <a
                                class="sidebar-menu-button"
                                data-toggle="collapse"
                                href="#social_menu">
                                <i
                                    class="sidebar-menu-icon sidebar-menu-icon--left fa fa-bullhorn"></i>
                                <span class="sidebar-menu-text">Manage Sosial Media</span>
                                <!-- <span class="badge badge-primary badge-pill ml-1">3</span> -->
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse" id="social_menu">
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="<?= $dashboardUrl ?>manage_socmed">
                                        <span class="sidebar-menu-text">Manage SosMed</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <!-- SOCIAL MEDIA MENU END -->

                    <!-- IKLAN MENU -->
                    <?php if (allowRole([1, 12])) : ?>
                        <li class="sidebar-menu-item">
                            <a
                                class="sidebar-menu-button"
                                data-toggle="collapse"
                                href="#ads_menu">
                                <i
                                    class="sidebar-menu-icon sidebar-menu-icon--left fa fa-ad"></i>
                                <span class="sidebar-menu-text">Manage Iklan</span>
                                <!-- <span class="badge badge-primary badge-pill ml-1">3</span> -->
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse" id="ads_menu">
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="<?= $dashboardUrl ?>manage_ads">
                                        <span class="sidebar-menu-text">Manage Iklan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <!-- IKLAN MENU END -->
                </ul>
                <!-- *********************************FIRST MENU END********************************* -->

            </div>

            <!-- ACCOUNT TOGGLE -->
            <div class="d-flex align-items-center sidebar-p-a border-bottom sidebar-account">

                <a href="edit_profile"
                    class="flex d-flex align-items-center text-underline-0 text-body">

                    <span class="avatar avatar-sm mr-2">

                        <img src="<?= htmlspecialchars($avatarPath); ?>"
                            alt="<?= htmlspecialchars($userData['full_name']); ?>"
                            class="avatar-img rounded-circle"
                            style="object-fit: cover;">

                    </span>

                    <span class="flex d-flex flex-column">

                        <strong>
                            <?= htmlspecialchars($userData['full_name']); ?>
                        </strong>

                        <small class="text-muted text-uppercase">
                            <?= htmlspecialchars($userData['role_name']); ?>
                        </small>

                    </span>

                </a>

                <div class="dropdown ml-auto">

                    <a href="#"
                        data-toggle="dropdown"
                        data-caret="false"
                        class="text-muted">

                        <i class="material-icons">more_vert</i>

                    </a>

                    <div class="dropdown-menu dropdown-menu-right">

                        <div class="dropdown-item-text dropdown-item-text--lh">

                            <div>
                                <strong><?= htmlspecialchars($userData['full_name']); ?></strong>
                            </div>

                            <div>
                                <?= htmlspecialchars($userData['email']); ?>
                            </div>

                        </div>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item"
                            href="/">
                            Dashboard
                        </a>

                        <a class="dropdown-item"
                            href="<?= $dashboardUrl ?>edit_profile">
                            Edit Profile
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item"
                            href="<?= $dashboardUrl ?>logout">
                            Logout
                        </a>

                    </div>

                </div>

            </div>
        </div>
        <!-- *********************************CLIENT MENU END********************************* -->
    </div>
</div>
</div>
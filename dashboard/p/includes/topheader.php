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

?>

<div class="mdk-header__content">

  <div class="navbar navbar-expand-sm navbar-main navbar-dark bg-dark  pr-0"
    id="navbar"
    data-primary>
    <div class="container">

      <!-- Navbar toggler -->

      <button class="navbar-toggler navbar-toggler-right d-block d-lg-none"
        type="button"
        data-toggle="sidebar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Brand -->
      <a href="/" class="my-navbar-brand">
        <img
          src="/hukuminfo/dashboard/assets/images/logos/logo.png" alt="Logo"
          class="my-navbar-logo">
      </a>

      <ul
        class="nav navbar-nav d-none d-sm-flex border-left navbar-height align-items-center">
        <li class="nav-item dropdown">
          <a
            href="#account_menu"
            class="nav-link dropdown-toggle"
            data-toggle="dropdown"
            data-caret="false">
            <span class="mr-1 d-flex-inline">
              <span class="text-light"> Hi, <?= htmlspecialchars($userData['full_name']); ?></span>
            </span>
            <img
              src="<?= htmlspecialchars($avatarPath); ?>"
              class="rounded-circle"
              width="32"
              alt="<?= htmlspecialchars($userData['full_name']); ?>" />
          </a>
          <div
            id="account_menu"
            class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-item-text dropdown-item-text--lh">
              <div><strong><?= htmlspecialchars($userData['full_name']); ?></strong></div>
              <div class="text-muted"><?= htmlspecialchars($userData['email']); ?></div>
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/"><i class="material-icons">dvr</i> Dashboard</a>
            <a class="dropdown-item" href="https://hukuminfo.id"><i class="material-icons">pageview</i> Lihat Website</a>
            <a class="dropdown-item" href="edit_profile"><i class="material-icons">account_circle</i> Edit Akun</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout"><i class="material-icons">exit_to_app</i> Logout</a>
          </div>
        </li>
      </ul>

    </div>
  </div>

</div>
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
        LEFT JOIN user_profile up
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
    '/hukuminfo/dashboard/assets/images/uploads/user_photos/' .
    $photoFile;

  if (file_exists($photoServerPath)) {

    $avatarPath =
      $baseUrl .
      'assets/images/uploads/user_photos/' .
      $photoFile;
  }
}

?>

<div id="header" class="mdk-header js-mdk-header m-0" data-fixed>
  <div class="mdk-header__content">
    <div
      class="navbar navbar-expand-sm navbar-main navbar-dark pr-0 pr-0"
      id="navbar"
      data-primary>
      <div class="container-fluid p-0">
        <!-- Navbar toggler -->
        <button
          class="navbar-toggler navbar-toggler-custom navbar-toggler-right d-block"
          type="button"
          data-toggle="sidebar">
          <span class="material-icons">apps</span>
        </button>

        <!-- Navbar Brand -->
        <a href="/" class="my-navbar-brand">
          <img
            src="/hukuminfo/dashboard/assets/images/logos/logo.png" alt="Logo"
            class="my-navbar-logo">
        </a>

        <ul class="nav navbar-nav ml-auto d-none d-md-flex">

        </ul>

        <!-- ACCOUNT -->
        <ul
          class="nav navbar-nav d-none d-sm-flex border-left navbar-height align-items-center">

          <li class="nav-item dropdown">

            <a
              href="#account_menu"
              class="nav-link dropdown-toggle"
              data-toggle="dropdown"
              data-caret="false">

              <span class="mr-1 d-flex-inline">

                <span class="text-light">
                 Hi, <?= htmlspecialchars($userData['full_name']); ?>
                </span>

              </span>

              <img
                src="<?= htmlspecialchars($avatarPath); ?>"
                class="rounded-circle"
                width="32"
                height="32"
                style="object-fit: cover;"
                alt="<?= htmlspecialchars($userData['full_name']); ?>" />

            </a>

            <div
              id="account_menu"
              class="dropdown-menu dropdown-menu-right">

              <div class="dropdown-item-text dropdown-item-text--lh">

                <div>
                  <strong>
                    <?= htmlspecialchars($userData['full_name']); ?>
                  </strong>
                </div>

                <div class="text-muted">
                  <?= htmlspecialchars($userData['role_name']); ?>
                </div>

                <div class="text-muted small">
                  <?= htmlspecialchars($userData['email']); ?>
                </div>

              </div>

              <div class="dropdown-divider"></div>

              <a class="dropdown-item active" href="/">
                <i class="material-icons">dvr</i>
                Dashboard
              </a>

              <a class="dropdown-item" href="https://hukuminfo.id">
                <i class="material-icons">pageview</i>
                View Website
              </a>

              <a class="dropdown-item" href="edit_profile">
                <i class="material-icons">account_circle</i>
                Edit Akun
              </a>

              <div class="dropdown-divider"></div>

              <a class="dropdown-item" href="logout">
                <i class="material-icons">exit_to_app</i>
                Logout
              </a>

            </div>

          </li>

        </ul>
      </div>
    </div>
  </div>
</div>
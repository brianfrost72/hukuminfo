<?php
session_start();

if (
  !isset($_SESSION['logged_in']) ||
  $_SESSION['user_type'] != 'internal'
) {
  header("Location: ../../../../index.php");
  exit;
}

require_once __DIR__ . "/../koneksi.php";
/*
|--------------------------------------------------------------------------
| TOTAL AKUN PUBLIC
|--------------------------------------------------------------------------
*/
$total_public = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM users
    WHERE user_type = 'public'
"));

$total_public = $total_public['total'];


/*
|--------------------------------------------------------------------------
| TOTAL PROVINSI YANG MEMILIKI USER PUBLIC
|--------------------------------------------------------------------------
*/
$total_province = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(DISTINCT pp.provinces_id) AS total
    FROM public_profile pp
    INNER JOIN users u ON u.id = pp.user_id
    WHERE u.user_type = 'public'
"));

$total_province = $total_province['total'];


/*
|--------------------------------------------------------------------------
| TOTAL KABUPATEN/KOTA YANG MEMILIKI USER PUBLIC
|--------------------------------------------------------------------------
*/
$total_regency = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(DISTINCT pp.regencies_id) AS total
    FROM public_profile pp
    INNER JOIN users u ON u.id = pp.user_id
    WHERE u.user_type = 'public'
"));

$total_regency = $total_regency['total'];


/*
|--------------------------------------------------------------------------
| PROVINSI DENGAN USER TERBANYAK
|--------------------------------------------------------------------------
*/
$top_province = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT
        p.name,
        COUNT(*) AS total_user
    FROM public_profile pp
    INNER JOIN users u
        ON u.id = pp.user_id
    INNER JOIN provinces p
        ON p.id = pp.provinces_id
    WHERE u.user_type = 'public'
    GROUP BY p.id
    ORDER BY total_user DESC
    LIMIT 1
"));

/*
|--------------------------------------------------------------------------
| CHART USER PUBLIC PER PROVINSI
|--------------------------------------------------------------------------
*/
$chart_query = mysqli_query($conn, "
    SELECT
        p.name,
        COUNT(*) AS total_user
    FROM public_profile pp
    INNER JOIN users u
        ON u.id = pp.user_id
    INNER JOIN provinces p
        ON p.id = pp.provinces_id
    WHERE u.user_type = 'public'
    GROUP BY p.id
    ORDER BY total_user DESC
");

$labels = [];
$values = [];

while ($row = mysqli_fetch_assoc($chart_query)) {
  $labels[] = $row['name'];
  $values[] = (int)$row['total_user'];
}
/*
|--------------------------------------------------------------------------
| AMBIL DATA PROVINSI
|--------------------------------------------------------------------------
*/
$province_query = mysqli_query($conn, "
    SELECT id,name
    FROM provinces
    ORDER BY name ASC
");
/*
|--------------------------------------------------------------------------
| TOTAL LIKES (AKUN PUBLIC)
|--------------------------------------------------------------------------
*/
$total_likes = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(pl.id) AS total
    FROM post_likes pl
    INNER JOIN users u
        ON u.id = pl.user_id
    WHERE u.user_type = 'public'
"));

$total_likes = (int)$total_likes['total'];


/*
|--------------------------------------------------------------------------
| TOTAL BOOKMARKS (AKUN PUBLIC)
|--------------------------------------------------------------------------
*/
$total_bookmarks = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(pb.id) AS total
    FROM post_bookmarks pb
    INNER JOIN users u
        ON u.id = pb.user_id
    WHERE u.user_type = 'public'
"));

$total_bookmarks = (int)$total_bookmarks['total'];


/*
|--------------------------------------------------------------------------
| RINGKASAN INTERAKSI
|--------------------------------------------------------------------------
*/
$total_interaction = $total_likes + $total_bookmarks;

$likes_percent = $total_interaction > 0
  ? round(($total_likes / $total_interaction) * 100)
  : 0;

$bookmark_percent = $total_interaction > 0
  ? round(($total_bookmarks / $total_interaction) * 100)
  : 0;

$most_interaction = $total_likes >= $total_bookmarks
  ? 'Likes'
  : 'Bookmark';

/*
|--------------------------------------------------------------------------
| TOTAL KOMENTAR (AKUN PUBLIC)
|--------------------------------------------------------------------------
*/
$total_comments = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(pc.id) AS total
    FROM post_comments pc
    INNER JOIN users u
        ON u.id = pc.user_id
    WHERE
        u.user_type = 'public'
        AND pc.status = 'approved'
"));

$total_comments = (int)$total_comments['total'];


/*
|--------------------------------------------------------------------------
| TOTAL REPLY KOMENTAR (AKUN PUBLIC)
|--------------------------------------------------------------------------
*/
$total_comment_reply = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(pcr.id) AS total
    FROM post_comment_reply pcr
    INNER JOIN users u
        ON u.id = pcr.user_id
    WHERE
        u.user_type = 'public'
        AND pcr.status = 'approved'
"));

$total_comment_reply = (int)$total_comment_reply['total'];


/*
|--------------------------------------------------------------------------
| TOTAL KOMENTAR + REPLY
|--------------------------------------------------------------------------
*/
$total_comment_all = $total_comments + $total_comment_reply;


/*
|--------------------------------------------------------------------------
| KOMENTAR HARI INI
|--------------------------------------------------------------------------
*/
$today_comments = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(pc.id) AS total
    FROM post_comments pc
    INNER JOIN users u
        ON u.id = pc.user_id
    WHERE
        u.user_type = 'public'
        AND pc.status = 'approved'
        AND DATE(pc.created_at) = CURDATE()
"));

$today_replies = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(pcr.id) AS total
    FROM post_comment_reply pcr
    INNER JOIN users u
        ON u.id = pcr.user_id
    WHERE
        u.user_type = 'public'
        AND pcr.status = 'approved'
        AND DATE(pcr.created_at) = CURDATE()
"));

$total_today_comments =
  (int)$today_comments['total']
  +
  (int)$today_replies['total'];

/*
|--------------------------------------------------------------------------
| TOTAL VIEWERS
|--------------------------------------------------------------------------
*/
$total_viewers = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM post_views
"));

$total_viewers = (int)$total_viewers['total'];


/*
|--------------------------------------------------------------------------
| TOP 5 POST VIEWERS
|--------------------------------------------------------------------------
*/
$top_posts = mysqli_query($conn, "
    SELECT
        p.id,
        p.post_title,
        COUNT(pv.id) AS total_view
    FROM post_views pv
    INNER JOIN post p
        ON p.id = pv.post_id
    GROUP BY p.id
    ORDER BY total_view DESC
    LIMIT 5
");


/*
|--------------------------------------------------------------------------
| DEVICE STATISTIC
|--------------------------------------------------------------------------
*/
$device_stat = [];

$device_query = mysqli_query($conn, "
    SELECT
        device,
        COUNT(*) AS total
    FROM post_views
    GROUP BY device
");

while ($row = mysqli_fetch_assoc($device_query)) {
  $device_stat[$row['device']] = $row['total'];
}

$desktop_total = $device_stat['Desktop'] ?? 0;
$mobile_total  = $device_stat['Mobile'] ?? 0;
$tablet_total  = $device_stat['Tablet'] ?? 0;

?>

<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Dashboard | Hukuminfo.id</title>

  <!-- Select2 -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

  <!-- Perfect Scrollbar -->
  <link
    type="text/css"
    href="../assets/vendor/perfect-scrollbar.css"
    rel="stylesheet" />

  <!-- App CSS -->
  <link type="text/css" href="../assets/css/app.css" rel="stylesheet" />

  <!-- Material Design Icons -->
  <link
    type="text/css"
    href="../assets/css/vendor-material-icons.css"
    rel="stylesheet" />

  <!-- Font Awesome FREE Icons -->
  <link
    type="text/css"
    href="../assets/css/vendor-fontawesome-free.css"
    rel="stylesheet" />

  <!-- Flatpickr -->
  <link
    type="text/css"
    href="../assets/css/vendor-flatpickr.css"
    rel="stylesheet" />
  <link
    type="text/css"
    href="../assets/css/vendor-flatpickr-airbnb.css"
    rel="stylesheet" />

  <!-- Vector Maps -->
  <link
    type="text/css"
    href="../assets/vendor/jqvmap/jqvmap.min.css"
    rel="stylesheet" />

  <!-- Toastr -->
  <link type="text/css"
    href="../assets/vendor/toastr.min.css"
    rel="stylesheet">
</head>

<body class="layout-fluid layout-sticky-subnav">
  <div class="preloader"></div>

  <!-- Header Layout -->
  <div class="mdk-header-layout js-mdk-header-layout">
    <!-- **********************************Top Header********************************** -->
    <?php include 'includes/topheader.php'; ?>
    <!-- **********************************// END Top Header //********************************** -->

    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page">
      <div class="page__header">
        <div class="container-fluid page__heading-container">
          <div class="page__heading d-flex align-items-end">
            <div class="flex">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Dashboard
                  </li>
                </ol>
              </nav>
              <h1 class="m-0">Dashboard</h1>
            </div>
          </div>
        </div>
      </div>
      <!-- // END page__header -->

      <!-- ********************************// START page__content //******************************* -->
      <div class="container-fluid page__container">

        <!-- ****************************CHART USER PUBLIK**************************** -->
        <div class="row my-4">

          <!-- Total Akun -->
          <div class="col-lg-3 col-md-6 mb-3">
            <div class="card shadow-sm border-0">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-lg mr-3">
                    <span class="avatar-title rounded-circle bg-primary">
                      <i class="material-icons text-white">people</i>
                    </span>
                  </div>
                  <div>
                    <h6 class="text-muted mb-1">Total Akun</h6>
                    <h2 class="mb-0"> <?= number_format($total_public, 0, ',', '.') ?> </h2>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Total Provinsi -->
          <div class="col-lg-3 col-md-6 mb-3">
            <div class="card shadow-sm border-0">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-lg mr-3">
                    <span class="avatar-title rounded-circle bg-success">
                      <i class="material-icons text-white">map</i>
                    </span>
                  </div>
                  <div>
                    <h6 class="text-muted mb-1">Total Provinsi</h6>
                    <h2 class="mb-0"><?= number_format($total_province, 0, ',', '.') ?></h2>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Total Kabupaten -->
          <div class="col-lg-3 col-md-6 mb-3">
            <div class="card shadow-sm border-0">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-lg mr-3">
                    <span class="avatar-title rounded-circle bg-warning">
                      <i class="material-icons text-white">location_city</i>
                    </span>
                  </div>
                  <div>
                    <h6 class="text-muted mb-1">Total Kota/Kabupaten</h6>
                    <h2 class="mb-0"><?= number_format($total_regency, 0, ',', '.') ?></h2>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Wilayah Terbanyak -->
          <div class="col-lg-3 col-md-6 mb-3">
            <div class="card shadow-sm border-0">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-lg mr-3">
                    <span class="avatar-title rounded-circle bg-danger">
                      <i class="material-icons text-white">location_city</i>
                    </span>
                  </div>
                  <div>
                    <h6 class="text-muted mb-1">Wilayah Terbanyak</h6>
                    <h5 class="mb-0"><?= htmlspecialchars($top_province['name'] ?? '-') ?></h5>
                    <small class="text-muted"><?= number_format($top_province['total_user'] ?? 0, 0, ',', '.') ?></small>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-lg-12">

            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="mb-0">
                  Statistik Akun Publik Berdasarkan Wilayah
                </h4>
                <a href="manage_users" class="btn btn-sm btn-primary">Lihat</a>
              </div>

              <div class="card-body">

                <!-- Filter -->
                <div class="row mb-4">

                  <div class="col-md-4">
                    <label>Provinsi</label>

                    <select
                      id="province_id"
                      class="form-control select2">

                      <option value="">
                        Semua Provinsi
                      </option>

                      <?php while ($province = mysqli_fetch_assoc($province_query)): ?>

                        <option value="<?= $province['id'] ?>">
                          <?= htmlspecialchars($province['name']) ?>
                        </option>

                      <?php endwhile; ?>

                    </select>
                  </div>

                  <div class="col-md-4">
                    <label>Kota / Kabupaten</label>

                    <select
                      id="regency_id"
                      class="form-control select2">

                      <option value="">
                        Semua Kota/Kabupaten
                      </option>

                    </select>
                  </div>

                  <div class="col-md-2">
                    <label>&nbsp;</label>

                    <button
                      type="button"
                      id="btnFilter"
                      class="btn btn-primary btn-block">

                      <i class="material-icons">filter_list</i>
                      Filter
                    </button>
                  </div>

                  <div class="col-md-2">
                    <label>&nbsp;</label>

                    <button
                      type="button"
                      id="btnReset"
                      class="btn btn-outline-secondary btn-block">

                      <i class="material-icons">refresh</i>
                      Reset
                    </button>
                  </div>

                </div>

                <!-- Chart -->
                <div style="height:500px;">
                  <canvas id="userRegionChart"></canvas>
                </div>

              </div>
            </div>

          </div>

        </div>
        <!-- ***************** END Statistik Akun Publik Berdasarkan Wilayah ************************* -->

        <!-- *********************************** TOP 5 POST VIEWERS ************************* -->
        <div class="row mt-4">

          <!-- TOP USER AGENT -->
          <div class="col-lg-8">

            <div class="card">

              <div class="card-header d-flex justify-content-between align-items-center">

                <h4 class="mb-0">
                  Top 5 Post Popular
                </h4>

                <span class="badge badge-primary">
                  Total Viewer :
                  <?= number_format($total_viewers, 0, ',', '.') ?>
                </span>

              </div>

              <div class="card-body p-0">

                <div class="table-responsive">

                  <table class="table table-hover mb-0">

                    <thead>
                      <tr>
                        <th width="60">#</th>
                        <th>Post</th>
                        <th width="150">Total View</th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php
                      $no = 1;

                      while ($post = mysqli_fetch_assoc($top_posts)):
                      ?>

                        <tr>

                          <td>
                            <span class="badge badge-primary">
                              <?= $no++ ?>
                            </span>
                          </td>

                          <td>

                            <div class="font-weight-bold">
                              <?= htmlspecialchars($post['post_title']) ?>
                            </div>

                          </td>

                          <td>

                            <?php
                            $percent = $total_viewers > 0
                              ? round(($post['total_view'] / $total_viewers) * 100, 1)
                              : 0;
                            ?>

                            <div class="font-weight-bold">
                              <?= number_format($post['total_view'], 0, ',', '.') ?>
                            </div>

                            <small class="text-muted">
                              <?= $percent ?>% dari total view
                            </small>

                          </td>

                        </tr>

                      <?php endwhile; ?>

                    </tbody>

                  </table>

                </div>

              </div>

            </div>

          </div>

          <!-- DEVICE -->
          <div class="col-lg-4">

            <div class="card h-100">

              <div class="card-header">
                <h4 class="mb-0">
                  Statistik Device
                </h4>
              </div>

              <div class="card-body">

                <div class="mb-4">

                  <div class="d-flex justify-content-between">
                    <span>
                      <i class="material-icons text-primary">
                        desktop_windows
                      </i>
                      Desktop
                    </span>

                    <strong>
                      <?= number_format($desktop_total, 0, ',', '.') ?>
                    </strong>
                  </div>

                </div>

                <div class="mb-4">

                  <div class="d-flex justify-content-between">
                    <span>
                      <i class="material-icons text-success">
                        smartphone
                      </i>
                      Mobile
                    </span>

                    <strong>
                      <?= number_format($mobile_total, 0, ',', '.') ?>
                    </strong>
                  </div>

                </div>

                <div>

                  <div class="d-flex justify-content-between">
                    <span>
                      <i class="material-icons text-warning">
                        tablet_mac
                      </i>
                      Tablet
                    </span>

                    <strong>
                      <?= number_format($tablet_total, 0, ',', '.') ?>
                    </strong>
                  </div>

                </div>

                <hr>

                <h3 class="text-center mb-0">
                  <?= number_format($total_viewers, 0, ',', '.') ?>
                </h3>

                <small class="text-muted d-block text-center">
                  Total Views
                </small>

              </div>

            </div>

          </div>

        </div>

        <!-- *********************************** TOP 5 POST VIEWERS END ************************* -->

        <!-- *********************************** DONAT CHART LIKE & BOOKMARK ************************* -->
        <div class="row mt-5">

          <div class="col-lg-6">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="mb-0">
                  Statistik Interaksi Konten
                </h4>
              </div>

              <div class="card-body">

                <div style="height:350px;">
                  <canvas id="interactionChart"></canvas>
                </div>

              </div>
            </div>
          </div>

          <div class="col-lg-6">

            <div class="row">

              <div class="col-md-6 mb-3">
                <div class="card shadow-sm border-0 bg-primary text-white h-100">
                  <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                      <div>
                        <small style="color: white;">
                          Total Likes
                        </small>

                        <h1 class="font-weight-bold mb-2">
                          <?= number_format($total_likes, 0, ',', '.') ?>
                        </h1>

                        <a href="list_likes"
                          class="btn btn-light btn-sm">
                          Lihat Detail
                        </a>
                      </div>

                      <div>
                        <i class="material-icons"
                          style="font-size:60px;opacity:.3;">
                          thumb_up
                        </i>
                      </div>

                    </div>

                  </div>
                </div>
              </div>


              <div class="col-md-6 mb-3">
                <div class="card shadow-sm border-0 bg-success text-white h-100">
                  <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                      <div>
                        <small style="color:white;">
                          Total Bookmark
                        </small>

                        <h1 class="font-weight-bold mb-2">
                          <?= number_format($total_bookmarks, 0, ',', '.') ?>
                        </h1>

                        <a href="list_bookmarks"
                          class="btn btn-light btn-sm">
                          Lihat Detail
                        </a>
                      </div>

                      <div>
                        <i class="material-icons"
                          style="font-size:60px;opacity:.3;">
                          bookmark
                        </i>
                      </div>

                    </div>

                  </div>
                </div>
              </div>

            </div>

            <div class="card">
              <div class="card-body">

                <h5>Ringkasan</h5>

                <table class="table table-bordered mb-0">
                  <tbody>
                    <tr>
                      <th>Total Interaksi</th>
                      <td><?= number_format($total_interaction, 0, ',', '.') ?></td>
                    </tr>

                    <tr>
                      <th>Likes</th>
                      <td>
                        <?= number_format($total_likes, 0, ',', '.') ?>
                        (<?= $likes_percent ?>%)
                      </td>
                    </tr>

                    <tr>
                      <th>Bookmark</th>
                      <td>
                        <?= number_format($total_bookmarks, 0, ',', '.') ?>
                        (<?= $bookmark_percent ?>%)
                      </td>
                    </tr>

                    <tr>
                      <th>Interaksi Terbanyak</th>
                      <td><?= $most_interaction ?></td>
                    </tr>
                  </tbody>
                </table>

              </div>
            </div>

          </div>

        </div>
        <!-- ******************************* //END DONAT CHART LIKE & BOOKMARK *********************** -->

        <!-- *************************************** TOTAL COMMENT ******************************* -->
        <div class="row mt-4">

          <div class="col-lg-6">

            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="mb-0">
                  Statistik Komentar
                </h4>
                <a href="manage_comments.php" class="btn btn-sm btn-primary">
                  Lihat
                </a>
              </div>

              <div class="card-body">

                <div style="height:350px;">
                  <canvas id="commentChart"></canvas>
                </div>

              </div>
            </div>

          </div>

          <div class="col-lg-6">

            <div class="card mb-3">
              <div class="card-body text-center">

                <div class="avatar avatar-xl mx-auto mb-3">
                  <span class="avatar-title rounded-circle bg-info">
                    <i class="material-icons text-white" style="font-size:32px;">
                      comment
                    </i>
                  </span>
                </div>

                <h6 class="text-muted">Total Komentar</h6>
                <h1 class="font-weight-bold mb-0">
                  <?= number_format($total_comment_all, 0, ',', '.') ?>
                </h1>

              </div>
            </div>

            <div class="card">
              <div class="card-body">

                <h5>Ringkasan Komentar</h5>

                <table class="table table-bordered mb-0">
                  <tbody>
                    <tr>
                      <th>Total Komentar</th>
                      <td>
                        <?= number_format($total_comment_all, 0, ',', '.') ?>
                      </td>
                    </tr>

                    <tr>
                      <th>Komentar Utama</th>
                      <td>
                        <?= number_format($total_comments, 0, ',', '.') ?>
                      </td>
                    </tr>

                    <tr>
                      <th>Balasan Komentar</th>
                      <td>
                        <?= number_format($total_comment_reply, 0, ',', '.') ?>
                      </td>
                    </tr>

                    <tr>
                      <th>Komentar Hari Ini</th>
                      <td>
                        <?= number_format($total_today_comments, 0, ',', '.') ?>
                      </td>
                    </tr>
                  </tbody>
                </table>

              </div>
            </div>

          </div>

        </div>

        <!-- *********************************** END TOTAL COMMENT *********************************** -->

        <!-- ********************************** //END page-content ********************************** -->
      </div>
      <!-- ********************************** //END page-content ********************************** -->
    </div>
  </div>
  <!-- // END header-layout -->

  <!-- App Settings FAB -->
  <div id="app-settings" style="display: none">
    <app-settings layout-active="fluid"></app-settings>
  </div>

  <!-- ********************************** // MENU-Drawer ********************************** -->
  <?php include 'includes/drawer_menu.php'; ?>
  <!-- ********************************** //END MENU-drawer ********************************** -->

  <footer class="dashboard-footer mt-4">
    <div class="container-fluid">
      <div class="row align-items-center">
        <!-- LEFT -->
        <div class="col-md-6 text-md-left text-center mb-2 mb-md-0">
          <span class="footer-text">
            © 2026 Hukuminfo.id. All rights reserved.
          </span>
        </div>
      </div>
    </div>
  </footer>

  <!-- jQuery -->
  <script src="../assets/vendor/jquery.min.js"></script>

  <!-- Select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- Bootstrap -->
  <script src="../assets/vendor/popper.min.js"></script>
  <script src="../assets/vendor/bootstrap.min.js"></script>

  <!-- Perfect Scrollbar -->
  <script src="../assets/vendor/perfect-scrollbar.min.js"></script>

  <!-- DOM Factory -->
  <script src="../assets/vendor/dom-factory.js"></script>

  <!-- MDK -->
  <script src="../assets/vendor/material-design-kit.js"></script>

  <!-- App -->
  <script src="../assets/js/toggle-check-all.js"></script>
  <script src="../assets/js/check-selected-row.js"></script>
  <script src="../assets/js/dropdown.js"></script>
  <script src="../assets/js/sidebar-mini.js"></script>
  <script src="../assets/js/app.js"></script>

  <!-- App Settings (safe to remove) -->
  <script src="../assets/js/app-settings.js"></script>

  <!-- Flatpickr -->
  <script src="../assets/vendor/flatpickr/flatpickr.min.js"></script>
  <script src="../assets/js/flatpickr.js"></script>

  <!-- Global Settings -->
  <script src="../assets/js/settings.js"></script>

  <!-- Moment.js -->
  <script src="../assets/vendor/moment.min.js"></script>
  <script src="../assets/vendor/moment-range.js"></script>

  <!-- Chart.js -->
  <script src="../assets/vendor/Chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Toastr -->
  <script src="assets/vendor/toastr.min.js"></script>
  <script src="assets/js/toastr.js"></script>

  <script>
    const ctx = document.getElementById('userRegionChart');

    let userRegionChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
          label: 'Jumlah Akun',
          data: <?= json_encode($values) ?>,
          borderWidth: 1,
          borderRadius: 8
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,

        plugins: {
          legend: {
            display: false
          },
          title: {
            display: true,
            text: 'Jumlah Akun Publik per Wilayah'
          }
        },

        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Jumlah Akun'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Provinsi / Kota'
            }
          }
        }
      }
    });
  </script>

  <script>
    const interactionCtx = document.getElementById('interactionChart');

    new Chart(interactionCtx, {
      type: 'doughnut',
      data: {
        labels: [
          'Likes',
          'Bookmark'
        ],
        datasets: [{
          data: [
            <?= $total_likes ?>,
            <?= $total_bookmarks ?>
          ],
          backgroundColor: [
            '#6774df',
            '#7dc668'
          ],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,

        cutout: '70%',

        plugins: {
          legend: {
            position: 'bottom'
          },
          title: {
            display: true,
            text: 'Perbandingan Likes dan Bookmark'
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                let value = context.raw;
                let percentage = ((value / total) * 100).toFixed(1);

                return context.label +
                  ': ' +
                  value.toLocaleString('id-ID') +
                  ' (' + percentage + '%)';
              }
            }
          }
        }
      }
    });
  </script>

  <script>
    const commentCtx = document.getElementById('commentChart');

    new Chart(commentCtx, {
      type: 'doughnut',
      data: {
        labels: ['Komentar'],
        datasets: [{
          data: [
            <?= $total_comments ?>,
            <?= $total_comment_reply ?>
          ],
          backgroundColor: ['#36b9cc'],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,

        cutout: '75%',

        plugins: {
          legend: {
            display: false
          },
          title: {
            display: true,
            text: 'Total Komentar'
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                return 'Komentar: ' +
                  context.raw.toLocaleString('id-ID');
              }
            }
          }
        }
      },

      plugins: [{
        id: 'centerText',
        beforeDraw(chart) {
          const {
            width,
            height,
            ctx
          } = chart;

          ctx.restore();

          const fontSize = (height / 120).toFixed(2);
          ctx.font = `bold ${fontSize}em sans-serif`;
          ctx.textBaseline = "middle";

          const text = "";
          const textX = Math.round((width - ctx.measureText(text).width) / 2);
          const textY = height / 2;

          ctx.fillStyle = "#112b4a";
          ctx.fillText(text, textX, textY);

          ctx.save();
        }
      }]
    });
  </script>

  <script>
    $('.select2').select2({
      width: '100%'
    });

    $('#province_id').on('change', function() {

      let province_id = $(this).val();

      $('#regency_id').html(
        '<option value="">Semua Kota/Kabupaten</option>'
      );

      if (province_id == '') {
        return;
      }

      $.ajax({

        url: 'ajax/get_regencies.php',

        type: 'GET',

        data: {
          province_id: province_id
        },

        dataType: 'json',

        success: function(response) {

          $.each(response, function(i, row) {

            $('#regency_id').append(`
                    <option value="${row.id}">
                        ${row.name}
                    </option>
                `);

          });

        }

      });

    });

    // FILTER BTN
    $('#btnFilter').on('click', function() {

      $.ajax({

        url: 'ajax/get_user_region_chart.php',

        type: 'GET',

        data: {
          province_id: $('#province_id').val(),
          regency_id: $('#regency_id').val()
        },

        dataType: 'json',

        success: function(res) {

          userRegionChart.data.labels = res.labels;
          userRegionChart.data.datasets[0].data = res.values;

          userRegionChart.update();

        }

      });

    });

    // RESET BTN
    $('#btnReset').on('click', function() {

      $('#province_id').val('').trigger('change');

      $('#regency_id').html(
        '<option value="">Semua Kota/Kabupaten</option>'
      );

      $.ajax({

        url: 'ajax/get_user_region_chart.php',

        type: 'GET',

        dataType: 'json',

        success: function(res) {

          userRegionChart.data.labels = res.labels;
          userRegionChart.data.datasets[0].data = res.values;

          userRegionChart.update();

        }

      });

    });
  </script>
</body>

</html>
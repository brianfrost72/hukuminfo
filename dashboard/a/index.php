<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Dashboard | Hukuminfo.id</title>

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
                    <h2 class="mb-0">25.430</h2>
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
                    <h2 class="mb-0">38</h2>
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
                    <h2 class="mb-0">514</h2>
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
                    <h5 class="mb-0">DKI Jakarta</h5>
                    <small class="text-muted">3.520 Akun</small>
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
                <a href="manage_income_reports" class="btn btn-sm btn-primary">Lihat</a>
              </div>

              <div class="card-body">

                <!-- Filter -->
                <div class="row mb-4">

                  <div class="col-md-4">
                    <label>Provinsi</label>
                    <select class="form-control">
                      <option>Semua Provinsi</option>
                      <option>DKI Jakarta</option>
                      <option>Jawa Barat</option>
                      <option>Jawa Tengah</option>
                      <option>Jawa Timur</option>
                      <option>Banten</option>
                    </select>
                  </div>

                  <div class="col-md-4">
                    <label>Kota / Kabupaten</label>
                    <select class="form-control">
                      <option>Semua Kota/Kabupaten</option>
                      <option>Jakarta Selatan</option>
                      <option>Jakarta Timur</option>
                      <option>Jakarta Barat</option>
                      <option>Jakarta Utara</option>
                      <option>Jakarta Pusat</option>
                    </select>
                  </div>

                  <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button class="btn btn-primary btn-block">
                      <i class="material-icons">filter_list</i>
                      Filter
                    </button>
                  </div>

                  <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button class="btn btn-outline-secondary btn-block">
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

        <!-- *********************************** DONAT CHART LIKE & BOOKMARK ************************* -->
        <div class="row mt-4">

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
                <div class="card border-left-primary">
                  <div class="card-body">
                    <small class="text-muted">Total Likes</small>
                    <h2 class="mb-0">128.540</h2>
                    <a href="manage_income_reports" class="btn btn-sm btn-primary">Lihat</a>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <div class="card border-left-success">
                  <div class="card-body">
                    <small class="text-muted">Total Bookmark</small>
                    <h2 class="mb-0">42.875</h2>
                    <a href="manage_income_reports" class="btn btn-sm btn-primary">Lihat</a>
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
                      <td>171.415</td>
                    </tr>
                    <tr>
                      <th>Likes</th>
                      <td>128.540 (75%)</td>
                    </tr>
                    <tr>
                      <th>Bookmark</th>
                      <td>42.875 (25%)</td>
                    </tr>
                    <tr>
                      <th>Interaksi Terbanyak</th>
                      <td>Likes</td>
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
                  84.275
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
                      <td>84.275</td>
                    </tr>
                    <tr>
                      <th>Rata-rata per Artikel</th>
                      <td>48</td>
                    </tr>
                    <tr>
                      <th>Komentar Hari Ini</th>
                      <td>125</td>
                    </tr>
                    <tr>
                      <th>Status</th>
                      <td>Aktif</td>
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

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          'DKI Jakarta',
          'Jawa Barat',
          'Jawa Tengah',
          'Jawa Timur',
          'Banten',
          'Sumatera Utara',
          'Lampung',
          'Riau',
          'Bali',
          'Sulawesi Selatan'
        ],
        datasets: [{
          label: 'Jumlah Akun',
          data: [
            3520,
            2875,
            2540,
            2380,
            1820,
            1420,
            1210,
            1180,
            960,
            890
          ],
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
            128540,
            42875
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
          data: [84275],
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
</body>

</html>
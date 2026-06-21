<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: ../../index.php");
  exit;
}

?>

<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Dashboard | Konig Guard Bureau</title>

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
        <div class="row mt-3 mb-3">
          <h3>Quick Access</h3>
        </div>
        <div class="row card-group-row">
          <div class="col-lg-3 col-md-4 card-group-row__col">
            <div class="card card-group-row__card">
              <div class="p-2 d-flex flex-row align-items-center">
                <div class="avatar avatar-xs mr-2">
                  <span
                    class="avatar-title rounded-circle text-center bg-primary">
                    <i class="material-icons text-white icon-18pt">accessibility</i>
                  </span>
                </div>
                <a href="manage_roles.php" class="text-dark">
                  <strong>Manage Role</strong>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 card-group-row__col">
            <div class="card card-group-row__card">
              <div class="p-2 d-flex flex-row align-items-center">
                <div class="avatar avatar-xs mr-2">
                  <span
                    class="avatar-title rounded-circle text-center bg-success">
                    <i class="material-icons text-white icon-18pt">person_add</i>
                  </span>
                </div>
                <a href="manage_employees.php" class="text-dark">
                  <strong>Tambah Personel</strong>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 card-group-row__col">
            <div class="card card-group-row__card">
              <div class="p-2 d-flex flex-row align-items-center">
                <div class="avatar avatar-xs mr-2">
                  <span
                    class="avatar-title rounded-circle text-center bg-info">
                    <i class="material-icons text-white icon-18pt">photo_library</i>
                  </span>
                </div>
                <a href="manage_gallery.php" class="text-dark">
                  <strong>Manage Galeri</strong>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 card-group-row__col">
            <div class="card card-group-row__card">
              <div class="p-2 d-flex flex-row align-items-center">
                <div class="avatar avatar-xs mr-2">
                  <span
                    class="avatar-title rounded-circle text-center bg-blue">
                    <i class="material-icons text-white icon-18pt">work</i>
                  </span>
                </div>
                <a href="manage_job_information.php" class="text-dark">
                  <strong>Manage Lowongan Kerja</strong>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 card-group-row__col">
            <div class="card card-group-row__card">
              <div class="p-2 d-flex flex-row align-items-center">
                <div class="avatar avatar-xs mr-2">
                  <span
                    class="avatar-title rounded-circle text-center bg-warning">
                    <i class="material-icons text-white icon-18pt">work</i>
                  </span>
                </div>
                <a href="manage_company_structure.php" class="text-dark">
                  <strong>Manage Struktur Organisasi</strong>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 card-group-row__col">
            <div class="card card-group-row__card">
              <div class="p-2 d-flex flex-row align-items-center">
                <div class="avatar avatar-xs mr-2">
                  <span
                    class="avatar-title rounded-circle text-center bg-primary">
                    <i class="material-icons text-white icon-18pt">inbox</i>
                  </span>
                </div>
                <a href="manage_inbox.php" class="text-dark">
                  <strong>Kotak Masuk</strong>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 card-group-row__col">
            <div class="card card-group-row__card">
              <div class="p-2 d-flex flex-row align-items-center">
                <div class="avatar avatar-xs mr-2">
                  <span
                    class="avatar-title rounded-circle text-center bg-primary">
                    <i class="material-icons text-white icon-18pt">layers</i>
                  </span>
                </div>
                <a href="manage_post.php" class="text-dark">
                  <strong>Manage Postingan</strong>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 card-group-row__col">
            <div class="card card-group-row__card">
              <div class="p-2 d-flex flex-row align-items-center">
                <div class="avatar avatar-xs mr-2">
                  <span
                    class="avatar-title rounded-circle text-center bg-primary">
                    <i class="material-icons text-white icon-18pt">layers</i>
                  </span>
                </div>
                <a href="manage_our_clients.php" class="text-dark">
                  <strong>Manage Klien Kami</strong>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 card-group-row__col">
            <div class="card card-group-row__card">
              <div class="p-2 d-flex flex-row align-items-center">
                <div class="avatar avatar-xs mr-2">
                  <span
                    class="avatar-title rounded-circle text-center bg-primary">
                    <i class="material-icons text-white icon-18pt">layers</i>
                  </span>
                </div>
                <a href="manage_partners.php" class="text-dark">
                  <strong>Manage Mitra Kami</strong>
                </a>
              </div>
            </div>
          </div>
          <!-- <div class="col-lg-3 col-md-4 card-group-row__col">
              <div class="card card-group-row__card">
                <div class="p-2 d-flex flex-row align-items-center">
                  <div class="avatar avatar-xs mr-2">
                    <span
                      class="avatar-title rounded-circle text-center bg-primary"
                    >
                      <i class="material-icons text-white icon-18pt">insert_emoticon</i>
                    </span>
                  </div>
                  <a href="#" class="text-dark">
                    <strong>Manage Testimoni</strong>
                  </a>
                </div>
              </div>
            </div> -->
          <div class="col-lg-3 col-md-4 card-group-row__col">
            <div class="card card-group-row__card">
              <div class="p-2 d-flex flex-row align-items-center">
                <div class="avatar avatar-xs mr-2">
                  <span
                    class="avatar-title rounded-circle text-center bg-primary">
                    <i class="material-icons text-white icon-18pt">layers</i>
                  </span>
                </div>
                <a href="manage_legality.php" class="text-dark">
                  <strong>Manage Legalitas Perusahaan</strong>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- ****************************ANALISTIK DAN LAPORAN**************************** -->

        <div class="row mt-4 mb-3">
          <h3>Analitik & Laporan</h3>
        </div>
        <div class="row card-group-row">
          <div class="col-lg-12">
            <div class="card">
              <!-- HEADER -->
              <div
                class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Visitor Analytics</h4>

                <!-- TOGGLE -->
                <ul class="nav nav-pills" id="chartToggle">
                  <li class="nav-item">
                    <a class="nav-link active" data-type="daily" href="#">Harian</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-type="weekly" href="#">Mingguan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-type="monthly" href="#">Bulanan</a>
                  </li>
                </ul>
              </div>

              <!-- BODY -->
              <div class="card-body">
                <canvas id="visitorChart" height="100"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <!-- HEADER -->
              <div
                class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="m-0">Total Pendapatan</h4>

                <!-- TOGGLE -->
                <ul class="nav nav-pills" id="revenueToggle">
                  <li class="nav-item">
                    <a class="nav-link active" data-type="personal" href="#">Personal</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-type="company" href="#">Perusahaan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-type="all" href="#">Total</a>
                  </li>
                </ul>
              </div>

              <!-- FILTER -->
              <div class="card-body border-bottom">
                <div class="row">
                  <div class="col-md-4">
                    <label>Dari</label>
                    <input type="date" id="dateFrom" class="form-control" />
                  </div>
                  <div class="col-md-4">
                    <label>Sampai</label>
                    <input type="date" id="dateTo" class="form-control" />
                  </div>
                  <div class="col-md-4 d-flex align-items-end">
                    <button id="filterBtn" class="btn btn-primary w-100">
                      Filter
                    </button>
                  </div>
                </div>
              </div>

              <!-- TOTAL SUMMARY -->
              <div class="card-body text-center border-bottom">
                <h6 class="text-muted">Total Pendapatan (1 Tahun)</h6>
                <h2 id="totalRevenueAll" style="font-weight: 600">Rp 0</h2>
              </div>

              <!-- CHART -->
              <div class="card-body">
                <canvas id="revenueChart" height="100"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="card">
              <!-- HEADER -->
              <div
                class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Total Personil</h4>
                <a href="#" class="btn btn-sm btn-primary">View</a>
              </div>

              <!-- FILTER -->
              <div class="card-body border-bottom">
                <div class="row">
                  <div class="col-4">
                    <select id="filterGender" class="form-control">
                      <option value="">Semua Gender</option>
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                  </div>

                  <div class="col-4">
                    <select id="filterDept" class="form-control">
                      <option value="">Semua Dept</option>
                      <option value="Security">Security</option>
                      <option value="Bodyguard">Bodyguard</option>
                      <option value="Driver">Driver</option>
                      <option value="Pramubakti">Pramubakti</option>
                      <option value="Cleaning">Cleaning Service</option>
                      <option value="Pengacara">Pengacara</option>
                    </select>
                  </div>

                  <div class="col-4">
                    <select id="filterStatus" class="form-control">
                      <option value="">Semua Status</option>
                      <option value="kontrak">Kontrak</option>
                      <option value="tetap">Tetap</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- CHART -->
              <div class="card-body text-center">
                <canvas id="personnelChart" height="200"></canvas>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card">
              <!-- HEADER -->
              <div
                class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Total Klien</h4>
                <a href="#" class="btn btn-sm btn-primary">View</a>
              </div>

              <!-- TOGGLE TYPE -->
              <div class="card-body border-bottom">
                <ul
                  class="nav nav-pills justify-content-center mb-2"
                  id="clientTypeToggle">
                  <li class="nav-item">
                    <a class="nav-link active" data-type="personal" href="#">Personal</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-type="company" href="#">Perusahaan</a>
                  </li>
                </ul>

                <!-- STATUS FILTER -->
                <div class="text-center">
                  <select
                    id="clientStatusFilter"
                    class="form-control w-50 mx-auto">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                  </select>
                </div>
              </div>

              <!-- CHART -->
              <div class="card-body text-center">
                <canvas id="clientChart" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <!-- HEADER -->
              <div
                class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Laporan Keuangan Bulanan</h4>
                <a href="#" class="btn btn-sm btn-primary">Lihat</a>
              </div>

              <!-- FILTER -->
              <div class="card-body border-bottom">
                <div class="row align-items-end">
                  <div class="col-md-4">
                    <label>Pilih Bulan</label>
                    <input
                      type="month"
                      id="monthPicker"
                      class="form-control" />
                  </div>

                  <div class="col-md-2">
                    <button id="loadFinance" class="btn btn-success w-100">
                      Tampilkan
                    </button>
                  </div>
                </div>
              </div>

              <!-- KPI -->
              <div class="card-body">
                <div class="row text-center">
                  <div class="col-md-6">
                    <h6>Total Pendapatan</h6>
                    <h2 id="totalIncome">Rp 0</h2>
                  </div>

                  <div class="col-md-6">
                    <h6>Sisa Deposit</h6>
                    <h2 id="totalBalance">Rp 0</h2>
                  </div>
                </div>
              </div>

              <!-- CHART -->
              <div class="card-body">
                <canvas id="financeChart" height="120"></canvas>
              </div>

              <!-- NOTE -->
              <div class="card-body border-top">
                <p class="mb-1"><strong>Catatan:</strong></p>
                <p class="mb-1">
                  • Total Pengeluaran Gaji: <span id="salaryCost">Rp 0</span>
                </p>
                <p class="mb-0">
                  • Pengeluaran Kantor: <span id="officeCost">Rp 0</span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- ********************************** //END page-content ********************************** -->
      </div>
      <!-- ********************************** //END page-content ********************************** -->
    </div>
  </div>
  <!-- // END header-layout -->

  <!-- App Settings FAB -->
  <div id="app-settings" style="display: none">
    <app-settings
      layout-active="fluid"
      :layout-location="{
      'default': 'index.html',
      'fixed': 'fixed-dashboard.html',
      'fluid': 'fluid-dashboard.html',
      'mini': 'mini-dashboard.html'
    }"></app-settings>
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
            © 2026 Konig Guard Bureau. All rights reserved.
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

  <script>
    // VISITOR WEB
    const ctx = document.getElementById("visitorChart").getContext("2d");

    let chart;

    // DATA SIMULASI
    const dataSets = {
      daily: {
        labels: [
          "00",
          "02",
          "04",
          "06",
          "08",
          "10",
          "12",
          "14",
          "16",
          "18",
          "20",
          "22",
        ],
        data: [12, 19, 8, 15, 25, 30, 40, 35, 50, 45, 38, 28],
      },
      weekly: {
        labels: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"],
        data: [120, 190, 300, 250, 220, 310, 400],
      },
      monthly: {
        labels: ["M1", "M2", "M3", "M4"],
        data: [1200, 1900, 1500, 2200],
      },
    };

    // INIT CHART
    function loadChart(type = "daily") {
      if (chart) chart.destroy();

      chart = new Chart(ctx, {
        type: "line",
        data: {
          labels: dataSets[type].labels,
          datasets: [{
            label: "Visitors",
            data: dataSets[type].data,
            borderColor: "#6774DF",
            backgroundColor: "rgba(103,116,223,0.1)",
            borderWidth: 2,
            fill: true,
            tension: 0.4,
            pointRadius: 3,
          }, ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            },
          },
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    }

    // LOAD DEFAULT
    loadChart();

    document.querySelectorAll("#chartToggle .nav-link").forEach((btn) => {
      btn.addEventListener("click", function(e) {
        e.preventDefault();

        // remove active
        document
          .querySelectorAll("#chartToggle .nav-link")
          .forEach((el) => el.classList.remove("active"));

        this.classList.add("active");

        const type = this.getAttribute("data-type");
        loadChart(type);
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    // TOTAL PENDAPATAN
    // =======================
    // DATA SIMULASI
    // =======================
    const revenueData = {
      personal: [{
          date: "2026-01-10",
          value: 200
        },
        {
          date: "2026-02-05",
          value: 350
        },
        {
          date: "2026-03-12",
          value: 500
        },
        {
          date: "2026-04-04",
          value: 300
        },
        {
          date: "2026-05-20",
          value: 450
        },
      ],
      company: [{
          date: "2026-01-15",
          value: 1000
        },
        {
          date: "2026-02-10",
          value: 1200
        },
        {
          date: "2026-03-22",
          value: 900
        },
        {
          date: "2026-04-18",
          value: 1500
        },
        {
          date: "2026-05-25",
          value: 1800
        },
      ],
    };

    // =======================
    // SETUP CHART
    // =======================
    const ctxRevenue = document
      .getElementById("revenueChart")
      .getContext("2d");

    let revenueChart;
    let currentType = "all"; // default langsung total

    // =======================
    // FORMAT RUPIAH
    // =======================
    function formatRupiah(num) {
      return "Rp " + num.toLocaleString("id-ID");
    }

    // =======================
    // FILTER DATA
    // =======================
    function getDataByType(type, from, to) {
      let data = [];

      if (type === "all") {
        data = [...revenueData.personal, ...revenueData.company];
      } else {
        data = revenueData[type];
      }

      return data.filter((item) => {
        if (!from && !to) return true;

        const date = new Date(item.date);
        const fromDate = from ? new Date(from) : null;
        const toDate = to ? new Date(to) : null;

        return (!fromDate || date >= fromDate) && (!toDate || date <= toDate);
      });
    }

    // =======================
    // GROUP BY BULAN (JAN-DEC)
    // =======================
    function groupByMonth(data) {
      const months = Array(12).fill(0);

      data.forEach((item) => {
        const month = new Date(item.date).getMonth(); // 0-11
        months[month] += item.value;
      });

      return months;
    }

    // =======================
    // LOAD CHART
    // =======================
    function loadRevenueChart(type, from = null, to = null) {
      const filtered = getDataByType(type, from, to);
      const monthlyData = groupByMonth(filtered);

      const labels = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "Mei",
        "Jun",
        "Jul",
        "Agu",
        "Sep",
        "Okt",
        "Nov",
        "Des",
      ];

      // TOTAL SEMUA
      const total = monthlyData.reduce((a, b) => a + b, 0);

      document.getElementById("totalRevenueAll").innerText =
        formatRupiah(total);

      // HAPUS CHART LAMA
      if (revenueChart) revenueChart.destroy();

      // WARNA DINAMIS
      let color = "#6774DF";
      if (type === "personal") color = "#7DC668";
      if (type === "company") color = "#F5B666";

      // CREATE CHART
      revenueChart = new Chart(ctxRevenue, {
        type: "bar",
        data: {
          labels: labels,
          datasets: [{
            label: "Pendapatan",
            data: monthlyData,
            backgroundColor: color,
            borderRadius: 6,
          }, ],
        },
        options: {
          responsive: true,
          animation: {
            duration: 1200,
            easing: "easeOutQuart",
          },
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  return formatRupiah(context.raw);
                },
              },
            },
          },
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    }

    // =======================
    // INIT
    // =======================
    loadRevenueChart("all");

    // =======================
    // TOGGLE BUTTON
    // =======================
    document.querySelectorAll("#revenueToggle .nav-link").forEach((btn) => {
      btn.addEventListener("click", function(e) {
        e.preventDefault();

        // remove active hanya di revenue toggle
        document
          .querySelectorAll("#revenueToggle .nav-link")
          .forEach((el) => el.classList.remove("active"));

        this.classList.add("active");

        currentType = this.dataset.type;

        const from = document.getElementById("dateFrom").value;
        const to = document.getElementById("dateTo").value;

        loadRevenueChart(currentType, from, to);
      });
    });

    // =======================
    // FILTER BUTTON
    // =======================
    document
      .getElementById("filterBtn")
      .addEventListener("click", function() {
        const from = document.getElementById("dateFrom").value;
        const to = document.getElementById("dateTo").value;

        loadRevenueChart(currentType, from, to);
      });
  </script>

  <script>
    // TOTAL KARYAWAN ATAU PERSONEL
    const personnelData = [{
        dept: "Security",
        gender: "L",
        status: "tetap"
      },
      {
        dept: "Security",
        gender: "P",
        status: "kontrak"
      },
      {
        dept: "Bodyguard",
        gender: "L",
        status: "tetap"
      },
      {
        dept: "Driver",
        gender: "L",
        status: "kontrak"
      },
      {
        dept: "Pramubakti",
        gender: "P",
        status: "tetap"
      },
      {
        dept: "Cleaning",
        gender: "P",
        status: "kontrak"
      },
      {
        dept: "Pengacara",
        gender: "L",
        status: "tetap"
      },
      {
        dept: "Driver",
        gender: "L",
        status: "tetap"
      },
      {
        dept: "Security",
        gender: "L",
        status: "kontrak"
      },
      {
        dept: "Cleaning",
        gender: "P",
        status: "tetap"
      },
    ];

    function getFilteredData() {
      const gender = document.getElementById("filterGender").value;
      const dept = document.getElementById("filterDept").value;
      const status = document.getElementById("filterStatus").value;

      return personnelData.filter((p) => {
        return (
          (!gender || p.gender === gender) &&
          (!dept || p.dept === dept) &&
          (!status || p.status === status)
        );
      });
    }

    // GROUP BY DEPT
    function groupByDept(data) {
      const result = {
        Security: 0,
        Bodyguard: 0,
        Driver: 0,
        Pramubakti: 0,
        Cleaning: 0,
        Pengacara: 0,
      };

      data.forEach((p) => {
        result[p.dept]++;
      });

      return result;
    }

    const ctxPersonel = document
      .getElementById("personnelChart")
      .getContext("2d");

    let personelChart;

    function loadPersonelChart() {
      const filtered = getFilteredData();
      const grouped = groupByDept(filtered);

      if (personelChart) personelChart.destroy();

      personelChart = new Chart(ctxPersonel, {
        type: "doughnut",
        data: {
          labels: Object.keys(grouped),
          datasets: [{
            data: Object.values(grouped),
            backgroundColor: [
              "#6774DF",
              "#7DC668",
              "#F5B666",
              "#5dd2bc",
              "#ff7076",
              "#939FAD",
            ],
          }, ],
        },
        options: {
          cutout: "65%",
          plugins: {
            legend: {
              position: "bottom",
            },
          },
        },
      });
    }

    // INIT
    loadPersonelChart();

    ["filterGender", "filterDept", "filterStatus"].forEach((id) => {
      document
        .getElementById(id)
        .addEventListener("change", loadPersonelChart);
    });
  </script>

  <script>
    const clientData = [{
        type: "personal",
        status: "aktif"
      },
      {
        type: "personal",
        status: "nonaktif"
      },
      {
        type: "personal",
        status: "aktif"
      },
      {
        type: "company",
        status: "aktif"
      },
      {
        type: "company",
        status: "nonaktif"
      },
      {
        type: "company",
        status: "aktif"
      },
      {
        type: "company",
        status: "aktif"
      },
      {
        type: "personal",
        status: "aktif"
      },
    ];

    let currentClientType = "personal";

    function getFilteredClientData() {
      const status = document.getElementById("clientStatusFilter").value;

      return clientData.filter((c) => {
        return (
          c.type === currentClientType && (!status || c.status === status)
        );
      });
    }

    function groupClientStatus(data) {
      return {
        Aktif: data.filter((d) => d.status === "aktif").length,
        Nonaktif: data.filter((d) => d.status === "nonaktif").length,
      };
    }

    const ctxClient = document.getElementById("clientChart").getContext("2d");

    let clientChart;

    function loadClientChart() {
      const filtered = getFilteredClientData();
      const grouped = groupClientStatus(filtered);

      if (clientChart) clientChart.destroy();

      clientChart = new Chart(ctxClient, {
        type: "doughnut",
        data: {
          labels: ["Aktif", "Nonaktif"],
          datasets: [{
            data: [grouped.Aktif, grouped.Nonaktif],
            backgroundColor: ["#7DC668", "#ff7076"],
          }, ],
        },
        options: {
          cutout: "65%",
          plugins: {
            legend: {
              position: "bottom",
            },
          },
        },
      });
    }

    // INIT
    loadClientChart();

    // TOGGLE TYPE
    document
      .querySelectorAll("#clientTypeToggle .nav-link")
      .forEach((btn) => {
        btn.addEventListener("click", function(e) {
          e.preventDefault();

          document
            .querySelectorAll("#clientTypeToggle .nav-link")
            .forEach((el) => el.classList.remove("active"));

          this.classList.add("active");

          currentClientType = this.dataset.type;
          loadClientChart();
        });
      });

    // STATUS FILTER
    document
      .getElementById("clientStatusFilter")
      .addEventListener("change", loadClientChart);
  </script>

  <script>
    // UNTUK PENGELUARAN
    const financeData = {
      "2026-04": {
        income: 15000000,
        salary: 5000000,
        office: 2000000,
      },
      "2026-05": {
        income: 18000000,
        salary: 6000000,
        office: 2500000,
      },
    };

    // -----------------------------
    function formatRupiah(num) {
      return "Rp " + num.toLocaleString("id-ID");
    }

    // ANIMASI ANGKA
    function animateValue(id, start, end, duration) {
      let range = end - start;
      let current = start;
      let increment = range / (duration / 16);

      const obj = document.getElementById(id);

      const timer = setInterval(() => {
        current += increment;

        if (
          (increment > 0 && current >= end) ||
          (increment < 0 && current <= end)
        ) {
          current = end;
          clearInterval(timer);
        }

        obj.innerText = formatRupiah(Math.floor(current));
      }, 16);
    }

    // -------------------------------------
    const ctxFinance = document
      .getElementById("financeChart")
      .getContext("2d");

    let financeChart;

    function loadFinanceChart(income, expense) {
      if (financeChart) financeChart.destroy();

      financeChart = new Chart(ctxFinance, {
        type: "bar",
        data: {
          labels: ["Pendapatan", "Pengeluaran"],
          datasets: [{
            data: [income, expense],
            backgroundColor: ["#7DC668", "#ff7076"],
          }, ],
        },
        options: {
          indexAxis: "y", // horizontal
          animation: {
            duration: 1200,
            easing: "easeOutQuart",
          },
          plugins: {
            legend: {
              display: false
            },
          },
          scales: {
            x: {
              beginAtZero: true,
            },
          },
        },
      });
    }

    // ------------------------------------
    function loadFinance(month) {
      const data = financeData[month];
      if (!data) return;

      const income = data.income;
      const salary = data.salary;
      const office = data.office;

      const totalExpense = salary + office;
      const balance = income - totalExpense;

      // ANIMASI KPI
      animateValue("totalIncome", 0, income, 800);
      animateValue("totalBalance", 0, balance, 800);

      // NOTE
      document.getElementById("salaryCost").innerText = formatRupiah(salary);
      document.getElementById("officeCost").innerText = formatRupiah(office);

      // CHART
      loadFinanceChart(income, totalExpense);
    }

    // ----------------------------
    document
      .getElementById("loadFinance")
      .addEventListener("click", function() {
        const month = document.getElementById("monthPicker").value;

        if (!month) {
          alert("Pilih bulan dulu");
          return;
        }

        loadFinance(month);
      });
  </script>
</body>

</html>
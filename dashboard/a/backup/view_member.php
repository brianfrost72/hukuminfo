<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Detail Member - Dashboard | Konig Guard Bureau</title>

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

    <!-- 
    FONT AWESOME 
-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <!-- Flatpickr -->
    <link
        type="text/css"
        href="../assets/css/vendor-flatpickr.css"
        rel="stylesheet" />
    <link
        type="text/css"
        href="../assets/css/vendor-flatpickr-airbnb.css"
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
                                        Detail Member
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Detail Member</h1>

                        </div>
                        <a href="our_members.php"
                            class="btn btn-primary ml-1">Kembali List Member</a>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <!-- =========================
        MEMBER CARD
========================== -->
                <div class="member-card">

                    <!-- TOP HEADER -->
                    <div class="member-card-header">

                        <div class="member-title">
                            <span class="member-subtitle">KARTU</span>
                            <h2>MEMBER</h2>
                        </div>

                        <div class="member-badge">
                            <i class="fa-solid fa-crown"></i>
                        </div>

                        <div class="member-wave"></div>

                    </div>

                    <!-- BODY -->
                    <div class="member-card-body">

                        <!-- ITEM -->
                        <div class="member-info-item">
                            <div class="member-icon">
                                <span class="material-icons">contacts</span>
                            </div>

                            <div class="member-label">
                                Nama Klien
                            </div>

                            <div class="member-separator">
                                :
                            </div>

                            <div class="member-value">
                                John Doe
                            </div>
                        </div>

                        <!-- ITEM -->
                        <div class="member-info-item">
                            <div class="member-icon">
                                <span class="material-icons">card_membership</span>
                            </div>

                            <div class="member-label">
                                Nomor ID Klien
                            </div>

                            <div class="member-separator">
                                :
                            </div>

                            <div class="member-value">
                                KLN-2024-0001
                            </div>
                        </div>

                        <!-- ITEM -->
                        <div class="member-info-item">
                            <div class="member-icon">
                                <span class="material-icons">card_membership</span>
                            </div>

                            <div class="member-label">
                                Nomor ID Member
                            </div>

                            <div class="member-separator">
                                :
                            </div>

                            <div class="member-value">
                                MBR-2024-000123
                            </div>
                        </div>

                        <!-- ITEM -->
                        <div class="member-info-item">
                            <div class="member-icon">
                                <span class="material-icons">date_range</span>
                            </div>

                            <div class="member-label">
                                Start Member
                            </div>

                            <div class="member-separator">
                                :
                            </div>

                            <div class="member-value">
                                01 Mei 2024
                            </div>
                        </div>

                        <!-- ITEM -->
                        <div class="member-info-item">
                            <div class="member-icon">
                                <span class="material-icons">event_available</span>
                            </div>

                            <div class="member-label">
                                End Member
                            </div>

                            <div class="member-separator">
                                :
                            </div>

                            <div class="member-value">
                                30 April 2025
                            </div>
                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="member-card-footer">

                        <div class="company-logo">

                            <!-- LOGO IMAGE -->
                            <div class="logo-image">
                                <img src="../assets/images/logos/logo-full.png" alt="Logo Perusahaan">
                            </div>

                            <!-- TEXT -->
                            <div class="logo-text">
                                <h4>KONIG GUARD BUREAU</h4>
                                <span>GUARDING WITH HONOR. <br>
                                    PROTECTING WITH POWER
                                </span>
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



</body>

</html>
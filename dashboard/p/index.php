<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Dashboard - Konig Guard Bureau</title>

        <!-- Perfect Scrollbar -->
        <link type="text/css"
              href="../assets/vendor/perfect-scrollbar.css"
              rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css"
              href="../assets/css/app.css"
              rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css"
              href="../assets/css/vendor-material-icons.css"
              rel="stylesheet">

        <!-- Font Awesome FREE Icons -->
        <link type="text/css"
              href="assets/css/vendor-fontawesome-free.css"
              rel="stylesheet">

    </head>

    <body>

        <div class="preloader"></div>

        <!-- Header Layout -->
        <div class="mdk-header-layout js-mdk-header-layout">

            <!-- Header -->

            <div id="header"
                 class="mdk-header js-mdk-header m-0"
                 data-fixed
                 data-effects="waterfall">
                <?php include 'includes/topheader.php'; ?>
            </div>

            <!-- // END Header -->

            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content page">
                <div class="page__header mb-0">
                    <?php include 'includes/navbar.php'; ?>
                </div>

                <div class="container page__heading-container">
                    <div class="page__heading d-flex align-items-center">
                        <div class="flex">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                                    <li class="breadcrumb-item">Blank</li>
                                    <li class="breadcrumb-item active"
                                        aria-current="page">Page</li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Blank Page</h1>
                        </div>

                        <a href=""
                           class="btn btn-success ml-1">Action</a>
                    </div>
                </div>

                <div class="container page__container">
                    // Content
                </div>

            </div>
            <!-- // END Header Layout Content -->

        </div>
        <!-- // END Header Layout -->

        <!-- App Settings FAB -->
        <div id="app-settings">
            <app-settings layout-active="fixed"></app-settings>
        </div>
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

    </body>

</html>
<div class="container ">
    <div class="row">
        <div class="col-sm-12 col-md-5">
            <div class="topbar-left">
                <div class="topbar-text">
                    <?php
                    $hari = [
                        'Sunday' => 'Minggu',
                        'Monday' => 'Senin',
                        'Tuesday' => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu'
                    ];

                    $bulan = [
                        'January' => 'Januari',
                        'February' => 'Februari',
                        'March' => 'Maret',
                        'April' => 'April',
                        'May' => 'Mei',
                        'June' => 'Juni',
                        'July' => 'Juli',
                        'August' => 'Agustus',
                        'September' => 'September',
                        'October' => 'Oktober',
                        'November' => 'November',
                        'December' => 'Desember'
                    ];

                    echo $hari[date('l')] . ', ' . date('d') . ' ' . $bulan[date('F')] . ' ' . date('Y');
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-7">
            <div class="list-unstyled topbar-right">
                <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                ?>

                <ul class="topbar-link">

                    <?php if (!empty($_SESSION['logged_in'])): ?>

                        <li class="user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Hai, <?= htmlspecialchars($_SESSION['email']); ?>
                                <span class="caret"></span>
                            </a>

                            <ul class="user-dropdown">

                                <li>
                                    <a href="dashboard/">
                                        Dashboard
                                    </a>
                                </li>

                                <li>
                                    <a href="logout.php">
                                        Logout
                                    </a>
                                </li>

                            </ul>
                        </li>

                    <?php else: ?>

                        <li>
                            <a href="login.php">
                                Login / Register
                            </a>
                        </li>

                    <?php endif; ?>

                </ul>
                <ul class="topbar-sosmed">
                    <li>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
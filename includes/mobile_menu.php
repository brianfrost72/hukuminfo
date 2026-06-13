<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../koneksi.php';

$userName  = '';
$userEmail = '';
$userPhoto = '';
function getUserPhoto($folder, $filename)
{
    if (empty($filename)) {
        return '';
    }

    $fullPath = __DIR__ . '/../dashboard/assets/images/uploads/' . $folder . '/' . $filename;

    if (file_exists($fullPath)) {
        return 'dashboard/assets/images/uploads/' . $folder . '/' . $filename;
    }

    return '';
}
$userType  = '';
$gender    = 'male';

if (!empty($_SESSION['logged_in']) && !empty($_SESSION['user_id'])) {

    $user_id = (int) $_SESSION['user_id'];

    $qUser = mysqli_query($conn, "
        SELECT
            id,
            email,
            user_type
        FROM users
        WHERE id = '$user_id'
        LIMIT 1
    ");

    if ($qUser && mysqli_num_rows($qUser) > 0) {

        $user = mysqli_fetch_assoc($qUser);

        $userEmail = $user['email'];
        $userType = $user['user_type'];

        // ==========================
        // INTERNAL USER
        // ==========================
        if ($user['user_type'] === 'internal') {

            $qProfile = mysqli_query($conn, "
                SELECT full_name, gender, photo_profile
FROM user_profile
WHERE user_id = '$user_id'
LIMIT 1
            ");

            if ($qProfile && mysqli_num_rows($qProfile) > 0) {

                $profile = mysqli_fetch_assoc($qProfile);

                $userName = $profile['full_name'];
                $gender   = $profile['gender'] ?? 'male';

                if (!empty($profile['photo_profile'])) {

                    $photoFile = __DIR__ . '/../dashboard/assets/images/uploads/user_photos/' . $profile['photo_profile'];

                    if (file_exists($photoFile)) {
                        $userPhoto = 'dashboard/assets/images/uploads/user_photos/' . $profile['photo_profile'];
                    }
                }
            }
        }

        // ==========================
        // PUBLIC USER
        // ==========================
        else {

            $qProfile = mysqli_query($conn, "
                SELECT full_name, gender, photo_profile
FROM public_profile
WHERE user_id = '$user_id'
LIMIT 1
            ");

            if ($qProfile && mysqli_num_rows($qProfile) > 0) {

                $profile = mysqli_fetch_assoc($qProfile);

                $userName = $profile['full_name'];
                $gender   = $profile['gender'] ?? 'male';

                if (!empty($profile['photo_profile'])) {

                    $photoFile = __DIR__ . '/../dashboard/assets/images/uploads/public_photos/' . $profile['photo_profile'];

                    if (file_exists($photoFile)) {
                        $userPhoto = 'dashboard/assets/images/uploads/public_photos/' . $profile['photo_profile'];
                    }
                }
            }
        }

        // fallback
        if (empty($userName)) {
            $userName = $userEmail;
        }
    }
}

if (empty($userPhoto)) {

    if (
        strtolower($gender) == 'female' ||
        strtolower($gender) == 'perempuan'
    ) {

        $userPhoto =
            'dashboard/assets/images/avatar/avatar-women.png';
    } else {

        $userPhoto =
            'dashboard/assets/images/avatar/avatar-men.png';
    }
}

$dashboardUrl = 'dashboard/';

if ($userType === 'internal') {
    $dashboardUrl = 'dashboard/a/';
} elseif ($userType === 'public') {
    $dashboardUrl = 'dashboard/p/';
}

// SOCIAL MEDIA QUERY
$socialMedia = [];

$qSocmed = mysqli_query($conn, "
    SELECT
        sm.link_platform,
        lsm.name_platform
    FROM social_media sm
    INNER JOIN list_socmed lsm
        ON lsm.id = sm.platform_id
    ORDER BY lsm.name_platform ASC
");

if ($qSocmed) {
    while ($row = mysqli_fetch_assoc($qSocmed)) {
        $socialMedia[] = $row;
    }
}

// HELPER ICON
function getSocmedIcon($platform)
{
    $platform = strtolower(trim($platform));

    switch ($platform) {
        case 'facebook':
            return 'fab fa-facebook-f';

        case 'instagram':
            return 'fab fa-instagram';

        case 'twitter':
        case 'x':
            return 'fab fa-x-twitter';

        case 'youtube':
            return 'fab fa-youtube';

        case 'tiktok':
            return 'fab fa-tiktok';

        case 'linkedin':
            return 'fab fa-linkedin-in';

        case 'telegram':
            return 'fab fa-telegram';

        case 'whatsapp':
            return 'fab fa-whatsapp';

        case 'threads':
            return 'fab fa-threads';

        default:
            return 'fas fa-globe';
    }
}
?>

<div id="modal_aside_right" class="modal fixed-left fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-aside" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- SEARCHBAR -->
                <div class="widget__form-search-bar position-relative">

                    <div class="row no-gutters">
                        <div class="col">

                            <input
                                type="text"
                                id="mobileSearchInput"
                                class="form-control border-secondary border-right-0 rounded-0"
                                placeholder="Cari artikel hukum...">

                        </div>

                        <div class="col-auto">
                            <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>

                    <div id="mobileSearchResult"></div>

                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <nav class="list-group list-group-flush">
                    <ul class="navbar-nav ">
                        <li class="nav-item"><a class="nav-link" href="/"> Beranda </a></li>
                        <li class="nav-item"><a class="nav-link" href="tentang-kami"> Tentang Kami </a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                                href="#"
                                id="topikDropdown"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                Topik Hukum
                            </a>

                            <div class="dropdown-menu">

                                <a class="dropdown-item" href="artikel-populer">
                                    <i class="fa fa-star mr-2"></i> Artikel Populer
                                </a>

                                <a class="dropdown-item" href="artikel-disukai">
                                    <i class="fa fa-heart mr-2"></i> Paling Disukai
                                </a>

                                <a class="dropdown-item" href="artikel-dibookmark">
                                    <i class="fa fa-bookmark mr-2"></i> Paling Diminati
                                </a>

                                <a class="dropdown-item" href="kategori">
                                    <i class="fa fa-folder-open mr-2"></i> Kategori
                                </a>

                                <a class="dropdown-item" href="tags">
                                    <i class="fa fa-tags mr-2"></i> Tags
                                </a>
                            </div>
                        </li>

                        <li class="nav-item"><a class="nav-link" href="pedoman-media-siber"> Pedoman Media Cyber </a></li>
                        <li class="nav-item"><a class="nav-link" href="privacy-policy"> Kebijakan Privasi </a></li>
                        <li class="nav-item"><a class="nav-link" href="desclaimer"> Disclaimer </a></li>
                        <li class="nav-item"><a class="nav-link" href="kontak-kami"> Kontak Kami </a></li>

                        <!-- tombol login & registrasi -->
                    </ul>

                    <?php if (!empty($_SESSION['logged_in'])): ?>

                        <div class="text-center my-4">

                            <img src="<?= $userPhoto; ?>"
                                alt="<?= htmlspecialchars($userName); ?>"
                                class="rounded-circle shadow"
                                style="width:80px;height:80px;object-fit:cover;">

                            <h6 class="mt-3 mb-1">
                                <?= htmlspecialchars($userName); ?>
                            </h6>

                            <small class="text-muted">
                                <?= htmlspecialchars($userEmail); ?>
                            </small>

                            <div class="mt-3">

                                <a href="<?= ($userType === 'internal') ? 'dashboard/a/' : 'dashboard/p/'; ?>"
                                    class="btn btn-primary btn-sm mr-1">

                                    <i class="fa fa-user-circle"></i>
                                    Dashboard
                                </a>

                                <a href="logout"
                                    class="btn btn-danger btn-sm">

                                    <i class="fa fa-sign-out-alt"></i>
                                    Logout
                                </a>

                            </div>

                        </div>

                    <?php else: ?>

                        <div class="mb-4">

                            <a href="login"
                                class="btn btn-primary btn-block mb-2">

                                <i class="fa fa-sign-in-alt mr-2"></i>
                                Login
                            </a>

                            <a href="register"
                                class="btn btn-outline-primary btn-block">

                                <i class="fa fa-user-plus mr-2"></i>
                                Registrasi
                            </a>

                        </div>

                    <?php endif; ?>

                    <?php if (!empty($socialMedia)): ?>

                        <hr class="my-3">

                        <div class="text-center">

                            <?php foreach ($socialMedia as $socmed): ?>

                                <a href="<?= htmlspecialchars($socmed['link_platform']); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mx-2 text-danger"
                                    title="<?= htmlspecialchars($socmed['name_platform']); ?>"
                                    style="font-size:22px;">

                                    <i class="<?= getSocmedIcon($socmed['name_platform']); ?>"></i>

                                </a>

                            <?php endforeach; ?>

                        </div>

                    <?php endif; ?>
                </nav>
            </div>
            <div class="modal-footer">
                <p>© 2026 Hukuminfo.id — Media Informasi &amp; Edukasi Hukum Indonesia</p>
            </div>
        </div>
    </div> <!-- modal-bialog .// -->
    <script>
        const mobileSearchInput =
            document.getElementById('mobileSearchInput');

        const mobileSearchResult =
            document.getElementById('mobileSearchResult');

        if (mobileSearchInput) {

            mobileSearchInput.addEventListener('keyup', function() {

                let q = this.value.trim();

                if (q.length < 2) {

                    mobileSearchResult.style.display = 'none';
                    mobileSearchResult.innerHTML = '';

                    return;
                }

                fetch(
                        'ajax/mobile-search.php?q=' +
                        encodeURIComponent(q)
                    )

                    .then(res => res.text())

                    .then(data => {

                        mobileSearchResult.innerHTML = data;

                        mobileSearchResult.style.display =
                            data.trim() ? 'block' : 'none';

                    });

            });

            document.addEventListener('click', function(e) {

                if (!e.target.closest('.widget__form-search-bar')) {

                    mobileSearchResult.style.display = 'none';

                }

            });

        }
    </script>
</div> <!-- modal.// -->
<!-- End Navbar sidebar menu  -->
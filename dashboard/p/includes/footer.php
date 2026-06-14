<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/../../koneksi.php";

// =========================
// SOCIAL MEDIA
// =========================

$socialMedia = [];

$qSocmed = mysqli_query($conn, "
    SELECT
        sm.account_name,
        sm.link_platform,
        ls.name_platform
    FROM social_media sm
    INNER JOIN list_socmed ls
        ON ls.id = sm.platform_id
    ORDER BY ls.name_platform ASC
");

if ($qSocmed && mysqli_num_rows($qSocmed) > 0) {
    while ($row = mysqli_fetch_assoc($qSocmed)) {
        $socialMedia[] = $row;
    }
}
?>

<div class="container-fluid">
    <div class="row align-items-center">

        <!-- LEFT -->
        <div class="col-md-6 text-md-left text-center mb-2 mb-md-0">
            <span class="footer-text">
                © 2026 Hukuminfo.id. All rights reserved.
            </span>
        </div>

        <!-- RIGHT -->
        <div class="col-md-6 text-md-right text-center">

            <span class="follow-text">Follow Our Social Media : </span>

            <?php foreach ($socialMedia as $socmed): ?>

                <?php
                $platform = strtolower(trim($socmed['name_platform']));

                $icon = 'fa-link';

                switch ($platform) {

                    case 'facebook':
                        $icon = 'fa-facebook-f';
                        break;

                    case 'instagram':
                        $icon = 'fa-instagram';
                        break;

                    case 'twitter':
                    case 'x':
                    case 'x twitter':
                        $icon = 'fa-x-twitter';
                        break;

                    case 'youtube':
                        $icon = 'fa-youtube';
                        break;

                    case 'tiktok':
                        $icon = 'fa-tiktok';
                        break;

                    case 'linkedin':
                        $icon = 'fa-linkedin';
                        break;

                    case 'telegram':
                        $icon = 'fa-telegram';
                        break;

                    case 'whatsapp':
                        $icon = 'fa-whatsapp';
                        break;
                }
                ?>

                <a href="<?= htmlspecialchars($socmed['link_platform']); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="footer-social"
                    title="<?= htmlspecialchars($socmed['account_name']); ?>">

                    <i class="fab <?= $icon; ?>"></i>

                </a>

            <?php endforeach; ?>

        </div>

    </div>
</div>
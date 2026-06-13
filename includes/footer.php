<?php
require_once __DIR__ . '/../koneksi.php';

$socialMedia = [];

$qSocmed = mysqli_query($conn, "
    SELECT
        sm.account_name,
        sm.link_platform,
        ls.name_platform
    FROM social_media sm
    INNER JOIN list_socmed ls
        ON ls.id = sm.platform_id
    ORDER BY sm.id ASC
");

if ($qSocmed && mysqli_num_rows($qSocmed) > 0) {

    while ($row = mysqli_fetch_assoc($qSocmed)) {
        $socialMedia[] = $row;
    }
}
?>
<footer>
    <div class="wrapper__footer py-5">
        <div class="container">

            <div class="text-center mb-4">
                <a href="/">
                    <img src="images/placeholder/logo.png"
                        alt="Hukuminfo"
                        class="img-fluid logo-footer mb-3">
                </a>

                <p class="col-lg-8 mx-auto mb-0" style="font-size: 16px; color: #8b8b8b;">
                    Hukuminfo.id adalah media informasi hukum Indonesia yang menyajikan
                    berita, regulasi, putusan pengadilan, analisis hukum, dan berbagai
                    perkembangan dunia hukum secara objektif, akurat, dan terpercaya.
                </p>
            </div>

            <hr>

            <div class="row text-center">

                <div class="col-md-12">
                    <ul class="list-inline mb-4">

                        <li class="list-inline-item px-2">
                            <a href="tentang-kami">Tentang Kami</a>
                        </li>

                        <li class="list-inline-item px-2">
                            <a href="redaksi">Redaksi</a>
                        </li>

                        <li class="list-inline-item px-2">
                            <a href="pedoman-media-siber">Pedoman Media Siber</a>
                        </li>

                        <li class="list-inline-item px-2">
                            <a href="privacy-policy">Kebijakan Privasi</a>
                        </li>

                        <li class="list-inline-item px-2">
                            <a href="terms-of-service">Syarat & Ketentuan</a>
                        </li>

                        <li class="list-inline-item px-2">
                            <a href="disclaimer">Disclaimer</a>
                        </li>

                        <li class="list-inline-item px-2">
                            <a href="kontak-kami">Kontak Kami</a>
                        </li>

                    </ul>
                </div>

            </div>

            <div class="text-center">

                <p class="mb-3">

                    <?php foreach ($socialMedia as $socmed): ?>

                        <?php

                        $platform = strtolower(trim($socmed['name_platform']));
                        $icon = 'fas fa-globe';

                        switch ($platform) {

                            case 'facebook':
                                $icon = 'fab fa-facebook-f';
                                break;

                            case 'twitter':
                                $icon = 'fab fa-twitter';
                                break;

                            case 'x':
                                $icon = 'fab fa-x-twitter';
                                break;

                            case 'instagram':
                                $icon = 'fab fa-instagram';
                                break;

                            case 'youtube':
                                $icon = 'fab fa-youtube';
                                break;

                            case 'linkedin':
                                $icon = 'fab fa-linkedin-in';
                                break;

                            case 'tiktok':
                                $icon = 'fab fa-tiktok';
                                break;

                            case 'telegram':
                                $icon = 'fab fa-telegram-plane';
                                break;

                            case 'whatsapp':
                                $icon = 'fab fa-whatsapp';
                                break;
                        }

                        ?>

                        <a
                            href="<?= htmlspecialchars($socmed['link_platform']); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="mx-2"
                            title="<?= htmlspecialchars($socmed['account_name']); ?>">

                            <i class="<?= $icon; ?> fa-lg"></i>

                        </a>

                    <?php endforeach; ?>

                </p>

                <small style="color: #acaaaa;">
                    © 2026 Hukuminfo.id — Media Informasi Hukum Indonesia
                </small>

            </div>

        </div>
    </div>
</footer>
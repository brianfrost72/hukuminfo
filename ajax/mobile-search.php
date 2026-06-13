<?php

require_once __DIR__ . '/../koneksi.php';

$q = trim($_GET['q'] ?? '');

if (strlen($q) < 2) {
    exit;
}

$q = mysqli_real_escape_string($conn, $q);

$query = mysqli_query($conn, "
    SELECT
        p.slug,
        p.post_title,
        p.post_image,
        pc.name_category,

        COALESCE(
            up.full_name,
            'Administrator'
        ) AS author_name

    FROM post p

    LEFT JOIN post_category pc
        ON pc.id = p.post_category_id

    LEFT JOIN users u
        ON u.id = p.user_id

    LEFT JOIN user_profile up
        ON up.user_id = u.id

    WHERE p.status='publish'
    AND (
        p.post_title LIKE '%$q%'
        OR p.post_sub_title LIKE '%$q%'
        OR p.post_desc LIKE '%$q%'
    )

    ORDER BY p.created_at DESC
    LIMIT 8
");

while ($row = mysqli_fetch_assoc($query)):
?>

    <a href="artikel-detail.php?slug=<?= urlencode($row['slug']); ?>"
        class="nav-search-item">

        <img src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($row['post_image']); ?>">

        <div>

            <div class="nav-search-title">
                <?= htmlspecialchars($row['post_title']); ?>
            </div>

            <div class="nav-search-meta">

                <span class="search-author">
                    <i class="fa fa-user"></i>
                    <?= htmlspecialchars($row['author_name']); ?>
                </span>

                <span class="search-dot">•</span>

                <span class="search-category">
                    <?= htmlspecialchars($row['name_category']); ?>
                </span>

            </div>

        </div>

    </a>

<?php endwhile; ?>
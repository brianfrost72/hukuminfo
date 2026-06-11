<?php

require_once __DIR__ . '/../koneksi.php';

$keyword =
    mysqli_real_escape_string(
        $conn,
        $_GET['keyword'] ?? ''
    );

if(strlen($keyword) < 2){
    exit;
}

$query = mysqli_query($conn,"
    SELECT
        id,
        post_title,
        slug,
        post_image
    FROM post
    WHERE status='publish'
    AND (
        post_title LIKE '%$keyword%'
        OR post_desc LIKE '%$keyword%'
    )
    LIMIT 8
");

while($row = mysqli_fetch_assoc($query)) :

?>

<a
    href="detail.php?slug=<?= $row['slug']; ?>"
    class="search-item">

    <img
        src="dashboard/assets/images/uploads/posts/<?= $row['post_image']; ?>">

    <div class="search-item-title">

        <?= htmlspecialchars($row['post_title']); ?>

    </div>

</a>

<?php endwhile; ?>
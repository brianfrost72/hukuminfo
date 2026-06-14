<?php

require_once __DIR__ . '/../../../koneksi.php';

$id = (int)$_GET['id'];

$query = mysqli_query(
    $conn,
    "
    SELECT
        pc.*,
        p.post_title,
        u.email,
        pp.full_name,
        pp.gender,
        pp.photo_profile
    FROM post_comments pc
    INNER JOIN post p
        ON p.id = pc.post_id
    INNER JOIN users u
        ON u.id = pc.user_id
    LEFT JOIN public_profile pp
        ON pp.user_id = u.id
    WHERE pc.id='$id'
    LIMIT 1
    "
);

$data = mysqli_fetch_assoc($query);

if (
    !empty($data['photo_profile']) &&
    file_exists(
        __DIR__ .
        "/../../../assets/images/uploads/public_photos/" .
        $data['photo_profile']
    )
) {

    $avatar =
        "../assets/images/uploads/public_photos/" .
        $data['photo_profile'];

} else {

    $avatar =
        strtolower(trim($data['gender'] ?? '')) === 'perempuan'
        ? "../assets/images/avatar/avatar-women.png"
        : "../assets/images/avatar/avatar-men.png";
}

?>

<style>

.post-box{
    background:#f8fafc;
    border:1px solid #e5e7eb;
    border-radius:12px;
    padding:15px;
    margin-bottom:20px;
}

.comment-box{
    background:#eff6ff;
    border-left:5px solid #2563eb;
    border-radius:12px;
    padding:15px;
    margin-bottom:20px;
}

.reply-box{
    background:#f0fdf4;
    border-left:5px solid #16a34a;
    border-radius:12px;
    padding:15px;
    margin-bottom:12px;
}

.avatar{
    width:55px;
    height:55px;
    border-radius:50%;
    object-fit:cover;
}

.section-title{
    font-size:13px;
    font-weight:700;
    color:#64748b;
    text-transform:uppercase;
    margin-bottom:10px;
}

</style>

<div class="section-title">
    Judul Postingan
</div>

<div class="post-box">
    <h5 class="mb-0">
        <?= htmlspecialchars($data['post_title']) ?>
    </h5>
</div>

<div class="section-title">
    Komentar Utama
</div>

<div class="comment-box">

```
<div class="d-flex">

    <img
        src="<?= $avatar ?>"
        class="avatar">

    <div class="ml-3">

        <strong>
            <?= htmlspecialchars($data['full_name'] ?? '-') ?>
        </strong>

        <br>

        <small class="text-muted">
            <?= htmlspecialchars($data['email']) ?>
        </small>

        <hr>

        <?= nl2br(htmlspecialchars($data['comment'])) ?>

    </div>

</div>
```

</div>

<div class="section-title">
    Balasan Komentar
</div>

<?php

$replyQuery = mysqli_query(
    $conn,
    "
    SELECT
        r.*,
        u.email,
        pp.full_name,
        pp.gender,
        pp.photo_profile

    FROM post_comment_reply r

    INNER JOIN users u
        ON u.id = r.user_id

    LEFT JOIN public_profile pp
        ON pp.user_id = u.id

    WHERE r.comment_id='$id'

    ORDER BY r.created_at ASC
    "
);

?>

<?php if(mysqli_num_rows($replyQuery) > 0): ?>

```
<?php while($reply = mysqli_fetch_assoc($replyQuery)): ?>

    <?php

    if (
        !empty($reply['photo_profile']) &&
        file_exists(
            __DIR__ .
            "/../../../assets/images/uploads/public_photos/" .
            $reply['photo_profile']
        )
    ) {

        $replyAvatar =
            "../assets/images/uploads/public_photos/" .
            $reply['photo_profile'];

    } else {

        $replyAvatar =
            strtolower(trim($reply['gender'] ?? '')) === 'perempuan'
            ? "../assets/images/avatar/avatar-women.png"
            : "../assets/images/avatar/avatar-men.png";
    }

    ?>

    <div class="reply-box">

        <div class="d-flex">

            <img
                src="<?= $replyAvatar ?>"
                class="avatar">

            <div class="ml-3">

                <strong>
                    <?= htmlspecialchars($reply['full_name'] ?? '-') ?>
                </strong>

                <br>

                <small class="text-muted">
                    <?= htmlspecialchars($reply['email']) ?>
                </small>

                <hr>

                <?= nl2br(htmlspecialchars($reply['reply'])) ?>

            </div>

        </div>

    </div>

<?php endwhile; ?>
```

<?php else: ?>

```
<div class="alert alert-warning">
    Belum ada balasan komentar.
</div>
```

<?php endif; ?>

<?php

require_once __DIR__ . '/../../koneksi.php';

mysqli_query($conn,"
DELETE FROM public_profile
WHERE user_id IN (
    SELECT id
    FROM users
    WHERE
        pending_delete = 1
        AND delete_scheduled_at <= NOW()
)
");

mysqli_query($conn,"
DELETE FROM users
WHERE
    pending_delete = 1
    AND delete_scheduled_at <= NOW()
");
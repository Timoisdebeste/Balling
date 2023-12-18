<?php
include 'db/connect.php';
// Fetch videos along with like counts from the database
    $sql = "SELECT v.name, v.file_path, COALESCE(l.likes, 0) AS likes FROM videos v LEFT JOIN ( SELECT id, COUNT(*) AS likes FROM video_likes GROUP BY id ) l ON v.id = l.video_id";

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balling verify video</title>
</head>
    <?php include 'includes/navbar.php'; ?>
<body>
    <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            echo '<button class="navbutton" onclick="document.location=\'flag_video.php\'">flag</button> ';
            echo '<button class="navbutton" onclick="document.location=\'rate_video.php\'">rate</button> ';
        } else {
            // Redirect to login page or perform other actions after successful registration
            header("location: index.php");
        }
    include 'db/connect.php'; // Include your database connection code
    
        // Fetch videos from the database
    $sql = "SELECT id, name, file_path, likes, valid FROM videos"; // Select name along with file_path
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo '<div class="all-box">';
        while ($row = $result->fetch_assoc()) {
            $videoId = $row['id'];
            $videoPath = $row['file_path'];
            $videoName = $row['name'];
            $likes = $row['likes'];
            $valid = $row['valid'];
            
            if ($valid === 'valid') {
            } else if ($valid === 'flagged') {
            } else {
            // Display the video name and the video using HTML5 video tag
            echo '<div class="video-box"><div class="video-box-2"><h1 class="video-title">' . $videoName . '</h1><br>';
            echo '<video class="video" controls>';
            echo '<source src="' . $videoPath . '" type="video/mp4">';
            echo 'Your browser does not support the video tag.';
            echo '</video>';
            ?>
            <!-- Accept video-->
            <div class="report-options">
                <form method="post" class="padding" action=" php/accept_video.php">
                    <input type="hidden" name="video_id" value="<?php echo $videoId; ?>">
                    <button type="submit" class="report-button" name="valid" value="1">valid</button>
                </form>
                <!-- Remove incorrect video -->
                <form method="post" class="padding" action=" php/remove_video.php">
                    <input type="hidden" name="video_id" value="<?php echo $videoId; ?>">
                    <button type="submit" class="report-button" name="valid" value="1">remove</button>
                </form>
                <!-- Flag bad videos -->
                <form method="post" class="padding" action=" php/flagged_video.php">
                    <input type="hidden" name="video_id" value="<?php echo $videoId; ?>">
                    <button type="submit" class="report-button" name="valid" value="1">Flagged</button>
                </form>
            </div>
            <?php
            }
            echo '</div></div>';
        }
        echo '</div>';
    } else {
        echo "No videos found.";
    }

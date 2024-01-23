<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balling watch videos</title>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    <?php
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
                echo '<div class="video-box"><div class="video-box-2"><h1 class="video-title">' . $videoName . '</h1><br>';
                echo '<video class="video" controls>';
                echo '<source src="' . $videoPath . '" type="video/mp4">';
                echo 'Your browser does not support the video tag.';
                echo '</video>';
                echo '<span class="likes-count"> the reviewers have liked it this many times ' . $likes . ' </span>';
                echo '</div></div>';
            } else {
                // Video is not valid, so don't display it
                // You can add alternative messaging or skip displaying it entirely
                continue;
            }
        }
        echo '</div>';
    } else {
        echo "No videos found.";
    }

    $conn->close();
    ?>
</body>
</html>
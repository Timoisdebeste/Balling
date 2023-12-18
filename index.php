<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balling</title>
</head>
    <?php include 'includes/navbar.php'; ?>
<body>
    <h1>
        Hello World
    </h1>
    <p>
    </p>
    <?php
    include 'db/connect.php'; // Include your database connection code

    // Fetch top 3 videos with the highest views from the database
    $sql = "SELECT name, file_path FROM videos ORDER BY likes DESC LIMIT 3"; // Select name and file_path, ordered by views in descending order, limit to 3
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="video-box">';
        while ($row = $result->fetch_assoc()) {
            $videoPath = $row['file_path'];
            $videoName = $row['name'];
            // Display the video name and the video using HTML5 video tag
            echo '<div class="video-box-3"><div class="video-box-4"><h1 class="video-title">' . $videoName . '</h1><br>';
            echo '<video class="video-2" controls>';
            echo '<source src="' . $videoPath . '" type="video/mp4">';
            echo 'Your browser does not support the video tag.';
            echo '</video></div></div>';
        }
        echo '</div>';
    } else {
        echo "No videos found.";
    }

    $conn->close();
    ?>
</body>
</html>
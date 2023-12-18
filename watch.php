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
    $sql = "SELECT id, name, file_path, likes FROM videos"; // Select name along with file_path
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="all-box">';
        while ($row = $result->fetch_assoc()) {
            $videoId = $row['id'];
            $videoPath = $row['file_path'];
            $videoName = $row['name'];
            $likes = $row['likes'];
            
            // Display the video name and the video using HTML5 video tag
            echo '<div class="video-box"><div class="video-box-2"><h1 class="video-title">' . $videoName . '</h1><br>';
            echo '<video class="video" controls>';
            echo '<source src="' . $videoPath . '" type="video/mp4">';
            echo 'Your browser does not support the video tag.';
            echo '</video>';
            echo '<span class="likes-count"> ' . $likes . ' likes</span>';
            ?>
    
            <!-- Corrected form submission -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="video_id" value="<?php echo $videoId; ?>">
                <button type="submit" class="like-button" name="like" value="1">Like</button>
            </form>
    
            <?php
            echo '</div></div>';
        }
        echo '</div>';
    } else {
        echo "No videos found.";
    }
    
    // Handling the form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['like'])) {
        // Assuming $videoId is the unique identifier for each video in your database
        $videoIdUpload = $_POST['video_id'];
    
        // Perform your database update logic here
        // Update the likes count for the corresponding video ID in your database
        // Example assuming you have a 'videos' table and a column 'likes':
        $sql = "UPDATE videos SET likes = likes + 1 WHERE id = $videoIdUpload";
        
        // Execute your SQL query here
        if ($conn->query($sql) === TRUE) {
            // Redirect to the same page after updating likes
            header("Location: $_SERVER[PHP_SELF]");
            exit();
        } else {
            // Handle errors if the query fails
            echo "Error updating record: " . $conn->error;
        }
    }

    $conn->close();
    ?>
</body>
</html>
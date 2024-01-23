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
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        echo '<button class="navbutton" onclick="document.location=\'flag_video.php\'">flag</button> ';
        echo '<button class="navbutton" onclick="document.location=\'rate_video.php\'">rate</button> ';
    } else if (isset($_SESSION['role']) && $_SESSION['role'] === 'reviewer'){
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
    
    // Handling the form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['like'])) {
        // Assuming $videoId is the unique identifier for each video in your database
        $videoIdUpload = $_POST['video_id'];
        // Assuming $userId is the ID of the logged-in user
        $userId = $_SESSION['user_id']; // Adjust this based on your authentication

        // Check if the user has already liked this video
        $checkLikedQuery = "SELECT * FROM video_likes WHERE user_id = $userId AND video_id = $videoIdUpload";
        $checkLikedResult = $conn->query($checkLikedQuery);

        if ($checkLikedResult && $checkLikedResult->num_rows > 0) {
            // User has already liked this video
            echo "You've already liked this video!";
        } else {
            // Perform your database update logic here
            // Update the likes count for the corresponding video ID in your database
            // Example assuming you have a 'videos' table and a column 'likes':
            $sql = "UPDATE videos SET likes = likes + 1 WHERE id = $videoIdUpload";
            
            // Insert the like into the video_likes table to track the user's like
            $insertLikeQuery = "INSERT INTO video_likes (user_id, video_id) VALUES ($userId, $videoIdUpload)";
            
            // Execute your SQL queries here in a transaction to ensure consistency
            $conn->begin_transaction();
            $updateLikes = $conn->query($sql);
            $insertLike = $conn->query($insertLikeQuery);

            if ($updateLikes && $insertLike) {
                // Commit the transaction if both queries succeed
                $conn->commit();
                // Redirect to the same page after updating likes
                header("Location: $_SERVER[PHP_SELF]");
                exit();
            } else {
                // Rollback the transaction if any query fails
                $conn->rollback();
                // Handle errors if the queries fail
                echo "Error updating record: " . $conn->error;
            }
        }
    }

    $conn->close();
    ?>
</body>
</html>
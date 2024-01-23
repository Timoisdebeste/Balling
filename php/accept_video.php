<?php
include '../db/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['valid'])) {
    // Assuming $videoId is the unique identifier for each video in your database
    $videoIdUpload = $_POST['video_id'];
    
    // Sanitize the input to prevent SQL injection
    $videoIdUpload = mysqli_real_escape_string($conn, $videoIdUpload);
    
    // Perform database update logic here
    // Update the 'valid' field for the corresponding video ID in your database
    $sql = "UPDATE videos SET valid = 'valid' WHERE id = '$videoIdUpload'";
    
    // Execute your SQL query here
    if ($conn->query($sql) === TRUE) {
        // Redirect to the same page after updating likes
        header("Location: ../admin.php");
        exit();
    } else {
        // Handle errors if the query fails
        echo "Error updating record: " . $conn->error;
    }
}
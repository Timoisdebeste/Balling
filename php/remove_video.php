<?php
include '../db/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['valid'])) {
    // Assuming $videoId is the unique identifier for each video in your database
    $videoIdUpload = $_POST['video_id'];
    
    // Sanitize the input to prevent SQL injection
    $videoIdUpload = mysqli_real_escape_string($conn, $videoIdUpload);
    
    // Prepare SQL statement to delete all data based on ID
    $sql = "DELETE FROM videos WHERE id = $videoIdUpload";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to the same page after deleting the records
        header("Location: ../admin.php");
        exit();
    } else {
        // Handle errors if the query fails
        echo "Error deleting records: " . $conn->error;
    }
}
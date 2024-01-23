<?php
include 'db/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $videoName = $_FILES['video']['name'];
    $videoTmp = $_FILES['video']['tmp_name'];
    $videoSize = $_FILES['video']['size'];
    $name = $_POST['name']; // Fetching the video name from the form

    // Directory where videos will be stored
    $uploadDirectory = "videos/";

    // Generate a unique name for the video file
    $videoPath = $uploadDirectory . uniqid() . '_' . $videoName;

    // Move the uploaded video to the designated directory
    if (move_uploaded_file($videoTmp, $videoPath)) {
        // Insert video name and path into the database
        $sql = "INSERT INTO videos (name, file_path) VALUES ('$name', '$videoPath')";
        if ($conn->query($sql) === TRUE) {
            echo "Video uploaded successfully.";
            header("location: video-upload.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading video.";
    }
    $conn->close();
}
?>
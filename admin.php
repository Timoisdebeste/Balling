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
    ?>

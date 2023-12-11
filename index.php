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
    <p>Hello World</p>
    <?php
    if (isset($_SESSION['username'])) {
        // Session variable 'my_variable' exists
        echo "Hello, " . $_SESSION['username'];
    } else {
        // Session variable 'my_variable' does not exist
        echo "Hello welcome to my website i see you are new ore not logged in.";
    }
    ?>
</body>
</html>
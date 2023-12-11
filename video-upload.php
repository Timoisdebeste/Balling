<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balling upload videos</title>
</head>
    <?php include 'includes/navbar.php'; ?>
<body>
    <h2>Upload Video</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label>Video name:</label><br>
        <input type="text" name="name" required><br>
        <input type="file" name="video" accept="video/*" required>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
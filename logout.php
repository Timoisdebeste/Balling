<?php
// Start session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to a different page or perform other actions after clearing sessions
header("Location: index.php"); // Replace 'index.php' with the desired page
exit();
?>
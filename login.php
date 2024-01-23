<?php include 'includes/navbar.php'; ?>
<?php include 'db/connect.php'; ?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT id, username, role, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // User authenticated successfully
                echo "Welcome, " . $row["username"];
                // Set username in session
                $_SESSION['username'] = $row["username"];
                $_SESSION['user_id'] = $row["id"];
                $_SESSION['role'] = $row["role"];
                $_SESSION['logged_in'] = true;
                header("Location: index.php");
                exit();
            } else {
                echo "Invalid email or password";
            }
        } else {
            echo "Invalid email or password";
        }
        $stmt->close();
        $conn->close();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balling login</title>
</head>
<body>
    <h2>
        Login
    </h2>
    <!-- login text boxes -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Email:</label><br>
        <input type="text" name="email" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <button onclick="document.location='register.php'">register</button>
</body>
</html>
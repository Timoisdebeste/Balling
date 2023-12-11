<div class="navbar">
    <nav>
        <a class="logo" href="index.php">
            <img src="imgs/balling.jpg" alt="logo">
        </a>
        <button class="navbutton" onclick="document.location='index.php'">Home</button>
        <?php
        // Start session
        session_start();

        // Check if the 'logged-in' session variable is set and not empty
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            echo '<button class="navbutton" onclick="document.location=\'video-upload.php\'">Upload</button> ';
            echo '<button class="navbutton" onclick="document.location=\'watch.php\'">Videos</button> ';
            echo '<button class="navbutton" onclick="document.location=\'logout.php\'">Logout</button> ';
        } else {
            echo '<button class="navbutton" onclick="document.location=\'watch.php\'">Videos</button> ';
            echo '<button class="navbutton" onclick="document.location=\'login.php\'">Login</button>';
        }
        ?>
    </nav>
</div>
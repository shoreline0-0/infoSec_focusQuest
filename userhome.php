<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self' data:; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
    header("X-Content-Type-Options: nosniff");
    
    session_start();

    if (!isset($_SESSION['userID'])) {
        header("Location: logout.php");
        exit();
    }
    
    $timeout_duration = 300; 

    if (isset($_SESSION['LAST_ACTIVITY'])) {
        $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];
        if ($elapsed_time > $timeout_duration) {
            session_unset();
            session_destroy();
            header("Location: logout.php");
            exit();
        }
    }
    $_SESSION['LAST_ACTIVITY'] = time();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="refresh" content="300;url=index.php">
        <ul>
            <li><a href="logout.php">Log out</a></li>
        </ul>
        <link rel="stylesheet" href="style.css">
        <title>Home</title>
    </head>
    <body>
        <div class="index">
            <h2>Focus Quest is currently on maintenance. Please try again later!</h2>
        </div>  
    </body>
</html>
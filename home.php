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
    <meta http-equiv="refresh" content="300;url=index.php">
    <head>
        <ul>
            <li><a href="index.php">Log out</a></li>
        </ul>
        <link rel="stylesheet" href="style.css">
        <title>Home</title>
    </head>
    <body>
        <div class="index">
            <h2>Home</h2>
            <div class="container">
                <div class="box2">
                    <img src="assets/icon_users.png" class="icons">
                    <button type="button">
                        <a href="viewUsers.php">
                            Users
                        </a>
                    </button> 
                </div>
                <div class="box2">
                    <img src="assets/icon_gamelogs.png" class="icons">
                    <button type="button">
                        <a href="viewGamelogs.php">
                            Gamelogs
                        </a>
                    </button>
                </div>
                <div class="box2">
                    <img src="assets/icon_difficulty.png" class="icons">
                    <button type="button">
                        <a href="viewDifficulty.php">
                            Difficulty
                        </a>
                    </button>
                </div>
                <div class="box2">
                    <img src="assets/icon_access.png" class="icons">
                    <button type="button">
                        <a href="viewAccessLogs.php">
                            Access Logs
                        </a>
                    </button>
                </div>
                <div class="box2">
                    <img src="assets/icon_roles.png" class="icons">
                    <button type="button">
                        <a href="viewRoles.php">
                            Roles
                        </a>
                    </button>
                </div>
            </div>
        </div>  
    </body>
</html>
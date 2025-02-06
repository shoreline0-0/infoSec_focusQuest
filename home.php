<?php
    $timeout_duration = 300; 

    if (isset($_SESSION['LAST_ACTIVITY'])) {
        $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];
        if ($elapsed_time > $timeout_duration) {
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        }
    }
    $_SESSION['LAST_ACTIVITY'] = time();
?>


<!DOCTYPE html>
<html>
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
            </div>
        </div>  
    </body>
</html>
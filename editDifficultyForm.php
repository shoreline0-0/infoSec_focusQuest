<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self' data:; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
    header("X-Content-Type-Options: nosniff");
    
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

    include 'dbconn.php';

    $difficultyID = $_POST['difficultyID'];
    $penalty = $_POST['penalty'];
    $maxDistractions = $_POST['maxDistractions'];
    $goal = $_POST['goal'];

    $sql = "SELECT * FROM difficulty";
    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "No difficulty found.";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="refresh" content="300;url=index.php">
        <link rel="stylesheet" href="style.css">
        <title>Edit Difficulty</title>
    </head>
    <body>
        <div class="login">
            <h1>Edit Difficulty</h1>
            <div class = box1>
                <?php
                        echo 
                            "<form method='post' action='updateDifficulty.php'>
                                <label for='difficultyID'> Difficulty:</label><br>
                                <input type = 'text', name = 'difficultyID' value = '". $_POST['difficultyID']. "' readonly/><br><br>

                                <label for='penalty'>Penalty:</label><br>
                                <input type = 'text', name = 'penalty', value='". $_POST["penalty"] ."' /><br><br>

                                <label for='maxDistractions'>Distractions:</label><br>
                                <input type = 'text', name = 'maxDistractions'  value='". $_POST["maxDistractions"] ."' /><br><br>

                                <label for='goal'>Goal:</label><br>
                                <input type = 'text', name = 'goal'  value='". $_POST["goal"] ."' /><br><br>

                                <button type='submit' class='updateDifficulty'>Update</button>
                                <br>
                                <button onclick='history.back()'>Go Back</button>
                            </form>";
                    
                ?>
            </div>
        </div>
    </body>
</html>



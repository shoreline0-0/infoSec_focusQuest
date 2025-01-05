<?php
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
        <link rel="stylesheet" href="styles.css">
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
                            </form>";
                    
                ?>
            </div>
        </div>
    </body>
</html>

<!-- Agustin, Sherlene F.     INF227 -->


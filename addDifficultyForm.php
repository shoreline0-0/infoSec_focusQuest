<?php
    include 'dbconn.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Add Difficulty</title>
    </head>
    <body>
        <div class="addDifficulty">
            <h1>Add Difficulty</h1>
            <div class="box1">
                <?php
                        echo 
                            "<form method='post' action='createDifficulty.php'>

                                <input type = 'hidden', name = 'difficultyID'><br><br>

                                <label for='penalty'>Penalty:</label><br>
                                <input type = 'text', name = 'penalty' /><br><br>

                                <label for='maxDistractions'>Distractions:</label><br>
                                <input type = 'text', name = 'maxDistractions' /><br><br>

                                <label for='goal'>Goal:</label><br>
                                <input type = 'text', name = 'goal' /><br><br>
                    
                                <button class='createDifficulty' type='submit'> Add Difficulty </a></button>
                                <br>
                                <button onclick='history.back()'>Go Back</button>
                            </form>";
                ?>
            </div>  
        </div>
    </body>
</html>
<?php
    include 'dbconn.php';
    $sql = "SELECT * FROM difficulty";
    $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <ul>
            <li><a href="index.php">Log out</a></li>
            <li><a href="home.php">Home</a></li>
        </ul>
        <link rel="stylesheet" href="style.css">
        <title>Manage - Difficulty</title>
    </head>
    <body>
        <div class="difficulty">
            <h2>Manage Difficulty</h2>
            <table class="tableStyle">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>
                            <form method='post' action='addDifficultyForm.php'>
                                <button type='submit'>
                                    Add Difficulty
                                </button> 
                            </form>
                        </th>
                    </tr>
                    <tr>
                        <th> Difficulty ID </th>
                        <th> Penalty </th>    
                        <th> Distractions </th>
                        <th> Goal </th>
                        <th> Actions </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                    echo "<td>" . $row["difficultyID"] . "</td>";
                                    echo "<td>" . $row["penalty"] . "</td>";
                                    echo "<td>" . $row["maxDistractions"] . "</td>";
                                    echo "<td>" . $row["goal"] . "</td>";
                                    echo "<td>
                                            <form method='post' action='editDifficultyForm.php'>
                                                <input type = 'hidden' name = 'difficultyID' value = '". $row['difficultyID']. "'/>
                                                <input type = 'hidden' name = 'penalty' value = '". $row['penalty']. "'/>      
                                                <input type = 'hidden' name = 'maxDistractions' value = '". $row['maxDistractions']. "'/>
                                                <input type = 'hidden' name = 'goal' value = '". $row['goal']. "'/>
                                                <button type='submit'>Update</button>
                                            </form>
                                            <br>
                                            <form method='post' action='deleteDifficulty.php'>
                                                <input type = 'hidden' name = 'difficultyID' value = '". $row['difficultyID']. "'/>
                                                <input type = 'hidden' name = 'penalty' value = '". $row['penalty']. "'/>      
                                                <input type = 'hidden' name = 'maxDistractions' value = '". $row['maxDistractions']. "'/>
                                                <input type = 'hidden' name = 'goal' value = '". $row['goal']. "'/>
                                                <button type='submit'>Delete</button>
                                            </form>
                                        </td>";
                                echo "<tr>";

                            }
                        } else {
                            echo "<tr><td>No records.</td></tr>";
                        }
                        mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>  
    </body>
</html>
<?php
    include 'dbconn.php';
    $sql = "SELECT * FROM gamelog";
    $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <ul>
            <li><a href="index.php">Log out</a></li>
            <li><a href="home.php">Home</a></li>
        </ul>
        <link rel="stylesheet" href="styles.css">
        <title>Manage - Gamelogs</title>
    </head>
    <body>
        <div class="gamelogs">
            <h2>Manage Gamelogs</h2>
            <table class="tableStyle">
                <thead>
                    <tr>
                        <th> Log ID </th>
                        <th> User </th>    
                        <th> Difficulty  </th>
                        <th> Score </th>
                        <th> Timestamp </th>
                        <th> Status </th>
                        <th> Actions </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                    echo "<td>" . $row["logID"] . "</td>";
                                    echo "<td>" . $row["userID"] . "</td>";
                                    echo "<td>" . $row["difficultyID"] . "</td>";
                                    echo "<td>" . $row["score"] . "</td>";
                                    echo "<td>" . $row["timestamp"] . "</td>";
                                    echo "<td>" . $row["status"] . "</td>";
                                // echo "<td> 
                                //         <form method='post' action='editGamelogForm.php'>
                                //             <input type = 'hidden', name = 'logID' value = '". $row['logID']. "'/>
                                //             <input type = 'hidden', name = 'userID' value = '". $row['userID']. "'/>      
                                //             <input type = 'hidden', name = 'difficultyID' value = '". $row['difficultyID']. "'/>
                                //             <input type = 'hidden', name = 'score' value = '". $row['score']. "'/>
                                //             <input type = 'hidden', name = 'timestamp' value = '". $row['timestamp']. "'/>
                                //             <input type = 'hidden', name = 'status' value = '". $row['status']. "'/>

                                //             <button type='submit'>Update</button>
                                //         </form>
                                //       </td>";
                                echo "<tr>";
                            }
                        } else {
                            echo "No results found.";
                        }
                        mysqli_close($conn);
                    ?>
                </tbody>
                
            </table>
        </div>  
    </body>
</html>
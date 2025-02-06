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
    $sql = "SELECT * FROM gamelog";
    $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="refresh" content="300;url=index.php">
        <ul>
            <li><a href="logout.php">Log out</a></li>
            <li><a href="home.php">Home</a></li>
        </ul>
        <link rel="stylesheet" href="style.css">
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
                                echo "<td> 
                                        <form method='post' action='deleteGamelog.php'>
                                            <input type = 'hidden', name = 'logID' value = '". $row['logID']. "'/>
                                            <input type = 'hidden', name = 'userID' value = '". $row['userID']. "'/>      
                                            <input type = 'hidden', name = 'difficultyID' value = '". $row['difficultyID']. "'/>
                                            <input type = 'hidden', name = 'score' value = '". $row['score']. "'/>
                                            <input type = 'hidden', name = 'timestamp' value = '". $row['timestamp']. "'/>
                                            <input type = 'hidden', name = 'status' value = '". $row['status']. "'/>
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

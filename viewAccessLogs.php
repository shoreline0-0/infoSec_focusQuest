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

    include 'dbconn.php';
    
    $sql = "SELECT * FROM access_logs";
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
        <title>View - Access Logs</title>
    </head>
    <body>
        <div class="accessLogs">
            <h2>View Access Logs</h2>
            <table class="tableStyle">
                <thead>
                    <tr>
                        <th> Access ID </th>
                        <th> User </th>    
                        <th> Role  </th>
                        <th> Log Time </th>
                        <th> Status </th>
                        <th> Access Type </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                    echo "<td>" . $row["accessID"] . "</td>";
                                    echo "<td>" . $row["userID"] . "</td>";
                                    echo "<td>" . $row["roleID"] . "</td>";
                                    echo "<td>" . $row["logTime"] . "</td>";
                                    echo "<td>" . $row["status"] . "</td>";
                                    echo "<td>" . $row["accessType"] . "</td>";
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

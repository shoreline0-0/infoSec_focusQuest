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
    
    $sql = "SELECT * FROM roles";
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
        <title>View - Roles</title>
    </head>
    <body>
        <div class="accessLogs">
            <h2>View Roles</h2>
            <table class="tableStyle">
                <thead>
                    <tr>
                        <th> Role ID </th>
                        <th> Role Name </th>    
                        <th> Admin Access  </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                    echo "<td>" . $row["roleID"] . "</td>";
                                    echo "<td>" . $row["roleName"] . "</td>";
                                    echo "<td>" . $row["adminAccess"] . "</td>";
                                echo "<tr>";
                            }
                        } else {
                            echo "<tr><td>No roles.</td></tr>";
                        }
                        mysqli_close($conn);
                    ?>
                </tbody>
                
            </table>
        </div>  
    </body>
</html>

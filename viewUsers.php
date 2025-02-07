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
            header("Location: index.php");
            exit();
        }
    }
    $_SESSION['LAST_ACTIVITY'] = time();

    include 'dbconn.php';
    
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="refresh" content="300;url=index.php">
        <title>Manage - Users</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="navigation">
            <ul>
                <li><a href="logout.php">Log out</a></li>
                <li><a href="home.php">Home</a></li>
            </ul>
        </div>
        <div class="users">
            <h2>Manage Users</h2>
            <table class="tableStyle">
                    <thead>
                        <tr>
                            <th> UserID </th>
                            <th> Name </th>    
                            <th> Email </th>
                            <th> Role </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    </tbody>
                        <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                            echo "<td>" . $row["userID"] . "</td>";
                                            echo "<td>" . $row["fName"] . " " . $row["lName"]. "</td>";
                                            echo "<td>" . $row["email"] . "</td>";
                                            echo "<td>" . $row["roleID"] . "</td>";
                                            echo "<td> 
                                                    <form method='post' action='editUserForm.php'>
                                                        <input type = 'hidden' name = 'userID' value = '". $row['userID']. "'/>
                                                        <input type = 'hidden' name = 'fName' value = '". $row['fName']. "'/>      
                                                        <input type = 'hidden' name = 'lName' value = '". $row['lName']. "'/>
                                                        <input type = 'hidden' name = 'email' value = '". $row['email']. "'/>
                                                        <input type = 'hidden' name = 'password' value = '". $row['password']. "'/>
                                                        <input type = 'hidden' name = 'roleID' value = '". $row['roleID']. "'/>
                                                          
                                                        <button type='submit'>Update</button>
                                                    </form>
                                                    <br>
                                                    <form method='post' action='deleteUser.php'>
                                                        <input type = 'hidden' name = 'userID' value = '". $row['userID']. "'/>
                                                        <input type = 'hidden' name = 'fName' value = '". $row['fName']. "'/>      
                                                        <input type = 'hidden' name = 'lName' value = '". $row['lName']. "'/>
                                                        <input type = 'hidden' name = 'email' value = '". $row['email']. "'/>
                                                        <input type = 'hidden' name = 'password' value = '". $row['password']. "'/>
                                                        <input type = 'hidden' name = 'roleID' value = '". $row['roleID']. "'/> 
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
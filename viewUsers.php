<?php
    include 'dbconn.php';
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Manage - Users</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="navigation">
            <ul>
                <li><a href="index.php">Log out</a></li>
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
                                            echo "<td> 
                                                    <form method='post' action='editUserForm.php'>
                                                        <input type = 'hidden' name = 'userID' value = '". $row['userID']. "'/>
                                                        <input type = 'hidden' name = 'fName' value = '". $row['fName']. "'/>      
                                                        <input type = 'hidden' name = 'lName' value = '". $row['lName']. "'/>
                                                        <input type = 'hidden' name = 'email' value = '". $row['email']. "'/>
                                                        <input type = 'hidden' name = 'password' value = '". $row['password']. "'/>  
                                                        <button type='submit'>Update</button>
                                                    </form>
                                                </td>";
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
<?php
    include 'dbconn.php';

    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "No user found.";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Edit User</title>
    </head>
    <body>
        <div class="login">
            <h1>Edit User</h1>
            <div class = box1>
                <?php
                        echo 
                            "<form method='post' action='updateUser.php'>
                                <label for='userID'>User ID:</label><br>
                                <input type = 'text', name = 'userID' value = '". $_POST['userID']. "' readonly/><br><br>

                                <label for='fName'>First Name:</label><br>
                                <input type = 'text', name = 'fName', value='". $_POST["fName"] ."' /><br><br>

                                <label for='lName'>Last Name:</label><br>
                                <input type = 'text', name = 'lName'  value='". $_POST["lName"] ."' /><br><br>

                                <label for='email'>Email:</label><br>
                                <input type = 'text', name = 'email'  value='". $_POST["email"] ."' /><br><br>

                                <label for='password'>Password:</label><br>
                                <input type = 'password', name = 'password'  value='". $_POST["password"] ."' /><br><br>

                                <button type='submit' class='updateUser'>Update</button>
                                <br>
                                <button onclick='history.back()'>Go Back</button>
                            </form>";
                    
                ?>
            </div>
        </div>
    </body>
</html>


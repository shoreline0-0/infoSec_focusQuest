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

    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $roleID = $_POST['roleID'];
    
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
        <meta http-equiv="refresh" content="300;url=index.php">
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

                                <label for='roleID'>Role:</label><br>
                                <input type = 'text', name = 'roleID'  value='". $_POST["roleID"] ."' /><br><br>


                                <button type='submit' class='updateUser'>Update</button>
                                <br>
                                <button onclick='history.back()'>Go Back</button>
                            </form>";
                    
                ?>
            </div>
        </div>
    </body>
</html>


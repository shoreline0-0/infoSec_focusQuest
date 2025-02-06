<?php
    include 'dbconn.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Sign Up</title>
    </head>
    <body>
        <div class="signup">
            <h1>Sign Up</h1>
            <div class="box1">
                <?php
                        echo 
                            "<form method='post' action='createUser.php'>

                                <input type = 'hidden' id='userID' name = 'userID' /><br><br>

                                <label for='fName'>First Name:</label><br>
                                <input type = 'text' id='fName' name = 'fName' /><br><br>

                                <label for='lName'>Last Name:</label><br>
                                <input type = 'text' id='flName' name = 'lName'  /><br><br>

                                <label for='email'>Email:</label><br>
                                <input type = 'text' id='email' name = 'email'  /><br><br>

                                <label for='password'>Password:</label><br>
                                <input type = 'password' id='password' name = 'password'  /><br><br>

                                <!-- <label for='confPass'>Confirm Password:</label><br>
                                <input type='password' id='confPass' id='fName' name='confPass' required><br> to be added later-->
                    
                                <br><br>
                    
                                <button class='createUser' type='submit'> Sign up </a></button>
                            </form>";
                ?>
            </div>  
        </div>
    </body>
</html>

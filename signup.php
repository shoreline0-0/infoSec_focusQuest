<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self' data:; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
    header("X-Content-Type-Options: nosniff");

    session_start();
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

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
                            "<form method='post' action='createUser.php'>
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <input type = 'hidden' id='userID' name = 'userID' /><br><br>

                                <label for='fName'>First Name:</label><br>
                                <input type = 'text' id='fName' name = 'fName' /><br><br>

                                <label for='lName'>Last Name:</label><br>
                                <input type = 'text' id='flName' name = 'lName'  /><br><br>

                                <label for='email'>Email:</label><br>
                                <input type = 'text' id='email' name = 'email'  /><br><br>

                                <label for='password'>Password:</label><br>
                                <input type = 'password' id='password' name = 'password'  /><br><br>

                    
                                <br><br>
                    
                                <button class='createUser' type='submit'> Sign up </a></button>
                            </form>";
            </div>  
        </div>
    </body>
</html>

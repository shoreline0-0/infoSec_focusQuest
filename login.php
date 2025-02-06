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
        <link rel="stylesheet" href="style.css">
        <title>Log In</title>
    </head> 
    <body>
        <div class="login">
            <h1>Log-in</h1>
            <div class="box1">
                        <form method="post" action="verifyLogin.php">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        
                            <label for="email">Email:</label><br>
                            <input type="text" id="email" name="email"><br><br>
                        
                            <label for="password">Password:</label><br>
                            <input type="password" id="password" name="password"><br><br>
                        
                            <br><br>
                        
                            <button class="verifyLogin" type="submit"> Login </button>
                        
                            <br><br>
                        
                            <p>No account yet? <br>
                            <a href="signup.php">Sign up here!</a></p>
                        </form>                    
            </div>
        </div>
    </body>
</html>

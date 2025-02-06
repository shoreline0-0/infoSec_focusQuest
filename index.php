<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self' data:; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
    header("X-Content-Type-Options: nosniff");
    include 'dbconn.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Index</title>
    </head>
    <body>
        <div class="index">
            <h2>Welcome to Focus Quest</h2>
            <div class="box2">
                <button type="button"> <a href="login.php">Log-in</a></button>
                <br> <br>  
                <button type="button"> <a href="signup.php">Sign Up</a></button>
            </div>
        </div>
    </body>
</html>
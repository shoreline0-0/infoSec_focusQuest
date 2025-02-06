<?php
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
                    <?php
                        echo 
                            "<form method='post' action='verifyLogin.php'>

                                <label for='email'>Email:</label><br>
                                <input type = 'text' id='email' name = 'email'  /><br><br>

                                <label for='password'>Password:</label><br>
                                <input type = 'password' id='password' name = 'password'  /><br><br>

                                <br><br>
                    
                                <button class='verifyLogin' type='submit'> Login </a></button>

                                <br><br>
                                
                                <p1>No account yet? <br>
                                <a href='signup.php' style='text-decoration: underline; color: black;'>Sign up here!</a></p1>
                            </form>";
                    ?>
            </div>
        </div>
    </body>
</html>


<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>Sign Up</title>
    </head>
    <body>
        <div class="signup">
            <h1>Sign Up</h1>
            <div class="box1">
                <form action="signup.php" method="post">
                    <label for="fName">First Name:</label><br>
                    <input type="text" id="fName" name="fName" required><br>
        
                    <label for="lName">Last Name:</label><br>
                    <input type="text" id="lName" name="lName" required><br>
        
                    <br>
        
                    <label for="email">Email:</label><br>
                    <input type="text" id="email" name="email" required><br>
        
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" required><br>
        
                    <label for="confPass">Confirm Password:</label><br>
                    <input type="password" id="confPass" name="confPass" required><br>
        
                    <br><br>
        
                    <button class="signLogBtn" type="submit"> <a href="login.php">Sign up</a></button>
                </form>
            </div>  
        </div>
    </body>
</html>

<!-- Agustin, Sherlene F.     INF227 -->
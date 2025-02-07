<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self' data:; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
    header("X-Content-Type-Options: nosniff");
    setcookie("cookie_name", "cookie_value", ['expires' => time() + 3600, 'path' => '/', 'domain' => '','secure' => false, 'httponly' => true,'samesite' => 'Lax'        ]);

    session_start();
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    
    include 'dbconn.php';

    $errors = $_SESSION['errors'] ?? "";
    $email = $_SESSION['email'] ?? "";

    unset(
        $_SESSION['errors'],
        $_SESSION['email']
    );
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
            <div>
                <?php if (isset($errors['general'])): ?>
                    <p class="error"> <?php echo $_SESSION['csrf_token']?? ''; ?></p>
                <?php endif; ?>
            </div>
            <div class="box1">
                        <form method="post" action="verifyLogin.php">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        
                            <br><br><label for='email'>Email:</label><br>
                            <input type = 'text' id='email' name = 'email' value = '<?php echo htmlspecialchars($email); ?>'/><br>
                            <?php if (isset($errors['email'])): ?>
                                <span class="error"> <?php echo $errors['email']; ?></span>
                            <?php endif; ?>
                    
                            <br><br><label for='password'>Password:</label>
                            <input type = 'password' id='password' name = 'password' />
                            <?php if (isset($errors['password'])): ?>
                                <span class="error"> <?php echo $errors['password']; ?></span>
                            <?php endif; ?>
                        
                            <br><br>
                        
                            <button class="verifyLogin" type="submit"> Login </button>
                        
                            <br><br>

                            <button type="button">
                                <a href="index.php">
                                    Back
                                </a>
                            </button>
                            <p>No account yet? <br>
                            <a href="signup.php">Sign up here!</a></p>
                        </form>                    
            </div>
        </div>
    </body>
</html>

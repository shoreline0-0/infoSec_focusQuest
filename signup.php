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
    $fName = $_SESSION['fName'] ?? "";
    $lName = $_SESSION['lName'] ?? "";
    $email = $_SESSION['email'] ?? "";

    unset(
        $_SESSION['errors'],
        $_SESSION['fName'],
        $_SESSION['lName'],
        $_SESSION['email']
    );
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
            <div>
                <?php if (isset($errors['general'])): ?>
                    <p class="error"> <?php echo $_SESSION['csrf_token']?? ''; ?></p>
                <?php endif; ?>
            </div>
            <div class="box1">
                            <form method='post' action='createUser.php'>
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                
                                <input type = 'hidden' id='userID' name = 'userID' />

                                <label for='fName'>First Name:</label><br>
                                <input type = 'text' id='fName' name = 'fName' value = '<?php echo htmlspecialchars($fName); ?>'/><br>
                                <?php if (isset($errors['fName'])): ?>
                                    <span class="error"> <?php echo $errors['fName']; ?></span><br>
                                <?php endif; ?>
                                

                                <br><br><label for='lName'>Last Name:</label><br>
                                <input type = 'text' id='lName' name = 'lName' value = '<?php echo htmlspecialchars($lName); ?>'/>
                                <?php if (isset($errors['lName'])): ?>
                                    <span class="error"> <?php echo $errors['lName']; ?></span>
                                <?php endif; ?>

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
                    
                                <button class='createUser' type='submit'> Sign up </a></button>
                                <br>
                                <button type="button">
                                    <a href="index.php">
                                        Back
                                    </a>
                                </button>
                            </form>
            </div>  
        </div>
    </body>
</html>

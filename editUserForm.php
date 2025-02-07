<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self' data:; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
    header("X-Content-Type-Options: nosniff");
    
    session_start();

    if (!isset($_SESSION['userID'])) {
        header("Location: logout.php");
        exit();
    }
    
    $timeout_duration = 300; 

    if (isset($_SESSION['LAST_ACTIVITY'])) {
        $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];
        if ($elapsed_time > $timeout_duration) {
            session_unset();
            session_destroy();
            header("Location: logout.php");
            exit();
        }
    }
    $_SESSION['LAST_ACTIVITY'] = time();

    include 'dbconn.php';

    $errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['errors']);

    $userID = $_POST['userID'] ?? ($_SESSION['userID'] ?? '');
    $fName = $_POST['fName'] ?? ($_SESSION['fName'] ?? '');
    $lName = $_POST['lName'] ?? ($_SESSION['lName'] ?? ''); 
    $email = $_POST['email'] ?? ($_SESSION['email'] ?? ''); 
    $roleID = $_POST['roleID'] ?? ($_SESSION['roleID'] ?? ''); 


    if ($userID) {
        $sql = "SELECT * FROM users WHERE userID = '$userID'";
        $result = mysqli_query($conn,$sql);
        $user = mysqli_fetch_assoc($result);

        if (!$user) {
            echo "No user found.";
        }
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
            <div>
                <?php if (isset($errors['general'])): ?>
                    <p class="error"> <?php echo $_SESSION['csrf_token']?? ''; ?></p>
                <?php endif; ?>
            </div>
            <div class = box1>
                <form method="post" action="updateUser.php">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="userID" value="<?= htmlspecialchars($user['userID']) ?>" readonly/>

                    <label for="fName">First Name:</label><br>
                    <input type="text" name="fName" value="<?= htmlspecialchars($fName) ?>" /><br>
                    <?php if (isset($errors['fName'])): ?>
                        <span class="error"><?= $errors['fName'] ?></span><br>
                    <?php endif; ?>
                    <br>

                    <label for="lName">Last Name:</label><br>
                    <input type="text" name="lName" value="<?= htmlspecialchars($lName) ?>" /><br>
                    <?php if (isset($errors['lName'])): ?>
                        <span class="error"><?= $errors['lName'] ?></span><br>
                    <?php endif; ?>
                    <br>

                    <label for="email">Email:</label><br>
                    <input type="text" name="email" value="<?= htmlspecialchars($email) ?>" /><br>
                    <?php if (isset($errors['email'])): ?>
                        <span class="error"><?= $errors['email'] ?></span><br>
                    <?php endif; ?>
                    <br>

                    <label for="roleID">Role:</label><br>
                    <input type="text" name="roleID" value="<?= htmlspecialchars($roleID) ?>" /><br>
                    <?php if (isset($errors['roleID'])): ?>
                        <span class="error"><?= $errors['roleID'] ?></span><br>
                    <?php endif; ?>
                    <br>

                    <button type='submit' class='updateUser'>Update</button>
                    <br>
                    <button type='button'>
                        <a href='viewUsers.php'>
                            Back
                        </a>
                    </button>
                </form>
            </div>
        </div>
    </body>
</html>


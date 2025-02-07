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

    $errors = $_SESSION['errors'] ?? "";
    $penalty = $_SESSION['penalty'] ?? "";
    $maxDistractions = $_SESSION['maxDistractions'] ?? "";
    $goal = $_SESSION['goal'] ?? "";

    unset(
        $_SESSION['errors'],
        $_SESSION['penalty'],
        $_SESSION['maxDistractions'],
        $_SESSION['goal']
    );
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="refresh" content="300;url=index.php">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Add Difficulty</title>
    </head>
    <body>
        <div class="addDifficulty">
            <h1>Add Difficulty</h1>
            <div>
                <?php if (isset($errors['general'])): ?>
                    <p class="error"> <?php echo $_SESSION['csrf_token']?? ''; ?></p>
                <?php endif; ?>
            </div>
            <div class="box1">
            <form method='post' action='createDifficulty.php'>
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                
                                <input type = 'hidden' id='difficultyID' name = 'difficultyID' />

                                <label for='penalty'>Penalty:</label><br>
                                <input type = 'text' id='penalty' name = 'penalty' value = '<?php echo htmlspecialchars($penalty); ?>'/><br>
                                <?php if (isset($errors['penalty'])): ?>
                                    <span class="error"> <?php echo $errors['penalty']; ?></span><br>
                                <?php endif; ?>
                                
                                <br><label for='maxDistractions'>Max. Distractions:</label><br>
                                <input type = 'text' id='maxDistractions' name = 'maxDistractions' value = '<?php echo htmlspecialchars($maxDistractions); ?>'/><br>
                                <?php if (isset($errors['maxDistractions'])): ?>
                                    <span class="error"> <?php echo $errors['maxDistractions']; ?></span><br>
                                <?php endif; ?>

                                <br><label for='goal'>Goal:</label><br>
                                <input type = 'text' id='goal' name = 'goal' value = '<?php echo htmlspecialchars($goal); ?>'/><br>
                                <?php if (isset($errors['goal'])): ?>
                                    <span class="error"> <?php echo $errors['goal']; ?></span><br>
                                <?php endif; ?>

                                <br><br>
                    
                                <button class='createDifficulty' type='submit'> Add Difficulty </a></button>
                                <br>
                                <button type="button">
                                    <a href="viewDifficulty.php">
                                        Back
                                    </a>
                                </button>
                            </form>
            </div>  
        </div>
    </body>
</html>
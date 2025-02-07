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

    $difficultyID = $_POST['difficultyID'] ?? '';
    $penalty = $_POST['penalty'] ?? ($_SESSION['penalty'] ?? '');
    $maxDistractions = $_POST['maxDistractions'] ?? ($_SESSION['maxDistractions'] ?? ''); 
    $goal = $_POST['goal'] ?? ($_SESSION['goal'] ?? ''); 

    if ($difficultyID) {
        $sql = "SELECT * FROM difficulty WHERE difficultyID = '$difficultyID'";
        $result = mysqli_query($conn,$sql);
        $difficulty = mysqli_fetch_assoc($result);

        if (!$difficulty) {
            echo "No difficulty found.";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="refresh" content="300;url=index.php">
        <link rel="stylesheet" href="style.css">
        <title>Edit Difficulty</title>
    </head>
    <body>
        <div class="login">
            <h1>Edit Difficulty</h1>
            <div>
                <?php if (isset($errors['general'])): ?>
                    <p class="error"> <?php echo $_SESSION['csrf_token']?? ''; ?></p>
                <?php endif; ?>
            </div>
            <div class = box1>
                <form method="post" action="updateDifficulty.php">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="difficultyID" value="<?= htmlspecialchars($difficulty['difficultyID']) ?>" readonly/>

                    <label for="penalty">Penalty:</label><br>
                    <input type="text" name="penalty" value="<?= htmlspecialchars($penalty) ?>" /><br>
                    <?php if (isset($errors['penalty'])): ?>
                        <span class="error"><?= $errors['penalty'] ?></span><br>
                    <?php endif; ?>
                    <br>

                    <label for="maxDistractions">Distractions:</label><br>
                    <input type="text" name="maxDistractions" value="<?= htmlspecialchars($maxDistractions) ?>" /><br>
                    <?php if (isset($errors['maxDistractions'])): ?>
                        <span class="error"><?= $errors['maxDistractions'] ?></span><br>
                    <?php endif; ?>
                    <br>

                    <label for="goal">Goal:</label><br>
                    <input type="text" name="goal" value="<?= htmlspecialchars($goal) ?>" /><br>
                    <?php if (isset($errors['goal'])): ?>
                        <span class="error"><?= $errors['goal'] ?></span><br>
                    <?php endif; ?>
                    <br>

                    <button type='submit' class='updateDifficulty'>Update</button>
                    <br>
                    <button type='button'>
                        <a href='viewDifficulty.php'>
                            Back
                        </a>
                    </button>
                </form>
            </div>
        </div>
    </body>
</html>


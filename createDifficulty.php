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

    $errors = [];
    $penalty = $maxDistractions = $goal = "";

    var_dump($_POST);
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $penalty = intval($_POST['penalty']);
        $maxDistractions = intval($_POST['maxDistractions']);
        $goal = intval($_POST['goal']);

        if (empty($penalty)) {
            $errors['penalty'] = "Penalty amount required.";
        } elseif (!is_numeric($penalty) || $penalty < 1 || $penalty > 99) {
            $errors['penalty'] = "Please enter a number between 1 and 99.";
        }
    
        if (empty($maxDistractions)) {
            $errors['maxDistractions'] = "Maximum number of distractions required.";
        } elseif (!is_numeric($maxDistractions) || $maxDistractions < 1 || $maxDistractions > 99) {
            $errors['maxDistractions'] = "Please enter a number between 1 and 99.";
        }
    
        if (empty($goal)) {
            $errors['goal'] = "Goal score required.";
        } elseif (!is_numeric($goal) || $goal < 1 || $goal > 9999) {
            $errors['goal'] = "Please enter a number between 1 and 9999.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['penalty'] = $penalty;
            $_SESSION['maxDistractions'] = $maxDistractions;
            $_SESSION['goal'] = $goal;
            
            header("Location: addDifficultyForm.php");
            exit();

        } else {
            $sql = "INSERT INTO difficulty (penalty, maxDistractions, goal) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "iii", $penalty, $maxDistractions, $goal);

                if (mysqli_stmt_execute($stmt)) {
                    header("Location: viewDifficulty.php?difficulty=created");
                    exit();
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);

            } else {
                echo "Error preparing statement: " . mysqli_error($conn);
            }
        }
    }
    mysqli_close($conn);
?>
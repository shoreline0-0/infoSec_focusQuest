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

    $sql = "SELECT * FROM difficulty";
    $result = mysqli_query($conn,$sql);

    if (
        isset($_POST['difficultyID']) &&
        isset($_POST['penalty']) &&
        isset($_POST['maxDistractions']) &&
        isset($_POST['goal'])
    ) {

        $difficultyID = $_POST['difficultyID'];
        $penalty = $_POST['penalty'];
        $maxDistractions = $_POST['maxDistractions'];
        $goal = $_POST['goal'];

        $sql = 
        "DELETE FROM difficulty WHERE difficultyID = $difficultyID";

        if (mysqli_query($conn, $sql)) {
            header("Location: viewDifficulty.php?difficulty=deleted");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }

    } else {
        echo "Missing parameters.";
    }

    mysqli_close($conn);
?>
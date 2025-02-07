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

    $sql = "SELECT * FROM gamelog";
    $result = mysqli_query($conn,$sql);

    if (
        isset($_POST['logID']) &&
        isset($_POST['userID']) &&
        isset($_POST['difficultyID']) &&
        isset($_POST['score']) &&
        isset($_POST['timestamp']) &&
        isset($_POST['status'])

    ) {

        $logID = $_POST['logID'];
        $userID = $_POST['userID'];
        $difficultyID = $_POST['difficultyID'];
        $score = $_POST['score'];
        $timestamp = $_POST['timestamp'];
        $status = $_POST['status'];
        
        $sql = 
        "DELETE FROM gamelog WHERE logID = $logID";

        if (mysqli_query($conn, $sql)) {
            header("Location: viewGamelogs.php?gamelog=deleted");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        
    } else {
        echo "Missing parameters.";
    }
    mysqli_close($conn);
?>
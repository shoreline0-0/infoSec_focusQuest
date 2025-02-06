<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self' data:; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
    header("X-Content-Type-Options: nosniff");

    $timeout_duration = 300; 

    if (isset($_SESSION['LAST_ACTIVITY'])) {
        $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];
        if ($elapsed_time > $timeout_duration) {
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        }
    }
    $_SESSION['LAST_ACTIVITY'] = time();

    include 'dbconn.php';
    var_dump($_POST);
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $difficultyID = intval($_POST['difficultyID']);
        $penalty = intval($_POST['penalty']);
        $maxDistractions = intval($_POST['maxDistractions']);
        $goal = intval($_POST['goal']);

        $sql = 
        "INSERT INTO difficulty (penalty, maxDistractions, goal)
        VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
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

    } else {
        echo "Missing parameters.";
    }

    mysqli_close($conn);
?>
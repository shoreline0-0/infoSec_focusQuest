<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self' data:; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
    header("X-Content-Type-Options: nosniff");
    
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
        $penalty = intval($_POST['penalty']);
        $maxDistractions = intval($_POST['maxDistractions']);
        $goal = intval($_POST['goal']);

        $sql = 
        "UPDATE difficulty 
        SET 
            penalty = ?,
            maxDistractions = ?,
            goal = ?

        WHERE difficultyID = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "iiii", $penalty, $maxDistractions, $goal, $difficultyID);
            if (mysqli_stmt_execute($stmt)) {
                header("Location: viewDifficulty.php?difficulty=updated");
                exit();
            } else {
                echo "Error: " . mysqli_stmt_execute($stmt);
            }
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    } else {
        echo "Missing parameters.";
    }

    mysqli_close($conn);
?>

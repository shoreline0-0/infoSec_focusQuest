<?php
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
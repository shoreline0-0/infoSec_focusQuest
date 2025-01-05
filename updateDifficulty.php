<?php
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
        "UPDATE difficulty 
        SET 
            penalty = '$penalty',
            maxDistractions = '$maxDistractions',
            goal = '$goal'

        WHERE difficultyID = '$difficultyID'";

        if (mysqli_query($conn, $sql)) {
            echo "Updated successfully.
            <a href='viewDifficulty.php'>Go back</a>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Missing parameters.";
    }

    mysqli_close($conn);
?>

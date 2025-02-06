<?php
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
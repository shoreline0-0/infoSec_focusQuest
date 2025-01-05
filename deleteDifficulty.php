<?php

    $sql = 
    "DELETE FROM difficulty WHERE difficultyID = $difficultyID";

    if (mysqli_query($conn, $sql)) {
        echo "Deleted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
<?php

    $sql = 
    "DELETE FROM gamelogs WHERE logID = $logID";

    if (mysqli_query($conn, $sql)) {
        echo "Deleted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
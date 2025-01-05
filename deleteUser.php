<?php

    $sql = 
    "DELETE FROM users WHERE userID = $userID";

    if (mysqli_query($conn, $sql)) {
        echo "Deleted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
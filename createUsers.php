<?php
    $sql = 
    "INSERT INTO users 
    SET 
        fName = $fName,
        lName = $lName,
        email = $email,
        password = $password

    WHERE userID = $userID";

    if (mysqli_query($conn, $sql)) {
        echo "Created successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
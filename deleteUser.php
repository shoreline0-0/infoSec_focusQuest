<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self' data:; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
    header("X-Content-Type-Options: nosniff");

    include 'dbconn.php';
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);

    if (
        isset($_POST['userID']) &&
        isset($_POST['fName']) &&
        isset($_POST['lName']) &&
        isset($_POST['email']) &&
        isset($_POST['password'])
    ) {

        $userID = $_POST['userID'];
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $email = $_POST['email'];
        $password = $_POST['password'];


        $sqlDelGameLogs = "DELETE FROM gamelog WHERE userID = ?";
        if ($stmt = mysqli_prepare($conn, $sqlDelGameLogs)) {
            mysqli_stmt_bind_param($stmt, "i", $userID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            echo "Error deleting game logs: " . mysqli_error($conn);
            exit();
        }

        $sql = 
        "DELETE FROM users WHERE userID = $userID";

        if (mysqli_query($conn, $sql)) {
            header("Location: viewUsers.php?user=deleted");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }

    } else {
        echo "Missing parameters.";
    }

    mysqli_close($conn);
?>
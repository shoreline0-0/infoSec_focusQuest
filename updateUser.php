<?php
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

        $sql = 
        "UPDATE users 
        SET 
            fName = '$fName',
            lName = '$lName',
            email = '$email',
            password = '$password'

        WHERE userID = '$userID'";

        if (mysqli_query($conn, $sql)) {
            echo "Updated successfully.
            <a href='viewUsers.php'>Go back</a>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Missing parameters.";
    }

    mysqli_close($conn);
?>

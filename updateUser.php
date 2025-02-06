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
        isset($_POST['roleID'])
    ) {

        $userID = $_POST['userID'];
        $fName = htmlspecialchars($_POST['fName'], ENT_QUOTES, 'UTF-8');
        $lName = htmlspecialchars($_POST['lName'], ENT_QUOTES, 'UTF-8');
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $roleID = intval($_POST['roleID']);
    
        $sql = 
        "UPDATE users 
        SET 
            fName = ?,
            lName = ?,
            email = ?,
            roleID = ?

        WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssi", $fName, $lName, $email, $roleID, $userID);
            if (mysqli_stmt_execute($stmt)) {
                header("Location: viewUsers.php?user=updated");
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

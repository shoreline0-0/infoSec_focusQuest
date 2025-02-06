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
        $fName = htmlspecialchars($_POST['fName'], ENT_QUOTES, 'UTF-8');
        $lName = htmlspecialchars($_POST['lName'], ENT_QUOTES, 'UTF-8');
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');
        $hashedPassword = hash('sha256', $password);
    
        $sql = 
        "UPDATE users 
        SET 
            fName = ?,
            lName = ?,
            email = ?,
            password = ?

        WHERE userID = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssi", $fName, $lName, $email, $hashedPassword, $userID);
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

<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self' data:; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
    header("X-Content-Type-Options: nosniff");
    
    session_start();

    if (!isset($_SESSION['userID'])) {
        header("Location: logout.php");
        exit();
    }
    
    $timeout_duration = 300; 

    if (isset($_SESSION['LAST_ACTIVITY'])) {
        $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];
        if ($elapsed_time > $timeout_duration) {
            session_unset();
            session_destroy();
            header("Location: logout.php");
            exit();
        }
    }
    $_SESSION['LAST_ACTIVITY'] = time();

    include 'dbconn.php';

    $errors = [];
    $fName = $lName = $email = $roleID = "";

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

        if (empty($fName)) {
            $errors['fName'] = "First name required.";
        } elseif (strlen($fName) > 50) {
            $errors['fName'] = "First name too long.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fName)) {
            $errors['fName'] = "Only letters and spaces allowed.";
        }
    
        if (empty($lName)) {
            $errors['lName'] = "Last name required.";
        } elseif (strlen($lName) > 50) {
            $errors['lName'] = "Last name too long.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $lName)) {
            $errors['lName'] = "Only letters and spaces allowed.";
        }
    
        if (empty($email)) {
            $errors['email'] = "Email required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format.";
        }

        if (empty($roleID)) {
            $errors['roleID'] = "Role required.";
        } elseif (!is_numeric($roleID) || $roleID < 1 || $roleID > 2) {
            $errors['roleID'] = "There are only two roles!";
        }
        

        $sql = "SELECT * FROM users WHERE email = ? AND userID != ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "si", $email, $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if (mysqli_num_rows($result) > 0) {
                $errors['email'] = "Account already exists with this email!";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Database error: " . mysqli_error($conn);
        }
    
        if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['fName'] = $fName;
                $_SESSION['lName'] = $lName;
                $_SESSION['email'] = $email;
                $_SESSION['roleID'] = $roleID;
                $_SESSION['userID'] = $userID;

                
                header("Location: editUserForm.php");
                exit();
        } else {
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
        }
        
    }

    mysqli_close($conn);
?>

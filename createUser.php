<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self' data:; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
    header("X-Content-Type-Options: nosniff");

    session_start();
    
    if (!isset($_SESSION['userID'])) {
        header("Location: logout.php");
        exit();
    }

    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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
    $fName = $lName = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fName = htmlspecialchars($_POST['fName'], ENT_QUOTES, 'UTF-8');
    $lName = htmlspecialchars($_POST['lName'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');

    if (empty($fName)) {
        $errors['fName'] = "First name required.";
    } elseif (strlen($fName) > 50) {
        $errors['fName'] = "First name too long.";
    }

    if (empty($lName)) {
        $errors['lName'] = "Last name required.";
    } elseif (strlen($lName) > 50) {
        $errors['lName'] = "Last name too long.";
    }

    if (empty($email)) {
        $errors['email'] = "Email required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }
 
    $sql = "SELECT * FROM users WHERE email = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) > 0) {
            $errors['email'] = "Account already exists with this email!";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Database error: " . mysqli_error($conn);
    }

    if (empty($password)) {
        $errors['password'] = "Password required.";
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        $errors['password'] = "Password must be at least 8 characters long, contain an uppercase letter, a lowercase letter, a number, and a special character.";
    } 

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['fName'] = $fName;
        $_SESSION['lName'] = $lName;
        $_SESSION['email'] = $email;
        
        header("Location: signup.php");
        exit();

    } else {
        $hashedPassword = hash('sha256', $password);
        $sql = "INSERT INTO users (fName, lName, email, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $fName, $lName, $email, $hashedPassword);
            if (mysqli_stmt_execute($stmt)) {
                header("Location: login.php?account=created");
                exit();
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement.";
        }
    }

}

mysqli_close($conn);
?>
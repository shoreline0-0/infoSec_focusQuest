<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self' data:; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
    header("X-Content-Type-Options: nosniff");
    
    session_start();

    include 'dbconn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Invalid CSRF token.");
        }

        include 'dbconn.php';
        $errors = [];
        $email = "";
    
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $loginPW = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');
        $hashedInput = hash('sha256', $loginPW);

        if (empty($email)) {
            $errors['email'] = "Email required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format.";
        }

        if (empty($loginPW)) {
            $errors['password'] = "Password required.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['email'] = $email;
            
            header("Location: login.php");               
            exit();
        }

        $sql = "SELECT * FROM users WHERE email = ?";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        
            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                $hashedPW = $user['password'];

                $access = 'login';
        
                if ($hashedInput == $hashedPW) {
                    $_SESSION['userID'] = $user['userID'];
                    $_SESSION['fName'] = $user['fName'];
                    $_SESSION['roleID'] = $user['roleID'];
                        
                    $status = 'success';
                    $sqlLog = "INSERT INTO access_logs (userID, roleID, logTime, status, accessType) VALUES (?, ?, NOW(), ?, ?)";
                    if ($stmtLog = mysqli_prepare($conn, $sqlLog)) {
                        mysqli_stmt_bind_param($stmtLog, "iiss", $user['userID'], $user['roleID'], $status, $access);                            
                        mysqli_stmt_execute($stmtLog);
                    }

                    if ($user['roleID'] == 1) {
                        header("Location: userhome.php");
                    } elseif ($user['roleID'] == 2) {
                        header("Location: home.php");
                    }
                } else {
                    $errors['password'] = "Incorrect password.";
                    if (!empty($errors)) {
                        $_SESSION['errors'] = $errors;
                        $_SESSION['email'] = $email;
                        
                        header("Location: login.php");               
                        exit();
                    } 
                    $status = 'failed';
                    $sqlLog = "INSERT INTO access_logs (userID, roleID, logTime, status, accessType) VALUES (?, ?, NOW(), ?, ?)";
                    if ($stmtLog = mysqli_prepare($conn, $sqlLog)) {
                        mysqli_stmt_bind_param($stmtLog, "iiss", $user['userID'], $user['roleID'], $status, $access);
                        mysqli_stmt_execute($stmtLog);
                    }
                                     
                }
            } else {
                $errors['email'] = "Account does not exist!";     
                if (!empty($errors)) {
                    $_SESSION['errors'] = $errors;
                    $_SESSION['email'] = $email;
                    
                    header("Location: login.php");               
                    exit();
                }    
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Database error: " . mysqli_error($conn);
        }
    }
?>
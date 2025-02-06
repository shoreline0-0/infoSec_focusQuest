<?php
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self' data:; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
    header("X-Content-Type-Options: nosniff");

    session_start();
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fName = htmlspecialchars($_POST['fName'], ENT_QUOTES, 'UTF-8');
    $lName = htmlspecialchars($_POST['lName'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');
    $hashedPassword = hash('sha256', $password);

    if (strlen($fName) > 50) {
        die("First name is too long.");
    }

    if (strlen($lName) > 50) {
        die("Last name is too long.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    if (strlen($password) < 6 || strlen($password) > 20) {
        die("Password must be between 6 and 20 characters.");
    }
    
    $sql = "SELECT * FROM users WHERE email = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) > 0) {
            echo "Account already exists with this email!";
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Database error: " . mysqli_error($conn);
    }

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

mysqli_close($conn);
?>
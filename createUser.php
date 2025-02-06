<?php
header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self' data:;object-src 'none'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fName = htmlspecialchars($_POST['fName'], ENT_QUOTES, 'UTF-8');
    $lName = htmlspecialchars($_POST['lName'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');
    $hashedPassword = hash('sha256', $password);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
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

<!-- http://localhost/focusQuest -->
<?php
session_start();


include 'dbconn.php';

if (isset($_SESSION['userID']) && isset($_SESSION['roleID'])) {

    $userID = $_SESSION['userID'];
    $roleID = $_SESSION['roleID'];
    $accessType = 'logout';
    $status = 'success';

    $sqlLog = "INSERT INTO access_logs (userID, roleID, logTime, status, accessType) VALUES (?, ?, NOW(), ?, ?)";
    if ($stmtLog = mysqli_prepare($conn, $sqlLog)) {
        mysqli_stmt_bind_param($stmtLog, "iiss", $userID, $roleID, $status, $accessType);
        mysqli_stmt_execute($stmtLog);
    }

    session_unset(); 
    session_destroy(); 
    
}

header("Location: index.php"); 
exit();
?>


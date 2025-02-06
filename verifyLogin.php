<?php
    include 'dbconn.php';
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $_POST['email'];
        $loginPW = $_POST['password'];
        $hashedInput = hash('sha256', $loginPW);
        
        $sql = "SELECT * FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                $hashedPW = $user['password'];

                if ($hashedInput == $hashedPW) {
                    session_start();
                    $_SESSION['userID'] = $user['userID'];
                    $_SESSION['fName'] = $user['fName'];
                    header("Location: home.php");
                } else {
                    echo "Incorrect password.";
                    echo "input: ", $hashedInput, "    pw: ", $hashedPW;
                }
            } else {
                echo "Account does not exist!";        
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Database error: " . mysqli_error($conn);
        }
    } else {
        echo "Missing parameters.";
    }

?>
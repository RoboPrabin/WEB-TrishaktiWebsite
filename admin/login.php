<?php
session_start();
include "db.php";

$lockout_time = 15 * 60; // 15 minutes in seconds
$max_attempts = 3;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = hash("sha256", $_POST['password']);

    // Check if the user exists
    $stmt = $conn->prepare("SELECT id, password, login_attempts, last_attempt FROM admins WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $db_pass, $attempts, $last_attempt);
        $stmt->fetch();

        // Check if user is locked
        if ($attempts >= $max_attempts && (time() - strtotime($last_attempt)) < $lockout_time) {
            $error = "Account is temporarily locked. Please try again after 15 minutes.";
        } else {
            // Check password
            if ($password === $db_pass) {
                $_SESSION['admin'] = $username;

                // Reset attempts
                $reset_stmt = $conn->prepare("UPDATE admins SET login_attempts=0, last_attempt=NULL WHERE username=?");
                $reset_stmt->bind_param("s", $username);
                $reset_stmt->execute();

                header("Location: index.php");
                exit();
            } else {
                // Update attempts
                $new_attempts = ($attempts >= $max_attempts && (time() - strtotime($last_attempt)) > $lockout_time) ? 1 : $attempts + 1;

                $update_stmt = $conn->prepare("UPDATE admins SET login_attempts=?, last_attempt=NOW() WHERE username=?");
                $update_stmt->bind_param("is", $new_attempts, $username);
                $update_stmt->execute();

                $error = ($new_attempts >= $max_attempts)
                    ? "Too many failed attempts. Account locked for 15 minutes."
                    : "Incorrect Username or Password.";
            }
        }
    } else {
        $error = "Incorrect Username or Password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Trishakti Admin Login </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">

    <div class="login-wrapper">
        <form class="login-box" method="post">
            <h2>Trishakti Admin</h2>
            <?php if (!empty($error)) echo "<p class='error-msg'>$error</p>"; ?>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>

</body>
</html>

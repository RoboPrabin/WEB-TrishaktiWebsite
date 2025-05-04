<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your CSS file -->
    <title>Admin Dashboard</title>
</head>
<body>
<?php include 'sidebar/sidebar.php'; ?>


    <div class="main-content">
    <div class="header">
        <p>Hello, <?= $_SESSION['admin']; ?></p>
        <a href="logout.php">Logout</a>
    </div>


        <div class="welcome-box">
            <h2>Welcome to the Admin Dashboard</h2>
            <p>Use the sidebar to manage site sections.</p>
        </div>
    </div>

</body>
</html>

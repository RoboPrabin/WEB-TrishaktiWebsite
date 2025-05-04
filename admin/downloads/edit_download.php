<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: downloads.php");
    exit();
}

$id = $_GET['id'];

// Fetch current form data
$stmt = $conn->prepare("SELECT * FROM downloads WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$download = $result->fetch_assoc();

if (!$download) {
    echo "Form not found!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $form_name = $_POST['form_name'];
    $new_file = $download['file']; // default to old file

    // Handle new file upload
    if (!empty($_FILES['file']['name']) && pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) === 'pdf') {
        $new_file = time() . "_" . basename($_FILES['file']['name']);
        $uploadPath = __DIR__ . "/uploads/" . $new_file;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
            // Delete old file
            $oldPath = __DIR__ . "/uploads/" . $download['file'];
            if (file_exists($oldPath)) unlink($oldPath);
        }
    }

    $stmt = $conn->prepare("UPDATE downloads SET form_name = ?, file = ? WHERE id = ?");
    $stmt->bind_param("ssi", $form_name, $new_file, $id);
    $stmt->execute();

    header("Location: downloads.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Download Form</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include '../sidebar/sidebar1.php'; ?>
<div class="main-content">
    <div class="header">
        <p>Hello, <?= $_SESSION['admin']; ?></p>
        <a href="../logout.php">Logout</a>
    </div>

    <div class="form-box">
        <h3>Edit Download Form</h3>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="form_name" value="<?= htmlspecialchars($download['form_name']); ?>" required>
            <label>Replace PDF (optional):</label>
            <input type="file" name="file" accept=".pdf">
            <button type="submit" name="update">Update</button>
        </form>
    </div>
    <a href="downloads.php" class="back-btn">Back to Downloads</a>
</div>
</body>
</html>

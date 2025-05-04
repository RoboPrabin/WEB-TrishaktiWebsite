<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: notices.php");
    exit();
}

$id = (int) $_GET['id'];

// Fetch existing notice/act
$stmt = $conn->prepare("SELECT * FROM notices WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {  
    header("Location: notices.php");
    exit();
}
$notice = $result->fetch_assoc();

$type = $notice['type'];

// Update logic
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $description = $_POST['description'];
    $newImage = $notice['image'];

    if ($type === 'act') {
        // For acts, we just update the link
        if (!empty($_POST['pdf_link'])) {
            $newImage = trim($_POST['pdf_link']);
        }
    } else {
        // For notices, handle file upload
        if (!empty($_FILES['image']['name'])) {
            $newImage = time() . "_" . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $newImage);

            // Optional: delete old image
            // if (file_exists("uploads/" . $notice['image'])) {
            //     unlink("uploads/" . $notice['image']);
            // }
        }
    }

    $updateStmt = $conn->prepare("UPDATE notices SET description = ?, image = ? WHERE id = ?");
    $updateStmt->bind_param("ssi", $description, $newImage, $id);
    $updateStmt->execute();

    header("Location: notices.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit <?= ucfirst($type); ?></title>
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
        <h2>Edit <?= ucfirst($type); ?></h2>
        <form method="post" enctype="multipart/form-data">
            <?php if ($type === 'act'): ?>
                <label>Current PDF Link:</label><br>
                <a href="<?= htmlspecialchars($notice['image']); ?>" target="_blank">
                    <?= htmlspecialchars($notice['image']); ?>
                </a><br><br>

                <label>Change PDF Link (optional):</label>
                <input type="url" name="pdf_link" placeholder="Enter PDF URL" value="<?= htmlspecialchars($notice['image']); ?>">

            <?php else: ?>
                <label>Current Image:</label><br>
                <a href="uploads/<?= htmlspecialchars($notice['image']); ?>" target="_blank">
                    <img src="uploads/<?= htmlspecialchars($notice['image']); ?>" alt="Current Image" style="max-width:200px;">
                </a><br><br>

                <label>Change Image (optional):</label>
                <input type="file" name="image">
            <?php endif; ?>

            <label>Description (Title):</label>
            <textarea name="description" rows="5" required><?= htmlspecialchars($notice['description']); ?></textarea>

            <button type="submit">Update</button>
        </form>
    </div>
    <a href="notices.php" class="back-btn">Back to Notices</a>
</div>

</body>
</html>

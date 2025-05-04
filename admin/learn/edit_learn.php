<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: learn.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch existing entry
$stmt = $conn->prepare("SELECT * FROM learn WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$entry = $result->fetch_assoc();

if (!$entry) {
    header("Location: learn.php");
    exit();
}

// Handle update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_entry'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $source = $_POST['source'];
    $file = $entry['image']; // Keep old file by default

    // If new file uploaded, replace
    if (!empty($_FILES['file']['name'])) {
        $file = time() . "_" . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $file);
    }

    $stmt = $conn->prepare("UPDATE learn SET title = ?, content = ?, source = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $title, $content, $source, $file, $id);
    $stmt->execute();

    header("Location: learn.php?tab=" . $entry['type']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Learn Entry</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include '../sidebar/sidebar1.php'; ?>

<div class="main-content">
    <div class="header">
        <p>Hello, <?= $_SESSION['admin']; ?></p>
        <a href="../logout.php">Logout</a>
    </div>

    <h2>Edit <?= ucfirst($entry['type']) ?> Entry</h2> <br><br>

    <div class="form-box">
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title" value="<?= htmlspecialchars($entry['title']); ?>" required>
            <textarea name="content" rows="3" placeholder="Content..." required><?= htmlspecialchars($entry['content']); ?></textarea>
            <input type="text" name="source" placeholder="Source" value="<?= htmlspecialchars($entry['source']); ?>" required>

            <?php if (!empty($entry['image'])): ?>
                <p>Current File:</p>
                <?php
                    $ext = strtolower(pathinfo($entry['image'], PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                        <img src="uploads/<?= htmlspecialchars($entry['image']); ?>" class="thumb" alt="Image" width="100">
                    <?php elseif ($ext === 'pdf'): ?>
                        <a href="uploads/<?= htmlspecialchars($entry['image']); ?>" target="_blank">View PDF</a>
                    <?php else: ?>
                        No File
                    <?php endif; ?>
            <?php endif; ?>

            <br><br>
            <input type="file" name="file">
            <input type="hidden" name="update_entry" value="1">
            <button type="submit">Update</button>
        </form>
    </div>
    
    <a href="learn.php?tab=<?= $entry['type']; ?>" class="back-btn">Back to <?= ucfirst($entry['type']); ?></a>
</div>

</body>
</html>

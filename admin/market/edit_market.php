<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: market.php");
    exit();
}

$id = (int)$_GET['id'];

// Fetch existing data
$stmt = $conn->prepare("SELECT * FROM market WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$market = $result->fetch_assoc();

if (!$market) {
    echo "Market summary not found.";
    exit();
}

// Handle update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_market'])) {
    $summary = $_POST['summary'];
    $description = $_POST['description'];
    $new_image = $market['image']; // default to old image

    if (!empty($_FILES['image']['name'])) {
        $new_image = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $new_image);
        // Optionally delete the old image
        if (file_exists("uploads/" . $market['image'])) {
            unlink("uploads/" . $market['image']);
        }
    }

    $update_stmt = $conn->prepare("UPDATE market SET image = ?, summary = ?, description = ? WHERE id = ?");
    $update_stmt->bind_param("sssi", $new_image, $summary, $description, $id);
    $update_stmt->execute();

    header("Location: market.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Market Summary</title>
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
        <h3>Edit Market Summary</h3>
        <form method="post" enctype="multipart/form-data">
            <p>Current Image:</p>
            <img src="uploads/<?= htmlspecialchars($market['image']); ?>" class="thumb" style="max-width: 200px;"><br><br>
            <label>Change Image:</label>
            <input type="file" name="image"><br><br>

            <input type="text" name="summary" value="<?= htmlspecialchars($market['summary']); ?>" required>
            <textarea name="description" rows="4"><?= htmlspecialchars($market['description']); ?></textarea>
            <button type="submit" name="update_market">Update Market</button>
        </form>
    </div>
    <a href="market.php" class="back-btn">Back to Market</a>

</div>
</body>
</html>

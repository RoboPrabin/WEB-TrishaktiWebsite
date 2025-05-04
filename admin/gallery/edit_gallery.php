<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: gallery.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM gallery WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$imageData = $result->fetch_assoc();

if (!$imageData) {
    echo "Image not found.";
    exit();
}

// Update image
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $category = $_POST['category'];
    $description = $_POST['description'];
    $newImage = $imageData['image']; // default to old image

    if (!empty($_FILES['image']['name'])) {
        // Upload new image
        $newImage = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $newImage);

        // Optionally delete the old image file
        if (file_exists("uploads/" . $imageData['image'])) {
            unlink("uploads/" . $imageData['image']);
        }
    }

    $updateStmt = $conn->prepare("UPDATE gallery SET image=?, category=?, description=? WHERE id=?");
    $updateStmt->bind_param("sssi", $newImage, $category, $description, $id);
    $updateStmt->execute();

    header("Location: gallery.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Gallery Image</title>
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
    <h3>Edit Gallery Image</h3>



    <form method="post" enctype="multipart/form-data">
        <p><strong>Current Image:</strong></p>
        <img src="uploads/<?= $imageData['image']; ?>" class="thumb" alt="Current Image">

        <p>Upload New Image (optional):</p>
        <input type="file" name="image">

        <p>Category:</p>
        <select name="category" required>
            <option value="">-- Select Category --</option>
            <option value="event" <?= $imageData['category'] === 'event' ? 'selected' : '' ?>>Event Image</option>
            <option value="office" <?= $imageData['category'] === 'office' ? 'selected' : '' ?>>Office Image</option>
            <option value="client" <?= $imageData['category'] === 'client' ? 'selected' : '' ?>>Client Image</option>
        </select>

        <p>Description:</p>
        <textarea name="description" rows="3" required><?= htmlspecialchars($imageData['description']); ?></textarea>

        <button type="submit">Update Image</button>
        </form>
    </div>
    <a href="gallery.php" class="back-btn">Back to Gallery</a>

</div>
</body>
</html>

<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: news.php");
    exit();
}

$id = $_GET['id'];

// Fetch current news item
$stmt = $conn->prepare("SELECT * FROM news WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$news = $result->fetch_assoc();

if (!$news) {
    echo "News item not found!";
    exit();
}

// Handle update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $link = $_POST['link'];
    $image = $news['image']; // Keep old image by default

    // If a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
    }

    $stmt = $conn->prepare("UPDATE news SET title=?, image=?, category=?, link=? WHERE id=?");
    $stmt->bind_param("ssssi", $title, $image, $category, $link, $id);
    $stmt->execute();

    header("Location: news.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit News</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include '../sidebar/sidebar1.php'; ?>

<div class="main-content">
    <div class="header">
        <h2>Edit News Item</h2>
        <a href="news.php">Back to News</a>
    </div>

    <div class="form-box">
        <form method="post" enctype="multipart/form-data">
            <label>Title:</label>
            <input type="text" name="title" value="<?= htmlspecialchars($news['title']) ?>" required>

            <label>Current Image:</label><br>
            <img src="uploads/<?= $news['image'] ?>" class="thumb" style="max-width:150px;"><br><br>

            <label>Change Image:</label>
            <input type="file" name="image" accept="image/*">

            <label>Category:</label>
            <input type="text" name="category" value="<?= htmlspecialchars($news['category']) ?>" required>

            <label>External Link:</label>
            <input type="url" name="link" value="<?= htmlspecialchars($news['link']) ?>">

            <button type="submit">Update News</button>
        </form>
    </div>
    <a href="news.php" class="back-btn">Back to News</a>

</div>
</body>
</html>

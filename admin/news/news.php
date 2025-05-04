<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

// Add news
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_news'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $link = $_POST['link'];

    $image = "";
    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
    }

    $stmt = $conn->prepare("INSERT INTO news (title, image, category, link, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $title, $image, $category, $link);
    $stmt->execute();
}

// Delete news
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM news WHERE id=$id");
    header("Location: news.php");
    exit();
}

// Pagination
$limit = 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Total count
$total_result = $conn->query("SELECT COUNT(*) as total FROM news");
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);

// Fetch paginated news
$result = $conn->query("SELECT * FROM news ORDER BY created_at DESC LIMIT $limit OFFSET $offset");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News Management</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include '../sidebar/sidebar1.php'; ?>
<div class="main-content">
    <div class="header">
        <p>Hello, <?= $_SESSION['admin']; ?></p>
        <a href="../logout.php">Logout</a>
    </div>

    <h2>News Management</h2> <br>

    <div class="form-box">
        <h3>Add New News</h3>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="News Title" required>
            <input type="file" name="image" accept="image/*" required>
            <input type="text" name="category" placeholder="Category" required>
            <input type="url" name="link" placeholder="External Link">
            <button type="submit" name="add_news">Add News</button>
        </form>
    </div>

    <table>
        <thead>
        <tr>
            <th>Title</th>
            <th>Image</th>
            <th>Category</th>
            <th>Link</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']); ?></td>
                <td><img src="uploads/<?= $row['image']; ?>" class="thumb" alt="news image"></td>
                <td><?= htmlspecialchars($row['category']); ?></td>
                <td><a href="<?= htmlspecialchars($row['link']); ?>" target="_blank">Open</a></td>
                <td><?= $row['created_at']; ?></td>
                <td class="action-btns">
                    <a href="edit_news.php?id=<?= $row['id']; ?>" class="edit-btn">Edit</a>
                    <a href="news.php?delete=<?= $row['id']; ?>" class="delete-btn" onclick="return confirm('Delete this news?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <?php if ($total_pages > 1): ?>
    <div class="pagination">
        <?php
        $range = 1; // Number of pages to show around current page
        $dot_shown = false;

        // Prev Button
        if ($page > 1) {
            echo '<a href="?page=' . ($page - 1) . '" class="page-btn">« Prev</a>';
        } else {
            echo '<span class="page-btn disabled">« Prev</span>';
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if (
                $i == 1 || 
                $i == 2 || 
                $i == $total_pages || 
                $i == $total_pages - 1 || 
                ($i >= $page - $range && $i <= $page + $range)
            ) {
                $active = ($i == $page) ? 'active' : '';
                echo '<a href="?page=' . $i . '" class="page-btn ' . $active . '">' . $i . '</a>';
                $dot_shown = false;
            } else {
                if (!$dot_shown) {
                    echo '<span class="page-btn dots">...</span>';
                    $dot_shown = true;
                }
            }
        }

        // Next Button
        if ($page < $total_pages) {
            echo '<a href="?page=' . ($page + 1) . '" class="page-btn">Next »</a>';
        } else {
            echo '<span class="page-btn disabled">Next »</span>';
        }
        ?>
    </div>
<?php endif; ?>

</div>
</body>
</html>

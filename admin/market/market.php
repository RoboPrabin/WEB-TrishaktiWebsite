<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

// Pagination setup
$limit = 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Count total entries
$total_result = $conn->query("SELECT COUNT(*) AS total FROM market");
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);

// Add Market Entry
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_market'])) {
    $summary = $_POST['summary'];
    $description = $_POST['description'];
    $image = "";

    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
    }

    $stmt = $conn->prepare("INSERT INTO market (image, summary, description, uploaded_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $image, $summary, $description);
    $stmt->execute();

    // Redirect to first page
    header("Location: market.php?page=1");
    exit();
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM market WHERE id=$id");
    header("Location: market.php?page=$page");
    exit();
}

// Fetch paginated market entries
$result = $conn->query("SELECT * FROM market ORDER BY uploaded_at DESC LIMIT $limit OFFSET $offset");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Market Management</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include '../sidebar/sidebar1.php'; ?>
<div class="main-content">
    <div class="header">
        <p>Hello, <?= $_SESSION['admin']; ?></p>
        <a href="../logout.php">Logout</a>
    </div>

    <h2>Market Management</h2><br>

    <div class="form-box">
        <h3>Add Market Summary</h3>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="image" required>
            <input type="text" name="summary" placeholder="Market Summary" required>
            <textarea name="description" rows="4" placeholder="Detailed description..."></textarea>
            <button type="submit" name="add_market">Add Market</button>
        </form>
    </div>

    <table>
        <thead>
        <tr>
            <th>Image</th>
            <th>Market Summary</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><img src="uploads/<?= $row['image']; ?>" class="thumb" alt="Market Image"></td>
                <td><?= htmlspecialchars($row['summary']); ?></td>
                <td><?= htmlspecialchars($row['description']); ?></td>
                <td class="action-btns">
                    <a href="edit_market.php?id=<?= $row['id']; ?>" class="edit-btn">Edit</a>
                    <a href="market.php?delete=<?= $row['id']; ?>&page=<?= $page ?>" class="delete-btn" onclick="return confirm('Delete this entry?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <?php if ($total_pages > 1): ?>
    <div class="pagination" style="margin-top: 20px; text-align: center;">
        <?php
        $range = 1; // Pages to show around current page
        $dot_shown = false;

        // Prev Button
        if ($page > 1) {
            echo '<a href="market.php?page=' . ($page - 1) . '">« Prev</a>';
        } else {
            echo '<span class="disabled">« Prev</span>';
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if (
                $i == 1 || 
                $i == 2 || 
                $i == $total_pages || 
                $i == $total_pages - 1 || 
                ($i >= $page - $range && $i <= $page + $range)
            ) {
                $active = $i == $page ? 'active' : '';
                echo '<a class="' . $active . '" href="market.php?page=' . $i . '">' . $i . '</a>';
                $dot_shown = false;
            } else {
                if (!$dot_shown) {
                    echo '<span class="dots">...</span>';
                    $dot_shown = true;
                }
            }
        }

        // Next Button
        if ($page < $total_pages) {
            echo '<a href="market.php?page=' . ($page + 1) . '">Next »</a>';
        } else {
            echo '<span class="disabled">Next »</span>';
        }
        ?>
    </div>
<?php endif; ?>

</div>
</body>
</html>

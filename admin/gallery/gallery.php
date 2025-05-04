<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

// Handle image delete
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);

    // Get the filename first so you can delete it from the folder
    $stmt = $conn->prepare("SELECT image FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $deleteId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($image);
        $stmt->fetch();
        $stmt->close();

        // Delete the image file from server
        $filePath = "uploads/" . $image;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete from database
        $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
        $stmt->bind_param("i", $deleteId);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect to avoid repeated delete on refresh
    header("Location: gallery.php");
    exit();
}

// Pagination setup
$limit = 4;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Total number of records
$totalQuery = $conn->query("SELECT COUNT(*) as total FROM gallery");
$totalRows = $totalQuery->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Fetch gallery with limit and offset
$result = $conn->query("SELECT * FROM gallery ORDER BY uploaded_at DESC LIMIT $limit OFFSET $offset");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery Management</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
<?php include '../sidebar/sidebar1.php'; ?>
<div class="main-content">
    <div class="header">
        <p>Hello, <?= $_SESSION['admin']; ?></p>
        <a href="../logout.php">Logout</a>
    </div>

    <h2>Gallery Management</h2> <br>

    <div class="form-box">
        <h3>Add Gallery Image</h3>
        <form method="post" enctype="multipart/form-data" action="upload_gallery.php">
            <input type="file" name="image" required>
            <select name="category" required>
                <option value="">-- Select Category --</option>
                <option value="event">Event Image</option>
                <option value="office">Office Image</option>
                <option value="client">Client Image</option>
            </select>
            <textarea name="description" rows="3" placeholder="Image description..."></textarea>
            <button type="submit" name="add_image">Upload Image</button>
        </form>
    </div>

    <table>
        <thead>
        <tr>
            <th>Image</th>
            <th>View</th>
            <th>Description</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><img src="uploads/<?= $row['image']; ?>" class="thumb" alt="Gallery Image"></td>
                <td><a href="uploads/<?= $row['image']; ?>" target="_blank" class="view-btn">View</a></td>
                <td><?= htmlspecialchars($row['description']); ?></td>
                <td><?= htmlspecialchars(ucfirst($row['category'])); ?></td>
                <td class="action-btns">
                    <a href="edit_gallery.php?id=<?= $row['id']; ?>" class="edit-btn">Edit</a>
                    <a href="gallery.php?delete=<?= $row['id']; ?>" class="delete-btn" onclick="return confirm('Delete this image?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Pagination Controls -->
    <div class="pagination">
    <?php
    if ($totalPages > 1) {
        $range = 1; // How many numbers to show left and right of current page
        $dot_shown = false;

        // Prev button
        if ($page > 1) {
            echo '<a href="?page=' . ($page - 1) . '">« Prev</a>';
        } else {
            echo '<span class="disabled">« Prev</span>';
        }

        for ($i = 1; $i <= $totalPages; $i++) {
            if (
                $i == 1 || 
                $i == 2 || 
                $i == $totalPages || 
                $i == $totalPages - 1 || 
                ($i >= $page - $range && $i <= $page + $range)
            ) {
                $active = $i === $page ? 'active' : '';
                echo '<a href="?page=' . $i . '" class="' . $active . '">' . $i . '</a>';
                $dot_shown = false;
            } else {
                if (!$dot_shown) {
                    echo '<span class="dots">...</span>';
                    $dot_shown = true;
                }
            }
        }

        // Next button
        if ($page < $totalPages) {
            echo '<a href="?page=' . ($page + 1) . '">Next »</a>';
        } else {
            echo '<span class="disabled">Next »</span>';
        }
    }
    ?>
</div>

</div>
</body>
</html>

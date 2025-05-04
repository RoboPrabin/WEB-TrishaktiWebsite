<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

// Handle add
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_entry'])) {
    $type = $_POST['type'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $source = $_POST['source'];
    $file = "";

    if (!empty($_FILES['file']['name'])) {
        $file = time() . "_" . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $file);
    }

    $stmt = $conn->prepare("INSERT INTO learn (type, title, content, source, image, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssss", $type, $title, $content, $source, $file);
    $stmt->execute();

    header("Location: learn.php?tab=" . $type);
    exit();
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM learn WHERE id=$id");
    header("Location: learn.php");
    exit();
}

// Pagination setup
$types = ['research', 'education', 'library'];
$current_tab = isset($_GET['tab']) && in_array($_GET['tab'], $types) ? $_GET['tab'] : 'research';
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 3;
$offset = ($page - 1) * $limit;

// Fetch entries for current tab
$total_result = $conn->query("SELECT COUNT(*) as count FROM learn WHERE type='$current_tab'");
$total_row = $total_result->fetch_assoc();
$total_entries = $total_row['count'];
$total_pages = ceil($total_entries / $limit);

$entries = $conn->query("SELECT * FROM learn WHERE type='$current_tab' ORDER BY created_at DESC LIMIT $limit OFFSET $offset");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Learn Management</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include '../sidebar/sidebar1.php'; ?>

<div class="main-content">
    <div class="header">
        <p>Hello, <?= $_SESSION['admin']; ?></p>
        <a href="../logout.php">Logout</a>
    </div>

    <h2>Learn Management</h2> <br><br>

    <div class="tab-buttons">
        <a href="learn.php?tab=research" class="<?= $current_tab == 'research' ? 'active' : '' ?>">Research Paper</a>
        <a href="learn.php?tab=education" class="<?= $current_tab == 'education' ? 'active' : '' ?>">Education Materials</a>
        <a href="learn.php?tab=library" class="<?= $current_tab == 'library' ? 'active' : '' ?>">Library</a>
    </div>

    <div class="form-box">
        <h3>Add <?= ucfirst($current_tab) ?></h3>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="content" rows="3" placeholder="Content..." required></textarea>
            <input type="text" name="source" placeholder="Source" required>
            <input type="file" name="file" required>
            <input type="hidden" name="type" value="<?= $current_tab ?>">
            <input type="hidden" name="add_entry" value="1">
            <button type="submit">Add</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>File</th>
                <th>Title</th>
                <th>Content</th>
                <th>Source</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($entries->num_rows > 0): ?>
                <?php while ($row = $entries->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php
                                $ext = strtolower(pathinfo($row['image'], PATHINFO_EXTENSION));
                                if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                    <img src="uploads/<?= htmlspecialchars($row['image']); ?>" class="thumb" alt="Image" width="80">
                                <?php elseif ($ext === 'pdf'): ?>
                                    <a href="uploads/<?= htmlspecialchars($row['image']); ?>" target="_blank">View PDF</a>
                                <?php else: ?>
                                    No File
                                <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['title']); ?></td>
                        <td><?= htmlspecialchars($row['content']); ?></td>
                        <td><?= htmlspecialchars($row['source']); ?></td>
                        <td class="action-btns">
                            <a href="edit_learn.php?id=<?= $row['id']; ?>" class="edit-btn">Edit</a>
                            <a href="learn.php?delete=<?= $row['id']; ?>&tab=<?= $current_tab ?>" class="delete-btn" onclick="return confirm('Delete this entry?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" style="text-align: center;">No entries found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($total_pages > 1): ?>
    <div class="pagination" style="margin-top: 20px; text-align: center;">
        <?php
        $range = 1; // How many pages to show around current
        $dot_shown = false;

        // Prev Button
        if ($page > 1) {
            echo '<a href="learn.php?tab=' . $current_tab . '&page=' . ($page - 1) . '">« Prev</a>';
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
                echo '<a class="' . $active . '" href="learn.php?tab=' . $current_tab . '&page=' . $i . '">' . $i . '</a>';
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
            echo '<a href="learn.php?tab=' . $current_tab . '&page=' . ($page + 1) . '">Next »</a>';
        } else {
            echo '<span class="disabled">Next »</span>';
        }
        ?>
    </div>
<?php endif; ?>

</div>

</body>
</html>

<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

// Handle Add Notice
if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['type'] === 'notice') {
    $type = $_POST['type'];
    $description = trim($_POST['description']);
    $file = "";

    if (!empty($_FILES['image']['name'])) {
        $filename = basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'pdf'])) {
            $file = time() . "_" . preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $filename);
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $file);
        } else {
            echo "<script>alert('Only JPG, JPEG, PNG, GIF, and PDF files are allowed.'); window.location.href='notices.php';</script>";
            exit();
        }
    }

    $stmt = $conn->prepare("INSERT INTO notices (type, image, description, uploaded_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $type, $file, $description);
    $stmt->execute();
    header("Location: notices.php");
    exit();
}

// Handle Add Act (link only)
if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['type'] === 'act') {
    $type = $_POST['type'];
    $description = trim($_POST['description']); // Title
    $file = trim($_POST['link']); // Link

    $stmt = $conn->prepare("INSERT INTO notices (type, file, description, uploaded_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $type, $file, $description);
    $stmt->execute();
    header("Location: notices.php?act_page=1");
    exit();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM notices WHERE id=$id");
    header("Location: notices.php");
    exit();
}

// Pagination Setup
$limit = 4;

$notice_page = isset($_GET['notice_page']) ? (int)$_GET['notice_page'] : 1;
if ($notice_page < 1) $notice_page = 1;
$notice_offset = ($notice_page - 1) * $limit;
$total_notices = $conn->query("SELECT COUNT(*) as total FROM notices WHERE type='notice'")->fetch_assoc()['total'];
$total_notice_pages = ceil($total_notices / $limit);
$notices = $conn->query("SELECT * FROM notices WHERE type='notice' ORDER BY uploaded_at DESC LIMIT $limit OFFSET $notice_offset");

$act_page = isset($_GET['act_page']) ? (int)$_GET['act_page'] : 1;
if ($act_page < 1) $act_page = 1;
$act_offset = ($act_page - 1) * $limit;
$total_acts = $conn->query("SELECT COUNT(*) as total FROM notices WHERE type='act'")->fetch_assoc()['total'];
$total_act_pages = ceil($total_acts / $limit);
$acts = $conn->query("SELECT * FROM notices WHERE type='act' ORDER BY uploaded_at DESC LIMIT $limit OFFSET $act_offset");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notices & Acts Management</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include '../sidebar/sidebar1.php'; ?>

<div class="main-content">
    <div class="header">
        <p>Hello, <?= htmlspecialchars($_SESSION['admin']); ?></p>
        <a href="../logout.php">Logout</a>
    </div>

    <h2>Notices & Acts Management</h2><br><br>

    <div class="tab-buttons">
        <button class="tab-btn active" data-target="notice-tab">Notices</button>
        <button class="tab-btn" data-target="act-tab">Acts</button>
    </div>

    <!-- Notices Tab -->
    <div id="notice-tab" class="tab-content active">
        <div class="form-box">
            <h3>Add Notice</h3>
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="image" required>
                <textarea name="description" rows="3" placeholder="Notice description..." required></textarea>
                <input type="hidden" name="type" value="notice">
                <button type="submit">Add Notice</button>
            </form>
        </div>

        <table>
            <thead>
            <tr>
                <th>File</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $notices->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?php
                        $file_path = "uploads/" . $row['file'];
                        $ext = strtolower(pathinfo($row['file'], PATHINFO_EXTENSION));
                        if ($ext === 'pdf'): ?>
                            <a href="<?= $file_path; ?>" target="_blank" class="btn-primary">View PDF</a>
                        <?php else: ?>
                            <a href="<?= $file_path; ?>" target="_blank">
                                <img src="<?= $file_path; ?>" class="thumb" alt="Notice">
                            </a>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['description']); ?></td>
                    <td class="action-btns">
                        <a href="edit_notice.php?id=<?= $row['id']; ?>" class="edit-btn">Edit</a>
                        <a href="notices.php?delete=<?= $row['id']; ?>" class="delete-btn" onclick="return confirm('Delete this notice?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Notices Pagination -->
        <?php if ($total_notice_pages > 1): ?>
            <div class="pagination">
                <?php
                if ($notice_page > 1) {
                    echo '<a href="notices.php?notice_page=' . ($notice_page - 1) . '" class="page-btn">« Prev</a>';
                } else {
                    echo '<span class="page-btn disabled">« Prev</span>';
                }

                for ($i = 1; $i <= $total_notice_pages; $i++) {
                    $active = ($i == $notice_page) ? 'active' : '';
                    echo '<a href="notices.php?notice_page=' . $i . '" class="page-btn ' . $active . '">' . $i . '</a>';
                }

                if ($notice_page < $total_notice_pages) {
                    echo '<a href="notices.php?notice_page=' . ($notice_page + 1) . '" class="page-btn">Next »</a>';
                } else {
                    echo '<span class="page-btn disabled">Next »</span>';
                }
                ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Acts Tab -->
    <div id="act-tab" class="tab-content">
        <div class="form-box">
            <h3>Add Act</h3>
            <form method="post">
                <input type="text" name="description" placeholder="Enter Title..." required>
                <input type="url" name="link" placeholder="Enter PDF Link (e.g., https://example.com/file.pdf)" required>
                <input type="hidden" name="type" value="act">
                <button type="submit">Add Act</button>
            </form>
        </div>

        <table>
            <thead>
            <tr>
                <th>PDF Link</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $acts->fetch_assoc()): ?>
                <tr>
                    <td>
                        <a href="<?= htmlspecialchars($row['file']); ?>" target="_blank" class="btn-primary">View PDF</a>
                    </td>
                    <td><?= htmlspecialchars($row['description']); ?></td>
                    <td class="action-btns">
                        <a href="edit_notice.php?id=<?= $row['id']; ?>" class="edit-btn">Edit</a>
                        <a href="notices.php?delete=<?= $row['id']; ?>" class="delete-btn" onclick="return confirm('Delete this act?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Acts Pagination -->
        <?php if ($total_act_pages > 1): ?>
            <div class="pagination" style="margin-top: 20px;">
                <?php
                if ($act_page > 1) {
                    echo '<a href="notices.php?act_page=' . ($act_page - 1) . '" class="page-btn">« Prev</a>';
                } else {
                    echo '<span class="page-btn disabled">« Prev</span>';
                }

                for ($i = 1; $i <= $total_act_pages; $i++) {
                    $active = ($i == $act_page) ? 'active' : '';
                    echo '<a href="notices.php?act_page=' . $i . '" class="page-btn ' . $active . '">' . $i . '</a>';
                }

                if ($act_page < $total_act_pages) {
                    echo '<a href="notices.php?act_page=' . ($act_page + 1) . '" class="page-btn">Next »</a>';
                } else {
                    echo '<span class="page-btn disabled">Next »</span>';
                }
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    const tabButtons = document.querySelectorAll('.tab-btn');
    const contents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            tabButtons.forEach(b => b.classList.remove('active'));
            contents.forEach(c => c.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById(btn.dataset.target).classList.add('active');
        });
    });

    const url = new URL(window.location.href);
    if (url.searchParams.has('act_page')) {
        document.querySelector('.tab-btn[data-target="notice-tab"]').classList.remove('active');
        document.querySelector('.tab-btn[data-target="act-tab"]').classList.add('active');
        document.getElementById('notice-tab').classList.remove('active');
        document.getElementById('act-tab').classList.add('active');
    }
</script>

</body>
</html>

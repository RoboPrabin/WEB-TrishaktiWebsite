<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

// Handle upload
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['upload'])) {
    $form_name = $_POST['form_name'];
    $file = "";

    if (!empty($_FILES['file']['name']) && pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) === 'pdf') {
        $file = time() . "_" . basename($_FILES['file']['name']);
        $uploadPath = __DIR__ . "/uploads/" . $file;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
            $stmt = $conn->prepare("INSERT INTO downloads (form_name, file, uploaded_at) VALUES (?, ?, NOW())");
            $stmt->bind_param("ss", $form_name, $file);
            $stmt->execute();
            $_SESSION['message'] = "Upload successful!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to upload file.";
            $_SESSION['message_type'] = "error";
        }
    } else {
        $_SESSION['message'] = "Only PDF files allowed.";
        $_SESSION['message_type'] = "error";
    }

    header("Location: downloads.php");
    exit();
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $result = $conn->query("SELECT file FROM downloads WHERE id = $id");
    if ($row = $result->fetch_assoc()) {
        $filepath = __DIR__ . "/uploads/" . $row['file'];
        if (file_exists($filepath)) unlink($filepath);
    }

    $conn->query("DELETE FROM downloads WHERE id = $id");
    $_SESSION['message'] = "Form deleted successfully!";
    $_SESSION['message_type'] = "success";

    header("Location: downloads.php");
    exit();
}

// Pagination
$limit = 8;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Total count
$total_result = $conn->query("SELECT COUNT(*) as total FROM downloads");
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);

// Fetch downloads
$stmt = $conn->prepare("SELECT * FROM downloads ORDER BY uploaded_at DESC LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Downloads Management</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
    <style>

    </style>
</head>
<body>
<?php include '../sidebar/sidebar1.php'; ?>
<div class="main-content">
    <div class="header">
        <p>Hello, <?= $_SESSION['admin']; ?></p>
        <a href="../logout.php" class="btn" style="background: #6c757d;">Logout</a>
    </div>

    <h2>Downloads Management</h2> <br>

    <!-- Show success/error messages -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert <?= $_SESSION['message_type'] === 'success' ? 'alert-success' : 'alert-error'; ?>">
            <?= $_SESSION['message']; ?>
        </div>
        <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
    <?php endif; ?>

    <div class="form-box">
        <h3>Upload New Download Form (PDF only)</h3>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="form_name" placeholder="Form Name" required>
            <input type="file" name="file" accept=".pdf" required>
            <button type="submit" name="upload" class="btn" style="background: #007bff;">Upload</button>
        </form>
    </div>

    <table>
        <thead>
        <tr>
            <th>Form</th>
            <th>View</th>
            <th>Download</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['form_name']); ?></td>
                <td><a href="uploads/<?= $row['file']; ?>" target="_blank" class="btn view-btn">View</a></td>
                <td><a href="uploads/<?= $row['file']; ?>" download class="btn download-btn">Download</a></td>
                <td class="action-btns">
                    <a href="edit_download.php?id=<?= $row['id']; ?>" class="btn edit-btn">Edit</a>
                    <a href="#" onclick="confirmDelete(<?= $row['id']; ?>)" class="btn delete-btn">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>


<!-- Pagination -->
<div class="pagination" style="margin-top: 20px; text-align: center;">
    <?php
    if ($total_pages > 1):
        $range = 2; // how many pages to show around current
        $dot_shown = false;

        // Prev button
        if ($page > 1) {
            echo '<a href="?page=' . ($page - 1) . '" class="prev-next">« Prev</a>';
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
        if ($page < $total_pages) {
            echo '<a href="?page=' . ($page + 1) . '" class="prev-next">Next »</a>';
        }
    endif;
    ?>
</div>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to delete this form!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "downloads.php?delete=" + id;
        }
    })
}
</script>

</body>
</html>

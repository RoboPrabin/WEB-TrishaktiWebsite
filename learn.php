<?php
require_once "admin/db.php"; // Adjust if needed

// Pagination
$items_per_page = 2;
$type = isset($_GET['type']) ? $_GET['type'] : 'research';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Total count
$total_query = $conn->prepare("SELECT COUNT(*) FROM learn WHERE type = ?");
$total_query->bind_param("s", $type);
$total_query->execute();
$total_query->bind_result($total_items);
$total_query->fetch();
$total_query->close();

$total_pages = ceil($total_items / $items_per_page);

// Fetch current page items
$stmt = $conn->prepare("SELECT * FROM learn WHERE type = ? ORDER BY created_at DESC LIMIT ?, ?");
$stmt->bind_param("sii", $type, $offset, $items_per_page);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Learning Materials - Trishakti Securities</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        td img {
            max-width: 80px;
            height: auto;
        }
        .action-buttons a {
            margin-right: 5px;
        }
    </style>
</head>

<body>

<?php include 'headfoot/header.php'; ?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5">
    <div class="container">
        <h1 class="display-3 mb-4">Learning Materials</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Learning Materials</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Main Content Start -->
<div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            <div class="list-group sticky-top" style="top: 20px;">
                <a href="?type=research" class="list-group-item list-group-item-action <?= $type === 'research' ? 'active' : '' ?>">
                    Research Paper
                </a>
                <a href="?type=education" class="list-group-item list-group-item-action <?= $type === 'education' ? 'active' : '' ?>">
                    Education Materials
                </a>
                <a href="?type=library" class="list-group-item list-group-item-action <?= $type === 'library' ? 'active' : '' ?>">
                    Library
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="col-md-9">
            <div class="table-responsive shadow-sm">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Sn.</th>
                            <th>Preview</th>
                            <th>Title</th>
                            <th>Source</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): $i = $offset + 1; ?>
                            <?php while ($row = $result->fetch_assoc()): 
                                $file_path = 'admin/learn/uploads/' . htmlspecialchars($row['image']);
                                $file_ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
                                $is_pdf = ($file_ext === 'pdf');
                            ?>
                                <tr class="align-middle text-center">
                                    <td><?= $i++; ?></td>
                                    <td>
                                        <?php if ($is_pdf): ?>
                                            <img src="img/pdf-icon.png" alt="PDF">
                                        <?php else: ?>
                                            <img src="<?= $file_path; ?>" alt="Image">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($row['title']); ?></td>
                                    <td><?= htmlspecialchars($row['source']); ?></td>
                                    <td class="action-buttons">
                                        <a href="<?= $file_path; ?>" target="_blank" class="btn btn-primary btn-sm">
                                            View
                                        </a>
                                        <a href="<?= $file_path; ?>" download class="btn btn-success btn-sm">
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No entries found for <?= htmlspecialchars(ucfirst($type)); ?>.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mt-4">
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?type=<?= urlencode($type); ?>&page=<?= $page - 1; ?>">« Prev</a>
                            </li>
                        <?php endif; ?>

                        <?php
                        $range = 1;
                        $dot_shown = false;
                        for ($i = 1; $i <= $total_pages; $i++):
                            if (
                                $i == 1 ||
                                $i == 2 ||
                                $i == $total_pages ||
                                $i == $total_pages - 1 ||
                                ($i >= $page - $range && $i <= $page + $range)
                            ):
                        ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?type=<?= urlencode($type); ?>&page=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                            <?php $dot_shown = false; ?>
                        <?php elseif (!$dot_shown): ?>
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php $dot_shown = true; ?>
                        <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?type=<?= urlencode($type); ?>&page=<?= $page + 1; ?>">Next »</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
            <!-- Pagination End -->
        </div>
    </div>
</div>
<!-- Main Content End -->

<?php include 'headfoot/footer.php'; ?>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>

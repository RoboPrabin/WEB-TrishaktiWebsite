<?php
require_once "../admin/db.php";

$limit = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Get total notices (all types: image/pdf)
$count_result = $conn->query("SELECT COUNT(*) as total FROM notices WHERE type='notice'");
$count_row = $count_result->fetch_assoc();
$total_pages = ceil($count_row['total'] / $limit);

// Fetch notices
$sql = "SELECT * FROM notices WHERE type='notice' ORDER BY uploaded_at DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<?php include "../headfoot/header1.php"; ?>

<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-4 animated slideInDown">Notices</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Notices</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th scope="col">Sn.</th>
                    <th scope="col">Description</th>
                    <th scope="col">Preview</th>
                    <th scope="col">Posted On</th>
                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php $serial = $offset + 1; ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <?php
                        $fileName = basename($row['file']);
                        $fileUrl = "../admin/notices/uploads/" . rawurlencode($fileName);
                        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                        ?>
                        <tr>
                            <td class="text-center"><?= $serial++; ?></td>
                            <td><?= nl2br(htmlspecialchars($row['description'])); ?></td>
                            <td class="text-center">
                                <?php if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                    <img src="<?= $fileUrl ?>" alt="Notice Image" style="max-height: 80px;">
                                <?php elseif ($fileExtension === 'pdf'): ?>
                                    <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Unknown</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?= date("F j, Y", strtotime($row['uploaded_at'])); ?></td>
                            <td class="text-center">
                                <a href="<?= $fileUrl ?>" target="_blank" class="btn btn-sm btn-primary">
                                    View
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No notices found.</td>
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
                    <a class="page-link" href="?page=<?= $page - 1 ?>">« Prev</a>
                </li>
            <?php endif; ?>

            <?php
            $range = 1; // Number of pages to show around current page
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
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
                <?php $dot_shown = false; ?>
            <?php elseif (!$dot_shown): ?>
                <li class="page-item disabled"><span class="page-link">...</span></li>
                <?php $dot_shown = true; ?>
            <?php endif; ?>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1 ?>">Next »</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>

</div>
<?php include "../headfoot/footer1.php"; ?>
</body>
</html>

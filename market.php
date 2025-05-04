<?php
require_once "admin/db.php";

// Pagination setup
$limit = 2;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Get total count
$total_result = $conn->query("SELECT COUNT(*) as total FROM market");
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);

// Fetch paginated data
$sql = "SELECT * FROM market ORDER BY uploaded_at DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'headfoot/header.php'; ?>

<!-- Floating Learn Icon -->
<div class="floating-icon learn" onclick="window.location.href='learn.php';">
    📚
    <span class="icon-label">Learn</span>
</div>

<!-- Page Header -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-4 animated slideInDown">Market Summary</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Market Summary</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Market Summary Section -->
<div class="container py-5">
    <h1 class="mb-5 text-center">Market Summary</h1>
    <div class="row g-5">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card shadow-sm border-0 w-100 d-flex flex-row align-items-start">
                        <img 
                            src="admin/market/uploads/<?= htmlspecialchars($row['image']); ?>" 
                            alt="Market Image" 
                            style="width: 50%; height: auto; object-fit: cover;" 
                            class="img-fluid"
                        >
                        <div class="card-body" style="width: 50%;">
                            <h5 class="card-title"><?= htmlspecialchars($row['summary']); ?></h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($row['description'])); ?></p>
                            <div class="card-footer text-muted small p-0 mt-3">
                                Posted on <?= date("F j, Y", strtotime($row['uploaded_at'])); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No market summaries available at the moment.</p>
        <?php endif; ?>
    </div>

<!-- Pagination -->
<!-- Pagination -->
<?php if ($total_pages > 1): ?>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center mt-5">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1; ?>">« Prev</a>
                </li>
            <?php endif; ?>

            <?php
            $range = 1; // Pages around current
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
                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                </li>
                <?php $dot_shown = false; ?>
            <?php elseif (!$dot_shown): ?>
                <li class="page-item disabled"><span class="page-link">...</span></li>
                <?php $dot_shown = true; ?>
            <?php endif; ?>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1; ?>">Next »</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
<!-- Pagination End -->


</div>

<?php include 'headfoot/footer.php'; ?>
</body>
</html>

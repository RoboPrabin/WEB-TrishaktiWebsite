<?php
require_once "admin/db.php"; // Adjust path if needed

// Pagination setup
$limit = 6; // items per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Total count
$total_result = $conn->query("SELECT COUNT(*) as total FROM news");
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);

// Fetch paginated news
$sql = "SELECT * FROM news ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<?php include "headfoot/header.php"; ?>

<!-- Page Header -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-4 animated slideInDown">News and Articles</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">News and Articles</li>
            </ol>
        </nav>
    </div>
</div>


  <div class="text-center">
    <h1 class="display-5 font-weight-bold">Latest News and Article</h1>
  </div>

<!-- News Section -->
<div class="container py-5">
    <div class="row g-4">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="admin/news/uploads/<?= htmlspecialchars($row['image']); ?>" class="card-img-top" alt="News Image" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['title']); ?></h5>
                            <p class="text-muted small"><?= htmlspecialchars($row['category']); ?></p>
                            <?php if (!empty($row['link'])): ?>
                                <a href="<?= htmlspecialchars($row['link']); ?>" class="btn btn-primary btn-sm" target="_blank">Read More</a>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer text-muted small">
                            Posted on <?= date("F j, Y", strtotime($row['created_at'])); ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No news and articles available at the moment.</p>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
        <nav class="mt-5">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $page - 1; ?>">Previous</a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $page + 1; ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<?php include "headfoot/footer.php"; ?>
</body>
</html>

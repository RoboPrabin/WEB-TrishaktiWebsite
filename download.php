<?php
// Database connection
require_once "admin/db.php"; // Adjust path if this file is placed elsewhere

// Pagination settings
$items_per_page = 7; // How many downloads per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $items_per_page;

// Fetch total number of downloads
$total_sql = "SELECT COUNT(*) AS total FROM downloads";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);
$total_downloads = $total_row['total'];
$total_pages = ceil($total_downloads / $items_per_page);

// Fetch downloads for current page
$sql = "SELECT * FROM downloads ORDER BY uploaded_at DESC LIMIT $offset, $items_per_page";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'headfoot/header.php'; ?>

<!-- Floating Learn Icon (Left) -->
<div class="floating-icon learn" onclick="window.location.href='learn.php';">
  📚
  <span class="icon-label">Learn</span>
</div>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-4 animated slideInDown">Downloads</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Downloads</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<div class="container my-5 py-5">
  <div class="text-center my-5 py-5">
    <h1 class="display-4 font-weight-bold">Download Resources</h1>
    <p class="lead downn">Access our valuable resources below</p>
  </div>

  <div class="container downloads-list">
    <h2 class="text-center mb-4">Available Downloads</h2>

    <div class="row">
      <div class="col-12">
        <?php if (mysqli_num_rows($result) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <?php
              $form_name = htmlspecialchars($row['form_name']);
              $file = htmlspecialchars($row['file']);
              $file_url = "admin/downloads/uploads/" . $file;
            ?>
            <!-- Resource Card -->
            <div class="card shadow-sm border-light rounded mb-4">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-lg-6 col-md-6 col-sm-12 mb-2 mb-md-0">
                    <h5 class="card-title mb-0"><?= $form_name; ?></h5>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-wrap justify-content-lg-end justify-content-md-end justify-content-start gap-2">
                    <a href="<?= $file_url; ?>" class="btn btn-outline-dark btn-lg" style="min-width: 130px;" target="_blank">View</a>
                    <a href="<?= $file_url; ?>" class="btn btn-primary btn-lg" style="min-width: 130px;" download>Download</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="text-center">No download resources available at the moment.</p>
        <?php endif; ?>
      </div>
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
          $range = 1; // Pages shown around current
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
    <!-- Pagination End -->

  </div>
</div>

<?php include 'headfoot/footer.php'; ?>

</body>
</html>

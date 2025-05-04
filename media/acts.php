<?php
require_once "../admin/db.php";

$limit = 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Get total acts with PDF links
$count_result = $conn->query("SELECT COUNT(*) as total FROM notices WHERE type='act' AND file LIKE '%.pdf'");
$count_row = $count_result->fetch_assoc();
$total_pages = ceil($count_row['total'] / $limit);

// Fetch paginated acts
$sql = "SELECT * FROM notices WHERE type='act' AND file LIKE '%.pdf' ORDER BY uploaded_at DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<?php include "../headfoot/header1.php"; ?>

<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-4 animated slideInDown">Acts</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Acts</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>Sn.</th>
                    <th>Title</th>
                    <th>Posted On</th>
                    <th>View PDF</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php $serial = $offset + 1; ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="text-center"><?= $serial++; ?></td>
                            <td><?= htmlspecialchars($row['description']); ?></td>
                            <td class="text-center"><?= date("F j, Y", strtotime($row['uploaded_at'])); ?></td>
                            <td class="text-center">
                                <a href="<?= htmlspecialchars($row['file']); ?>" target="_blank" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No Acts found.</td>
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
                $dot_shown = false;
                for ($i = 1; $i <= $total_pages; $i++) {
                    if (
                        $i == 1 || 
                        $i == $total_pages || 
                        ($i >= $page - 1 && $i <= $page + 1)
                    ) {
                        $active = ($i == $page) ? 'active' : '';
                        echo '<li class="page-item ' . $active . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                        $dot_shown = false;
                    } else {
                        if (!$dot_shown) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            $dot_shown = true;
                        }
                    }
                }
                ?>

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

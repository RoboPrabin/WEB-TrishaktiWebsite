<?php
require_once "../admin/db.php"; // Adjust path if needed

$sql = "SELECT * FROM gallery ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
$images = [];
while ($row = $result->fetch_assoc()) {
    $images[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include "../headfoot/header1.php"; ?>
       
 <!-- Page Header Start -->
 <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-4 animated slideInDown">Gallery</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>

                    <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

<!-- GALLERY CONTAINER -->
<div class="gallery-container">
    <!-- Filter Buttons -->
    <div class="filter-buttons">
        <button class="filter-btn active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="event">Event</button>
        <button class="filter-btn" data-filter="office">Office</button>
        <button class="filter-btn" data-filter="client">Client</button>
    </div>

    <!-- Image Grid -->
    <div class="gallery-grid" id="galleryGrid">
        <?php foreach ($images as $img): ?>
            <div class="gallery-item" data-category="<?= htmlspecialchars($img['category']); ?>" data-title="<?= htmlspecialchars($img['description']); ?>">
                <img src="../admin/gallery/uploads/<?= $img['image']; ?>" alt="<?= htmlspecialchars($img['description']); ?>" />
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Pagination -->
<div id="pagination" style="text-align: center; margin-top: 20px;"></div>


<!-- Lightbox -->
<div class="lightbox" id="lightbox">
    <span class="lightbox-close" id="lightbox-close">&times;</span>
    <img src="" alt="Full Image" id="lightbox-img" />
    <div class="lightbox-controls">
        <button id="prevImg">←</button>
        <button id="nextImg">→</button>
    </div>
</div>



<script>
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = Array.from(document.querySelectorAll('.gallery-item'));
    const itemsPerPage = 8;
    let currentCategory = 'all';
    let currentPage = 1;
    let filteredItems = [];

    // Filter gallery items
    function filterItems() {
        return currentCategory === 'all'
            ? galleryItems
            : galleryItems.filter(item => item.dataset.category === currentCategory);
    }

    // Render pagination buttons (with smart dots)
    function renderPagination(totalPages) {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    const range = 1; // Number of pages around current page
    let dotShown = false;

    if (currentPage > 1) {
        const prevBtn = document.createElement('button');
        prevBtn.textContent = '« Prev';
        prevBtn.addEventListener('click', () => {
            currentPage--;
            renderGallery();
        });
        pagination.appendChild(prevBtn);
    }

    for (let i = 1; i <= totalPages; i++) {
        if (
            i === 1 ||
            i === 2 ||
            i === totalPages ||
            i === totalPages - 1 ||
            (i >= currentPage - range && i <= currentPage + range)
        ) {
            const btn = document.createElement('button');
            btn.textContent = i;
            if (i === currentPage) btn.classList.add('active-page');
            btn.addEventListener('click', () => {
                currentPage = i;
                renderGallery();
            });
            pagination.appendChild(btn);
            dotShown = false;
        } else if (!dotShown) {
            const dots = document.createElement('span');
            dots.textContent = '...';
            dots.style.margin = '0 5px';
            pagination.appendChild(dots);
            dotShown = true;
        }
    }

    if (currentPage < totalPages) {
        const nextBtn = document.createElement('button');
        nextBtn.textContent = 'Next »';
        nextBtn.addEventListener('click', () => {
            currentPage++;
            renderGallery();
        });
        pagination.appendChild(nextBtn);
    }
}

    // Render gallery and setup lightbox for visible items
    function renderGallery() {
        filteredItems = filterItems();
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        galleryItems.forEach(item => item.style.display = 'none');
        const visibleItems = filteredItems.slice(start, end);
        visibleItems.forEach(item => item.style.display = 'block');

        renderPagination(Math.ceil(filteredItems.length / itemsPerPage));
        setupLightboxListeners(visibleItems);
    }

    // Handle filter buttons
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentCategory = btn.dataset.filter;
            currentPage = 1;
            renderGallery();
        });
    });

    // Lightbox functionality
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    let currentIndex = -1;

    function setupLightboxListeners(visibleItems) {
        visibleItems.forEach((item, index) => {
            item.onclick = () => {
                currentIndex = filteredItems.indexOf(item); // Get index from full filtered list
                lightboxImg.src = item.querySelector('img').src;
                lightbox.style.display = 'flex';
            };
        });
    }

    document.getElementById("lightbox-close").addEventListener('click', () => {
        lightbox.style.display = 'none';
    });

    document.getElementById("prevImg").addEventListener('click', () => {
        if (filteredItems.length === 0) return;
        currentIndex = (currentIndex - 1 + filteredItems.length) % filteredItems.length;
        lightboxImg.src = filteredItems[currentIndex].querySelector('img').src;
    });

    document.getElementById("nextImg").addEventListener('click', () => {
        if (filteredItems.length === 0) return;
        currentIndex = (currentIndex + 1) % filteredItems.length;
        lightboxImg.src = filteredItems[currentIndex].querySelector('img').src;
    });

    // Initial render
    renderGallery();
</script>


<?php include "../headfoot/footer1.php"; ?>

</body>
</html>

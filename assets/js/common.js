// Function to fetch data from an API and cache it
async function fetchDataAndCache(apiUrl, cacheDuration = 60 * 1000) {
    const cacheKey = `${apiUrl}_cache`;
    const cachedData = localStorage.getItem(cacheKey);

    if (cachedData) {
        return JSON.parse(cachedData);
    } else {
        try {
            const response = await fetch(apiUrl);
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

            const data = await response.json();
            localStorage.setItem(cacheKey, JSON.stringify(data));

            setTimeout(() => {
                localStorage.removeItem(cacheKey);
            }, cacheDuration);

            return data;
        } catch (error) {
            console.error('Error fetching data:', error);
            throw error;
        }
    }
}

// Content binding
const contentContainer = document.getElementById('contentContainer');
// const footerContainer = document.getElementById('footerContainer');

// Function to bind content to containers
function bindDataToContainer(data) {
    data.forEach(function (obj) {
        var txt = document.createElement("textarea");
        txt.innerHTML = obj.LongTitle;
        contentContainer.innerHTML = txt.value;

        // var txtFooter = document.createElement("textarea");
        // txtFooter.innerHTML = obj.Footer;
        // footerContainer.innerHTML = txtFooter.value;
    });
}

// Function to format image URLs properly
function formatImageUrl(imagePath) {
    if (!imagePath) return null;

    let formattedUrl = imagePath.replace(/\\/g, "/"); // Convert backslashes to forward slashes

    if (!formattedUrl.startsWith("http")) {
        formattedUrl = `https://astercms.azurewebsites.net${formattedUrl}`;
    }

    return formattedUrl;
}

// Function to fetch and bind popups
async function bindPopupsToContainer(data) {
    let currentIndex = 0;

    async function showPopup() {
        if (currentIndex >= data.length) return; // Stop if no more popups

        const popup = data[currentIndex];
        if (!popup) return;

        try {
            // Fetch detailed popup content
            const popupDetailApiUrl = `https://astercms.azurewebsites.net/Cms/PageContents/GetPopupContent?Id=${popup.Id}`;
            const popupDetail = await fetchDataAndCache(popupDetailApiUrl);

            // Update modal content
            if (popupDetail.ShortTitle) {
                document.getElementById('popupContainerTitle').innerText = popupDetail.ShortTitle;
            }

            if (popupDetail.LongTitle) {
                var longTitleTxt = document.createElement("textarea");
                longTitleTxt.innerHTML = popupDetail.LongTitle;
                document.getElementById('popupText').innerHTML = longTitleTxt.value;
            }

            // Handle images
            let imageUrl = formatImageUrl(popupDetail.LongTitleImage);

            // If no LongTitleImage, check PageCmsImages
            if (!imageUrl && popupDetail.PageCmsImages && popupDetail.PageCmsImages.length > 0) {
                imageUrl = formatImageUrl(popupDetail.PageCmsImages[0].ImageUrl);
            }

            if (imageUrl) {
                let imageContainer = document.createElement('img');
                imageContainer.setAttribute('src', imageUrl);
                imageContainer.setAttribute('class', 'img-fluid');
                imageContainer.setAttribute('alt', popupDetail.ShortTitle || "Popup Image");

                let popupImageDiv = document.getElementById('popupImage');
                popupImageDiv.innerHTML = ""; // Clear previous images
                popupImageDiv.appendChild(imageContainer);
            }

            // Show the modal
            var modal = new bootstrap.Modal(document.getElementById('popupContainer'));
            modal.show();

            // Listen for modal hide event to show the next popup
            modal._element.addEventListener("hidden.bs.modal", function modalHiddenHandler() {
                modal._element.removeEventListener("hidden.bs.modal", modalHiddenHandler);
                currentIndex++;
                showPopup(); // Show the next popup
            });
        } catch (error) {
            console.error("Error fetching popup details:", error);
            currentIndex++;
            showPopup(); // Skip this popup and continue
        }
    }

    showPopup();
}

// Function to load content based on page
async function loadContent(page) {
    const apiUrl = `https://astercms.azurewebsites.net/api/PageContentsApi?id=17&SectionName=${page}`;

    try {
        const data = await fetchDataAndCache(apiUrl);
        bindDataToContainer(data);
    } catch (error) {
        console.error("Error loading page content:", error);
    }
}

// Function to load popups
async function loadPopups() {
    const popupApiUrl = 'https://astercms.azurewebsites.net/Cms/PageContents/FrontPopUpRead?branchId=200';

    try {
        const popupData = await fetchDataAndCache(popupApiUrl);
        bindPopupsToContainer(popupData);
    } catch (error) {
        console.error("Error loading popups:", error);
    }
}

// Example: Call these functions when needed
// loadContent('home');  // Load home page content
loadPopups();         // Load popups

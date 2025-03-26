async function fetchData(apiUrl) {
    try {
        const response = await fetch(apiUrl);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
        throw error;
    }
}

//fetch('https://astercms.azurewebsites.net/api/ProductCategories/WebsiteMenu/200')
//    .then(response => response.json())
//    .then(data => {
//        // Create the menu
//        createMenu(data, 'menu-container');
//    })
//    .catch(error => console.error('Error fetching data:', error));

// Function to create a menu item
function createMenuItem(item) {
    const li = document.createElement('li');
    li.className = item.Children && item.Children.length > 0 ? 'dropdown' : '';

    const a = document.createElement('a');
    a.href = item.Link || '#';
    a.textContent = item.Text || '';

    


    li.appendChild(a);

    

    if (item.Children && item.Children.length > 0) {
        a.href = '#';
        const ul = document.createElement('ul');
        item.Children.forEach(child => ul.appendChild(createMenuItem(child)));
        li.appendChild(ul);
        console.log(li.outerHTML);
    }
    return li;
}

// Function to create the main menu
async function createMenu() {
    const container = document.getElementById('menu-container');
    //const mobileContainer = document.getElementById('mobileMenu');
    const ul = document.createElement('ul');
    ul.className = 'main-menu__list'; // Add class to the ul element

    try {
        const menuData = await fetchData('https://astercms.azurewebsites.net/api/ProductCategories/WebsiteMenu/200');
        //const menuData = await fetchData('https://localhost:7024/api/ProductCategories/WebsiteMenu/200');
        menuData.forEach(item => ul.appendChild(createMenuItem(item)));
        container.appendChild(ul);
        if ($(".main-menu__list").length && $(".mobile-nav__container").length) {
            let navContent = document.querySelector(".main-menu__list").outerHTML;
            let mobileNavContainer = document.querySelector(".mobile-nav__container");
            mobileNavContainer.innerHTML = navContent;
        }
        if ($(".mobile-nav__container .main-menu__list").length) {
            let dropdownAnchor = $(
                ".mobile-nav__container .main-menu__list .dropdown > a"
            );
            dropdownAnchor.each(function () {
                let self = $(this);
                let toggleBtn = document.createElement("BUTTON");
                toggleBtn.setAttribute("aria-label", "dropdown toggler");
                toggleBtn.innerHTML = "<i class='fa fa-angle-down'></i>";
                self.append(function () {
                    return toggleBtn;
                });
                self.find("button").on("click", function (e) {
                    e.preventDefault();
                    let self = $(this);
                    self.toggleClass("expanded");
                    self.parent().toggleClass("expanded");
                    self.parent().parent().children("ul").slideToggle();
                });
            });
        }
        //mobileContainer.innerHTML = container.innerHTML;
    } catch (error) {
        console.error('Error creating menu:', error);
    }
}

// Function to create the main menu
//function createMenu(menuData, containerId) {

//    const container = document.getElementById(containerId);
//    const ul = document.createElement('ul');
//    ul.className = 'main-menu__list'; 

//    menuData.forEach(item => ul.appendChild(createMenuItem(item)));

//    container.appendChild(ul);
//}

// Function to create a menu item
//function createMenuItem(item) {
//    const li = document.createElement('li');
//    li.className = item.Children.length ? 'dropdown' : '';

//    const a = document.createElement('a');
//    a.href = item.Link || '#';
//    a.textContent = item.Text || '';

//    li.appendChild(a);

//    if (item.Children.length) {
//        const ul = document.createElement('ul');
//        item.Children.forEach(child => ul.appendChild(createMenuItem(child)));
//        li.appendChild(ul);
//    }

//    return li;
//}

//// Function to create the main menu
//function createMainMenuTest(menuData) {
//    const container = document.getElementById('menu');
//    const ul = document.createElement('ul');

//    menuData.forEach(item => ul.appendChild(createMenuItem(item)));

//    container.appendChild(ul);
//}

//async function createMenu() {
//    try {

//        const response = await fetch('https://astercms.azurewebsites.net/api/ProductCategories/WebsiteMenu/200');
//        const menuData = await response.json();

//        //const container = document.getElementById('menu');
//        const ul = document.getElementById('menu');
//        menuData.forEach(item => ul.appendChild(createMenuItem(item)));
//        ul.appendChild(ul);


//    } catch (error) {
//        console.error('Error fetching data from the API:', error);
//    }
//}



//async function createMenu() {
//    try {

//        const response = await fetch('https://astercms.azurewebsites.net/api/ProductCategories/WebsiteMenu/200');
//        const data = await response.json();

//        // Get the menu container
//        const menuContainer = document.getElementById('menu');

//        // Create menu items dynamically
//        data.forEach(item => {
//            const menuItem = document.createElement('li');
//            const link = document.createElement('a');
//            link.href = item.Link;
//            link.textContent = item.Text;
//            // Add event listener to set "current" class on click
//            link.addEventListener('click', function (event) {
//                //event.preventDefault();
//                removeCurrentClass();
//                menuItem.classList.add('current');
//            });

//            // Check if the item has subitems
//            if (item.subitems && item.subitems.length > 0) {
//                const subMenu = document.createElement('ul');

//                // Create subitems dynamically
//                item.subitems.forEach(subitem => {
//                    const subMenuItem = document.createElement('li');
//                    const subLink = document.createElement('a');
//                    subLink.href = subitem.Link;
//                    subLink.textContent = subitem.Text;

//                    // Add event listener to set "current" class on click
//                    subLink.addEventListener('click', function (event) {
//                        //event.preventDefault();
//                        removeCurrentClass();
//                        subMenuItem.classList.add('current');
//                    });

//                    subMenuItem.appendChild(subLink);

//                    // Check if subitem has nested subitems
//                    if (subitem.subitems && subitem.subitems.length > 0) {
//                        const nestedSubMenu = document.createElement('ul');

//                        // Create nested subitems dynamically
//                        subitem.subitems.forEach(nestedSubitem => {
//                            const nestedSubMenuItem = document.createElement('li');
//                            const nestedSubLink = document.createElement('a');

//                            // Add event listener to set "current" class on click
//                            nestedSubLink.addEventListener('click', function (event) {
//                                //event.preventDefault();
//                                removeCurrentClass();
//                                nestedSubMenuItem.classList.add('current');
//                            });

//                            nestedSubLink.href = nestedSubitem.Link;
//                            nestedSubLink.textContent = nestedSubitem.Text;
//                            nestedSubMenuItem.appendChild(nestedSubLink);

//                            // Append nested subitem to the nested submenu
//                            nestedSubMenu.appendChild(nestedSubMenuItem);
//                        });

//                        // Append the nested submenu to the subitem
//                        subMenuItem.appendChild(nestedSubMenu);
//                    }

//                    // Append subitem to the submenu
//                    subMenu.appendChild(subMenuItem);
//                });

//                // Append the submenu to the menu item
//                menuItem.appendChild(subMenu);
//            }

//            // Append the link to the menu item
//            menuItem.appendChild(link);

//            // Append the menu item to the menu container
//            menuContainer.appendChild(menuItem);
//        });
//    } catch (error) {
//        console.error('Error fetching data from the API:', error);
//    }
//}

//function removeCurrentClass() {
//    const menuItems = document.querySelectorAll('.main-menu__list li');
//    menuItems.forEach(item => {
//        item.classList.remove('current');
//    });
//}
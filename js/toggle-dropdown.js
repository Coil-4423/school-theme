// document.addEventListener('DOMContentLoaded', function() {
//     const menuItems = document.querySelectorAll('.nav__link ul li');
    
//     menuItems.forEach(function(item) {
//         item.addEventListener('click', function(event) {
//             const submenu = this.querySelector('ul');

//             if (submenu) {
//                 event.preventDefault(); // Prevent default link behavior
//                 submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
//             }
//         });
//     });
// });

// document.addEventListener('DOMContentLoaded', function() {
//     const menuLinks = document.querySelectorAll('.menu-item-has-children > a');

//     menuLinks.forEach(function(link) {
//         link.addEventListener('click', function(event) {
//             const linkWidth = link.offsetWidth; // Get the width of the link element
//             const clickPosition = event.offsetX; // Get the position of the click inside the link
            
//             // Assuming the arrow is on the right side, allow clicks only near the right edge (last 20px)
//             if (clickPosition > linkWidth - 20) { // Adjust 20 to the width of your arrow area
//                 event.preventDefault(); // Prevent navigation
//                 const submenu = this.nextElementSibling; // Get the next sibling <ul> (the submenu)
                
//                 if (submenu) {
//                     submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block'; // Toggle display
//                 }
//             }
//             // If the click is not near the arrow, let the link work normally
//         });
//     });
// });

//   document.addEventListener('DOMContentLoaded', function () {
//     // Select all menu items that have children
//     const menuItems = document.querySelectorAll('.menu-item-has-children > a');

//     // Loop through each menu item and add a span for the arrow
//     menuItems.forEach(menuItem => {
//       // Create the dropdown arrow
//       const arrow = document.createElement('span');
//       arrow.classList.add('dropdown-arrow');
//       arrow.innerHTML = '&#25BC'; // Downward arrow

//       // Insert the arrow after the link
//       menuItem.parentElement.insertBefore(arrow, menuItem.nextSibling);

//       // Add event listener to toggle the dropdown when arrow is clicked
//       arrow.addEventListener('click', function (event) {
//         event.preventDefault();
//         const parentLi = this.parentElement;

//         // Toggle the 'show' class to open/close the dropdown
//         parentLi.classList.toggle('show');

//         // Close other open dropdowns
//         document.querySelectorAll('.menu-item-has-children').forEach(item => {
//           if (item !== parentLi) {
//             item.classList.remove('show');
//           }
//         });
//       });
//     });

//     // Close the dropdown if clicking outside of it
//     document.addEventListener('click', function (event) {
//       if (!event.target.closest('.nav__link')) {
//         document.querySelectorAll('.menu-item-has-children').forEach(item => {
//           item.classList.remove('show');
//         });
//       }
//     });
//   });

document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.menu-item-has-children');

    menuItems.forEach(function(menuItem) {
        const link = menuItem.querySelector('a');
        let arrow = menuItem.querySelector('.dropdown-arrow');

        // If the arrow does not exist, create and append it
        if (!arrow) {
            arrow = document.createElement('span');
            arrow.classList.add('dropdown-arrow');
            link.parentNode.insertBefore(arrow, link.nextSibling); // Insert the arrow after the link
        }

        // Add click event listener to the arrow only
        arrow.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default behavior of the arrow
            const submenu = menuItem.querySelector('ul'); // Get the submenu (the <ul> element)
            
            // Toggle the display of the submenu
            if (submenu) {
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
            }
            
            // Optionally, toggle the arrow direction by adding/removing a class
            arrow.classList.toggle('open');
        });

        // Optional: If you want to add click behavior for the link itself
        link.addEventListener('click', function(event) {
            // Allow the link to work normally, or add any custom behavior here
        });
    });

    // Close submenus when clicking outside
    document.addEventListener('click', function(event) {
        // If the click is outside the menu and submenu, close all submenus
        if (!event.target.closest('.menu-item-has-children')) {
            document.querySelectorAll('.menu-item-has-children > ul').forEach(function(submenu) {
                submenu.style.display = 'none'; // Hide all submenus
            });

            // Remove 'open' class from all arrows
            document.querySelectorAll('.dropdown-arrow').forEach(function(arrow) {
                arrow.classList.remove('open');
            });
        }
    });
});



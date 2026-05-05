/**
 * Mobile Menu Toggle
 *
 * @package Clean_Theme
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.menu-toggle');
        const primaryMenu = document.querySelector('#primary-menu');
        
        if (!menuToggle || !primaryMenu) return;

        // Toggle menu on button click
        menuToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true' || false;
            
            this.setAttribute('aria-expanded', !isExpanded);
            primaryMenu.classList.toggle('active');
            this.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.main-navigation')) {
                menuToggle.setAttribute('aria-expanded', 'false');
                primaryMenu.classList.remove('active');
                menuToggle.classList.remove('active');
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && primaryMenu.classList.contains('active')) {
                menuToggle.setAttribute('aria-expanded', 'false');
                primaryMenu.classList.remove('active');
                menuToggle.classList.remove('active');
                menuToggle.focus();
            }
        });

        // Handle submenu toggles for mobile
        const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children');
        
        menuItemsWithChildren.forEach(function(item) {
            const link = item.querySelector('a');
            if (link) {
                link.addEventListener('click', function(e) {
                    // Only prevent default on mobile when submenu exists
                    if (window.innerWidth <= 768 && item.querySelector('.sub-menu')) {
                        // Check if already expanded
                        const isExpanded = item.classList.contains('toggled-on');
                        
                        // Close all other submenus
                        menuItemsWithChildren.forEach(function(otherItem) {
                            if (otherItem !== item) {
                                otherItem.classList.remove('toggled-on');
                                const otherSubmenu = otherItem.querySelector('.sub-menu');
                                if (otherSubmenu) {
                                    otherSubmenu.style.display = '';
                                }
                            }
                        });
                        
                        // Toggle current submenu
                        if (!isExpanded) {
                            item.classList.add('toggled-on');
                            const submenu = item.querySelector('.sub-menu');
                            if (submenu) {
                                e.preventDefault();
                                submenu.style.display = 'block';
                            }
                        } else {
                            item.classList.remove('toggled-on');
                            const submenu = item.querySelector('.sub-menu');
                            if (submenu) {
                                submenu.style.display = '';
                            }
                        }
                    }
                });
            }
        });

        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.innerWidth > 768) {
                    menuToggle.setAttribute('aria-expanded', 'false');
                    primaryMenu.classList.remove('active');
                    menuToggle.classList.remove('active');
                    
                    // Reset all submenus
                    menuItemsWithChildren.forEach(function(item) {
                        item.classList.remove('toggled-on');
                        const submenu = item.querySelector('.sub-menu');
                        if (submenu) {
                            submenu.style.display = '';
                        }
                    });
                }
            }, 250);
        });

    });

})();

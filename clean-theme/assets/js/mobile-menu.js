/**
 * Mobile Menu JavaScript
 * Handles hamburger menu toggle and animations
 *
 * @package Clean_Theme
 * @since 1.0.0
 */

(function() {
    'use strict';

    // DOM Elements
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenuPanel = document.querySelector('.mobile-menu-panel');
    const menuOverlay = document.querySelector('.menu-overlay');
    const body = document.body;

    // Check if elements exist
    if ( ! menuToggle || ! mobileMenuPanel ) {
        return;
    }

    /**
     * Toggle mobile menu
     */
    function toggleMenu() {
        const isActive = menuToggle.classList.contains('active');

        if ( isActive ) {
            closeMenu();
        } else {
            openMenu();
        }
    }

    /**
     * Open mobile menu
     */
    function openMenu() {
        menuToggle.classList.add('active');
        mobileMenuPanel.classList.add('active');
        
        if ( menuOverlay ) {
            menuOverlay.classList.add('active');
        }

        // Prevent body scroll when menu is open
        body.style.overflow = 'hidden';

        // Set aria-expanded
        menuToggle.setAttribute('aria-expanded', 'true');

        // Focus first menu item for accessibility
        const firstMenuItem = mobileMenuPanel.querySelector('a');
        if ( firstMenuItem ) {
            setTimeout(() => firstMenuItem.focus(), 300);
        }
    }

    /**
     * Close mobile menu
     */
    function closeMenu() {
        menuToggle.classList.remove('active');
        mobileMenuPanel.classList.remove('active');
        
        if ( menuOverlay ) {
            menuOverlay.classList.remove('active');
        }

        // Restore body scroll
        body.style.overflow = '';

        // Set aria-expanded
        menuToggle.setAttribute('aria-expanded', 'false');

        // Return focus to menu toggle
        menuToggle.focus();
    }

    /**
     * Handle keyboard navigation
     */
    function handleKeyboard(e) {
        // Close on Escape key
        if ( e.key === 'Escape' && mobileMenuPanel.classList.contains('active') ) {
            closeMenu();
        }
    }

    /**
     * Handle click outside menu
     */
    function handleOutsideClick(e) {
        if ( 
            mobileMenuPanel.classList.contains('active') &&
            ! mobileMenuPanel.contains(e.target) &&
            ! menuToggle.contains(e.target)
        ) {
            closeMenu();
        }
    }

    /**
     * Handle submenu toggle on mobile
     */
    function handleSubmenus() {
        const menuItemsWithChildren = mobileMenuPanel.querySelectorAll('.menu-item-has-children > a');

        menuItemsWithChildren.forEach((item) => {
            item.addEventListener('click', function(e) {
                const parent = this.parentElement;
                const submenu = parent.querySelector('.sub-menu');

                if ( submenu ) {
                    // Toggle submenu visibility
                    if ( submenu.style.display === 'block' ) {
                        submenu.style.display = 'none';
                    } else {
                        submenu.style.display = 'block';
                    }

                    // Prevent default link behavior if it's a #
                    if ( this.getAttribute('href') === '#' ) {
                        e.preventDefault();
                    }
                }
            });
        });
    }

    // Event Listeners
    menuToggle.addEventListener('click', toggleMenu);

    // Close on overlay click
    if ( menuOverlay ) {
        menuOverlay.addEventListener('click', closeMenu);
    }

    // Close on outside click
    document.addEventListener('click', handleOutsideClick);

    // Keyboard navigation
    document.addEventListener('keydown', handleKeyboard);

    // Handle submenus
    handleSubmenus();

    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            // Close menu if resizing to desktop
            if ( window.innerWidth >= 1024 && mobileMenuPanel.classList.contains('active') ) {
                closeMenu();
            }
        }, 250);
    });

    // Initialize aria attributes
    menuToggle.setAttribute('aria-expanded', 'false');
    menuToggle.setAttribute('aria-controls', 'mobile-menu-panel');
    menuToggle.setAttribute('aria-label', 'Toggle menu');

})();

/**
 * Mobile Menu JavaScript
 * Handles hamburger menu toggle, floating buttons, and animations with smooth transitions
 *
 * @package Clean_Theme
 * @since 1.0.0
 */

(function() {
    'use strict';

    // DOM Elements
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
    const mobileMenuPanel = document.querySelector('.mobile-menu-panel');
    const mobileMenuClose = document.querySelector('.mobile-menu-close');
    const floatingMenuBtn = document.querySelector('.floating-menu-btn');
    const scrollTopBtn = document.getElementById('scrollTopBtn');
    const feedbackButton = document.getElementById('feedbackButton');
    const feedbackPopup = document.getElementById('feedbackPopup');
    const body = document.body;
    
    let isMenuOpen = false;
    let isFeedbackOpen = false;
    let ticking = false;

    /**
     * Toggle mobile menu
     */
    function toggleMenu() {
        isMenuOpen = !isMenuOpen;
        
        if (menuToggle) {
            menuToggle.classList.toggle('active', isMenuOpen);
        }
        
        if (mobileMenuOverlay) {
            mobileMenuOverlay.classList.toggle('active', isMenuOpen);
        }
        
        // Handle body scroll
        body.style.overflow = isMenuOpen ? 'hidden' : '';
        
        // Hide/show FAB button
        if (floatingMenuBtn) {
            if (isMenuOpen) {
                floatingMenuBtn.classList.remove('visible');
                floatingMenuBtn.classList.add('active');
            } else {
                floatingMenuBtn.classList.remove('active');
                if (window.scrollY > 100) {
                    floatingMenuBtn.classList.add('visible');
                }
            }
        }
        
        // Update aria-expanded
        if (menuToggle) {
            menuToggle.setAttribute('aria-expanded', isMenuOpen.toString());
        }
    }

    /**
     * Close mobile menu
     */
    function closeMenu() {
        isMenuOpen = false;
        
        if (menuToggle) {
            menuToggle.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
        }
        
        if (mobileMenuOverlay) {
            mobileMenuOverlay.classList.remove('active');
        }
        
        body.style.overflow = '';
        
        if (floatingMenuBtn) {
            floatingMenuBtn.classList.remove('active');
            if (window.scrollY > 100) {
                floatingMenuBtn.classList.add('visible');
            }
        }
    }

    /**
     * Toggle feedback popup
     */
    function toggleFeedback() {
        isFeedbackOpen = !isFeedbackOpen;
        
        if (feedbackButton) {
            feedbackButton.classList.toggle('expanded', isFeedbackOpen);
        }
        
        if (feedbackPopup) {
            feedbackPopup.classList.toggle('active', isFeedbackOpen);
        }
        
        // Update aria-expanded
        if (feedbackButton) {
            feedbackButton.setAttribute('aria-expanded', isFeedbackOpen.toString());
        }
    }

    /**
     * Close feedback popup
     */
    function closeFeedback() {
        isFeedbackOpen = false;
        
        if (feedbackButton) {
            feedbackButton.classList.remove('expanded');
            feedbackButton.setAttribute('aria-expanded', 'false');
        }
        
        if (feedbackPopup) {
            feedbackPopup.classList.remove('active');
        }
    }

    /**
     * Handle scroll events with requestAnimationFrame
     */
    function handleScroll() {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                // Show/hide scroll to top button
                if (scrollTopBtn) {
                    if (window.scrollY > 300) {
                        scrollTopBtn.classList.add('visible');
                    } else {
                        scrollTopBtn.classList.remove('visible');
                    }
                }
                
                // Show/hide floating menu button (mobile only)
                if (floatingMenuBtn && window.innerWidth <= 960 && !isMenuOpen) {
                    if (window.scrollY > 100) {
                        floatingMenuBtn.classList.add('visible');
                    } else {
                        floatingMenuBtn.classList.remove('visible');
                    }
                }
                
                ticking = false;
            });
            
            ticking = true;
        }
    }

    /**
     * Smooth scroll to section
     */
    function scrollToSection(id) {
        const element = document.getElementById(id);
        if (element) {
            const offset = window.innerWidth <= 960 ? 70 : 80;
            const elementPosition = element.getBoundingClientRect().top + window.scrollY;
            const offsetPosition = elementPosition - offset;
            
            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
            
            closeMenu();
        }
    }

    // Event Listeners
    if (menuToggle) {
        menuToggle.addEventListener('click', toggleMenu);
    }

    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', closeMenu);
    }

    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', (e) => {
            if (e.target === mobileMenuOverlay) {
                closeMenu();
            }
        });
    }

    if (floatingMenuBtn) {
        floatingMenuBtn.addEventListener('click', toggleMenu);
    }

    if (scrollTopBtn) {
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Feedback button listener
    if (feedbackButton) {
        feedbackButton.addEventListener('click', toggleFeedback);
    }

    // Close feedback popup when clicking outside
    document.addEventListener('click', (e) => {
        if (isFeedbackOpen && 
            feedbackPopup && 
            !feedbackPopup.contains(e.target) && 
            !feedbackButton.contains(e.target)) {
            closeFeedback();
        }
    });

    // Scroll listener with passive option for better performance
    window.addEventListener('scroll', handleScroll, { passive: true });

    // Handle anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener('click', (e) => {
            const href = anchor.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                scrollToSection(href.substring(1));
            }
        });
    });

    // Close menu and feedback on ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (isMenuOpen) {
                closeMenu();
            }
            if (isFeedbackOpen) {
                closeFeedback();
            }
        }
    });

    // Handle resize
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024 && isMenuOpen) {
            closeMenu();
        }
    });

    // Initialize aria attributes for accessibility
    if (menuToggle) {
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.setAttribute('aria-label', 'Toggle menu');
    }

    if (feedbackButton) {
        feedbackButton.setAttribute('aria-expanded', 'false');
        feedbackButton.setAttribute('aria-label', 'Contact us');
    }

    if (scrollTopBtn) {
        scrollTopBtn.setAttribute('aria-label', 'Scroll to top');
    }

})();

/**
 * Floating Action Buttons (FAB) JavaScript
 * Handles expandable FAB with messenger, phone, and form buttons
 * 
 * @package Clean_Theme
 */

(function() {
    'use strict';

    // DOM Elements
    const callbackFabMain = document.getElementById('callbackFabMain');
    const fabList = document.getElementById('fabList');
    const scrollTopFab = document.getElementById('scrollTopFab');
    const fabFormBtn = document.getElementById('fabFormBtn');
    const feedbackModalOverlay = document.getElementById('feedbackModalOverlay');
    const feedbackModalClose = document.getElementById('feedbackModalClose');

    let isFabOpen = false;
    let ticking = false;

    /**
     * Toggle FAB list
     */
    function toggleFab() {
        isFabOpen = !isFabOpen;
        
        if (callbackFabMain) {
            callbackFabMain.classList.toggle('rotated', isFabOpen);
            callbackFabMain.setAttribute('aria-expanded', isFabOpen.toString());
        }
        
        if (fabList) {
            fabList.classList.toggle('active', isFabOpen);
        }
    }

    /**
     * Close FAB list
     */
    function closeFab() {
        isFabOpen = false;
        
        if (callbackFabMain) {
            callbackFabMain.classList.remove('rotated');
            callbackFabMain.setAttribute('aria-expanded', 'false');
        }
        
        if (fabList) {
            fabList.classList.remove('active');
        }
    }

    /**
     * Open feedback modal
     */
    function openFeedbackModal() {
        closeFab();
        
        if (feedbackModalOverlay) {
            feedbackModalOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Focus first input
            const firstInput = feedbackModalOverlay.querySelector('input');
            if (firstInput) {
                setTimeout(() => firstInput.focus(), 300);
            }
        }
    }

    /**
     * Close feedback modal
     */
    function closeFeedbackModal() {
        if (feedbackModalOverlay) {
            feedbackModalOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    /**
     * Handle scroll events
     */
    function handleScroll() {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                // Show/hide scroll to top button
                if (scrollTopFab) {
                    if (window.scrollY > 300) {
                        scrollTopFab.classList.add('visible');
                    } else {
                        scrollTopFab.classList.remove('visible');
                    }
                }
                
                ticking = false;
            });
            
            ticking = true;
        }
    }

    // Event Listeners
    if (callbackFabMain) {
        callbackFabMain.addEventListener('click', toggleFab);
    }

    // Form button opens modal
    if (fabFormBtn) {
        fabFormBtn.addEventListener('click', openFeedbackModal);
    }

    // Scroll to top
    if (scrollTopFab) {
        scrollTopFab.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Close modal on close button click
    if (feedbackModalClose) {
        feedbackModalClose.addEventListener('click', closeFeedbackModal);
    }

    // Close modal on overlay click
    if (feedbackModalOverlay) {
        feedbackModalOverlay.addEventListener('click', (e) => {
            if (e.target === feedbackModalOverlay) {
                closeFeedbackModal();
            }
        });
    }

    // Close FAB when clicking outside
    document.addEventListener('click', (e) => {
        if (isFabOpen && 
            fabList && 
            callbackFabMain &&
            !fabList.contains(e.target) && 
            !callbackFabMain.contains(e.target)) {
            closeFab();
        }
    });

    // Scroll listener
    window.addEventListener('scroll', handleScroll, { passive: true });

    // Close on ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (isFabOpen) {
                closeFab();
            }
            if (feedbackModalOverlay && feedbackModalOverlay.classList.contains('active')) {
                closeFeedbackModal();
            }
        }
    });

    // Handle form submission
    const feedbackForm = document.querySelector('.feedback-form');
    if (feedbackForm) {
        feedbackForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(feedbackForm);
            const data = Object.fromEntries(formData.entries());
            
            // Here you would typically send the data via AJAX
            // For now, just show a success message
            alert('Thank you! We will contact you shortly.');
            closeFeedbackModal();
            feedbackForm.reset();
        });
    }

})();

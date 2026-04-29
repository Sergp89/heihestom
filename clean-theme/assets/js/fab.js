/**
 * Floating Action Buttons (FAB) and Modal Functionality
 * 
 * @package Clean_Dental
 */

(function() {
    'use strict';

    // DOM Elements
    const callbackFabMain = document.getElementById('callbackFabMain');
    const fabList = document.getElementById('fabList');
    const fabFormBtn = document.getElementById('fabFormBtn');
    const feedbackModalOverlay = document.getElementById('feedbackModalOverlay');
    const feedbackModalClose = document.getElementById('feedbackModalClose');
    const scrollTopFab = document.getElementById('scrollTopFab');
    const fabContainer = document.querySelector('.fab-container');

    // Toggle FAB List
    if (callbackFabMain && fabList) {
        callbackFabMain.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            this.classList.toggle('active');
            fabList.classList.toggle('open');
        });

        // Close FAB list when clicking outside
        document.addEventListener('click', function(event) {
            if (!fabContainer.contains(event.target)) {
                callbackFabMain.setAttribute('aria-expanded', 'false');
                callbackFabMain.classList.remove('active');
                fabList.classList.remove('open');
            }
        });
    }

    // Open Feedback Modal
    if (fabFormBtn && feedbackModalOverlay) {
        fabFormBtn.addEventListener('click', function() {
            // Close FAB list first
            if (callbackFabMain) {
                callbackFabMain.setAttribute('aria-expanded', 'false');
                callbackFabMain.classList.remove('active');
            }
            if (fabList) {
                fabList.classList.remove('open');
            }
            
            // Open modal
            feedbackModalOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Focus first input for accessibility
            const firstInput = feedbackModalOverlay.querySelector('input');
            if (firstInput) {
                setTimeout(() => firstInput.focus(), 100);
            }
        });
    }

    // Close Feedback Modal
    if (feedbackModalClose && feedbackModalOverlay) {
        feedbackModalClose.addEventListener('click', function() {
            feedbackModalOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });

        // Close on overlay click
        feedbackModalOverlay.addEventListener('click', function(event) {
            if (event.target === this) {
                this.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && feedbackModalOverlay.classList.contains('active')) {
                feedbackModalOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    // Scroll to Top Button
    let ticking = false;
    
    function toggleScrollTopButton() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                if (window.scrollY > 300) {
                    scrollTopFab.classList.add('visible');
                } else {
                    scrollTopFab.classList.remove('visible');
                }
                ticking = false;
            });
            ticking = true;
        }
    }

    if (scrollTopFab) {
        window.addEventListener('scroll', toggleScrollTopButton, { passive: true });
        
        scrollTopFab.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Handle Form Submission
    const feedbackForm = document.querySelector('.feedback-form');
    if (feedbackForm) {
        feedbackForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());
            
            // Here you would typically send the data via AJAX
            // For now, we'll just show a success message
            const submitBtn = this.querySelector('.submit-btn');
            const originalText = submitBtn.textContent;
            
            submitBtn.textContent = cleanDentalVars?.sendingText || 'Sending...';
            submitBtn.disabled = true;
            
            // Simulate AJAX request (replace with actual AJAX call)
            setTimeout(() => {
                submitBtn.textContent = cleanDentalVars?.sentText || 'Sent!';
                submitBtn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                
                // Reset form
                this.reset();
                
                // Close modal after delay
                setTimeout(() => {
                    feedbackModalOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                    
                    // Reset button
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                    submitBtn.style.background = '';
                }, 2000);
            }, 1000);
        });
    }

    // Keyboard navigation for FAB items
    if (fabList) {
        const fabItems = fabList.querySelectorAll('.fab-item');
        
        fabItems.forEach((item, index) => {
            item.addEventListener('keydown', function(event) {
                if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
                    event.preventDefault();
                    let nextIndex;
                    
                    if (event.key === 'ArrowDown') {
                        nextIndex = (index + 1) % fabItems.length;
                    } else {
                        nextIndex = (index - 1 + fabItems.length) % fabItems.length;
                    }
                    
                    fabItems[nextIndex].focus();
                }
            });
        });
    }

})();

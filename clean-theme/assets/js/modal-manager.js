/**
 * Modal Manager JavaScript
 *
 * Handles modal window functionality including opening, closing, animations,
 * focus trapping, and trigger events.
 *
 * @package Clean_Theme
 */

(function($) {
    'use strict';

    // Store for active modals
    const activeModals = new Map();
    
    // Store for trigger elements (for focus restoration)
    const triggerElements = new Map();

    $(document).ready(function() {

        // ============================================
        // Initialize all modals on page
        // ============================================
        function initializeModals() {
            $('.ct-modal-overlay').each(function() {
                const $modal = $(this);
                const modalId = $modal.data('modal-id');
                
                if (!modalId) return;
                
                // Set initial state
                $modal.attr('aria-hidden', 'true');
                
                // Setup event listeners
                setupModalEvents($modal);
            });
        }
        
        initializeModals();

        // ============================================
        // Setup modal events
        // ============================================
        function setupModalEvents($modal) {
            const modalId = $modal.data('modal-id');
            const closeOnOverlay = $modal.data('close-on-overlay') === 'true';
            
            // Close button click
            $modal.find('[data-modal-close]').on('click', function(e) {
                e.preventDefault();
                const targetModal = $(this).data('modal-close');
                if (targetModal && targetModal === modalId) {
                    closeModal(modalId);
                } else {
                    closeModal(modalId);
                }
            });
            
            // Overlay click to close
            if (closeOnOverlay) {
                $modal.on('click', function(e) {
                    if ($(e.target).hasClass('ct-modal-overlay')) {
                        closeModal(modalId);
                    }
                });
            }
        }

        // ============================================
        // Open modal function
        // ============================================
        function openModal(modalId, options = {}) {
            const $modal = $(`.ct-modal-overlay[data-modal-id="${modalId}"]`);
            
            if (!$modal.length) {
                console.warn(`Modal "${modalId}" not found.`);
                return false;
            }
            
            // Store current focus for restoration
            if (document.activeElement && !triggerElements.has(modalId)) {
                triggerElements.set(modalId, document.activeElement);
            }
            
            // If another modal is open, close it first
            if (activeModals.size > 0) {
                activeModals.forEach((_, id) => {
                    if (id !== modalId) {
                        closeModal(id);
                    }
                });
            }
            
            // Show modal
            $modal.addClass('active').attr('aria-hidden', 'false');
            activeModals.set(modalId, $modal);
            
            // Lock body scroll
            $('body').addClass('modal-open');
            
            // Setup focus trap
            setupFocusTrap($modal);
            
            // Focus first focusable element
            setTimeout(function() {
                const $firstFocusable = $modal.find('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])').first();
                if ($firstFocusable.length) {
                    $firstFocusable.focus();
                }
            }, 100);
            
            // Dispatch custom event
            document.dispatchEvent(new CustomEvent('modalOpened', { 
                detail: { modalId, modal: $modal[0] } 
            }));
            
            return true;
        }

        // ============================================
        // Close modal function
        // ============================================
        function closeModal(modalId) {
            const $modal = $(`.ct-modal-overlay[data-modal-id="${modalId}"]`);
            
            if (!$modal.length) {
                return false;
            }
            
            // Get animation duration
            const duration = parseInt($modal.data('animation-duration')) || 300;
            
            // Hide modal with animation
            $modal.removeClass('active').attr('aria-hidden', 'true');
            
            // Remove from active modals after animation
            setTimeout(function() {
                activeModals.delete(modalId);
                
                // Unlock body scroll if no more modals
                if (activeModals.size === 0) {
                    $('body').removeClass('modal-open');
                }
                
                // Restore focus to trigger element
                const triggerEl = triggerElements.get(modalId);
                if (triggerEl && typeof triggerEl.focus === 'function') {
                    triggerEl.focus();
                }
                triggerElements.delete(modalId);
                
                // Dispatch custom event
                document.dispatchEvent(new CustomEvent('modalClosed', { 
                    detail: { modalId, modal: $modal[0] } 
                }));
            }, duration);
            
            return true;
        }

        // ============================================
        // Focus trap implementation
        // ============================================
        function setupFocusTrap($modal) {
            const focusableSelectors = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
            const $focusableElements = $modal.find(focusableSelectors).filter(':visible');
            
            if ($focusableElements.length === 0) return;
            
            const $firstFocusable = $focusableElements.first();
            const $lastFocusable = $focusableElements.last();
            
            $modal.on('keydown.modal-focus-trap', function(e) {
                if (e.key !== 'Tab') return;
                
                if (e.shiftKey) {
                    // Shift + Tab
                    if (document.activeElement === $firstFocusable[0]) {
                        e.preventDefault();
                        $lastFocusable.focus();
                    }
                } else {
                    // Tab
                    if (document.activeElement === $lastFocusable[0]) {
                        e.preventDefault();
                        $firstFocusable.focus();
                    }
                }
            });
        }

        // ============================================
        // Modal triggers (click)
        // ============================================
        $(document).on('click', '[data-modal-trigger]', function(e) {
            e.preventDefault();
            const modalId = $(this).data('modal-trigger');
            if (modalId) {
                openModal(modalId);
            }
        });

        // ============================================
        // Keyboard events
        // ============================================
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && activeModals.size > 0) {
                // Close the most recently opened modal
                const lastModalId = Array.from(activeModals.keys()).pop();
                closeModal(lastModalId);
            }
        });

        // ============================================
        // Auto-open modals
        // ============================================
        function checkAutoOpenModals() {
            $('.ct-modal-overlay').each(function() {
                const $modal = $(this);
                const modalId = $modal.data('modal-id');
                const autoDelay = $modal.data('auto-delay');
                
                if (!modalId || !autoDelay) return;
                
                // Check if already opened
                if (activeModals.has(modalId)) return;
                
                setTimeout(function() {
                    openModal(modalId);
                }, parseInt(autoDelay));
            });
        }
        
        // Run auto-open check after page load
        $(window).on('load', function() {
            setTimeout(checkAutoOpenModals, 100);
        });

        // ============================================
        // Scroll trigger modals
        // ============================================
        let scrollTriggerChecked = false;
        
        function checkScrollTriggerModals() {
            if (scrollTriggerChecked) return;
            
            $('.ct-modal-overlay').each(function() {
                const $modal = $(this);
                const modalId = $modal.data('modal-id');
                const scrollPercent = $modal.data('scroll-trigger');
                
                if (!modalId || !scrollPercent) return;
                
                const scrollTop = $(window).scrollTop();
                const docHeight = $(document).height() - $(window).height();
                const scrollPercentage = (scrollTop / docHeight) * 100;
                
                if (scrollPercentage >= parseInt(scrollPercent)) {
                    scrollTriggerChecked = true;
                    openModal(modalId);
                }
            });
        }
        
        $(window).on('scroll', function() {
            checkScrollTriggerModals();
        });

        // ============================================
        // Exit intent detection
        // ============================================
        let exitIntentShown = false;
        
        function setupExitIntent() {
            $(document).on('mouseleave', function(e) {
                if (e.clientY <= 0 && !exitIntentShown) {
                    $('.ct-modal-overlay').each(function() {
                        const $modal = $(this);
                        const modalId = $modal.data('modal-id');
                        const hasExitIntent = $modal.data('exit-intent') === 'true';
                        
                        if (modalId && hasExitIntent) {
                            exitIntentShown = true;
                            openModal(modalId);
                            return false;
                        }
                    });
                }
            });
        }
        
        setupExitIntent();

        // ============================================
        // Form submission handling
        // ============================================
        $(document).on('submit', '.ct-modal-form', function(e) {
            e.preventDefault();
            
            const $form = $(this);
            const $submitBtn = $form.find('button[type="submit"]');
            const $responseDiv = $form.find('.ct-form-response');
            const modalId = $form.data('modal-id');
            const formData = new FormData(this);
            
            // Disable submit button
            const originalText = $submitBtn.text();
            $submitBtn.prop('disabled', true).text('Sending...');
            
            $.ajax({
                url: $form.data('action') || cleanThemeAjax?.ajaxurl || '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $responseDiv.html('<p class="success">' + response.data.message + '</p>')
                                   .addClass('visible');
                        $form[0].reset();
                        
                        // Auto-close after success (optional)
                        setTimeout(function() {
                            if (modalId) {
                                closeModal(modalId);
                            }
                            $responseDiv.removeClass('visible').empty();
                        }, 3000);
                    } else {
                        $responseDiv.html('<p class="error">' + response.data.message + '</p>')
                                   .addClass('visible');
                    }
                },
                error: function() {
                    $responseDiv.html('<p class="error">Error submitting form. Please try again.</p>')
                               .addClass('visible');
                },
                complete: function() {
                    $submitBtn.prop('disabled', false).text(originalText);
                }
            });
        });

        // ============================================
        // Expose functions globally
        // ============================================
        window.CleanThemeModals = {
            open: openModal,
            close: closeModal,
            isActive: function(modalId) {
                return activeModals.has(modalId);
            },
            getActiveModals: function() {
                return Array.from(activeModals.keys());
            }
        };

    });

})(jQuery);

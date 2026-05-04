/**
 * Float Buttons Functionality
 *
 * @package Clean_Theme
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        // ============================================
        // Back to Top Button
        // ============================================
        const $backToTop = $('.ct-back-to-top');
        
        if ($backToTop.length) {
            const scrollOffset = parseInt($backToTop.data('scroll-offset')) || 500;
            
            // Show/hide on scroll
            $(window).on('scroll', function() {
                if ($(this).scrollTop() > scrollOffset) {
                    $backToTop.addClass('visible');
                } else {
                    $backToTop.removeClass('visible');
                }
            });
            
            // Smooth scroll to top on click
            $backToTop.on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: 0
                }, 600);
            });
        }
        
        // ============================================
        // Contact Buttons Toggle
        // ============================================
        const $contactMainToggle = $('.ct-contact-main-toggle');
        const $contactSubmenu = $('.ct-contact-submenu');
        
        if ($contactMainToggle.length) {
            $contactMainToggle.on('click', function() {
                const isExpanded = $(this).attr('aria-expanded') === 'true';
                
                $(this).attr('aria-expanded', !isExpanded);
                $contactSubmenu.toggleClass('active');
                
                // Rotate icon if exists
                $(this).toggleClass('rotated');
            });
            
            // Close submenu when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.ct-contact-group').length) {
                    $contactMainToggle.attr('aria-expanded', 'false');
                    $contactSubmenu.removeClass('active');
                    $contactMainToggle.removeClass('rotated');
                }
            });
            
            // Close on escape key
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && $contactSubmenu.hasClass('active')) {
                    $contactMainToggle.attr('aria-expanded', 'false');
                    $contactSubmenu.removeClass('active');
                    $contactMainToggle.removeClass('rotated');
                    $contactMainToggle.focus();
                }
            });
        }
        
        // ============================================
        // Contact Form Modal/Panel
        // ============================================
        const $contactFormToggle = $('.ct-contact-form-toggle');
        const $modalOverlay = $('#contact-form-modal');
        const $contactPanel = $('#contact-form-panel');
        const $modalClose = $('.ct-modal-close');
        const $contactForm = $('#contact-form');
        
        // Open modal/panel
        $contactFormToggle.on('click', function() {
            const displayType = $(this).data('display-type');
            
            // Close contact submenu
            $contactSubmenu.removeClass('active');
            $contactMainToggle.attr('aria-expanded', 'false');
            
            if (displayType === 'modal' && $modalOverlay.length) {
                $modalOverlay.addClass('active');
                $('body').addClass('modal-open');
                
                // Focus first input
                setTimeout(function() {
                    $modalOverlay.find('input:first').focus();
                }, 100);
            } else if (displayType === 'panel' && $contactPanel.length) {
                $contactPanel.addClass('active');
                $('body').addClass('panel-open');
                
                // Focus first input
                setTimeout(function() {
                    $contactPanel.find('input:first').focus();
                }, 100);
            }
        });
        
        // Close modal/panel
        $modalClose.on('click', function() {
            closeContactForm();
        });
        
        // Close on overlay click
        $modalOverlay.on('click', function(e) {
            if ($(e.target).hasClass('ct-modal-overlay')) {
                closeContactForm();
            }
        });
        
        // Close panel on outside click
        $(document).on('click', function(e) {
            if ($contactPanel.hasClass('active') && 
                !$(e.target).closest('.ct-contact-panel').length &&
                !$(e.target).closest('.ct-contact-form-toggle').length) {
                closeContactForm();
            }
        });
        
        // Close on escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                if ($modalOverlay.hasClass('active') || $contactPanel.hasClass('active')) {
                    closeContactForm();
                }
            }
        });
        
        function closeContactForm() {
            $modalOverlay.removeClass('active');
            $contactPanel.removeClass('active');
            $('body').removeClass('modal-open panel-open');
            $contactFormToggle.focus();
        }
        
        // ============================================
        // Contact Form Submission
        // ============================================
        if ($contactForm.length) {
            $contactForm.on('submit', function(e) {
                e.preventDefault();
                
                const $submitBtn = $(this).find('.ct-btn-submit');
                const $responseDiv = $(this).find('.ct-form-response');
                const formData = new FormData(this);
                
                // Disable submit button
                $submitBtn.prop('disabled', true).text(cleanThemeAjax.i18n.sending);
                
                $.ajax({
                    url: cleanThemeAjax.ajaxurl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $responseDiv.html('<p class="success">' + response.data.message + '</p>');
                            $contactForm[0].reset();
                            
                            // Auto-hide success message and close after 3 seconds
                            setTimeout(function() {
                                closeContactForm();
                                $responseDiv.empty();
                            }, 3000);
                        } else {
                            $responseDiv.html('<p class="error">' + response.data.message + '</p>');
                        }
                        
                        // Re-enable submit button
                        $submitBtn.prop('disabled', false).text($submitBtn.data('original-text') || cleanThemeAjax.i18n.success);
                    },
                    error: function() {
                        $responseDiv.html('<p class="error">' + cleanThemeAjax.i18n.error + '</p>');
                        $submitBtn.prop('disabled', false);
                    }
                });
            });
        }
        
        // ============================================
        // Tooltip Enhancement
        // ============================================
        $('.ct-tooltip').each(function() {
            const $tooltip = $(this);
            const tooltipText = $tooltip.data('tooltip');
            
            if (tooltipText) {
                $tooltip.attr('title', tooltipText);
            }
        });
        
    });

})(jQuery);

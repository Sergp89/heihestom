/**
 * Main JavaScript for Dental Clinic Theme
 *
 * @package Dental_Clinic
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        
        /**
         * Mobile Menu Toggle
         */
        var hamburgerMenu = $('#hamburger-menu');
        var mobileMenuPanel = $('#mobile-menu-panel');
        var menuOverlay = $('#menu-overlay');
        var body = $('body');
        var isMenuOpen = false;

        function toggleMenu() {
            isMenuOpen = !isMenuOpen;
            
            if (isMenuOpen) {
                hamburgerMenu.addClass('active');
                mobileMenuPanel.addClass('active');
                menuOverlay.addClass('active');
                body.css('overflow', 'hidden');
            } else {
                hamburgerMenu.removeClass('active');
                mobileMenuPanel.removeClass('active');
                menuOverlay.removeClass('active');
                body.css('overflow', '');
            }
        }

        hamburgerMenu.on('click', function(e) {
            e.preventDefault();
            toggleMenu();
        });

        menuOverlay.on('click', function() {
            if (isMenuOpen) {
                toggleMenu();
            }
        });

        // Close menu when clicking on a menu item
        mobileMenuPanel.on('click', 'a', function() {
            if (isMenuOpen) {
                toggleMenu();
            }
        });

        // Close menu on escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && isMenuOpen) {
                toggleMenu();
            }
        });

        /**
         * Smooth Scroll for Anchor Links
         */
        $('a[href^="#"]').on('click', function(e) {
            var target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                
                var headerHeight = $('.site-header').outerHeight();
                var targetPosition = target.offset().top - headerHeight;
                
                $('html, body').stop().animate({
                    scrollTop: targetPosition
                }, 800);
            }
        });

        /**
         * Fade In Animation on Scroll
         */
        function checkFadeIn() {
            $('.fade-in').each(function() {
                var elementTop = $(this).offset().top;
                var windowBottom = $(window).scrollTop() + $(window).height();
                var triggerPoint = windowBottom - 100;
                
                if (elementTop < triggerPoint) {
                    $(this).addClass('visible');
                }
            });
        }

        // Check on load and scroll
        $(window).on('scroll', function() {
            checkFadeIn();
        });
        
        // Initial check
        checkFadeIn();

        /**
         * Back to Top Button Visibility Toggle
         */
        var backToTopBtn = document.getElementById('back-to-top-btn');
        
        if (backToTopBtn) {
            $(window).on('scroll', function() {
                if ($(window).scrollTop() > 300) {
                    backToTopBtn.classList.add('visible');
                } else {
                    backToTopBtn.classList.remove('visible');
                }
            });
            
            // Scroll to top on click
            backToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        /**
         * Feedback Button Click Handler
         */
        var feedbackBtn = document.getElementById('feedback-btn');
        
        if (feedbackBtn) {
            feedbackBtn.addEventListener('click', function() {
                // You can add your feedback modal or scroll to contact section here
                var contactSection = document.querySelector('.contact-section');
                if (contactSection) {
                    contactSection.scrollIntoView({ behavior: 'smooth' });
                } else {
                    // Fallback: scroll to footer
                    window.scrollTo({
                        top: document.body.scrollHeight,
                        behavior: 'smooth'
                    });
                }
            });
        }

        /**
         * Header Shadow on Scroll
         */
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 50) {
                $('.site-header').css('box-shadow', '0 2px 20px rgba(0, 0, 0, 0.15)');
            } else {
                $('.site-header').css('box-shadow', '0 2px 10px rgba(0, 0, 0, 0.1)');
            }
        });

        /**
         * Service Cards Hover Effect Enhancement
         */
        $('.service-card').on('mouseenter', function() {
            $(this).css('transform', 'translateY(-10px)');
        }).on('mouseleave', function() {
            $(this).css('transform', 'translateY(0)');
        });

        /**
         * Contact Items Hover Effect
         */
        $('.contact-item').on('mouseenter', function() {
            $(this).css('transform', 'translateY(-5px)');
        }).on('mouseleave', function() {
            $(this).css('transform', 'translateY(0)');
        });

        /**
         * Add staggered animation delay to service cards
         */
        $('.service-card').each(function(index) {
            $(this).css('transition-delay', (index * 0.1) + 's');
        });

        /**
         * Mobile Menu Touch Swipe Support
         */
        var touchStartX = 0;
        var touchEndX = 0;

        mobileMenuPanel.on('touchstart', function(e) {
            touchStartX = e.originalEvent.touches[0].clientX;
        });

        mobileMenuPanel.on('touchend', function(e) {
            touchEndX = e.originalEvent.changedTouches[0].clientX;
            handleSwipe();
        });

        function handleSwipe() {
            var swipeThreshold = 50;
            var swipeDistance = touchEndX - touchStartX;
            
            if (swipeDistance < -swipeThreshold && isMenuOpen) {
                toggleMenu();
            }
        }

        /**
         * Prevent body scroll when menu is open (iOS fix)
         */
        document.addEventListener('touchmove', function(e) {
            if (isMenuOpen) {
                if (!mobileMenuPanel[0].contains(e.target)) {
                    e.preventDefault();
                }
            }
        }, { passive: false });

        /**
         * Handle window resize
         */
        var resizeTimer;
        $(window).on('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                // Close mobile menu if switching to desktop
                if ($(window).width() > 768 && isMenuOpen) {
                    toggleMenu();
                }
            }, 250);
        });

    }); // End DOM Ready

})(jQuery);

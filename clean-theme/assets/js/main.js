/**
 * Main JavaScript
 *
 * @package Clean_Theme
 */

(function() {
    'use strict';

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        
        // Smooth scroll for anchor links
        if (document.body.classList.contains('smooth-scroll')) {
            document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
                anchor.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        e.preventDefault();
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        }

        // Add animation classes when elements come into view
        if (document.body.classList.contains('animations-enabled')) {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.fade-in, .slide-in').forEach(function(el) {
                observer.observe(el);
            });
        }

        // External links - add rel="noopener noreferrer"
        document.querySelectorAll('a[href^="http"]:not([href*="' + window.location.hostname + '"])').forEach(function(link) {
            if (!link.hasAttribute('rel')) {
                link.setAttribute('rel', 'noopener noreferrer');
            }
            link.setAttribute('target', '_blank');
        });

    });

})();

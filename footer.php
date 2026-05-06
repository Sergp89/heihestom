<?php
/**
 * The footer template
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Heyhestom
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Heyhestom;

if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Footer -->
<footer class="footer" id="contacts">
    <div class="container">
        <?php if (get_theme_mod('heyhestom_show_footer_widgets', true)): ?>
            <div class="footer-grid">
                <!-- Footer Brand / Column 1 -->
                <div class="footer-brand">
                    <?php if (is_active_sidebar('footer-1')): ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php else: ?>
                        <h2><?php bloginfo('name'); ?></h2>
                        <ul class="contact-list">
                            <li>
                                <div class="icon-box">📍</div>
                                <div class="contact-text">
                                    <strong><?php esc_html_e('Clinic Address', 'heyhestom'); ?></strong>
                                    <?php esc_html_e('Heihe, Central Street, 123', 'heyhestom'); ?>
                                </div>
                            </li>
                            <li>
                                <div class="icon-box">📞</div>
                                <div class="contact-text">
                                    <strong><?php esc_html_e('Phone', 'heyhestom'); ?></strong>
                                    <a href="tel:<?php echo esc_attr(get_theme_mod('heyhestom_fab_phone')); ?>">
                                        <?php echo esc_html(get_theme_mod('heyhestom_fab_phone', '+7 (495) 123-45-67')); ?>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="icon-box">✉️</div>
                                <div class="contact-text">
                                    <strong><?php esc_html_e('E-mail', 'heyhestom'); ?></strong>
                                    <a href="mailto:<?php echo esc_attr(get_option('admin_email')); ?>">
                                        <?php echo esc_html(get_option('admin_email')); ?>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="icon-box">🕒</div>
                                <div class="contact-text">
                                    <strong><?php esc_html_e('Working Hours', 'heyhestom'); ?></strong>
                                    <?php esc_html_e('Daily from 09:00 to 20:00', 'heyhestom'); ?>
                                </div>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Footer Links / Column 2 -->
                <div class="footer-links">
                    <?php if (is_active_sidebar('footer-2')): ?>
                        <?php dynamic_sidebar('footer-2'); ?>
                    <?php elseif (has_nav_menu('footer')): ?>
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'container'      => false,
                            'depth'          => 1,
                            'fallback_cb'    => false,
                        ]);
                        ?>
                    <?php else: ?>
                        <h3><?php esc_html_e('Site Sections', 'heyhestom'); ?></h3>
                        <ul>
                            <li><a href="#home"><?php esc_html_e('Home Page', 'heyhestom'); ?></a></li>
                            <li><a href="#about"><?php esc_html_e('About Clinic', 'heyhestom'); ?></a></li>
                            <li><a href="#services"><?php esc_html_e('All Services', 'heyhestom'); ?></a></li>
                            <li><a href="#doctors"><?php esc_html_e('Specialists', 'heyhestom'); ?></a></li>
                            <li><a href="#news"><?php esc_html_e('Promotions and News', 'heyhestom'); ?></a></li>
                            <li><a href="#calc"><?php esc_html_e('Calculator', 'heyhestom'); ?></a></li>
                            <li><a href="#comparison"><?php esc_html_e('All-inclusive Price', 'heyhestom'); ?></a></li>
                            <li><a href="#contacts"><?php esc_html_e('Contacts', 'heyhestom'); ?></a></li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Copyright -->
        <div class="copyright">
            <?php
            $copyright_text = get_theme_mod('heyhestom_copyright_text');
            if ($copyright_text):
                echo wp_kses_post($copyright_text);
            else:
                ?>
                &copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'heyhestom'); ?>
            <?php endif; ?>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button -->
<?php if (get_theme_mod('heyhestom_show_scroll_top', true)): ?>
<button class="scroll-top-btn" id="scrollTopBtn" aria-label="<?php esc_attr_e('Scroll to top', 'heyhestom'); ?>">
    <svg viewBox="0 0 24 24" aria-hidden="true">
        <polyline points="18 15 12 9 6 15"></polyline>
    </svg>
</button>
<?php endif; ?>

<!-- Contact FAB Container -->
<?php if (get_theme_mod('heyhestom_show_contact_fab', true)): ?>
<div class="callback-fab-container" id="callbackFab">
    <div class="fab-sub-buttons" id="fabSubButtons">
        <a href="<?php echo esc_url(get_theme_mod('heyhestom_fab_messenger', '#')); ?>" class="fab-sub-btn max-messenger" aria-label="<?php esc_attr_e('Write to Max messenger', 'heyhestom'); ?>">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
            </svg>
            <span class="fab-tooltip"><?php esc_html_e('Write to Max', 'heyhestom'); ?></span>
        </a>
        <a href="tel:<?php echo esc_attr(get_theme_mod('heyhestom_fab_phone')); ?>" class="fab-sub-btn phone-btn" aria-label="<?php esc_attr_e('Call now', 'heyhestom'); ?>">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
            <span class="fab-tooltip"><?php esc_html_e('Call', 'heyhestom'); ?></span>
        </a>
        <button class="fab-sub-btn form-btn" onclick="openContactForm()" aria-label="<?php esc_attr_e('Leave a request', 'heyhestom'); ?>">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="12" y1="8" x2="12" y2="16"></line>
                <line x1="8" y1="12" x2="16" y2="12"></line>
            </svg>
            <span class="fab-tooltip"><?php esc_html_e('Leave a request', 'heyhestom'); ?></span>
        </button>
    </div>
    <button class="fab-main" id="fabMain" onclick="toggleFab()" aria-label="<?php esc_attr_e('Toggle contact options', 'heyhestom'); ?>">
        <svg class="phone-icon" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
        </svg>
        <svg class="close-icon" viewBox="0 0 24 24" aria-hidden="true">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </button>
</div>
<?php endif; ?>

<!-- Contact Form Overlay -->
<div class="contact-form-overlay" id="contactFormOverlay" onclick="if(event.target===this) closeContactForm()">
    <div class="contact-form-wrapper">
        <button class="form-close" onclick="closeContactForm()" aria-label="<?php esc_attr_e('Close form', 'heyhestom'); ?>">✕</button>
        <div id="formContent">
            <h2><?php esc_html_e('Contact Us', 'heyhestom'); ?></h2>
            <p class="form-desc"><?php esc_html_e('Leave your contacts and we will contact you to clarify all issues!', 'heyhestom'); ?></p>
            <form id="callbackForm" onsubmit="submitForm(event)">
                <div class="form-group">
                    <label for="formName"><?php esc_html_e('Your Name', 'heyhestom'); ?></label>
                    <input type="text" id="formName" name="name" placeholder="<?php esc_attr_e('Enter your name', 'heyhestom'); ?>" required>
                </div>
                <div class="form-group">
                    <label><?php esc_html_e('Phone', 'heyhestom'); ?></label>
                    <div class="phone-input-wrapper" style="position: relative;">
                        <div class="country-code-select" id="countryCodeBtn" onclick="toggleCountryDropdown()">
                            <span id="selectedFlag">🇷🇺</span>
                            <span id="selectedCode">+7</span>
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        <div class="country-dropdown" id="countryDropdown">
                            <div class="country-dropdown-item" data-code="+7" data-flag="🇷🇺" onclick="selectCountry('+7', '🇷🇺', this)">🇷🇺 +7 Russia</div>
                            <div class="country-dropdown-item" data-code="+375" data-flag="🇧🇾" onclick="selectCountry('+375', '🇧🇾', this)">🇧🇾 +375 Belarus</div>
                            <div class="country-dropdown-item" data-code="+380" data-flag="🇺🇦" onclick="selectCountry('+380', '🇺🇦', this)">🇺🇦 +380 Ukraine</div>
                            <div class="country-dropdown-item" data-code="+7" data-flag="🇰🇿" onclick="selectCountry('+7', '🇰🇿', this)">🇰🇿 +7 Kazakhstan</div>
                            <div class="country-dropdown-item" data-code="+998" data-flag="🇺🇿" onclick="selectCountry('+998', '🇺🇿', this)">🇺🇿 +998 Uzbekistan</div>
                            <div class="country-dropdown-item" data-code="+86" data-flag="🇨🇳" onclick="selectCountry('+86', '🇨🇳', this)">🇨🇳 +86 China</div>
                        </div>
                        <input type="tel" id="formPhone" name="phone" placeholder="+7 (000) 000-00-00" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="formEmail"><?php esc_html_e('E-mail', 'heyhestom'); ?></label>
                    <input type="email" id="formEmail" name="email" placeholder="example@mail.ru">
                </div>
                <div class="form-group">
                    <label for="formCity"><?php esc_html_e('From which city?', 'heyhestom'); ?></label>
                    <input type="text" id="formCity" name="city" placeholder="<?php esc_attr_e('Your city', 'heyhestom'); ?>">
                </div>
                <div class="form-group">
                    <label for="formMessage"><?php esc_html_e('Describe your problem', 'heyhestom'); ?></label>
                    <textarea id="formMessage" name="message" placeholder="<?php esc_attr_e('Tell us what bothers you...', 'heyhestom'); ?>"></textarea>
                </div>
                <button type="submit" class="btn-submit"><?php esc_html_e('Send', 'heyhestom'); ?></button>
                <p class="form-privacy">
                    <?php
                    printf(
                        wp_kses(
                            /* translators: %s: Privacy policy link */
                            __('By clicking "Send" you agree to the <a href="%s">privacy policy</a>', 'heyhestom'),
                            ['a' => ['href' => [], 'onclick' => []]]
                        ),
                        '#'
                    );
                    ?>
                </p>
            </form>
        </div>
        <div class="form-success" id="formSuccess">
            <div class="success-icon">✓</div>
            <h3><?php esc_html_e('Thank you!', 'heyhestom'); ?></h3>
            <p><?php esc_html_e('Your request has been sent. We will contact you soon.', 'heyhestom'); ?></p>
            <button class="btn-glass-glow" style="margin-top: 20px;" onclick="closeContactForm(); resetForm();">
                <?php esc_html_e('Close', 'heyhestom'); ?>
            </button>
        </div>
    </div>
</div>

<!-- Detail Overlay (for service details modal) -->
<div class="detail-overlay" id="detailOverlay">
    <div class="detail-content">
        <button class="detail-close" onclick="closeDetail()" aria-label="<?php esc_attr_e('Close', 'heyhestom'); ?>">✕</button>
        <div id="detailContentArea"></div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>

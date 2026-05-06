<?php
/**
 * The header template
 *
 * Displays all of the <head> section and everything up until <div id="main-content">
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
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary">
    <?php esc_html_e('Skip to content', 'heyhestom'); ?>
</a>

<header class="header" id="masthead">
    <div class="container header-inner">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" rel="home">
            <?php if (has_custom_logo()): ?>
                <?php the_custom_logo(); ?>
            <?php else: ?>
                <div class="logo-icon">🦷</div>
                <span class="site-title"><?php bloginfo('name'); ?></span>
            <?php endif; ?>
        </a>

        <!-- Header Actions (Desktop) -->
        <div class="header-actions">
            <?php if (is_active_sidebar('header-widgets')): ?>
                <div class="header-widgets">
                    <?php dynamic_sidebar('header-widgets'); ?>
                </div>
            <?php else: ?>
                <!-- Phone Group -->
                <div class="phone-group">
                    <a href="tel:<?php echo esc_attr(get_theme_mod('heyhestom_fab_phone', '+74951234567')); ?>" class="phone-link">
                        <?php echo esc_html(get_theme_mod('heyhestom_fab_phone', '+7 (495) 123-45-67')); ?>
                    </a>
                    <a href="<?php echo esc_url(get_theme_mod('heyhestom_fab_messenger', '#')); ?>" class="messenger-link">
                        <?php esc_html_e('💬 WeChat / WhatsApp', 'heyhestom'); ?>
                    </a>
                </div>
                
                <!-- Call Button -->
                <button class="btn-glass-glow" onclick="openContactForm()">
                    <?php esc_html_e('Request a Call', 'heyhestom'); ?>
                </button>
            <?php endif; ?>
        </div>

        <!-- Hamburger Menu Button (Mobile) -->
        <button class="hamburger" id="hamburgerBtn" onclick="toggleMobileMenu()" aria-label="<?php esc_attr_e('Toggle menu', 'heyhestom'); ?>" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<!-- Navigation -->
<?php if (has_nav_menu('primary')): ?>
<nav class="navbar" id="site-navigation">
    <div class="container">
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'menu_class'     => 'nav-menu',
            'container'      => false,
            'depth'          => 2,
            'fallback_cb'    => false,
        ]);
        ?>
    </div>
</nav>
<?php endif; ?>

<!-- Floating Menu Button (Mobile) -->
<button class="floating-menu-btn" id="floatingMenuBtn" onclick="toggleMobileMenu()" aria-label="<?php esc_attr_e('Open menu', 'heyhestom'); ?>">
    <svg viewBox="0 0 24 24" aria-hidden="true">
        <line x1="3" y1="7" x2="21" y2="7"></line>
        <line x1="3" y1="12" x2="21" y2="12"></line>
        <line x1="3" y1="17" x2="21" y2="17"></line>
    </svg>
</button>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobileMenu" aria-hidden="true">
    <div class="mobile-menu-backdrop" onclick="closeMobileMenu()"></div>
    <div class="mobile-menu-panel" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e('Mobile menu', 'heyhestom'); ?>">
        <!-- Close Button -->
        <button class="mobile-menu-close" onclick="closeMobileMenu()" aria-label="<?php esc_attr_e('Close menu', 'heyhestom'); ?>">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        <!-- Mobile Menu Logo -->
        <div class="mobile-menu-header">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="mobile-menu-logo" onclick="closeMobileMenu(); window.scrollTo({top:0,behavior:'smooth'});">
                <div class="mml-icon">🦷</div>
                <div class="mml-text">
                    <?php bloginfo('name'); ?>
                </div>
            </a>
        </div>

        <!-- Mobile Menu Items -->
        <?php if (has_nav_menu('mobile')): ?>
            <?php
            wp_nav_menu([
                'theme_location' => 'mobile',
                'menu_class'     => 'mobile-menu-items',
                'container'      => false,
                'depth'          => 1,
                'fallback_cb'    => false,
                'link_before'    => '<div class="mobile-menu-icon">',
                'link_after'     => '</div><span>',
            ]);
            ?>
        <?php else: ?>
            <ul class="mobile-menu-items">
                <li><a href="#home" onclick="closeMobileMenu()"><div class="mobile-menu-icon">🏠</div><span><?php esc_html_e('Home', 'heyhestom'); ?></span></a></li>
                <li><a href="#about" onclick="closeMobileMenu()"><div class="mobile-menu-icon">🏥</div><span><?php esc_html_e('About Clinic', 'heyhestom'); ?></span></a></li>
                <li><a href="#services" onclick="closeMobileMenu()"><div class="mobile-menu-icon">🦷</div><span><?php esc_html_e('Services', 'heyhestom'); ?></span></a></li>
                <li><a href="#doctors" onclick="closeMobileMenu()"><div class="mobile-menu-icon">👨‍⚕️</div><span><?php esc_html_e('Specialists', 'heyhestom'); ?></span></a></li>
                <li><a href="#news" onclick="closeMobileMenu()"><div class="mobile-menu-icon">🎁</div><span><?php esc_html_e('Promotions', 'heyhestom'); ?></span></a></li>
                <li><a href="#calc" onclick="closeMobileMenu()"><div class="mobile-menu-icon">🧮</div><span><?php esc_html_e('Calculator', 'heyhestom'); ?></span></a></li>
                <li><a href="#prices" onclick="closeMobileMenu()"><div class="mobile-menu-icon">💰</div><span><?php esc_html_e('Prices', 'heyhestom'); ?></span></a></li>
                <li><a href="#contacts" onclick="closeMobileMenu()"><div class="mobile-menu-icon">📍</div><span><?php esc_html_e('Contacts', 'heyhestom'); ?></span></a></li>
            </ul>
        <?php endif; ?>

        <!-- Mobile Menu Contacts -->
        <div class="mobile-menu-contacts">
            <p><?php esc_html_e('Contact us:', 'heyhestom'); ?></p>
            <a href="tel:<?php echo esc_attr(get_theme_mod('heyhestom_fab_phone', '+74951234567')); ?>">
                <?php echo esc_html(get_theme_mod('heyhestom_fab_phone', '+7 (495) 123-45-67')); ?>
            </a>
            <button class="mobile-menu-btn" onclick="closeMobileMenu(); openContactForm();">
                <?php esc_html_e('Request a Call', 'heyhestom'); ?>
            </button>
        </div>
    </div>
</div>

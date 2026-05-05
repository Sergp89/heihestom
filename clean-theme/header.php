<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Clean_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'clean-theme' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="ct-container">
            <div class="header-content <?php echo esc_attr( 'logo-' . get_theme_mod( 'logo_position', 'left' ) ); ?>">
                
                <!-- Site Branding -->
                <div class="site-branding">
                    <?php clean_theme_site_logo(); ?>
                </div><!-- .site-branding -->

                <!-- Primary Navigation -->
                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle menu', 'clean-theme' ); ?>">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'primary-menu',
                        'container'      => false,
                        'fallback_cb'    => 'clean_theme_fallback_menu',
                    ) );
                    ?>
                </nav><!-- #site-navigation -->

                <!-- Header Widgets (if enabled) -->
                <?php if ( get_theme_mod( 'header_widgets_enabled', false ) && is_active_sidebar( 'header-widgets' ) ) : ?>
                    <div class="header-widgets">
                        <?php dynamic_sidebar( 'header-widgets' ); ?>
                    </div>
                <?php endif; ?>

            </div><!-- .header-content -->
        </div><!-- .ct-container -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
        <div class="ct-container <?php echo esc_attr( get_theme_mod( 'container_width', 'boxed' ) ); ?>">

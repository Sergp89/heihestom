<?php
/**
 * Footer Style 4: Minimal (Centered Copyright + Social)
 *
 * @package Clean_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<div class="ct-container">
    <div class="footer-widgets style-4">
        <!-- Single Centered Column -->
        <div class="footer-column footer-col-1">
            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <?php dynamic_sidebar( 'footer-1' ); ?>
            <?php else : ?>
                <div class="site-branding">
                    <?php clean_theme_site_logo(); ?>
                </div>
                
                <?php if ( get_theme_mod( 'footer_show_copyright', true ) ) : ?>
                    <p class="copyright">
                        &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. 
                        <?php printf( esc_html__( 'Powered by %s', 'clean-theme' ), '<a href="https://wordpress.org/">WordPress</a>' ); ?>
                    </p>
                <?php endif; ?>
                
                <!-- Social Links Placeholder -->
                <div class="social-links">
                    <?php
                    // Display social menu if exists
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'social-menu',
                        'menu_class'     => 'social-menu',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ) );
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div><!-- .footer-widgets -->
</div>

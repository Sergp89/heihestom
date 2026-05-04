<?php
/**
 * Footer Style 1: 2 Columns (Logo + Info, Menu)
 *
 * @package Clean_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<div class="ct-container">
    <div class="footer-widgets style-1">
        <!-- Column 1: Logo & Info -->
        <div class="footer-column footer-col-1">
            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <?php dynamic_sidebar( 'footer-1' ); ?>
            <?php else : ?>
                <div class="site-branding">
                    <?php clean_theme_site_logo(); ?>
                </div>
                <div class="footer-info">
                    <p><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Column 2: Menu -->
        <div class="footer-column footer-col-2">
            <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                <?php dynamic_sidebar( 'footer-2' ); ?>
            <?php else : ?>
                <?php if ( has_nav_menu( 'footer' ) ) : ?>
                    <nav class="footer-navigation">
                        <?php wp_nav_menu( array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'menu_class'     => 'footer-menu',
                            'depth'          => 1,
                        ) ); ?>
                    </nav>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div><!-- .footer-widgets -->

    <?php if ( get_theme_mod( 'footer_show_copyright', true ) ) : ?>
        <div class="footer-bottom <?php echo get_theme_mod( 'footer_show_top_border', true ) ? '' : 'no-border'; ?>">
            <p class="copyright">
                &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. 
                <?php printf( esc_html__( 'Powered by %s', 'clean-theme' ), '<a href="https://wordpress.org/">WordPress</a>' ); ?>
            </p>
        </div>
    <?php endif; ?>
</div>

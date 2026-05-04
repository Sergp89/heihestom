<?php
/**
 * Footer Style 2: 3 Columns (Logo, Menu, Contact)
 *
 * @package Clean_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<div class="ct-container">
    <div class="footer-widgets style-2">
        <!-- Column 1: Logo -->
        <div class="footer-column footer-col-1">
            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <?php dynamic_sidebar( 'footer-1' ); ?>
            <?php else : ?>
                <div class="site-branding">
                    <?php clean_theme_site_logo(); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Column 2: Menu -->
        <div class="footer-column footer-col-2">
            <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                <?php dynamic_sidebar( 'footer-2' ); ?>
            <?php else : ?>
                <h3><?php esc_html_e( 'Quick Links', 'clean-theme' ); ?></h3>
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

        <!-- Column 3: Contact Info -->
        <div class="footer-column footer-col-3">
            <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                <?php dynamic_sidebar( 'footer-3' ); ?>
            <?php else : ?>
                <h3><?php esc_html_e( 'Contact Us', 'clean-theme' ); ?></h3>
                <div class="footer-contact">
                    <p><strong><?php esc_html_e( 'Email:', 'clean-theme' ); ?></strong> <a href="mailto:<?php echo esc_attr( get_option( 'admin_email' ) ); ?>"><?php echo esc_html( get_option( 'admin_email' ) ); ?></a></p>
                </div>
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

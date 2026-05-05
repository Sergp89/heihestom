<?php
/**
 * Footer Style 3: 4 Columns (Full Widget Grid)
 *
 * @package Clean_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<div class="ct-container">
    <div class="footer-widgets style-3">
        <!-- Column 1 -->
        <div class="footer-column footer-col-1">
            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <?php dynamic_sidebar( 'footer-1' ); ?>
            <?php else : ?>
                <h3><?php esc_html_e( 'About', 'clean-theme' ); ?></h3>
                <div class="site-branding">
                    <?php clean_theme_site_logo(); ?>
                </div>
                <p><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
            <?php endif; ?>
        </div>

        <!-- Column 2 -->
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

        <!-- Column 3 -->
        <div class="footer-column footer-col-3">
            <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                <?php dynamic_sidebar( 'footer-3' ); ?>
            <?php else : ?>
                <h3><?php esc_html_e( 'Categories', 'clean-theme' ); ?></h3>
                <ul>
                    <?php wp_list_categories( array(
                        'title_li' => '',
                        'number'   => 5,
                    ) ); ?>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Column 4 -->
        <div class="footer-column footer-col-4">
            <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                <?php dynamic_sidebar( 'footer-4' ); ?>
            <?php else : ?>
                <h3><?php esc_html_e( 'Contact', 'clean-theme' ); ?></h3>
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

<?php
/**
 * Footer Style 1: 2 Columns (Logo + Info, Menu)
 *
 * @package Clean_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div class="footer-content footer-style-1">
    <div class="footer-column footer-left">
        <?php if ( has_custom_logo() ) : ?>
            <div class="footer-logo">
                <?php the_custom_logo(); ?>
            </div>
        <?php else : ?>
            <h3 class="site-title-footer">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php bloginfo( 'name' ); ?>
                </a>
            </h3>
        <?php endif; ?>

        <?php 
        $description = get_theme_mod( 'footer_description', '' );
        if ( ! empty( $description ) ) : 
        ?>
            <p class="footer-description"><?php echo esc_html( $description ); ?></p>
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'footer-left' ) ) : ?>
            <div class="footer-widgets">
                <?php dynamic_sidebar( 'footer-left' ); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="footer-column footer-right">
        <?php if ( is_active_sidebar( 'footer-menu' ) ) : ?>
            <div class="footer-menu-widget">
                <?php dynamic_sidebar( 'footer-menu' ); ?>
            </div>
        <?php elseif ( has_nav_menu( 'footer' ) ) : ?>
            <nav class="footer-navigation">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'menu_class'     => 'footer-menu',
                    'container'      => false,
                    'depth'          => 1,
                ) );
                ?>
            </nav>
        <?php endif; ?>
    </div>
</div>

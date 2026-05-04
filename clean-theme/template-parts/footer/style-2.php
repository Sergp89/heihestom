<?php
/**
 * Footer Style 2: 3 Columns (Logo, Menu, Contacts)
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div class="footer-content footer-style-2">
    <div class="footer-column">
        <?php if ( has_custom_logo() ) : ?>
            <div class="footer-logo"><?php the_custom_logo(); ?></div>
        <?php else : ?>
            <h3 class="site-title-footer"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h3>
        <?php endif; ?>
        <?php $desc = get_theme_mod( 'footer_description', '' ); if ( $desc ) : ?>
            <p class="footer-description"><?php echo esc_html( $desc ); ?></p>
        <?php endif; ?>
    </div>
    <div class="footer-column">
        <?php if ( has_nav_menu( 'footer' ) ) : ?>
            <nav class="footer-navigation"><?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'footer-menu', 'container' => false, 'depth' => 1 ) ); ?></nav>
        <?php endif; ?>
    </div>
    <div class="footer-column">
        <?php
        $phone = get_theme_mod( 'footer_phone', '' );
        $email = get_theme_mod( 'footer_email', '' );
        $hours = get_theme_mod( 'footer_hours', '' );
        if ( $phone || $email || $hours ) : ?>
            <div class="footer-contacts">
                <?php if ( $phone ) : ?><p><a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></p><?php endif; ?>
                <?php if ( $email ) : ?><p><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p><?php endif; ?>
                <?php if ( $hours ) : ?><p><?php echo esc_html( $hours ); ?></p><?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if ( is_active_sidebar( 'footer-contact' ) ) : ?><?php dynamic_sidebar( 'footer-contact' ); ?><?php endif; ?>
    </div>
</div>

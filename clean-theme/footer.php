<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Clean_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <!-- Footer Left Column -->
                <div class="footer-left">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="footer-logo-section">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( get_bloginfo( 'name' ) ) : ?>
                        <h3 class="footer-site-title">
                            <?php bloginfo( 'name' ); ?>
                            <?php if ( get_theme_mod( 'footer_accent_text' ) ) : ?>
                                <span><?php echo esc_html( get_theme_mod( 'footer_accent_text' ) ); ?></span>
                            <?php endif; ?>
                        </h3>
                    <?php endif; ?>

                    <?php 
                    $footer_description = get_theme_mod( 'footer_description', get_bloginfo( 'description' ) );
                    if ( $footer_description ) : 
                    ?>
                        <p class="footer-description"><?php echo esc_html( $footer_description ); ?></p>
                    <?php endif; ?>

                    <!-- Footer Contact Widget Area -->
                    <?php if ( is_active_sidebar( 'footer-contact' ) ) : ?>
                        <div class="footer-contact-widget">
                            <?php dynamic_sidebar( 'footer-contact' ); ?>
                        </div>
                    <?php else : ?>
                        <!-- Default contact info from Customizer -->
                        <?php $footer_phone = get_theme_mod( 'footer_phone' ); ?>
                        <?php $footer_email = get_theme_mod( 'footer_email' ); ?>
                        <?php $footer_address = get_theme_mod( 'footer_address' ); ?>
                        <?php $footer_hours = get_theme_mod( 'footer_hours' ); ?>
                        
                        <?php if ( $footer_phone || $footer_email || $footer_address || $footer_hours ) : ?>
                            <div class="footer-contact-widget">
                                <?php if ( $footer_address ) : ?>
                                    <div class="footer-contact-item">
                                        <div class="footer-contact-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                        </div>
                                        <div class="footer-contact-text">
                                            <span class="footer-contact-label"><?php esc_html_e( 'Address', 'clean-theme' ); ?></span>
                                            <span class="footer-contact-value"><?php echo esc_html( $footer_address ); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ( $footer_phone ) : ?>
                                    <div class="footer-contact-item">
                                        <div class="footer-contact-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                            </svg>
                                        </div>
                                        <div class="footer-contact-text">
                                            <span class="footer-contact-label"><?php esc_html_e( 'Phone', 'clean-theme' ); ?></span>
                                            <span class="footer-contact-value">
                                                <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $footer_phone ) ); ?>">
                                                    <?php echo esc_html( $footer_phone ); ?>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ( $footer_email ) : ?>
                                    <div class="footer-contact-item">
                                        <div class="footer-contact-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                <polyline points="22,6 12,13 2,6"></polyline>
                                            </svg>
                                        </div>
                                        <div class="footer-contact-text">
                                            <span class="footer-contact-label"><?php esc_html_e( 'Email', 'clean-theme' ); ?></span>
                                            <span class="footer-contact-value">
                                                <a href="mailto:<?php echo esc_attr( $footer_email ); ?>">
                                                    <?php echo esc_html( $footer_email ); ?>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ( $footer_hours ) : ?>
                                    <div class="footer-contact-item">
                                        <div class="footer-contact-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                        </div>
                                        <div class="footer-contact-text">
                                            <span class="footer-contact-label"><?php esc_html_e( 'Working Hours', 'clean-theme' ); ?></span>
                                            <span class="footer-contact-value"><?php echo esc_html( $footer_hours ); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <!-- Footer Right Column -->
                <div class="footer-right">
                    <!-- Footer Menu Widget Area -->
                    <?php if ( is_active_sidebar( 'footer-menu' ) ) : ?>
                        <div class="footer-menu-widget">
                            <?php dynamic_sidebar( 'footer-menu' ); ?>
                        </div>
                    <?php elseif ( has_nav_menu( 'footer' ) ) : ?>
                        <div class="footer-menu-widget">
                            <h4 class="footer-menu-title"><?php esc_html_e( 'Quick Links', 'clean-theme' ); ?></h4>
                            <nav class="footer-menu-nav">
                                <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'footer',
                                    'menu_class'     => 'footer-menu',
                                    'container'      => false,
                                    'depth'          => 1,
                                ) );
                                ?>
                            </nav>
                        </div>
                    <?php endif; ?>

                    <!-- Footer Right Widget Area -->
                    <?php if ( is_active_sidebar( 'footer-right' ) ) : ?>
                        <div class="footer-right-widget">
                            <?php dynamic_sidebar( 'footer-right' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Footer Bottom - Copyright -->
            <div class="footer-bottom">
                <p class="footer-copyright">
                    <?php
                    $current_year = date( 'Y' );
                    $site_name = get_bloginfo( 'name' );
                    
                    if ( $site_name ) {
                        printf(
                            /* translators: %1$d: current year, %2$s: site name */
                            esc_html__( '© %1$d %2$s. All rights reserved.', 'clean-theme' ),
                            esc_html( $current_year ),
                            esc_html( $site_name )
                        );
                    } else {
                        printf(
                            /* translators: %d: current year */
                            esc_html__( '© %d. All rights reserved.', 'clean-theme' ),
                            esc_html( $current_year )
                        );
                    }
                    
                    $copyright_text = get_theme_mod( 'footer_copyright_text' );
                    if ( $copyright_text ) {
                        echo ' ' . wp_kses_post( $copyright_text );
                    }
                    ?>
                </p>
            </div>
        </div>
    </footer><!-- #colophon -->

    <!-- Floating Action Buttons -->
    <div class="floating-buttons-container">
        <!-- Feedback Button -->
        <div class="feedback-button-wrapper">
            <div class="feedback-popup" id="feedbackPopup">
                <h4><?php echo esc_html( get_theme_mod( 'feedback_popup_title', __( 'Contact Us', 'clean-theme' ) ) ); ?></h4>
                <p><?php echo esc_html( get_theme_mod( 'feedback_popup_text', __( 'Get in touch with us using the contacts below:', 'clean-theme' ) ) ); ?></p>
                
                <?php $feedback_phone = get_theme_mod( 'feedback_phone' ); ?>
                <?php $feedback_email = get_theme_mod( 'feedback_email' ); ?>
                <?php $feedback_whatsapp = get_theme_mod( 'feedback_whatsapp' ); ?>
                
                <?php if ( $feedback_phone ) : ?>
                    <div class="feedback-contact-item">
                        <div class="feedback-contact-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div class="feedback-contact-info">
                            <span class="feedback-contact-label"><?php esc_html_e( 'Phone', 'clean-theme' ); ?></span>
                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $feedback_phone ) ); ?>" class="feedback-contact-link">
                                <?php echo esc_html( $feedback_phone ); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( $feedback_email ) : ?>
                    <div class="feedback-contact-item">
                        <div class="feedback-contact-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <div class="feedback-contact-info">
                            <span class="feedback-contact-label"><?php esc_html_e( 'Email', 'clean-theme' ); ?></span>
                            <a href="mailto:<?php echo esc_attr( $feedback_email ); ?>" class="feedback-contact-link">
                                <?php echo esc_html( $feedback_email ); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( $feedback_whatsapp ) : ?>
                    <div class="feedback-contact-item">
                        <div class="feedback-contact-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg>
                        </div>
                        <div class="feedback-contact-info">
                            <span class="feedback-contact-label"><?php esc_html_e( 'WhatsApp', 'clean-theme' ); ?></span>
                            <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $feedback_whatsapp ) ); ?>" class="feedback-contact-link" target="_blank" rel="noopener">
                                <?php echo esc_html( $feedback_whatsapp ); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <button class="feedback-button" id="feedbackButton" aria-label="<?php esc_attr_e( 'Contact us', 'clean-theme' ); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
            </button>
        </div>

        <!-- Scroll to Top Button -->
        <button class="scroll-top-btn" id="scrollTopBtn" aria-label="<?php esc_attr_e( 'Scroll to top', 'clean-theme' ); ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <polyline points="18 15 12 9 6 15"></polyline>
            </svg>
        </button>
    </div>

    <?php wp_footer(); ?>
</body>
</html>

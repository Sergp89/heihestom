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
        <div class="footer-inner">
            <!-- Footer Left Column -->
            <div class="footer-left">
                <?php if ( has_custom_logo() ) : ?>
                    <div class="footer-logo">
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
                        <ul class="widget-contact-list">
                            <?php if ( $footer_address ) : ?>
                                <li class="widget-contact-item">
                                    <div class="icon-box">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                    </div>
                                    <div class="contact-info">
                                        <span class="contact-label"><?php esc_html_e( 'Address', 'clean-dental' ); ?></span>
                                        <span class="contact-value"><?php echo esc_html( $footer_address ); ?></span>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if ( $footer_phone ) : ?>
                                <li class="widget-contact-item">
                                    <div class="icon-box">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg>
                                    </div>
                                    <div class="contact-info">
                                        <span class="contact-label"><?php esc_html_e( 'Phone', 'clean-dental' ); ?></span>
                                        <span class="contact-value">
                                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $footer_phone ) ); ?>">
                                                <?php echo esc_html( $footer_phone ); ?>
                                            </a>
                                        </span>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if ( $footer_email ) : ?>
                                <li class="widget-contact-item">
                                    <div class="icon-box">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                    </div>
                                    <div class="contact-info">
                                        <span class="contact-label"><?php esc_html_e( 'Email', 'clean-dental' ); ?></span>
                                        <span class="contact-value">
                                            <a href="mailto:<?php echo esc_attr( $footer_email ); ?>">
                                                <?php echo esc_html( $footer_email ); ?>
                                            </a>
                                        </span>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if ( $footer_hours ) : ?>
                                <li class="widget-contact-item">
                                    <div class="icon-box">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                    </div>
                                    <div class="contact-info">
                                        <span class="contact-label"><?php esc_html_e( 'Working Hours', 'clean-dental' ); ?></span>
                                        <span class="contact-value"><?php echo esc_html( $footer_hours ); ?></span>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
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
        <div class="footer-copyright">
            <p>
                <?php
                $current_year = date( 'Y' );
                $site_name = get_bloginfo( 'name' );
                
                if ( $site_name ) {
                    printf(
                        /* translators: %1$d: current year, %2$s: site name */
                        esc_html__( '© %1$d %2$s. All rights reserved.', 'clean-dental' ),
                        esc_html( $current_year ),
                        esc_html( $site_name )
                    );
                } else {
                    printf(
                        /* translators: %d: current year */
                        esc_html__( '© %d. All rights reserved.', 'clean-dental' ),
                        esc_html( $current_year )
                    );
                }
                ?>
            </p>
        </div>
    </footer><!-- #colophon -->

    <!-- Floating Action Buttons (FAB) -->
    <div class="fab-container">
        <!-- Main Callback FAB with Expandable List -->
        <button class="callback-fab-main" id="callbackFabMain" aria-label="<?php esc_attr_e( 'Contact us', 'clean-dental' ); ?>" aria-expanded="false">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
        </button>
        
        <!-- FAB List (Hidden by default) -->
        <div class="fab-list" id="fabList">
            <!-- Messenger Button -->
            <?php $messenger_link = get_theme_mod( 'fab_messenger_link' ); ?>
            <?php if ( $messenger_link ) : ?>
                <a href="<?php echo esc_url( $messenger_link ); ?>" class="fab-item" target="_blank" rel="noopener">
                    <span class="fab-item-icon messenger">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                        </svg>
                    </span>
                    <span class="fab-item-text"><?php echo esc_html( get_theme_mod( 'fab_messenger_label', __( 'Messenger', 'clean-dental' ) ) ); ?></span>
                </a>
            <?php endif; ?>

            <!-- Phone Button -->
            <?php $phone = get_theme_mod( 'fab_phone' ); ?>
            <?php if ( $phone ) : ?>
                <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" class="fab-item">
                    <span class="fab-item-icon phone">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </span>
                    <span class="fab-item-text"><?php echo esc_html( $phone ); ?></span>
                </a>
            <?php endif; ?>

            <!-- Form Button -->
            <button class="fab-item" id="fabFormBtn" type="button">
                <span class="fab-item-icon form">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </span>
                <span class="fab-item-text"><?php echo esc_html( get_theme_mod( 'fab_form_label', __( 'Request a call', 'clean-dental' ) ) ); ?></span>
            </button>
        </div>

        <!-- Scroll to Top FAB Button -->
        <button class="callback-fab-scroll" id="scrollTopFab" aria-label="<?php esc_attr_e( 'Scroll to top', 'clean-dental' ); ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="18 15 12 9 6 15"></polyline>
            </svg>
        </button>
    </div>

    <!-- Feedback Modal -->
    <div class="feedback-modal-overlay" id="feedbackModalOverlay">
        <div class="feedback-modal" role="dialog" aria-modal="true" aria-labelledby="feedbackModalTitle">
            <button class="modal-close" id="feedbackModalClose" aria-label="<?php esc_attr_e( 'Close modal', 'clean-dental' ); ?>">&times;</button>
            <div class="modal-header">
                <h3 id="feedbackModalTitle" class="modal-title"><?php echo esc_html( get_theme_mod( 'feedback_modal_title', __( 'Request a Call', 'clean-dental' ) ) ); ?></h3>
                <p class="modal-subtitle"><?php echo esc_html( get_theme_mod( 'feedback_modal_subtitle', __( 'Leave your details and we will call you back shortly.', 'clean-dental' ) ) ); ?></p>
            </div>
            
            <form class="feedback-form" method="post" action="">
                <div class="form-group">
                    <label for="feedback-name"><?php esc_html_e( 'Your Name', 'clean-dental' ); ?></label>
                    <input type="text" id="feedback-name" name="name" required placeholder="<?php esc_attr_e( 'John Doe', 'clean-dental' ); ?>">
                </div>

                <div class="form-group">
                    <label for="feedback-phone"><?php esc_html_e( 'Phone Number', 'clean-dental' ); ?></label>
                    <input type="tel" id="feedback-phone" name="phone" required placeholder="+1 (555) 123-4567">
                </div>

                <div class="form-group">
                    <label for="feedback-message"><?php esc_html_e( 'Message (optional)', 'clean-dental' ); ?></label>
                    <textarea id="feedback-message" name="message" placeholder="<?php esc_attr_e( 'How can we help you?', 'clean-dental' ); ?>"></textarea>
                </div>

                <button type="submit" class="submit-btn"><?php esc_html_e( 'Send Request', 'clean-dental' ); ?></button>
            </form>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>

<?php
/**
 * Template tags for Clean Theme
 *
 * Custom functions used as template tags throughout the theme.
 *
 * @package Clean_Theme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Display site logo with fallback to site title
 */
function clean_theme_site_logo() {
    if ( has_custom_logo() ) {
        the_custom_logo();
    } else {
        ?>
        <div class="site-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <?php bloginfo( 'name' ); ?>
            </a>
        </div>
        <?php
    }
}

/**
 * Get container class based on Customizer setting
 *
 * @return string Container class
 */
function clean_theme_get_container_class() {
    $layout = get_theme_mod( 'container_width', 'boxed' );
    
    switch ( $layout ) {
        case 'fluid':
            return 'ct-container-fluid';
        case 'wide':
            return 'ct-container-wide';
        default:
            return 'ct-container-boxed';
    }
}

/**
 * Get header layout class based on Customizer settings
 *
 * @return string Header class
 */
function clean_theme_get_header_class() {
    $logo_position = get_theme_mod( 'logo_position', 'left' );
    $menu_position = get_theme_mod( 'menu_position', 'below' );
    
    $classes = array();
    
    if ( 'center' === $logo_position ) {
        $classes[] = 'logo-center';
    } elseif ( 'right' === $logo_position ) {
        $classes[] = 'logo-right';
    }
    
    if ( 'inline' === $menu_position ) {
        $classes[] = 'menu-inline';
    }
    
    return implode( ' ', $classes );
}

/**
 * Get footer style from Customizer
 *
 * @return string Footer style slug
 */
function clean_theme_get_footer_style() {
    return get_theme_mod( 'footer_style', 'style-1' );
}

/**
 * Check if smooth scroll is enabled
 *
 * @return bool Whether smooth scroll is enabled
 */
function clean_theme_is_smooth_scroll_enabled() {
    return get_theme_mod( 'enable_smooth_scroll', true );
}

/**
 * Check if animations are enabled
 *
 * @return bool Whether animations are enabled
 */
function clean_theme_are_animations_enabled() {
    return get_theme_mod( 'enable_animations', true );
}

/**
 * Get typography settings
 *
 * @param string $type Font type ('headings' or 'body')
 * @return string Font family
 */
function clean_theme_get_font_family( $type = 'body' ) {
    $default = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif';
    
    if ( 'headings' === $type ) {
        $font = get_theme_mod( 'headings_font', 'default' );
    } else {
        $font = get_theme_mod( 'body_font', 'default' );
    }
    
    // Return Google Font if selected
    if ( 'default' !== $font && ! empty( $font ) ) {
        return '"' . esc_attr( $font ) . '", ' . $default;
    }
    
    return $default;
}

/**
 * Enqueue Google Fonts if selected
 */
function clean_theme_enqueue_google_fonts() {
    $fonts_to_load = array();
    
    $headings_font = get_theme_mod( 'headings_font', 'default' );
    $body_font     = get_theme_mod( 'body_font', 'default' );
    
    if ( 'default' !== $headings_font && ! empty( $headings_font ) ) {
        $fonts_to_load[] = $headings_font;
    }
    
    if ( 'default' !== $body_font && ! empty( $body_font ) && $body_font !== $headings_font ) {
        $fonts_to_load[] = $body_font;
    }
    
    if ( ! empty( $fonts_to_load ) ) {
        $font_families = array_unique( $fonts_to_load );
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'display' => 'swap',
        );
        
        wp_enqueue_style(
            'clean-theme-google-fonts',
            add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ),
            array(),
            null
        );
    }
}
add_action( 'wp_enqueue_scripts', 'clean_theme_enqueue_google_fonts' );

/**
 * Get floating buttons settings
 *
 * @return array Floating buttons configuration
 */
function clean_theme_get_float_buttons_settings() {
    return array(
        'scroll_top' => array(
            'enabled'      => get_theme_mod( 'enable_scroll_top', true ),
            'icon'         => get_theme_mod( 'scroll_top_icon', 'arrow' ),
            'bg_color'     => get_theme_mod( 'fab_scroll_bg_color', '#0ea5e9' ),
            'icon_color'   => get_theme_mod( 'scroll_top_icon_color', '#ffffff' ),
            'size'         => get_theme_mod( 'scroll_top_size', 50 ),
            'show_after'   => get_theme_mod( 'scroll_top_show_after', 300 ),
        ),
        'feedback' => array(
            'enabled'      => get_theme_mod( 'enable_feedback_group', true ),
            'icon'         => get_theme_mod( 'feedback_icon', 'chat' ),
            'animation'    => get_theme_mod( 'feedback_animation', 'fade' ),
            'bg_color'     => get_theme_mod( 'fab_feedback_bg_color', '#8b5cf6' ),
            'icon_color'   => get_theme_mod( 'feedback_icon_color', '#ffffff' ),
        ),
        'phone' => array(
            'enabled'      => get_theme_mod( 'enable_phone_button', false ),
            'phone'        => get_theme_mod( 'fab_phone', '' ),
            'icon'         => get_theme_mod( 'phone_icon', 'phone' ),
            'tooltip'      => get_theme_mod( 'phone_tooltip', __( 'Call us', 'clean-theme' ) ),
        ),
        'messenger' => array(
            'enabled'      => get_theme_mod( 'enable_messenger_button', false ),
            'link'         => get_theme_mod( 'fab_messenger_link', '' ),
            'label'        => get_theme_mod( 'fab_messenger_label', __( 'Write us', 'clean-theme' ) ),
            'icon'         => get_theme_mod( 'messenger_icon', 'messenger' ),
            'tooltip'      => get_theme_mod( 'messenger_tooltip', __( 'Chat with us', 'clean-theme' ) ),
        ),
        'contact_form' => array(
            'enabled'      => get_theme_mod( 'enable_contact_form_button', false ),
            'display_type' => get_theme_mod( 'contact_form_display', 'modal' ),
            'label'        => get_theme_mod( 'fab_form_label', __( 'Form', 'clean-theme' ) ),
            'icon'         => get_theme_mod( 'form_icon', 'form' ),
            'tooltip'      => get_theme_mod( 'form_tooltip', __( 'Contact form', 'clean-theme' ) ),
        ),
        'position' => array(
            'bottom'       => get_theme_mod( 'float_buttons_bottom', 20 ),
            'right'        => get_theme_mod( 'float_buttons_right', 20 ),
            'spacing'      => get_theme_mod( 'float_buttons_spacing', 15 ),
        ),
    );
}

/**
 * Display contact form modal
 */
function clean_theme_contact_form_modal() {
    $settings = clean_theme_get_float_buttons_settings();
    
    if ( ! $settings['contact_form']['enabled'] ) {
        return;
    }
    
    $title    = get_theme_mod( 'feedback_modal_title', __( 'Request a Call', 'clean-theme' ) );
    $subtitle = get_theme_mod( 'feedback_modal_subtitle', __( 'Leave your details and we will call you back shortly.', 'clean-theme' ) );
    $btn_text = get_theme_mod( 'contact_form_submit_text', __( 'Send Message', 'clean-theme' ) );
    $success_msg = get_theme_mod( 'contact_form_success_message', __( 'Thank you! Your message has been sent.', 'clean-theme' ) );
    $error_msg = get_theme_mod( 'contact_form_error_message', __( 'Sorry, there was an error. Please try again.', 'clean-theme' ) );
    
    ?>
    <div id="contact-form-modal" class="contact-form-modal" aria-hidden="true" role="dialog">
        <div class="contact-form-modal__overlay" tabindex="-1"></div>
        <div class="contact-form-modal__content">
            <button class="contact-form-modal__close" aria-label="<?php esc_attr_e( 'Close modal', 'clean-theme' ); ?>">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
            
            <div class="contact-form-modal__header">
                <h2><?php echo esc_html( $title ); ?></h2>
                <?php if ( ! empty( $subtitle ) ) : ?>
                    <p><?php echo esc_html( $subtitle ); ?></p>
                <?php endif; ?>
            </div>
            
            <form id="contact-form" class="contact-form" method="post">
                <?php wp_nonce_field( 'clean_theme_contact_form', 'contact_form_nonce' ); ?>
                
                <div class="contact-form__field">
                    <label for="contact-name"><?php esc_html_e( 'Your Name', 'clean-theme' ); ?> <span class="required">*</span></label>
                    <input type="text" id="contact-name" name="name" required autocomplete="name">
                </div>
                
                <div class="contact-form__field">
                    <label for="contact-email"><?php esc_html_e( 'Email Address', 'clean-theme' ); ?> <span class="required">*</span></label>
                    <input type="email" id="contact-email" name="email" required autocomplete="email">
                </div>
                
                <div class="contact-form__field">
                    <label for="contact-phone"><?php esc_html_e( 'Phone Number', 'clean-theme' ); ?></label>
                    <input type="tel" id="contact-phone" name="phone" autocomplete="tel">
                </div>
                
                <div class="contact-form__field">
                    <label for="contact-message"><?php esc_html_e( 'Message', 'clean-theme' ); ?> <span class="required">*</span></label>
                    <textarea id="contact-message" name="message" rows="4" required></textarea>
                </div>
                
                <button type="submit" class="contact-form__submit">
                    <span class="contact-form__submit-text"><?php echo esc_html( $btn_text ); ?></span>
                    <span class="contact-form__submit-loading" style="display:none;"><?php esc_html_e( 'Sending...', 'clean-theme' ); ?></span>
                </button>
                
                <div class="contact-form__response" style="display:none;"></div>
            </form>
        </div>
    </div>
    <?php
}

/**
 * Check if header widgets should be displayed
 *
 * @return bool Whether to show header widgets
 */
function clean_theme_should_show_header_widgets() {
    return get_theme_mod( 'show_header_widgets', true ) && is_active_sidebar( 'header-widgets' );
}

/**
 * Get number of header widget columns
 *
 * @return int Number of columns
 */
function clean_theme_get_header_widget_columns() {
    return absint( get_theme_mod( 'header_widget_columns', 1 ) );
}

<?php
/**
 * Template Tags
 *
 * Custom functions that display markup not covered by core WordPress.
 *
 * @package Clean_Theme
 * @since Clean Theme 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Display site logo
 */
function clean_theme_site_logo() {
    if ( has_custom_logo() ) {
        the_custom_logo();
    } else { ?>
        <div class="site-branding-text">
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
            <?php
            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
        </div>
    <?php }
}

/**
 * Display primary navigation menu
 */
function clean_theme_primary_menu() {
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'menu_id'        => 'primary-menu',
        'menu_class'     => 'primary-menu',
        'container'      => false,
        'fallback_cb'    => 'clean_theme_fallback_menu',
    ) );
}

/**
 * Fallback menu when no menu is assigned
 */
function clean_theme_fallback_menu() {
    ?>
    <ul id="primary-menu" class="primary-menu">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'clean-theme' ); ?></a></li>
        <?php wp_list_pages( array(
            'title_li' => '',
            'depth'    => 1,
        ) ); ?>
    </ul>
    <?php
}

/**
 * Display footer navigation menu
 */
function clean_theme_footer_menu() {
    wp_nav_menu( array(
        'theme_location' => 'footer',
        'menu_id'        => 'footer-menu',
        'menu_class'     => 'footer-menu',
        'container'      => false,
        'depth'          => 1,
        'fallback_cb'    => false,
    ) );
}

/**
 * Display post thumbnail with fallback
 */
function clean_theme_post_thumbnail( $size = 'post-thumbnail' ) {
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
        return;
    }

    if ( is_singular() ) : ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail( $size ); ?>
        </div>
    <?php else : ?>
        <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
            <?php the_post_thumbnail( $size, array(
                'alt' => the_title_attribute( array(
                    'echo' => false,
                ) ),
            ) ); ?>
        </a>
    <?php endif;
}

/**
 * Display posted on date
 */
function clean_theme_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
        $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( DATE_W3C ) ),
        esc_html( get_the_modified_date() )
    );

    printf(
        '<span class="posted-on">%1$s<a href="%2$s">%3$s</a></span>',
        esc_html_x( 'Posted on ', 'preceding label for publish date', 'clean-theme' ),
        esc_url( get_permalink() ),
        $time_string
    );
}

/**
 * Display post author
 */
function clean_theme_posted_by() {
    printf(
        '<span class="byline">%1$s<span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span></span>',
        esc_html_x( 'Posted by ', 'preceding label for author', 'clean-theme' ),
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_html( get_the_author() )
    );
}

/**
 * Display comments count
 */
function clean_theme_comments_count() {
    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        comments_popup_link(
            sprintf(
                wp_kses(
                    __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'clean-theme' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            )
        );
        echo '</span>';
    }
}

/**
 * Display entry meta
 */
function clean_theme_entry_meta() {
    if ( 'post' === get_post_type() ) {
        echo '<div class="entry-meta">';
        clean_theme_posted_on();
        clean_theme_posted_by();
        clean_theme_comments_count();
        echo '</div>';
    }
}

/**
 * Display widget area
 */
function clean_theme_widget_area( $id ) {
    if ( is_active_sidebar( $id ) ) {
        dynamic_sidebar( $id );
        return true;
    }
    return false;
}

/**
 * Get SVG icon
 */
function clean_theme_get_icon( $icon_name, $args = array() ) {
    $defaults = array(
        'class'       => '',
        'width'       => 24,
        'height'      => 24,
        'aria_hidden' => true,
    );
    
    $args = wp_parse_args( $args, $defaults );
    
    $icons_dir = CLEAN_THEME_DIR . '/assets/icons/';
    $icon_file = $icons_dir . $icon_name . '.svg';
    
    if ( file_exists( $icon_file ) ) {
        $svg = file_get_contents( $icon_file );
        
        if ( $args['aria_hidden'] ) {
            $svg = str_replace( '<svg', '<svg aria-hidden="true"', $svg );
        }
        
        if ( ! empty( $args['class'] ) ) {
            $svg = str_replace( '<svg', '<svg class="' . esc_attr( $args['class'] ) . '"', $svg );
        }
        
        $svg = str_replace( '<svg', '<svg width="' . absint( $args['width'] ) . '" height="' . absint( $args['height'] ) . '"', $svg );
        
        return $svg;
    }
    
    return '';
}

/**
 * Display back to top button
 */
function clean_theme_back_to_top_button() {
    if ( ! get_theme_mod( 'back_to_top_enabled', true ) ) {
        return;
    }
    
    $icon = get_theme_mod( 'back_to_top_icon', 'arrow-up' );
    $scroll_offset = get_theme_mod( 'back_to_top_scroll_offset', 500 );
    
    ?>
    <button class="ct-float-btn ct-back-to-top" 
            data-scroll-offset="<?php echo esc_attr( $scroll_offset ); ?>"
            aria-label="<?php esc_attr_e( 'Back to top', 'clean-theme' ); ?>">
        <?php echo clean_theme_get_icon( $icon ); ?>
    </button>
    <?php
}

/**
 * Display contact buttons group
 */
function clean_theme_contact_buttons() {
    if ( ! get_theme_mod( 'contact_buttons_enabled', false ) ) {
        return;
    }
    
    $animation = get_theme_mod( 'contact_animation', 'fade' );
    ?>
    <div class="ct-contact-group">
        <div class="ct-contact-submenu <?php echo esc_attr( $animation ); ?>">
            <?php
            // Phone button
            if ( get_theme_mod( 'phone_button_enabled', false ) ) :
                $phone = get_theme_mod( 'phone_number', '' );
                $tooltip = get_theme_mod( 'phone_tooltip', __( 'Call Us', 'clean-theme' ) );
                if ( ! empty( $phone ) ) : ?>
                    <a href="tel:<?php echo esc_attr( $phone ); ?>" 
                       class="ct-float-btn ct-tooltip" 
                       data-tooltip="<?php echo esc_attr( $tooltip ); ?>"
                       aria-label="<?php echo esc_attr( $tooltip ); ?>">
                        <?php echo clean_theme_get_icon( 'phone' ); ?>
                    </a>
                <?php endif;
            endif;
            
            // Messenger button
            if ( get_theme_mod( 'messenger_button_enabled', false ) ) :
                $link = get_theme_mod( 'messenger_link', '' );
                $tooltip = get_theme_mod( 'messenger_tooltip', __( 'Chat on Max', 'clean-theme' ) );
                if ( ! empty( $link ) ) : ?>
                    <a href="<?php echo esc_url( $link ); ?>" 
                       class="ct-float-btn ct-tooltip" 
                       data-tooltip="<?php echo esc_attr( $tooltip ); ?>"
                       aria-label="<?php echo esc_attr( $tooltip ); ?>"
                       target="_blank"
                       rel="noopener noreferrer">
                        <?php echo clean_theme_get_icon( 'chat' ); ?>
                    </a>
                <?php endif;
            endif;
            
            // Contact form button
            if ( get_theme_mod( 'contact_form_button_enabled', false ) ) :
                $display_type = get_theme_mod( 'contact_form_display_type', 'modal' );
                ?>
                <button class="ct-float-btn ct-contact-form-toggle" 
                        data-display-type="<?php echo esc_attr( $display_type ); ?>"
                        aria-label="<?php esc_attr_e( 'Contact Form', 'clean-theme' ); ?>">
                    <?php echo clean_theme_get_icon( 'envelope' ); ?>
                </button>
                <?php
            endif;
            ?>
        </div>
        
        <button class="ct-float-btn ct-contact-main-toggle" 
                aria-label="<?php esc_attr_e( 'Contact Options', 'clean-theme' ); ?>"
                aria-expanded="false">
            <?php echo clean_theme_get_icon( 'comments' ); ?>
        </button>
    </div>
    <?php
}

/**
 * Display contact form modal
 */
function clean_theme_contact_form_modal() {
    if ( ! get_theme_mod( 'contact_form_button_enabled', false ) ) {
        return;
    }
    
    $display_type = get_theme_mod( 'contact_form_display_type', 'modal' );
    $email = get_theme_mod( 'contact_form_email', get_option( 'admin_email' ) );
    $submit_text = get_theme_mod( 'contact_form_submit_text', __( 'Send Message', 'clean-theme' ) );
    ?>
    
    <?php if ( 'modal' === $display_type ) : ?>
        <div class="ct-modal-overlay" id="contact-form-modal">
            <div class="ct-modal">
                <button class="ct-modal-close" aria-label="<?php esc_attr_e( 'Close', 'clean-theme' ); ?>">&times;</button>
                <h3><?php esc_html_e( 'Contact Us', 'clean-theme' ); ?></h3>
                <form id="contact-form" class="ct-contact-form">
                    <?php wp_nonce_field( 'clean_theme_contact_form_nonce', 'contact_form_nonce' ); ?>
                    <input type="hidden" name="action" value="clean_theme_send_contact_form">
                    <input type="hidden" name="recipient_email" value="<?php echo esc_attr( $email ); ?>">
                    
                    <div class="ct-form-group">
                        <label for="contact-name"><?php esc_html_e( 'Name', 'clean-theme' ); ?> *</label>
                        <input type="text" id="contact-name" name="contact_name" required>
                    </div>
                    
                    <div class="ct-form-group">
                        <label for="contact-email"><?php esc_html_e( 'Email', 'clean-theme' ); ?> *</label>
                        <input type="email" id="contact-email" name="contact_email" required>
                    </div>
                    
                    <div class="ct-form-group">
                        <label for="contact-phone"><?php esc_html_e( 'Phone', 'clean-theme' ); ?></label>
                        <input type="tel" id="contact-phone" name="contact_phone">
                    </div>
                    
                    <div class="ct-form-group">
                        <label for="contact-message"><?php esc_html_e( 'Message', 'clean-theme' ); ?> *</label>
                        <textarea id="contact-message" name="contact_message" required></textarea>
                    </div>
                    
                    <button type="submit" class="ct-btn-submit"><?php echo esc_html( $submit_text ); ?></button>
                    <div class="ct-form-response"></div>
                </form>
            </div>
        </div>
    <?php else : ?>
        <div class="ct-contact-panel" id="contact-form-panel">
            <button class="ct-modal-close" aria-label="<?php esc_attr_e( 'Close', 'clean-theme' ); ?>">&times;</button>
            <h3><?php esc_html_e( 'Contact Us', 'clean-theme' ); ?></h3>
            <form id="contact-form" class="ct-contact-form">
                <?php wp_nonce_field( 'clean_theme_contact_form_nonce', 'contact_form_nonce' ); ?>
                <input type="hidden" name="action" value="clean_theme_send_contact_form">
                <input type="hidden" name="recipient_email" value="<?php echo esc_attr( $email ); ?>">
                
                <div class="ct-form-group">
                    <label for="contact-name"><?php esc_html_e( 'Name', 'clean-theme' ); ?> *</label>
                    <input type="text" id="contact-name" name="contact_name" required>
                </div>
                
                <div class="ct-form-group">
                    <label for="contact-email"><?php esc_html_e( 'Email', 'clean-theme' ); ?> *</label>
                    <input type="email" id="contact-email" name="contact_email" required>
                </div>
                
                <div class="ct-form-group">
                    <label for="contact-phone"><?php esc_html_e( 'Phone', 'clean-theme' ); ?></label>
                    <input type="tel" id="contact-phone" name="contact_phone">
                </div>
                
                <div class="ct-form-group">
                    <label for="contact-message"><?php esc_html_e( 'Message', 'clean-theme' ); ?> *</label>
                    <textarea id="contact-message" name="contact_message" required></textarea>
                </div>
                
                <button type="submit" class="ct-btn-submit"><?php echo esc_html( $submit_text ); ?></button>
                <div class="ct-form-response"></div>
            </form>
        </div>
    <?php endif;
}

/**
 * Display float buttons
 */
function clean_theme_float_buttons() {
    if ( ! get_theme_mod( 'back_to_top_enabled', true ) && ! get_theme_mod( 'contact_buttons_enabled', false ) ) {
        return;
    }
    ?>
    <div class="ct-float-buttons">
        <?php
        clean_theme_contact_buttons();
        clean_theme_back_to_top_button();
        ?>
    </div>
    <?php
    clean_theme_contact_form_modal();
}

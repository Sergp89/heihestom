<?php
/**
 * Custom template tags for this theme
 *
 * @package Dental_Clinic
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display posted on meta
 */
if (!function_exists('dental_clinic_posted_on')) {
    function dental_clinic_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            esc_html_x('Posted on %s', 'post date', 'dental-clinic'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>';
    }
}

/**
 * Display posted by meta
 */
if (!function_exists('dental_clinic_posted_by')) {
    function dental_clinic_posted_by() {
        $byline = sprintf(
            esc_html_x('by %s', 'post author', 'dental-clinic'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>';
    }
}

/**
 * Print HTML with meta information for the current post-date/time and author.
 */
if (!function_exists('dental_clinic_entry_footer')) {
    function dental_clinic_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'dental-clinic'));
            if ($categories_list) {
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'dental-clinic') . '</span>', $categories_list);
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'dental-clinic'));
            if ($tags_list) {
                printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'dental-clinic') . '</span>', $tags_list);
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'dental-clinic'),
                        array('span' => array('class' => array()))
                    ),
                    get_the_title()
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    __('Edit <span class="screen-reader-text">%s</span>', 'dental-clinic'),
                    array('span' => array('class' => array()))
                ),
                get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
}

/**
 * Display an avatar for the comment author.
 */
if (!function_exists('dental_clinic_comment_avatar')) {
    function dental_clinic_comment_avatar($comment) {
        if (get_option('show_avatars')) {
            echo '<div class="comment-avatar">' . get_avatar($comment, 60) . '</div>';
        }
    }
}

/**
 * Returns true if caption is being used.
 */
if (!function_exists('dental_clinic_get_video_caption')) {
    function dental_clinic_get_video_caption($attachment_id) {
        $caption = '';

        if (function_exists('wp_get_attachment_caption')) {
            $caption = wp_get_attachment_caption($attachment_id);
        }

        return $caption;
    }
}

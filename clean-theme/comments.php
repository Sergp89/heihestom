<?php
/**
 * Template for displaying comments
 *
 * @package Clean_Theme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password,
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>

        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ( '1' === $comment_count ) {
                printf(
                    /* translators: 1: title. */
                    esc_html__( 'One comment on &ldquo;%1$s&rdquo;', 'clean-theme' ),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html( _nx( '%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'clean-theme' ) ),
                    number_format_i18n( $comment_count ),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
            ) );
            ?>
        </ol>

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, show a note.
        if ( ! comments_open() ) :
        ?>
            <p class="no-comments"><?php _e( 'Comments are closed.', 'clean-theme' ); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    comment_form( array(
        'class_form'         => 'comment-form',
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h3>',
    ) );
    ?>

</div><!-- #comments -->

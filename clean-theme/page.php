<?php
/**
 * Template for displaying pages
 *
 * @package Clean_Theme
 * @since 1.0.0
 */

get_header(); ?>

<?php
while ( have_posts() ) :
    the_post();
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail( 'large' ); ?>
            </div>
        <?php endif; ?>

        <div class="entry-content">
            <?php
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'clean-theme' ),
                'after'  => '</div>',
            ) );
            ?>
        </div>

        <?php if ( comments_open() || get_comments_number() ) : ?>
            <footer class="entry-footer">
                <?php comments_template(); ?>
            </footer>
        <?php endif; ?>
    </article>

<?php
endwhile;
?>

<?php
get_footer();

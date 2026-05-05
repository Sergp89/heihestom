<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Clean_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <?php clean_theme_post_thumbnail(); ?>

            <div class="entry-content">
                <?php
                the_content();

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'clean-theme' ),
                    'after'  => '</div>',
                ) );
                ?>
            </div><!-- .entry-content -->

            <?php if ( get_edit_post_link() ) : ?>
                <footer class="entry-footer">
                    <?php
                    edit_post_link(
                        sprintf(
                            wp_kses(
                                __( 'Edit <span class="screen-reader-text">%s</span>', 'clean-theme' ),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            get_the_title()
                        ),
                        '<span class="edit-link">',
                        '</span>'
                    );
                    ?>
                </footer><!-- .entry-footer -->
            <?php endif; ?>
        </article><!-- #post-<?php the_ID(); ?> -->

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>

</main><!-- #primary -->

<?php
get_sidebar();
get_footer();

<?php
/**
 * The template for displaying all single posts and attachments
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
                <?php
                the_title( '<h1 class="entry-title">', '</h1>' );

                if ( 'post' === get_post_type() ) :
                    clean_theme_entry_meta();
                endif;
                ?>
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

            <footer class="entry-footer">
                <?php
                $categories_list = get_the_category_list( ', ' );
                if ( $categories_list ) {
                    printf( '<span class="cat-links">%1$s %2$s</span>', esc_html__( 'Categories:', 'clean-theme' ), $categories_list );
                }

                $tags_list = get_the_tag_list( '', ', ' );
                if ( $tags_list ) {
                    printf( '<span class="tags-links">%1$s %2$s</span>', esc_html__( 'Tags:', 'clean-theme' ), $tags_list );
                }

                if ( get_edit_post_link() ) :
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
                endif;
                ?>
            </footer><!-- .entry-footer -->
        </article><!-- #post-<?php the_ID(); ?> -->

        <?php
        // Post navigation
        the_post_navigation( array(
            'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'clean-theme' ) . '</span> <span class="nav-title">%title</span>',
            'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'clean-theme' ) . '</span> <span class="nav-title">%title</span>',
        ) );

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

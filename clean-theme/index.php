<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Clean_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<main id="primary" class="site-main">

    <?php if ( have_posts() ) : ?>

        <div class="posts-loop">

            <?php
            while ( have_posts() ) :
                the_post();
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php
                        if ( is_singular() ) :
                            the_title( '<h1 class="entry-title">', '</h1>' );
                        else :
                            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                        endif;

                        if ( 'post' === get_post_type() ) :
                            clean_theme_entry_meta();
                        endif;
                        ?>
                    </div><!-- .entry-header -->

                    <?php clean_theme_post_thumbnail(); ?>

                    <div class="entry-content">
                        <?php
                        if ( is_singular() ) :
                            the_content();
                        else :
                            the_excerpt();
                        endif;
                        ?>
                    </div><!-- .entry-content -->

                    <?php if ( is_singular() ) : ?>
                        <footer class="entry-footer">
                            <?php
                            wp_link_pages( array(
                                'before' => '<div class="page-links">' . __( 'Pages:', 'clean-theme' ),
                                'after'  => '</div>',
                            ) );

                            $categories_list = get_the_category_list( ', ' );
                            if ( $categories_list ) {
                                printf( '<span class="cat-links">%1$s %2$s</span>', esc_html__( 'Categories:', 'clean-theme' ), $categories_list );
                            }

                            $tags_list = get_the_tag_list( '', ', ' );
                            if ( $tags_list ) {
                                printf( '<span class="tags-links">%1$s %2$s</span>', esc_html__( 'Tags:', 'clean-theme' ), $tags_list );
                            }
                            ?>
                        </footer><!-- .entry-footer -->
                    <?php endif; ?>
                </article><!-- #post-<?php the_ID(); ?> -->

                <?php
            endwhile;

            the_posts_navigation();

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>

        </div><!-- .posts-loop -->

</main><!-- #primary -->

<?php
get_sidebar();
get_footer();

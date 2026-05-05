<?php
/**
 * The template for displaying archive pages
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

        <header class="page-header">
            <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
        </header><!-- .page-header -->

        <div class="posts-loop">

            <?php
            while ( have_posts() ) :
                the_post();
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

                        <?php if ( 'post' === get_post_type() ) : ?>
                            <div class="entry-meta">
                                <?php clean_theme_posted_on(); ?>
                                <?php clean_theme_posted_by(); ?>
                            </div><!-- .entry-meta -->
                        endif; ?>
                    </header><!-- .entry-header -->

                    <?php clean_theme_post_thumbnail(); ?>

                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->

                    <footer class="entry-footer">
                        <a class="read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'clean-theme' ); ?></a>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->

                <?php
            endwhile;

            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( 'Previous', 'clean-theme' ),
                'next_text' => __( 'Next', 'clean-theme' ),
            ) );

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>

        </div><!-- .posts-loop -->

</main><!-- #primary -->

<?php
get_sidebar();
get_footer();

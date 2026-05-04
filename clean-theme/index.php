<?php
/**
 * The main template file
 *
 * @package Clean_Theme
 * @since 1.0.0
 */

get_header();
?>

<div id="content" class="site-content">
    <div class="container">

        <!-- Content Top Widget Area -->
        <?php if ( is_active_sidebar( 'content-top' ) ) : ?>
            <div class="content-top-widget">
                <?php dynamic_sidebar( 'content-top' ); ?>
            </div>
        <?php endif; ?>

        <div class="content-area" id="primary">
            <main id="main" class="site-main">
                <?php
                if ( have_posts() ) :

                    /* Start the Loop */
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
                                ?>

                                <?php if ( ! is_singular() ) : ?>
                                    <div class="entry-meta">
                                        <span class="posted-on"><?php echo get_the_date(); ?></span>
                                        <?php if ( get_the_author() ) : ?>
                                            <span class="byline"><?php the_author(); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </header>

                            <?php if ( has_post_thumbnail() && ! is_singular() ) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'large' ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="entry-content">
                                <?php
                                if ( is_singular() ) :
                                    the_content();
                                else :
                                    the_excerpt();
                                endif;
                                ?>
                            </div>

                            <?php if ( is_singular() ) : ?>
                                <footer class="entry-footer">
                                    <?php
                                    wp_link_pages( array(
                                        'before' => '<div class="page-links">' . __( 'Pages:', 'clean-theme' ),
                                        'after'  => '</div>',
                                    ) );
                                    ?>
                                </footer>
                            <?php endif; ?>
                        </article>

                        <?php
                        // If singular and comments open, show comments
                        if ( is_singular() && comments_open() ) :
                            comments_template();
                        endif;
                        ?>

                    <?php endwhile;

                    // Pagination
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => __( 'Previous', 'clean-theme' ),
                        'next_text' => __( 'Next', 'clean-theme' ),
                    ) );

                else :
                    ?>
                    <section class="no-results not-found">
                        <header class="page-header">
                            <h1 class="page-title"><?php _e( 'Nothing Found', 'clean-theme' ); ?></h1>
                        </header>
                        <div class="page-content">
                            <?php if ( is_search() ) : ?>
                                <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'clean-theme' ); ?></p>
                                <?php get_search_form(); ?>
                            <?php else : ?>
                                <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'clean-theme' ); ?></p>
                                <?php get_search_form(); ?>
                            <?php endif; ?>
                        </div>
                    </section>
                <?php endif; ?>
                ?>

            </main><!-- #main -->
        </div><!-- #primary -->

        <!-- Sidebar -->
        <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
            <aside id="secondary" class="widget-area sidebar">
                <?php dynamic_sidebar( 'sidebar' ); ?>
            </aside>
        <?php endif; ?>

    </div><!-- .container -->

    <!-- Content Bottom Widget Area -->
    <?php if ( is_active_sidebar( 'content-bottom' ) ) : ?>
        <div class="content-bottom-widget">
            <?php dynamic_sidebar( 'content-bottom' ); ?>
        </div>
    <?php endif; ?>

</div><!-- #content -->

<?php get_footer(); ?>

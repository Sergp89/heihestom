<?php
/**
 * Template for displaying search results
 *
 * @package Clean_Theme
 * @since 1.0.0
 */

get_header(); ?>

<div class="content-area" id="primary">
    <main id="main" class="site-main">

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    printf(
                        /* translators: %s: search query */
                        esc_html__( 'Search Results for: %s', 'clean-theme' ),
                        '<span>' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
            </header>

            <?php
            while ( have_posts() ) :
                the_post();
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                    </header>

                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div>
                </article>

            <?php endwhile; ?>

            <?php
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

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();

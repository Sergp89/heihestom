<?php
/**
 * Template for displaying single posts and attachments
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

            <div class="entry-meta">
                <span class="posted-on">
                    <time datetime="<?php echo get_the_date( 'c' ); ?>">
                        <?php echo get_the_date(); ?>
                    </time>
                </span>
                <?php if ( get_the_author() ) : ?>
                    <span class="byline">
                        <?php _e( 'by', 'clean-theme' ); ?> <?php the_author(); ?>
                    </span>
                <?php endif; ?>
                <?php if ( has_category() ) : ?>
                    <span class="cat-links">
                        <?php _e( 'in', 'clean-theme' ); ?> <?php the_category( ', ' ); ?>
                    </span>
                <?php endif; ?>
            </div>
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

        <footer class="entry-footer">
            <?php
            // Display tags if any
            $tags_list = get_the_tag_list( '', ', ' );
            if ( $tags_list ) :
            ?>
                <div class="tags-links">
                    <?php _e( 'Tags:', 'clean-theme' ); ?> <?php echo $tags_list; ?>
                </div>
            <?php endif; ?>

            <!-- Post navigation -->
            <nav class="post-navigation">
                <div class="nav-previous">
                    <?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'clean-theme' ) . '</span> %title' ); ?>
                </div>
                <div class="nav-next">
                    <?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'clean-theme' ) . '</span>' ); ?>
                </div>
            </nav>
        </footer>

        <?php
        // If comments are open or there is at least one comment, load the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>
    </article>

<?php
endwhile;
?>

<?php
get_footer();

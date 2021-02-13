<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cavatina
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'c-post c-post--archive' ); ?>>
    <header class="c-post__header entry-header">
        <?php
		if ( is_singular() ) :
			the_title( '<h1 class="c-post__entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="c-post__entry-title"><a class="c-post__entry-title__anchor" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
        <div class="c-post__meta entry-meta">
            <?php
            
                echo '<div class="c-post__category">'. esc_html( cavatina_get_category() ) .'</div>';
                echo '<span class="o-bullet o-bullet--sm"></span>';
				echo '<span class="c-post__date">'. esc_html( cavatina_get_date_tertiary() ) .'</span>';

			?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="c-post__thumbnail">
        <a href=<?php the_permalink() ?>>
            <?php cavatina_get_posts_archive_thumbnail()  ?>
        </a>
    </div>
    <div class="entry-content">
        <?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cavatina' ),
				'after'  => '</div>',
			)
		);
		?>
    </div><!-- .entry-content -->
    <footer class="entry-footer">
        <?php //wp_cavatina_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
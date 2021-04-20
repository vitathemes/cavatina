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
			the_title( '<h3 class="c-post__entry-title">', '</h3>' );
		else :
			the_title( '<h3 class="c-post__entry-title"><a class="c-post__entry-title__anchor" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		endif;
		?>
        <div class="c-post__meta entry-meta">
            <?php
            
                echo '<div class="c-post__category">'. esc_html( cavatina_get_category( true ) ) .'</div>';
                echo '<span class="o-bullet o-bullet--sm" tabindex="-1"></span>';
				echo '<span class="c-post__date">'. esc_html( get_the_date( "M d.y" ) ) .'</span>';

			?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="c-post__thumbnail">
        <a href=<?php the_permalink() ?>>
            <?php cavatina_get_thumbnail_with_preloader("c-post__thumbnail__image")  ?>
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
</article><!-- #post-<?php the_ID(); ?> -->
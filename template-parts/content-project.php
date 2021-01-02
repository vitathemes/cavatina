<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-cavatina
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'c-post c-post--archive' ); ?>>


    <header class="c-post__header c-post__header--space-height entry-header">

        <span class="c-numeric-bullet"></span>
        <?php
		if ( is_singular() ) :
			the_title( '<h1 class="c-post__entry-title c-post__entry-title--projects entry-title ">', '</h1>' );
		else :
			the_title( '<h2 class="c-post__entry-title c-post__entry-title--projects entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

        <div class="c-post__meta c-post__meta--left-space entry-meta">
            <?php 
			
				echo '<span class="c-post__category">'. get_the_category( $id )[0]->name .'</span>';  
				
			
			?>
        </div><!-- .entry-meta -->



    </header><!-- .entry-header -->



    <a href=<?php the_permalink() ?>>
        <?php the_post_thumbnail('large', array('class' => 'c-post_thumbnail')); ?>
    </a>

    <div class="entry-content">
        <?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wp-cavatina' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-cavatina' ),
				'after'  => '</div>',
			)
		);
		?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php //wp_cavatina_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
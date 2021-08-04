<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cavatina
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'c-single__blog__post' ); ?>>
    <header class="c-single__blog__header entry-header">
        <div class="c-single__blog__meta entry-meta">
            <?php
                if( get_theme_mod( 'show_single_cat', true ) ) {
                    echo '<span class="c-post__category ">'.  esc_html( cavatina_get_category() ) .'</span>';
                }
                if( get_theme_mod( 'publish_date' , true ) ){   
                    echo '<span class="o-bullet o-bullet--sm"></span>';
				    echo '<span class="c-post__date"><a href="'. esc_url( get_permalink() ) .'">'.esc_html( get_the_date( "M d.y" ) ) .'</a></span>';
                }
			?>
        </div><!-- .entry-meta -->
        <?php
		if ( is_singular() ) :
			the_title( '<h1 class="c-single__blog__entry-title">', '</h1>' );
		else :
			the_title( '<h1 class="entry-title "><a class="c-post__entry-title__anchor" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
		endif;
		?>

        <?php if( get_theme_mod( 'show_author' , true )) :  ?>
        <div class="c-single__author">
            <div class="c-single__author__avatar">
                <?php echo get_avatar( get_the_author_meta('user_email'), '80', '' ); ?>
            </div>
            <div class="c-single__author__info">
                <?php cavatina_posted_by(); ?>
            </div>
        </div>
        <?php endif; ?>

    </header><!-- .entry-header -->

    <?php cavatina_get_thumbnail(); ?>


    <div class="c-single__blog__entery-content">
        <?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'cavatina' ),
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
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cavatina' ),
				'after'  => '</div>',
			)
		);
        ?>
    </div><!-- .entry-content -->

    <?php if( get_theme_mod('post_tags' , true) ) : ?>
    <ul class="c-single__blog__tags">
        <?php cavatina_get_post_tags(); ?>
    </ul>
    <?php endif; ?>

    <?php if( get_theme_mod('post_share_icons' , true)) : ?>
    <div class="c-social-media c-social-media--blog">
        <?php cavatina_social_media_share_post(true) ?>
    </div>
    <?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
<div class="u-border"></div>
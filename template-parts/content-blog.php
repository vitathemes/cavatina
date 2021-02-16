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
                echo '<span class="c-post__category ">'.  esc_html( cavatina_get_category() ) .'</span>';
                echo '<span class="o-bullet o-bullet--sm"></span>';
				echo '<span class="c-post__date">'.esc_html( cavatina_get_date_tertiary() ) .'</span>';
			?>
        </div><!-- .entry-meta -->
        <?php
		if ( is_singular() ) :
			the_title( '<h2 class="c-single__blog__entry-title">', '</h2>' );
		else :
			the_title( '<h2 class="entry-title "><a class="c-post__entry-title__anchor" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
        <div class="c-single__author">
            <div class="c-single__author__avatar">
                <?php echo get_avatar( get_the_author_meta('user_email'), '80', '' ); ?>
            </div>
            <div class="c-single__author__info">
                <span>By <?php the_author_link(); ?></span>
            </div>
        </div>
    </header><!-- .entry-header -->

    <?php cavatina_get_thumbnail() ?>

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
    <ul class="c-single__blog__tags">
        <?php
        $post_tags = get_the_tags();
            if ($post_tags) {
            foreach($post_tags as $post_tag) {
                echo '<li><a href="'.  esc_url( get_tag_link( $post_tag->term_id ) ) .'" title="'.  esc_attr( $post_tag->name ) .'">#'. esc_html( $post_tag->name ). '</a></li>';
            }
        }
        ?>
    </ul>

    <div class="c-social-media c-social-media--blog">
        <span class="c-social-media__title">Share :</span>
        <?php cavatina_get_social_media() ?>

    </div>

</article><!-- #post-<?php the_ID(); ?> -->
<div class="u-border"></div>
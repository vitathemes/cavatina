<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cavatina
 */

$decimalCounter = "0";
?>



<?php
        // get post number (auto increment)
        $postNumber = cavatina_get_post_number();
        // Remove zero when reaching 10
        if($postNumber >= 10){
            $decimalCounter = "";
            $postNumber = $postNumber;
        }
        else{$postNumber = $decimalCounter.$postNumber;}
    ?>
<article id="post-<?php echo esc_html($postNumber); ?>" <?php post_class( 'c-post c-post--archive' ); ?>>
    <header class="c-post__header c-post__header--space-height entry-header">

        <div class="c-post__header__col c-post__header__col--left">
            <span class="o-bullet-after"><?php  echo esc_html($postNumber); ?></span>
        </div>

        <div class="c-post__header__col c-post__header__col--right">
            <?php
            if ( is_singular() ) :
                the_title( '<h2 class="c-post__entry-title c-post__entry-title--projects entry-title"><a class="c-post__entry-title__anchor" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            else :
                the_title( '<h2 class="c-post__entry-title c-post__entry-title--projects entry-title"><a class="c-post__entry-title__anchor" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;
            ?>
            <div class="c-post__meta c-post__meta--left-space entry-meta">
                <?php
                    echo '<span class="c-post__category">' . esc_html(cavatina_get_category()) .'</span>';
                ?>
            </div><!-- .entry-meta -->
        </div>
    </header><!-- .entry-header -->

    <div class="c-post__thumbnail">
        <a href=<?php the_permalink() ?>>
            <?php the_post_thumbnail('large', array('class' => 'c-post__thumbnail__image')); ?>
        </a>
    </div>

    <div class="c-post__excerpt">
        <?php the_excerpt() ?>
    </div>

    <div class="c-post__entery-content entry-content">
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
</article><!-- #post-<?php the_ID(); ?> -->
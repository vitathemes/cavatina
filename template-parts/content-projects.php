<?php
/**
 * Template part for displaying projects
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cavatina
 */
?>

<?php  $postNumber = cavatina_deciaml_post_number(); ?>
<article id="post-<?php echo esc_html( $postNumber ); ?>" <?php post_class( 'c-post c-post--project' ); ?>>
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
                    echo '<span class="c-post__category">' .  esc_html(cavatina_get_category()) .'</span>';
                ?>
            </div><!-- .entry-meta -->
        </div>
    </header><!-- .entry-header -->

    <?php cavatina_get_posts_archive_thumbnail()  ?>

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
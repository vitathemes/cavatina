<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-cavatina
 */

?>

<div class="o-page__col c-content">
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'c-single' ); ?>>
        <div class="c-single__context" data-simplebar data-simplebar-auto-hide="false">
            <div class="c-single__context__holder">
                <?php
                        if ( is_singular() ) :
                            the_title( '<h2 class="c-single__title c-single__title--red c-single__title--page">', '</h2>' );
                        else :
                            the_title( '<h2 class="c-single__title c-single__title--red c-single__title--page"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                        endif;
                ?>
                <div class="c-single__text">
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
                </div>
            </div>
        </div>
        <div class="c-single__carousel c-single__carousel--mobile">
            <div class="c-carousel__single__slider c-carousel__single__slider--page js-single__slider">
                <div class="c-carousel__single__cell  c-carousel__single__cell--page">
                    <?php the_post_thumbnail('large', array('class' => 'c-carousel__single__cell__image c-carousel__single__cell_image--page')); ?>
                </div>
            </div>
        </div>
    </article><!-- #post-<?php the_ID(); ?> -->
</div>
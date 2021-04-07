<?php
/**
 * Template part for displaying page content without Aside
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cavatina
 */
?>
<div class="o-page__col c-content">
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'c-single c-single__context__holder--full-height' ); ?>>
        <div class="c-single__context">
            <div class="c-single__context__holder">
                <div class="c-single__text c-single__text--full-height">
                    <?php   
                            the_content(
                                sprintf(
                                    wp_kses(
                                        /* translators: %s: Name of current post. Only visible to screen readers */
                                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>' , 'cavatina' ),
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
                </div>
            </div>
        </div>
    </article><!-- #post-<?php the_ID(); ?> -->
</div>
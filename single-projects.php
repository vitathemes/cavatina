<?php
/**
 * The template for displaying single project
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wp_cavatina
 */

get_header();
?>
<!-- Aside -->
<aside class="o-page__col c-aside c-aside--mobile-hide js-aside">
    <div class="c-aside__content">
        <div class="c-aside__wrapper">
            <div class="c-aside__context">
                <span class="c-aside__title">Project</span>
            </div>
        </div>

    </div>
</aside>

<!-- Main content-->
<main class="o-page__main o-page__main--no-bottom-space js-page__main">
    <div class="o-page__col c-content">
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'c-single' ); ?>>
            <div class="c-single__context" data-simplebar data-simplebar-auto-hide="false">
                <div class="c-single__context__holder">
                    <?php
                            the_title( '<h1 class="c-single__title">', '</h1>' );
                    ?>
                    <ul class="c-single__meta">
                        <li>
                            <?php echo '<span>'. get_the_category( $id )[0]->name .'</span>'; ?>
                        </li>
                        <!-- bullet is here (single meta before) -->
                        <li>
                            <?php echo '<span>'. get_the_date( "F j.Y", $post_id ) .'</span>';   ?>
                        </li>
                    </ul>
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
                <h2 class="c-single__title">Advertisement Poster</h2>
                <ul class="c-single__meta">
                    <li>Commercial</li>
                    <li>April 2019</li>
                </ul>
                <div class="c-carousel__single__slider js-single__slider">
                    <div class="c-carousel__single__cell">
                        <img class="c-carousel__single__cell__image"
                            src="<?php echo get_template_directory_uri(); ?>/assets/images/post-images/single-carousel/img(1).jpg"
                            alt="slider_image_1" />
                    </div>
                    <div class="c-carousel__single__cell">
                        <img class="c-carousel__single__cell__image"
                            src="<?php echo get_template_directory_uri(); ?>/assets/images/post-images/single-carousel/img(2).jpg"
                            alt="slider_image_2" />
                    </div>
                    <div class="c-carousel__single__cell">
                        <img class="c-carousel__single__cell__image"
                            src="<?php echo get_template_directory_uri(); ?>/assets/images/post-images/single-carousel/img(3).jpg"
                            alt="slider_image_3" />
                    </div>
                </div>
            </div>
        </article><!-- #post-<?php the_ID(); ?> -->
        <!--Single-->
    </div>
    <?php get_footer();?>
</main><!-- #main -->

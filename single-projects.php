<?php
/**
 * The template for displaying single project
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package cavatina
 */
get_header();
?>

<!-- Aside -->
<aside class="o-page__col c-aside c-aside--mobile-hide js-aside">
    <div class="c-aside__content">
        <div class="c-aside__wrapper">
            <div class="c-aside__context">
                <span class="c-aside__title"><?php esc_html_e( 'Project', 'cavatina' ); ?></span>
            </div>
        </div>
    </div>
</aside>

<!-- Main content-->
<main class="o-page__main o-page__main--no-bottom-space js-page__main">
    <div class="o-page__col c-content">
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'c-single' ); ?>>
            <div class="c-single__context" data-simplebar data-simplebar-auto-hide="false">
                <div class="c-single__context__holder" id="wrapper">
                    <?php the_title( '<h1 class="c-single__title">', '</h1>' ); ?>
                    <ul class="c-single__meta">
                        <li>
                            <?php echo '<span>'.  esc_html( cavatina_get_category() ) .'</span>'; ?>
                        </li>
                        <!-- bullet is here (single meta before) -->
                        <li>
                            <?php echo '<span><a href="'. esc_url( get_permalink() ) .'">'.esc_html( get_the_date( "M Y" ) ).'</a></span>';   ?>
                        </li>
                    </ul>
                    <div class="c-single__text">
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
                    </div>
                </div>
            </div>
            <div class="c-single__carousel c-single__carousel--mobile">
                <?php the_title( '<h2 class="c-single__title">', '</h2>' ); ?>
                <ul class="c-single__meta">
                    <li>
                        <?php echo '<span>'. esc_html( cavatina_get_category() ).'</span>'; ?>
                    </li>
                    <li>
                        <?php echo '<span><a href="'. esc_url( get_permalink() ) .'">'.esc_html( get_the_date( "M Y" ) ).'</a></span>';   ?>
                    </li>
                </ul>
                <div class="c-carousel__single__slider js-single__slider">
                    <?php cavatina_get_slider( get_the_ID() ); ?>
                </div>
            </div>
        </article><!-- #post-<?php the_ID(); ?> -->
        <!--Single-->
    </div>
    <?php get_footer();?>
</main><!-- #main -->
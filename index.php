<?php
/**
 * The template for displaying index page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cavatina
 */
get_header();
?>
<!-- Aside -->
<aside class="o-page__col c-aside js-aside">
    <div class="c-aside__content">
        <div class="c-aside__wrapper">
            <div class="c-aside__context">
                <span class="c-aside__title"><?php esc_html_e( 'Blog', 'cavatina' ); ?></span>
            </div>
        </div>

    </div>
</aside>

<?php
    // Mobile searchbar
    get_template_part( 'template-parts/searchbar'); 
?>

<!-- Main content-->
<main class="o-page__main js-page__main o-page__main--posts">
    <div class="o-page__col c-content c-content--max-height">
        <div class="c-container site-main__container">
            <div class="c-container__content site-main__content" id="wrapper">
                <?php if (have_posts()) : ?>
                <?php
                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();
        
                            get_template_part( 'template-parts/content', get_post_type() );
                            
                        endwhile;
                            cavatina_get_pagination( "blog" ,  $wp_query );
                    else :
                        get_template_part('template-parts/content', 'none');
                    endif;
                ?>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>
</main><!-- #main -->
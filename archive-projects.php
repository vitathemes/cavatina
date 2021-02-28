<?php
/**
 * The template for displaying archive pages
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
                <span class="c-aside__title"><?php cavatina_post_type_name(); ?></span>
                <span class="c-aside__title c-aside__title--category">
                    <a
                        href=<?php echo "/".esc_html( get_post_type()) ?>><?php esc_html_e( ' Category ', 'cavatina' ); ?></a></span>
                <div class="c-aside__category"><?php cavatina_taxonomy_filter("c-aside__category__link" , " "); ?></div>
            </div>
        </div>
    </div>
</aside>

<?php
    // Mobile searchbar
    get_template_part( 'template-parts/searchbar');
?>

<!-- Main content-->
<main class="o-page__main js-page__main o-page__main--projects">
    <div class="o-page__col c-content c-content--max-height">
        <div class="c-container site-main__container">
            <div class="c-container__content site-main__content" id="wrapper">
                <?php if (have_posts()) :
                    /* Start the Loop */
                    while (have_posts()) : the_post();
                        /*
                        * Include the Post-Type-specific template for the content.
                        * If you want to override this in a child theme, then include a file
                        * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                        */
                        get_template_part( 'template-parts/content', 'projects' );
                    endwhile;
                        cavatina_get_pagination( "projects" ,  $wp_query );
                    else :
                    get_template_part('template-parts/content', 'none');
                    endif;
                ?>
            </div>
        </div>
    </div>
    <?php get_footer();?>
</main><!-- #main -->
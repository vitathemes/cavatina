<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-cavatina
 */

get_header();
?>
<aside class="o-page__col c-aside">
    <div class="c-aside__content">
        <div class="c-aside__wrapper">
            <div class="c-aside__context">
                <span class="c-aside__title"><?php cavatina_post_type_name();  ?></span>
                <span class="c-aside__counter"><?php cavatina_total_post_types(); ?> Portfolios</span>
            </div>
            <div class="c-search__icon js-search__icon"></div>
        </div>
        <div class="c-search js-search">
            <div class="c-search__holder">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</aside>
<main class="o-page__main js-page__main o-page__main--projects">
    <div class="o-page__col c-content c-content--max-height">
        <div class="c-container site-main__container">
            <div class="c-container__content site-main__content">
                <?php if (have_posts()) : ?>
                <?php 
                    echo get_post_meta($post->ID,'incr_number',true); 
                ?>
                <?php
                    /* Start the Loop */
                ?>
                <?php $loop = new WP_Query( array( 'post_type' => 'project', 'posts_per_page' => -1 ) ); ?>
                <?php $postNumber = 1; while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <div class="single-post">
                    <h1 class="post-number"><?php echo $postNumber++; ?></h1>
                    <h1 class="post-title"><a href="<?php the_permalink(); ?>"
                            title="<?php the_title(); ?>"><?php the_title(); ?></a>
                    </h1>
                    <div class="post-content"><?php the_excerpt(); ?> </div>
                    <?php edit_post_link(); ?>
                </div>
                <?php endwhile; wp_reset_query();


                while (have_posts()) :
                the_post();
                /*
                * Include the Post-Type-specific template for the content.
                * If you want to override this in a child theme, then include a file
                * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                */
                get_template_part('template-parts/content', 'project');
                endwhile;
                the_posts_navigation();
                else :
                get_template_part('template-parts/content', 'none');
                endif;
                ?>
            </div>
            <div class="c-pagination">
                <?php echo paginate_links( array(
                    'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>',
                    'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>'
                )); ?>
            </div>
        </div>
    </div>
    <?php get_footer();?>
</main><!-- #main -->
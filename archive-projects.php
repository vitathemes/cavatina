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

<main class="o-page__main">

    <div class="o-page__col c-aside">

        <div class="c-aside__content">


            <div class="c-aside__context">

                <h4 class="c-aside__title">Projects </h4>
                <span class="c-aside__counter">20 Portfolios</span>

            </div>


            <img class="c-search__icon" onClick="searchToggle()"
                src="<?php echo get_template_directory_uri(); ?>/assets/images/search.svg" alt="hamburger" />

            <div class="c-search">

                <input id="searchInput" type="search" name="s" class="c-search__input form-control search-field"
                    placeholder="Search…" autocomplete="off" value="" aria-describedby="Search Field"
                    title="Search for:">


            </div>



        </div>

    </div>


    <div class="o-page__col c-content c-content--max-height">

        <div class="c-container site-main__container default-max-width">

            <div class="c-container__content site-main__content">


                <?php if (have_posts()) : ?>
                <?php
                    /* Start the Loop */
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

        </div>

    </div>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
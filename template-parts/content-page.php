<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-cavatina
 */

?>




<div class="o-page__col c-aside">

    <div class="c-aside__content">

        <div class="c-aside__context">

            <h4 class="c-aside__title"><?php global $post; $post_slug=$post->post_name; echo $post_slug; ?></h4>


        </div>

        <img class="c-search__icon" onClick="searchToggle()"
            src="<?php echo get_template_directory_uri(); ?>/assets/images/search.svg" alt="hamburger" />

        <div class="c-search">

            <!-- <input id="searchInput" type="search" name="s" class="c-search__input form-control search-field"
                placeholder="Search…" autocomplete="off" value="" aria-describedby="Search Field" title="Search for:"> -->

            <?php get_search_form(); ?>


        </div>

    </div>

</div>


<div class="o-page__col c-content">

    <div class="c-single">


        <div class="c-single__context">


            <div class="c-single__context__holder">


                <h2 class="c-single__title c-single__title--red">HELLO THERE! MY NAME IS</h2>

                <h3 class="c-single__title c-single__title--small">NINA LOSERT</h3>


                <p class="c-single__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at arcu
                    dui. Aenean placerat
                    mauris nisl. Proin vitae urna eu sem pellentesque laoreet. Mauris varius quam ut libero
                    tempor rutrum. Sed quis maximus nunc. Nulla eu erat vel nunc consectetur ornare. Nam
                    bibendum cursus viverra. Aenean placerat bibendum quam, eugiat elit tincidunt in. Curabitur
                    nec aliquet erat, et dictum nulla. eugiat elit tincidunt in. Curabitur nec aliquet erat, et
                    dictum nulla.Sed quis maximus nunc. Nulla eu erat vel nunc consectetur ornare.Sed quis
                    maximus nunc.Sed at arcu dui. Aenean placerat mauris nisl.</p>

            </div>

        </div>


        <div class="c-single__carousel c-single__carousel--mobile">

            <h2 class="c-single__title">Advertisement Poster</h2>

            <ul class="c-single__meta">
                <li>Commercial</li>
                <li>April 2019</li>
            </ul>

            <div class="c-single__slider c-single__slider--page">

                <div class="carousel__cell__single carousel__cell__single--page ">
                    <img class="o-imagce"
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/about-page-thumbnail.jpg"
                        alt="hamburger" />
                </div>

            </div>
        </div>
    </div>
</div>




<?php
get_footer();
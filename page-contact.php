<?php
/**
 * The template for displaying contact page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wp_cavatina
 */

get_header();
?>

<main class="o-page__main">
    <div class="o-page__col c-aside">
        <div class="c-aside__content">
            <div class="c-aside__context">
                <h4 class="c-aside__title"><?php global $post; $post_slug=$post->post_name; echo $post_slug; ?></h4>
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
    <div class="o-page__col c-content">
        <div class="c-contact">
            <div class="c-contact__form">
                <form class="c-form">
                    <input class="c-form__text" type="text" placeholder="Insert Your Name" />
                    <input class="c-form__text" type="text" placeholder="Insert Your Name" />
                    <textarea class="c-form__text-area">Your Message</textarea>
                    <button class="c-form__button" type="submit">Send</button>
                </form>
            </div>
            <div class="c-contact__context">
                <div class="c-contact__widget">
                    <h6 class="c-widget__title">Project Inquiries </h6>
                    <p class="c-widget__text">hello@ cvatina.com</p>
                    <p class="c-widget__text">754.765.8373</p>
                </div>
                <div class="c-contact__widget">
                    <h6 class="c-widget__title">Project Inquiries </h6>
                    <p class="c-widget__text">hello@ cvatina.com</p>
                    <p class="c-widget__text">754.765.8373</p>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
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

<aside class="o-page__col c-aside">
    <div class="c-aside__content">
        <div class="c-aside__context">
            <span class="c-aside__title"><?php global $post; $post_slug=$post->post_name; echo $post_slug; ?></span>
        </div>
        <div class="c-search__icon"></div>
        <div class="c-search">
            <div class="c-search__holder">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</aside>
<main class="o-page__main">
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
    <?php get_footer(); ?>
</main><!-- #main -->
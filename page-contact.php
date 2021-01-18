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

<!-- Aside -->
<aside class="o-page__col c-aside js-aside">
    <div class="c-aside__content">
        <div class="c-aside__wrapper">
            <div class="c-aside__context">
                <span class="c-aside__title"><?php global $post; $post_slug=$post->post_name; echo $post_slug; ?></span>
            </div>
        </div>

    </div>
</aside>

<!-- Searchbar Mobile -->
<section class="c-search">
    <div class="c-search__content">
        <div class="c-search__wrapper">
            <div class="c-search__context">
                <span class="c-search__title">Search</span>
            </div>
            <div class="c-search__icon js-search__icon"></div>
        </div>
        <div class="c-search__form js-search__form">
            <div class="c-search__holder">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</section>

<!-- Main content-->
<main class="o-page__main js-page__main">
    <div class="o-page__col c-content">
        <div class="c-contact">
            <div class="c-contact__form__holder">
                <!-- <form class="c-contact__form" name="myForm">
                    <input class="c-contact__form__text" name="name" type="text" placeholder="Insert Your Name" />
                    <input class="c-contact__form__text" name="email" type="text"
                        placeholder="Insert Your E-mail Address" />
                    <textarea class="c-contact__form__text-area" name="message">Your Message</textarea>
                    <button class="c-contact__form__button button--small" name="submit" type="submit">Send</button>
                </form> -->

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
                        ?>

            </div>
            <div class="c-contact__context">
                <div class="c-contact__widget">
                    <h6 class="c-widget__title">Project Inquiries </h6>
                    <a href="#">
                        <p class="c-widget__text">hello@ cvatina.com</p>
                    </a>
                    <a href="#">
                        <p class="c-widget__text">754.765.8373</p>
                    </a>
                </div>
                <div class="c-contact__widget">
                    <h6 class="c-widget__title">Office </h6>
                    <a href="#">
                        <p class="c-widget__text">7653 sea Ave, Suite A</p>
                    </a>

                    <a href="#">
                        <p class="c-widget__text">North Charleston, Sc 87350</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>
</main><!-- #main -->
<?php
/**
 * Template Name: Contact
 * 
 * Page content with sidebar
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
                <span class="c-aside__title"><?php cavatina_get_current_page_name(); ?></span>
            </div>
        </div>
    </div>
</aside>

<?php
    // get mobile search bar
    get_template_part( 'template-parts/content', 'searchbar' );
?>

<!-- Main content-->
<main class="o-page__main js-page__main">
    <div class="o-page__col c-content">
        <div class="c-contact">
            <div class="c-contact__form__holder">
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
                ?>
            </div>
            <div class="c-contact__context">
                <?php
                if ( is_active_sidebar( 'custom-contact-widget' ) ) : ?>
                <div id="header-widget-area" class="c-contact__widget widget-area" role="complementary">
                    <?php dynamic_sidebar( 'custom-contact-widget' ); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>
</main><!-- #main -->
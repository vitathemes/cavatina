<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp-cavatina
 */

?>

<footer id="colophon" class="c-footer">

    <div class="c-footer__context">

        <div class="c-footer__social-media">


            <a href="#" class="c-social-media__item">
                <img class="o-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/linkedin.svg"
                    alt="hamburger" />
            </a>

            <a href="#" class="c-social-media__item">
                <img class="o-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.svg"
                    alt="hamburger" />
            </a>

            <a href="#" class="c-social-media__item">
                <img class="o-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/github.svg"
                    alt="hamburger" />
            </a>

            <a href="#" class="c-social-media__item">
                <img class="o-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter.svg"
                    alt="hamburger" />
            </a>


        </div>


        <div class="c-footer__copy">
            <p class="c-footer__text">© 2020 CAVATINA. TERMS OF USE AND PRIVACY POLICY.</p>
        </div>


    </div><!-- #.c-footer__context -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cavatina
 */
?>
<footer id="colophon" class="c-footer">
    <div class="c-footer__context">
        <div class="c-social-media">
            <?php cavatina_get_social_media(); ?>
        </div>
        <div class="c-footer__copy">
            <p class="c-footer__text">Cavatina theme by
                <a class="c-footer__text__link" href="https://vitathemes.com/"> VitaThemes </a> |
                <a class="c-footer__text__link" href="#"> Terms of use </a> &
                <a class="c-footer__text__link" href="<?php cavatina_get_privacy_policy(); ?>">Privacy Policy.</a>
            </p>
        </div>
    </div><!-- #.c-footer__context -->
</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>
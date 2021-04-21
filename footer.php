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
</div><!-- o-page -->

<footer id="colophon" class="<?php esc_attr( cavatina_get_footer_class() ) ?>">
    <div class="c-footer__context">
        <div class="c-footer__copy">
            <ul class="c-footer__nav">
                <li class="menu-item"><?php esc_html_e( 'Cavatina theme by', 'cavatina' ); ?>
                    <a class="c-footer__text__link" href="https://vitathemes.com/"> VitaThemes </a>
                </li>
                <?php
                    if ( has_nav_menu( 'footer-menu' ) ) {        
                        wp_nav_menu(
                                array(
                                    'theme_location' => 'footer-menu',
                                    'menu_id'        => 'footer-menu-registered',
                                    'container'      => "c-footer__nav",
                                    'items_wrap'     => '%3$s'
                                ));
                    }
                ?>
            </ul>

        </div>
        <div class="c-social-media">
            <?php cavatina_get_social_media(); ?>
        </div>
    </div><!-- #.c-footer__context -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>

</html>
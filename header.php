<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package wp-cavatina
*/
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wp-cavatina' ); ?></a>

    <div id="page" class="site">

        <header id="masthead" class="c-header">

            <div class="c-header__holder js-nav">

                <div class="c-logo--block">
                    <img class="o-logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg"
                        alt="logo" />
                </div>

                <button class="o-toggle c-toggle--block" aria-controls="primary-menu" aria-expanded="false">
                    <img class="o-header__image"
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/hamburger-menu.svg"
                        alt="hamburger" />
                </button>

                <div class="o-search--block">
                    <img class="o-search " src="<?php echo get_template_directory_uri(); ?>/assets/images/search.svg"
                        alt="hamburger" />
                </div>


                <?php
                                wp_nav_menu(
                                    array(
                                    'theme_location' => 'menu-1',
                                    'menu_id'        => 'primary-menu',
                                    "menu_class" => "c-nav", // nesting 
                                    "container_class" => "c-nav",
                                    "container" => "nav",
                                    )
                                );
                            ?>

            </div>
        </header>
    </div>








    <!-- #masthead -->
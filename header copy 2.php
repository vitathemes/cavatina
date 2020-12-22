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


                <img class="o-header__image o-header__image--logo"
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="logo" />
                <p class="o-context__description">digital creativity
                </p>


                <button class="o-toggle o-header__image--nav-icon" aria-controls="primary-menu" aria-expanded="false">
                    <img class="o-header__image"
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/hamburger-menu.svg"
                        alt="hamburger" />
                </button>



                <img class="o-header__image o-header__image--search"
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/search.svg" alt="hamburger" />


                <?php
                                wp_nav_menu(
                                    array(
                                    'theme_location' => 'menu-1',
                                    'menu_id'        => 'primary-menu',
                                    "menu_class" => "s-nav", // nesting 
                                    "container_class" => "c-nav",
                                    "container" => "nav",
                                    )
                                );
                            ?>
            </div>


        </header>



    </div>
    </div>


    <div class="c-back-drop">
    </div>
    <!-- #masthead -->
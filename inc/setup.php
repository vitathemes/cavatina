<?php
/**
 * Theme Setup
 *
 * @package cavatina
 */

 
if ( ! function_exists( 'cavatina_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cavatina_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on cavatina, use a find and replace
		 * to change 'cavatina' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'cavatina', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary', 'cavatina' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'cavatina_setup' );


function cavatina_footer_menu() {
	/**
	 * Create Footer Menu Location
	 */
	register_nav_menus(
		array(
			'footer-menu' => esc_html__( 'Footer', 'cavatina' ),
		)
	);
}
add_action( 'init', 'cavatina_footer_menu' );



/**
  * Register Post-type and Taxonomy
  */
if (function_exists('LibWp')) {

    LibWp()->postType()
        ->setName('projects')
        ->setLabels([
            'name'          => _x('Projects', 'Post type general name', 'cavatina'),
            'singular_name' => _x('Project', 'Post type singular name', 'cavatina'),
            'menu_name'     => _x('Projects', 'Admin Menu text', 'cavatina'),
            'add_new'       => __('Add New', 'cavatina'),
            'edit_item'     => __('Edit Project', 'cavatina'),
            'view_item'     => __('View Project', 'cavatina'),
            'all_items'     => __('All Projects', 'cavatina'),
        ])
        ->setArgument('public' , true)
        ->setArgument('show_ui', true)
        ->setArgument('menu_position' , 5)
        ->setArgument('show_in_nav_menus' , true)
        ->setArgument('show_in_admin_bar' , true)
        ->setArgument('hierarchical' , true)
        ->setArgument('can_export' , true)
        ->setArgument('has_archive' , true)
        ->setArgument('exclude_from_search' , false)
        ->setArgument('publicly_queryable' , true)
        ->setArgument('capability_type' , 'post')
        ->setArgument('show_in_rest' , true)
        ->setArgument('supports' , array('title', 'editor' , 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'))
        ->register();

    LibWp()->taxonomy()
        ->setName( 'project_category' )
        ->setArgument('show_in_rest' , true)
        ->setPostTypes( array( 'projects' ))
        ->setLabels([
            'name'          => _x('Project Categories', 'taxonomy general name', 'cavatina'),
            'singular_name' => _x('Project Category', 'taxonomy singular name', 'cavatina'),
            'search_items'  => __('Search Project Categories', 'cavatina'),
            'all_items'     => __('All Project Categories', 'cavatina'),
            'edit_item'     => __('Edit Project Category', 'cavatina'),
            'add_new_item'  => __('Add New Project Category', 'cavatina'),
            'new_item_name' => __('New Project Category Name', 'cavatina'),
            'menu_name'     => __('Project Categories', 'cavatina'),
        ])
        ->register();
}
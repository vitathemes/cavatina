<?php
/**
 * cavatina Theme Customizer
 *
 * @package cavatina
 */
 
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * 
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cavatina_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'cavatina_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'cavatina_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'cavatina_customize_register' );


if( ! function_exists('cavatina_customize_partial_blogname') ) : 
	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	function cavatina_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;


if( ! function_exists('cavatina_customize_partial_blogdescription') ) : 
	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	function cavatina_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
endif;

if( ! function_exists('cavatina_customize_preview_js') ) : 
	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	function cavatina_customize_preview_js() {
		wp_enqueue_script( 'wp-cavatina-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), CAVATINA_VERSION, true );
	}
endif;
add_action( 'customize_preview_init', 'cavatina_customize_preview_js' );



if( function_exists( 'kirki' ) ) {

	if (class_exists('\Kirki\Section')) {

		/*------------------------------------*\
		############# Panels ###############
		\*------------------------------------*/
		new \Kirki\Panel(
			'elements',
			[
				'priority' => 75,
				'title'    => esc_html__( 'Elements', 'cavatina' ),
			]
		);
		
		
		/*------------------------------------*\
		############# Sections #############
		\*------------------------------------*/
		
		/* Single Options */
		new \Kirki\Section(
			'single_options',
			[
				'title'          => esc_html__( 'Single Options', 'cavatina' ),
				'panel'          => 'elements',
				'priority'       => 200,
			]
		);

		/* Archive Options */
		new \Kirki\Section(
			'archive_options',
			[
				'title'          => esc_html__( 'Archive Options', 'cavatina' ),
				'panel'          => 'elements',
				'priority'       => 210,
			]
		);

		/* Projects Options */
		new \Kirki\Section(
			'projects_options',
			[
				'title'          => esc_html__( 'Projects Options', 'cavatina' ),
				'panel'          => 'elements',
				'priority'       => 220,
			]
		);

		// typography settings  
		new \Kirki\Section(
			'typography_headings',
			[
				'title'          => esc_html__( 'Typography Setting', 'cavatina' ),
				'description'    => esc_html__( 'Change typography color and customize them.', 'cavatina' ),
				'panel'          => '',
				'priority'       => 160,
			]
		);

		/* Load more selection */
		new \Kirki\Section(
			'loadmore_pagination',
			[
				'title'          => esc_html__( 'Pagination', 'cavatina' ),
				'description'    => esc_html__( 'You can add load more button to page that you want.', 'cavatina' ),
				'panel'          => '',
				'priority'       => 170,
			]
		);

		/* Social Media  */
		new \Kirki\Section(
			'social_media',
			[
				'title'          => esc_html__( 'Social Media', 'cavatina' ),
				'description'    => esc_html__( 'Add social media links.', 'cavatina' ),
				'panel'          => '',
				'priority'       => 180,
			]
		);
		
		/*------------------------------------*\
		############# Fields #############
		\*------------------------------------*/
		new \Kirki\Field\Checkbox(
			[
				'settings'    => 'projects_loadmore',
				'label'       => esc_html__( 'Projects Page Load more', 'cavatina' ),
				'description' => esc_html__( 'Add load more button to Project archives page', 'cavatina' ),
				'section'     => 'loadmore_pagination',
				'default'     => true,
			]
		);

		new \Kirki\Field\Checkbox(
			[
				'settings'    => 'blog_loadmore',
				'label'       => esc_html__( 'Blog Page Load more', 'cavatina' ),
				'description' => esc_html__( 'Add load more button to Blog archives page', 'cavatina' ),
				'section'     => 'loadmore_pagination',
				'default'     => false,
			]
		);


		new \Kirki\Field\Checkbox(
			[
				'settings'    => 'archive_loadmore',
				'label'       => esc_html__( 'Archives Page Load more', 'cavatina' ),
				'description' => esc_html__( 'Add load more button to archives page', 'cavatina' ),
				'section'     => 'loadmore_pagination',
				'default'     => false,
			]
		);
		

		/* Typography Settings */
		new \Kirki\Field\Color(
			[
				'settings' => 'typography_primary_color',
				'label'    => __( 'Primary Color', 'cavatina' ),
				'section'  => 'typography_headings',
				'default'  => '#000000',
				'priority' => 9,
			]
		);

		new \Kirki\Field\Color(
			[
				'settings' => 'typography_secondary_color',
				'label'    => __( 'Secondary Color', 'cavatina' ),
				'section'  => 'typography_headings',
				'default'  => '#767676',
				'priority' => 10,
			]
		);

		new \Kirki\Field\Color(
			[
				'settings' => 'typography_accent_color',
				'label'    => __( 'Accent Color', 'cavatina' ),
				'section'  => 'typography_headings',
				'default'  => '#ff3636',
				'priority' => 10,
			]
		);
		

		// Headings typography h1
		new \Kirki\Field\Typography(
			[
				'settings'    => 'typography_h1',
				'label'       => esc_html__( 'H1', 'cavatina' ),
				'section'     => 'typography_headings',
				'default'     => [
					'font-family'   	 => 'Montserrat',
					'font-size'          => '24px',
					'variant'         	 => '600',
					'color'         	 => '#000000',
					'line-height'     	 => '30px',
				],
				'priority'    => 10,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array( 'h1' ),
					],
				],
			]
		);

		
		// Headings typography h2
		new \Kirki\Field\Typography(
			[
				'settings'    => 'typography_h2',
				'label'       => esc_html__( 'H2', 'cavatina' ),
				'section'     => 'typography_headings',
				'default'     => [
					'font-family'   	 => 'Montserrat',
					'font-size'          => '19px',
					'line-height'     	 => '30px',
					'variant'         	 => '400',
					'color'         	 => '#000000',
				],
				'priority'    => 11,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array( 'h2' ),
					],
				],
			]
		);

		
		// Headings typography h3
		new \Kirki\Field\Typography(
			[
				'settings'    => 'typography_h3',
				'label'       => esc_html__( 'H3', 'cavatina' ),
				'section'     => 'typography_headings',
				'default'     => [
					'font-family'   	 => 'Montserrat',
					'font-size'          => '14px',
					'variant'         	 => '600',
					'color'         	  => '#000000',
					'line-height'     	 => '20px',
				],
				'priority'    => 12,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array( 'h3' ),
					],
				],
			]
		);

		// Headings typography h4
		new \Kirki\Field\Typography(
			[
				'settings'    => 'typography_h4',
				'label'       => esc_html__( 'H4', 'cavatina' ),
				'section'     => 'typography_headings',
				'default'     => [
					'font-family'   	 => 'Montserrat',
					'font-size'          => '14px',
					'line-height'     	 => '30px',
					'variant'         	 => 'regular',
					'color'         	 => '#000000',
				],
				'priority'    => 13,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array( 'h4' ),
					],
				],
			]
		);

		// Headings typography h5
		new \Kirki\Field\Typography(
			[
				'settings'    => 'typography_h5',
				'label'       => esc_html__( 'H5', 'cavatina' ),
				'section'     => 'typography_headings',
				'default'     => [
					'font-family'   	 => 'Montserrat',
					'font-size'          => '12px',
					'line-height'     	 => '30px',
					'variant'         	 => 'regular',
					'color'         	 => '#000000',
				],
				'priority'    => 14,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array( 'h5' ),
					],
				],
			]
		);

		
		// Headings typography h6
		new \Kirki\Field\Typography(
			[
				'settings'    => 'typography_h6',
				'label'       => esc_html__( 'H6', 'cavatina' ),
				'section'     => 'typography_headings',
				'default'     => [
					'font-family'   	 => 'Montserrat',
					'font-size'          => '10px',
					'line-height'     	 => '30px',
					'variant'         	 => 'regular',
					'color'         	 => '#000000',
				],
				'priority'    => 15,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array( 'h6' ),
					],
				],
			]
		);

		
		// Paragraph typography
		new \Kirki\Field\Typography(
			[
				'settings'    => 'typography_paragraph',
				'label'       => esc_html__( 'Paragraph', 'cavatina' ),
				'section'     => 'typography_headings',
				'default'     => [
					'font-family'   	 => 'Montserrat',
					'font-size'          => '14px',
					'line-height'        => '28px',
					'variant'         	 => 'regular',
					'color'         	 => '#000000',
				],
				'priority'    => 17,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array( 'p' , 'ul' , 'ol', ".menu-item a" ),
					],
				],
			]
		);


		// Secondary Links
		new \Kirki\Field\Typography(
			[
				'settings'    => 'secondary_links',
				'label'       => esc_html__( 'Secondary Links', 'cavatina' ),
				'section'     => 'typography_headings',
				'default'     => [
					'font-family'   	 => 'Montserrat',
					'font-size'          => '14px',
					'line-height'        => '17px',
					'variant'         	 => 'regular',
					'color'         	 => '#000000',
				],
				'priority'    => 18,
				'transport'   => 'auto',
				'output'      => [
					[
						'element' => array( '.h4-lh--sm' , ".s-nav > .menu-item a", ".c-aside__category__link h4" ),
					],
				],
			]
		);
		

		// -- Socials --
		new \Kirki\Field\URL(
			[
				'settings' => 'linkedin',
				'label'    => esc_html__( 'Linkedin', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 10,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'facebook',
				'label'    => esc_html__( 'Facebook', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 20,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'github',
				'label'    => esc_html__( 'Github', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 30,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'twitter',
				'label'    => esc_html__( 'Twitter', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 40,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'instagram',
				'label'    => esc_html__( 'Instagram', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 50,
			]
		);

		new \Kirki\Field\Text(
			[
				'settings' => 'mail',
				'label'    => esc_html__( 'Email', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 60,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'pinterest',
				'label'    => esc_html__( 'Pinterest', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 60,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'youtube',
				'label'    => esc_html__( 'Youtube', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 70,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'spotify',
				'label'    => esc_html__( 'Spotify', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 80,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'gitlab',
				'label'    => esc_html__( 'Gitlab', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 90,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'lastfm',
				'label'    => esc_html__( 'Lastfm', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 100,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'stackoverflow',
				'label'    => esc_html__( 'Stackoverflow', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 110,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'quora',
				'label'    => esc_html__( 'Quora', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 120,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'reddit',
				'label'    => esc_html__( 'Reddit', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 130,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'medium',
				'label'    => esc_html__( 'Medium', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 140,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'vimeo',
				'label'    => esc_html__( 'Vimeo', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 150,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'lanyrd',
				'label'    => esc_html__( 'Lanyrd', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 160,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'dribbble',
				'label'    => esc_html__( 'Dribbble', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 170,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'behance',
				'label'    => esc_html__( 'Behance', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 280,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'codepen',
				'label'    => esc_html__( 'Codepen', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 290,
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'telegram',
				'label'    => esc_html__( 'Telegram', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 300,
			]
		);

		new \Kirki\Field\Text(
			[
				'settings' => 'phone_number',
				'label'    => esc_html__( 'Phone Number', 'cavatina' ),
				'section'  => 'social_media',
				'priority' => 310,
			]
		);
		
		/*------------------------------------*\
		#Single Options
		\*------------------------------------*/
		new \Kirki\Field\Toggle(
			[
				'settings'    => 'publish_date',
				'label'       => esc_html__( 'Show Publish Date', 'cavatina' ),
				'section'     => 'single_options',
				'default'     => '1',
				'priority'    => 10,
			]
		);

		new \Kirki\Field\Toggle(
			[
				'settings'    => 'show_single_cat',
				'label'       => esc_html__( 'Display Posts Category', 'cavatina' ),
				'section'     => 'single_options',
				'default'     => '1',
				'priority'    => 11,
			]
		);

		new \Kirki\Field\Toggle(
			[
				'settings'    => 'show_author',
				'label'       => esc_html__( 'Show Author', 'cavatina' ),
				'section'     => 'single_options',
				'default'     => '1',
				'priority'    => 20,
			]
		);

		new \Kirki\Field\Toggle(
			[
				'settings'    => 'post_tags',
				'label'       => esc_html__( 'Show Posts Tags', 'cavatina' ),
				'section'     => 'single_options',
				'default'     => '1',
				'priority'    => 30,
			]
		);

		// Post Share icons Checkbox
		new \Kirki\Field\Toggle(
			[
				'settings'    => 'post_share_icons',
				'label'       => esc_html__( 'Display Share icons for posts', 'cavatina' ),
				'section'     => 'single_options',
				'default'     => '1',
				'priority'    => 70,
			]
		);
		
		new \Kirki\Field\Toggle(
			[
				'settings'    => 'post_thumbnail',
				'label'       => esc_html__( 'Show Post Thumbnail', 'cavatina' ),
				'section'     => 'single_options',
				'default'     => '1',
				'priority'    => 80,
			]
		);
		
		/*------------------------------------*\
			#Archive Options
		\*------------------------------------*/
		// Show Archives Posts Categories
		new \Kirki\Field\Toggle(
			[
				'settings'    => 'archives_posts_category',
				'label'       => esc_html__( 'Show Archives Posts Categories', 'cavatina' ),
				'section'     => 'archive_options',
				'default'     => '1',
				'priority'    => 20,
			]
		);

		// Display Date
		new \Kirki\Field\Toggle(
			[
				'settings'    => 'archives_posts_date',
				'label'       => esc_html__( 'Show Posts Date', 'cavatina' ),
				'section'     => 'archive_options',
				'default'     => '1',
				'priority'    => 30,
			]
		);

		/*------------------------------------*\
		#Projects Options
		\*------------------------------------*/
		// Enable Portfolios (Custom Post type) Category
		new \Kirki\Field\Toggle(
			[
				'settings'    => 'projects_category',
				'label'       => esc_html__( 'Display Project Category', 'cavatina' ),
				'section'     => 'projects_options',
				'default'     => '1',
				'priority'    => 30,
			]
		);
		

		// Enable Portfolios (Custom Post type) Category
		new \Kirki\Field\Toggle(
			[
				'settings'    => 'projects_excerpt',
				'label'       => esc_html__( 'Display Projects Excerpt', 'cavatina' ),
				'section'     => 'projects_options',
				'default'     => '1',
				'priority'    => 40,
			]
		);

	}
	
}
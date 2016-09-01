<?php
/*
  Functions and settings for Theme: "My Portfolio Theme"
 */

/*==============================================
	Include External Files
================================================*/
	require get_template_directory() . '/inc/class_tgm_plugin_activation.php'; // Include TGM Plugin Activation
	require get_template_directory() . '/inc/walker.php'; // Include Custom Walker
	require get_template_directory() . '/inc/pagination.php'; // Include Custom Pagination
	require get_template_directory() . '/inc/custom_functions.php'; // Custom Functions for My Portfolio Theme
	require get_template_directory() . '/inc/custom-meta-boxes.php'; // Add Custom Meta Box file
	require get_template_directory() . '/inc/configuration.php'; // Include Redux Framework Functions
	require get_template_directory() . '/inc/font_awesome.php'; // Include Font Awesome Icons for Shortcodes
	require get_template_directory() . '/inc/widgets.php'; // Include Widgets 
	require get_template_directory() . '/inc/shortcodes/portfolio-accordion.php'; // Accordion Shortcode
	require get_template_directory() . '/inc/shortcodes/portfolio-alert.php'; // Alert Shortcode
	require get_template_directory() . '/inc/shortcodes/portfolio-button.php'; // Button Shortcode
	require get_template_directory() . '/inc/shortcodes/portfolio-icon.php'; // Icon Shortcode
	require get_template_directory() . '/inc/shortcodes/portfolio-progressbar.php'; // Progressbar Shortcode
	require get_template_directory() . '/inc/shortcodes/portfolio-tabs.php'; // Tabs Shortcode
	require get_template_directory() . '/inc/shortcodes/portfolio-toggle.php'; // Toggle Shortcode
	require get_template_directory() . '/inc/shortcodes.php'; // Include Shortcode Options


/*=============================================
	Add Required Plugins for This Theme
===============================================*/
function portfolio_requred_plugins(){
	$plugins = array(
		array(
			'name'                 => 'Redux Options',
			'slug'                 => 'redux-framework',
			'source'               => get_stylesheet_directory() . '/lib/plugins/redux-framework.zip',
			'required'             => true,
			'version'              => '',
			'force_activation'     => false,
			'force_deactivation'   => false,
			'external_url'         => '',
		),
		array(
			'name'                 => 'SMeta',
			'slug'                 => 'smeta',
			'source'               => get_stylesheet_directory() . '/lib/plugins/smeta.zip',
			'required'             => true,
			'version'              => '',
			'force_activation'     => false,
			'force_deactivation'   => false,
			'external_url'         => '',
		),		
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array (
			'domain'           => 'portfolio',
			'default_path'     => '',
			'parent_menu_slug' => 'themes.php',
			'parent_url_slug'  => 'themes.php',
			'menu'             => 'install-required-plugins',
			'has_notices'      => true,
			'is_automatic'     => false,
			'message'          => '',
			'strings'          => array(
				'page_title'                      => __( 'Install Required Plugins', 'portfolio' ),
				'menu_title'                      => __( 'Install Plugins', 'portfolio' ),
				'installing'                      => __( 'Installing Plugin: %s', 'portfolio' ),
				'oops'                            => __( 'Something went wrong with the plugin API.', 'portfolio' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                          => __( 'Return to Required Plugins Installer', 'portfolio' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'portfolio' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'portfolio' ),
				'nag_type'                        => 'updated'
			)
	);

	tgmpa( $plugins, $config );
}

	add_action( 'tgmpa_register', 'portfolio_requred_plugins' );






/* do shortcodes in the excerpt */
	add_filter('the_excerpt', 'do_shortcode');


/*=============================================
	Add Theme Support
===============================================*/
if ( !function_exists('my_portfolio_theme_setup') ) :
	function my_portfolio_theme_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'my_portfolio_theme', get_template_directory() . '/languages' );

		// Add Support for Header Image
		add_theme_support( 'custom-header' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// WordPress manage with the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Register Navigation Menu - wp_nav_menu() .
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary My Portfolio Theme Menu', 'my_portfolio_theme' ),
		) );

		// Enable html5 Markup for the search forms, somment forms, comment lists, gallery and caption.
		add_theme_support( 'html5', array( 'search-form','comment-form', 'comment-list', 'gallery', 'caption' ) );

		// Enable Support for the post formats. Allow list for specific post formtas.
		add_theme_support( 'post-formats', array(
			'gallery',
			'video',
			'audio',
			'quote'
		) );
	}
	
endif;

	add_action( 'after_setup_theme', 'my_portfolio_theme_setup' );




/*=============================================
	Register Sidebar
===============================================*/
function my_portfolio_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'My Portfolio Theme Sidebar', 'my_portfolio_theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'You can add widgets for My Portfolio Theme.', 'my_portfolio_theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
	add_action( 'widgets_init', 'my_portfolio_theme_widgets_init' );




/*=============================================
	Register JavaScript and CSS Files 
===============================================*/
function my_portfolio_theme_scripts() {
	// Styles CSS
	wp_enqueue_style( 'Awesome Font', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css', array(), '3.3.6', 'all' );
	wp_enqueue_style( 'My Portfolio Theme - bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6', 'all' );
	wp_enqueue_style( 'Owl Carousel', get_template_directory_uri() . '/css/owl/owl.carousel.css', array(), '', 'all' );
	
	// Scripts JS
	wp_enqueue_script( 'Jquery - 1.12.3', get_template_directory_uri() . '/js/jquery/jquery-1.12.3.min.js', array(), '1.12.3', true );
	wp_enqueue_script( 'Ajax', get_template_directory_uri() . '/js/jquery/ajax.js', array(), '', true );
	wp_enqueue_script( 'My Portfolio Theme - bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true );
	wp_enqueue_script( 'My Portfolio Theme - main js', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true );
		wp_localize_script( 'My Portfolio Theme - main js', 'PORTFOLIO_SUBSCRIBE', array(
			'ajax_url'  => admin_url('admin-ajax.php'),
	    	'security'	=> wp_create_nonce( 'portfolio-subscriber-nonce' ),
	    	'success'	=> 'You are Subscribed Successfully. Congratulation! :)',
	    	'error'		=> 'Error while you try to Subscribe. Please try again.'
		));

	wp_enqueue_script( 'Google map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCjYPOCSmb19nyXY16B-mQoIf2x40hSFSM&sensor=false', array(), '', true );
	wp_enqueue_script( 'Wow', get_template_directory_uri() . '/js/wow/wow.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'Responsive-Slider', get_template_directory_uri().'/js/responsive-sliders/responsiveslides.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'Masonry', get_template_directory_uri().'/js/masonry.pkgd.min.js', array(), '', true );
	wp_enqueue_script( 'Images Loaded', get_template_directory_uri().'/js/imagesloaded.pkgd.js', array(), '', true );
	wp_enqueue_script( 'OWL Carousel', get_template_directory_uri().'/js/owl/owl.carousel.min.js', array(), '', true );
}
	add_action( 'wp_enqueue_scripts', 'my_portfolio_theme_scripts' );


/*==================================================
	Register Admin JS and CSS Files
====================================================*/
function my_portfolio_theme_admin_scripts(){
	wp_enqueue_style( 'Admin - My Portfolio Theme - custom style', get_template_directory_uri() . '/css/admin_style.css', array(), '3.3.6', 'all' );
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'jquery-ui-dialog' );

	wp_enqueue_style( 'portfolio-jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script( 'Portfolio Shortcodes', get_template_directory_uri().'/js/shortcodes.js', array(), '', true );
}
	add_action('admin_enqueue_scripts', 'my_portfolio_theme_admin_scripts');


/*==================================================
	Register CSS with PHP Extension
====================================================*/
function portfolio_add_main_style(){
	wp_enqueue_style( 'portfolio-style', get_stylesheet_uri() , array('dashicons') );
	ob_start();
	include( locate_template( 'css/my_portfolio.css.php' ) );
	$custom_css = ob_get_contents();
	ob_end_clean();
	wp_add_inline_style( 'portfolio-style', $custom_css );	
}
	add_action('wp_enqueue_scripts', 'portfolio_add_main_style');


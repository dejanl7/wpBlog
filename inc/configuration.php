<?php 
global $my_portfolio_opts;

if ( ! class_exists('My_Portfolio_Theme') ) {
    class My_Portfolio_Theme {
        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

    /*=========================================
        Function Constructor
    ===========================================*/
        public function __construct() {

            if ( ! class_exists('ReduxFramework') ) {
                return;
            }

            // This is needed, for WordPress bugs. 
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
            }

        }

    /*=========================================
        Init Settings for My Portfolio Theme
    ===========================================*/
        public function initSettings() {
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }

     /*=========================================
        Define Function for Setting Sections
    ===========================================*/
         public function setSections() {
                /**
                 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
                 * */
                // Background Patterns Reader
                $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
                $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :

                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();

                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;


        /*========================================================
            Custom Sections For My Portfolio Theme. 
            There are all necessery Redux Fields and Functions...
        ==========================================================*/
                /*=========================
                    LOGO Section
                ===========================*/
                $this->sections[] = array(
                    'title'     => __('Logo Settings', 'portfolio'),
                    'icon'      => '',
                    'id'        => 'logo_id',
                    'desc'      => __('Upload Your Company Logo and set up logo position. You can choose between left, right and center logo position', 'portfolio'),
                    'fields'    => array(
                        array(
                            'id'    => 'portfolio_logo',
                            'type'  => 'media',
                            'title' => __('Upload Your Logo', 'portfolio') ,
                            'desc'  => __('Upload logo', 'portfolio')
                        ),
                        array(
                            'id'        => 'portfolio_logo_select_option',
                            'type'      => 'select',
                            'options'   => portfolio_logo_options(),
                            'default'   => 'center',
                            'title'     => __('Choose LOGO Position', 'portfolio'),
                            'desc'      => __('Logo Position', 'portfolio')
                        ),
                    )
                );

                /*==========================
                    HEADER Section
                ============================*/
                $this->sections[] = array(
                    'title'     => __('Header Settings', 'portfolio') ,
                    'icon'      => '',
                    'id'        => 'header_id',
                    'desc'      => __('You can Upload Your Logo, Insert images, title and descriptions into Slider.', 'portfolio'),
                    'fields'    => array(
                        array(
                            'id'    => 'slider_title_color',
                            'type'  => 'color',
                            'title' => __('Header part - Title Color', 'portfolio'),
                            'desc'  => __('Change Title Color', 'portfolio')
                        ),
                        array(
                            'id'    => 'slider_text_color',
                            'type'  => 'color',
                            'title' => __('Header part - Text Color', 'portfolio'),
                            'desc'  => __('Change Text Color', 'portfolio')
                        ),


                        // Header Image
                        array(
                            'id'    => 'header_image_1',
                            'type'  => 'media',
                            'title' => __('Header Image 1', 'portfolio') ,
                            'desc'  => __('Select header background slider image 1', 'portfolio')
                        ),
                            array(
                                'id'    => 'header_image_1_title',
                                'type'  => 'text',
                                'title' => __('Title for Header Image 1', 'portfolio') ,
                                'desc'  => __('Title for Header Image 1', 'portfolio')
                            ),
                            array(
                                'id'    => 'header_image_1_description',
                                'type'  => 'textarea',
                                'title' => __('Description for Header Image 1', 'portfolio') ,
                                'desc'  => __('Description for Header Image 1', 'portfolio')
                            ),
                        array(
                            'id'    => 'header_image_2',
                            'type'  => 'media',
                            'title' => __('Header Image 2', 'portfolio') ,
                            'desc'  => __('Select header background slider image 2', 'portfolio')
                        ),
                            array(
                                'id'    => 'header_image_2_title',
                                'type'  => 'text',
                                'title' => __('Title for Header Image 2', 'portfolio') ,
                                'desc'  => __('Title for Header Image 2', 'portfolio')
                            ),
                            array(
                                'id'    => 'header_image_2_description',
                                'type'  => 'textarea',
                                'title' => __('Description for Header Image 2', 'portfolio') ,
                                'desc'  => __('Description for Header Image 2', 'portfolio')
                            ),
                        array(
                            'id'    => 'header_image_3',
                            'type'  => 'media',
                            'title' => __('Header Image 3', 'portfolio') ,
                            'desc'  => __('Select header background slider image 3', 'portfolio')
                        ),
                            array(
                                'id'    => 'header_image_3_title',
                                'type'  => 'text',
                                'title' => __('Title for Header Image 3', 'portfolio') ,
                                'desc'  => __('Title for Header Image 3', 'portfolio')
                            ),
                            array(
                                'id'    => 'header_image_3_description',
                                'type'  => 'textarea',
                                'title' => __('Description for Header Image 3', 'portfolio') ,
                                'desc'  => __('Description for Header Image 3', 'portfolio')
                            ),
                        array(
                            'id'    => 'header_image_4',
                            'type'  => 'media',
                            'title' => __('Header Image 4', 'portfolio') ,
                            'desc'  => __('Select header background slider image 4', 'portfolio')
                        ),
                            array(
                                'id'    => 'header_image_4_title',
                                'type'  => 'text',
                                'title' => __('Title for Header Image 4', 'portfolio') ,
                                'desc'  => __('Title for Header Image 4', 'portfolio')
                            ),
                            array(
                                'id'    => 'header_image_4_description',
                                'type'  => 'textarea',
                                'title' => __('Description for Header Image 4', 'portfolio') ,
                                'desc'  => __('Description for Header Image 4', 'portfolio')
                            ),
                        array(
                            'id'    => 'header_image_5',
                            'type'  => 'media',
                            'title' => __('Header Image 5', 'portfolio') ,
                            'desc'  => __('Select header background slider image 5', 'portfolio')
                        ),
                            array(
                                'id'    => 'header_image_5_title',
                                'type'  => 'text',
                                'title' => __('Title for Header Image 5', 'portfolio') ,
                                'desc'  => __('Title for Header Image 5', 'portfolio')
                            ),
                            array(
                                'id'    => 'header_image_5_description',
                                'type'  => 'textarea',
                                'title' => __('Description for Header Image 5', 'portfolio') ,
                                'desc'  => __('Description for Header Image 5', 'portfolio')
                            ),
                        array(
                            'id'    => 'header_image_6',
                            'type'  => 'media',
                            'title' => __('Header Image 6', 'portfolio') ,
                            'desc'  => __('Select header background slider image 6', 'portfolio')
                        ),
                            array(
                                'id'    => 'header_image_6_title',
                                'type'  => 'text',
                                'title' => __('Title for Header Image 6', 'portfolio') ,
                                'desc'  => __('Title for Header Image 6', 'portfolio')
                            ),
                            array(
                                'id'    => 'header_image_6_description',
                                'type'  => 'textarea',
                                'title' => __('Description for Header Image 6', 'portfolio') ,
                                'desc'  => __('Description for Header Image 6', 'portfolio')
                            ),
                        array(
                            'id'    => 'header_image_7',
                            'type'  => 'media',
                            'title' => __('Header Image 7', 'portfolio') ,
                            'desc'  => __('Select header background slider image 7', 'portfolio')
                        ),
                            array(
                                'id'    => 'header_image_7_title',
                                'type'  => 'text',
                                'title' => __('Title for Header Image 7', 'portfolio') ,
                                'desc'  => __('Title for Header Image 7', 'portfolio')
                            ),
                            array(
                                'id'    => 'header_image_7_description',
                                'type'  => 'textarea',
                                'title' => __('Description for Header Image 7', 'portfolio') ,
                                'desc'  => __('Description for Header Image 7', 'portfolio')
                            ),


                    ),
                );  
            
           /*================================
                BLOG Settings Section
            =================================*/
                $this->sections[] = array(
                    'title' => __('Blog Settings', 'portfolio'),
                    'id'    => 'blog_id',
                    'icon'  => '',
                    'desc'  => __('Define Layouts for Your Blog. This is a way how to posts will be display.', 'portfolio'),
                    'fields'=> array(
                        array(
                            'id'        => 'posts_layout',
                            'type'      => 'select',
                            'options'   => portfolio_blog_listings(),
                            'title'     => __('Main Blog Layout', 'portfolio'),
                            'desc'      => __('Select Main Blog Listing Layout','portfolio'),
                            'default'   => 1
                        ),
                        array(
                            'id'        => 'single_posts_layout',
                            'type'      => 'select',
                            'options'   => single_page_listings(),
                            'title'     => __('Single Page Layout', 'portfolio'),
                            'desc'      => __('Select Single Page Listing Layout','portfolio'),
                            'default'   => 1
                        ),
                        array(
                            'id'        => 'category_posts_layout',
                            'type'      => 'select',
                            'options'   => portfolio_blog_listings(),
                            'title'     => __('Portfolio Category Layout', 'portfolio'),
                            'desc'      => __('Select Listing Layout for Category','portfolio'),
                            'default'   => 1
                        ),
                        array(
                            'id'        => 'tag_posts_layout',
                            'type'      => 'select',
                            'options'   => portfolio_blog_listings(),
                            'title'     => __('Portfolio Tags Layout', 'portfolio'),
                            'desc'      => __('Select Listing Layout for Tags','portfolio'),
                            'default'   => 1
                        ),
                        array(
                            'id'        => 'author_posts_layout',
                            'type'      => 'select',
                            'options'   => portfolio_blog_listings(),
                            'title'     => __('Portfolio Author Layout', 'portfolio'),
                            'desc'      => __('Select Listing Layout for Author','portfolio'),
                            'default'   => 1
                        ),
                        array(
                            'id'        => 'archive_posts_layout',
                            'type'      => 'select',
                            'options'   => portfolio_blog_listings(),
                            'title'     => __('Portfolio Archive Layout', 'portfolio'),
                            'desc'      => __('Select Listing Layout for Portfolio','portfolio'),
                            'default'   => 1
                        ),
                        array(
                            'id'        => 'search_posts_layout',
                            'type'      => 'select',
                            'options'   => portfolio_blog_listings(),
                            'title'     => __('Portfolio Search Layout', 'portfolio'),
                            'desc'      => __('Select Listing Layout for Search','portfolio'),
                            'default'   => 1
                        ),

                    )  
                );

            /*================================
                SUBSCRIBE Settings Section
            =================================*/
                $this->sections[] = array(
                    'title'     => __('Subscribe to MailChimp', 'portfolio'),
                    'icon'      => '',
                    'id'        => 'subscribe_id',
                    'desc'      => __('Insert API and List ID for MailChimp, if you want to receive information about subscribers.', 'portfolio'),
                    'fields'    => array(
                        array(
                            'id'    => 'subscribe_api',
                            'type'  => 'text',
                            'title' => __('API Key', 'portfolio') ,
                            'desc'  => __('MailChimp API Key', 'portfolio')
                        ),
                        array(
                            'id'    => 'subscribe_list_id',
                            'type'  => 'text',
                            'title' => __('List ID', 'portfolio') ,
                            'desc'  => __('MailChimp List ID', 'portfolio')
                        ),
                    )
                );            
            /*================================
               SEO Section
            =================================*/
                $this->sections[] = array(
                    'title'     => __('SEO', 'portfolio'),
                    'icon'      => '',
                    'id'        => 'seo_id',
                    'desc'      => __('Insert text for SEO purposes.', 'portfolio'),
                    'fields'    => array(
                        array(
                            'id'    => 'seo_keywords_id',
                            'type'  => 'text',
                            'title' => __('Keywords', 'portfolio') ,
                            'desc'  => __('Type keywords here. Spearate them with comma(lorem, ipsum, example).', 'portfolio')
                        ),
                        array(
                            'id'    => 'seo_description_id',
                            'type'  => 'textarea',
                            'title' => __('Description', 'portfolio') ,
                            'desc'  => __('Describe your website.', 'portfolio')
                        ),
                    )
                );
            /*================================
               E-mail Sending
            =================================*/
                $this->sections[] = array(
                    'title'     => __('Contact Page Info', 'portfolio'),
                    'icon'      => '',
                    'id'        => 'contact_page_id',
                    'desc'      => __('Insert Information About Your E-mail.', 'portfolio'),
                    'fields'    => array(
                        array(
                            'id'    => 'email_info_id',
                            'type'  => 'text',
                            'title' => __('Insert E-mail', 'portfolio') ,
                            'desc'  => __('Insert E-mail Where Message Should Arrive..', 'portfolio')
                        ),
                        array(
                            'id'    => 'subject_info_id',
                            'type'  => 'text',
                            'title' => __('Insert Name', 'portfolio') ,
                            'desc'  => __('Insert Contact Person Name.', 'portfolio')
                        ),
                    )
                );
            /*================================
                Copyrights
            =================================*/
                $this->sections[] = array(
                    'title'     => __('Copyrights', 'portfolio'),
                    'icon'      => '',
                    'id'        => 'copyrights_id',
                    'desc'      => __('Insert Copyrights Rules Into Footer.', 'portfolio'),
                    'fields'    => array(
                        array(
                            'id'    => 'copyrights_author_name',
                            'type'  => 'text',
                            'title' => __('Insert Website Author Name', 'portfolio') ,
                            'desc'  => __('Insert Name Here', 'portfolio')
                        ),
                        array(
                            'id'    => 'copyrights_info_id',
                            'type'  => 'textarea',
                            'title' => __('Insert Copyrights Description', 'portfolio') ,
                            'desc'  => __('Insert Text Here', 'portfolio')
                        )
                    )
                );
    







            } // END "setSections()"




            /*=======================================================================
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to:
                https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
            ==========================================================================*/
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'my_portfolio',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => __('My Portfolio Theme','portfolio'),
                    // Name that appears at the top of your panel
                    'display_version'      => __('1.0', 'portfolio'),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'My Portfolio Theme ', 'portfolio' ),
                    'page_title'           => __( 'My Portfolio Theme Settings', 'portfolio' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => true,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => true,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => '_options',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );
            }
        } 

            // Create $my_portfolio_opts - global variable
            global $my_portfolio_opts;
            $my_portfolio_opts = new My_Portfolio_Theme();
    }
        else {
            echo "The class named My_Portfolio_Theme has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
        }

?>   
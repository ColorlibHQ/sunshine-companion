<?php
if( !defined( 'WPINC' ) ){
    die;
}
/**
 * @Packge     : Sunshine Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */



// Make sure the same class is not loaded twice in free/premium versions.
if ( !class_exists( 'Sunshine_El_Widgets' ) ) {
    /**
     * Main Sunshine Elementor Widgets Class
     *
     *
     * @since 1.7.0
     */
    final class Sunshine_El_Widgets {
        /**
         * Sunshine Companion Core Version
         *
         * Holds the version of the plugin.
         *
         * @since 1.7.0
         * @since 1.7.1 Moved from property with that name to a constant.
         *
         * @var string The plugin version.
         */
        const  VERSION = '1.0' ;
        /**
         * Minimum Elementor Version
         *
         * Holds the minimum Elementor version required to run the plugin.
         *
         * @since 1.7.0
         * @since 1.7.1 Moved from property with that name to a constant.
         *
         * @var string Minimum Elementor version required to run the plugin.
         */
        const  MINIMUM_ELEMENTOR_VERSION = '1.7.0';
        /**
         * Minimum PHP Version
         *
         * Holds the minimum PHP version required to run the plugin.
         *
         * @since 1.7.0
         * @since 1.7.1 Moved from property with that name to a constant.
         *
         * @var string Minimum PHP version required to run the plugin.
         */
        const  MINIMUM_PHP_VERSION = '5.4' ;
        /**
         * Instance
         *
         * Holds a single instance of the `Press_Elements` class.
         *
         * @since 1.7.0
         *
         * @access private
         * @static
         *
         * @var Press_Elements A single instance of the class.
         */
        private static  $_instance = null ;

        /**
         * Instance
         *
         * Ensures only one instance of the class is loaded or can be loaded.
         *
         * @since 1.7.0
         *
         * @access public
         * @static
         *
         * @return Press_Elements An instance of the class.
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Clone
         *
         * Disable class cloning.
         *
         * @since 1.7.0
         *
         * @access protected
         *
         * @return void
         */
        public function __clone() {
            // Cloning instances of the class is forbidden
            _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'sunshine-companion' ), '1.7.0' );
        }

        /**
         * Wakeup
         *
         * Disable unserializing the class.
         *
         * @since 1.7.0
         *
         * @access protected
         *
         * @return void
         */
        public function __wakeup() {
            // Unserializing instances of the class is forbidden.
            _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'sunshine-companion' ), '1.7.0' );
        }

        /**
         * Constructor
         *
         * Initialize the sunshine elementor widgets.
         *
         * @since 1.7.0
         *
         * @access public
         */
        public function __construct() {
           
            $this->init_hooks();
            do_action( 'press_elements_loaded' );
        }


        /**
         * Init Hooks
         *
         * Hook into actions and filters.
         *
         * @since 1.7.0
         *
         * @access private
         */
        private function init_hooks() {
            add_action( 'init', [ $this, 'init' ] );
        }


        /**
         * Init Sunshine Elementor Widget
         *
         * Load the plugin after Elementor (and other plugins) are loaded.
         *
         * @since 1.0.0
         * @since 1.7.0 The logic moved from a standalone function to this class method.
         *
         * @access public
         */
        public function init() {

            if ( !did_action( 'elementor/loaded' ) ) {
                add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
                return;
            }

            // Check for required Elementor version

            if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
                add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
                return;
            }

            // Check for required PHP version

            if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
                add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
                return;
            }

            // Add new Elementor Categories
            add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_category' ] );
            // Register Widget Scripts
            add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_widget_scripts' ] );
            // Register Widget Styles
            add_action( 'admin_enqueue_scripts', [ $this, 'register_admin_styles' ] );
            add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'register_widget_styles' ] );
            add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_widget_styles' ] );
            add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'register_widget_styles' ] );

            // Register New Widgets
            add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );

            // Sunshine Companion enqueue style and scripts
            add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_element_widgets_scripts' ] );

        }

        /**
         * Admin notice
         *
         * Warning when the site doesn't have Elementor installed or activated.
         *
         * @since 1.1.0
         * @since 1.7.0 Moved from a standalone function to a class method.
         *
         * @access public
         */
        public function admin_notice_missing_main_plugin() {
            $message = sprintf(
            /* translators: 1: Elementor */
                esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'sunshine-companion' ),
                '<strong>' . esc_html__( 'Sunshine Theme', 'sunshine-companion' ) . '</strong>',
                '<strong>' . esc_html__( 'Elementor', 'sunshine-companion' ) . '</strong>'
            );
            printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
        }

        /**
         * Admin notice
         *
         * Warning when the site doesn't have a minimum required Elementor version.
         *
         * @since 1.1.0
         * @since 1.7.0 Moved from a standalone function to a class method.
         *
         * @access public
         */
        public function admin_notice_minimum_elementor_version() {
            $message = sprintf(
            /* translators: 1: Elementor 2: Required Elementor version */
                esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'sunshine-companion' ),
                '<strong>' . esc_html__( 'Sunshine', 'sunshine-companion' ) . '</strong>',
                '<strong>' . esc_html__( 'Elementor', 'sunshine-companion' ) . '</strong>',
                self::MINIMUM_ELEMENTOR_VERSION
            );
            printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
        }

        /**
         * Admin notice
         *
         * Warning when the site doesn't have a minimum required PHP version.
         *
         * @access public
         */
        public function admin_notice_minimum_php_version() {
            $message = sprintf(
            /* translators: 1: PHP 2: Required PHP version */
                esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'sunshine-companion' ),
                '<strong>' . esc_html__( 'Sunshine', 'sunshine-companion' ) . '</strong>',
                '<strong>' . esc_html__( 'PHP', 'sunshine-companion' ) . '</strong>',
                self::MINIMUM_PHP_VERSION
            );
            printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
        }

        /**
         * Add new Elementor Categories
         *
         * Register new widget categories for Sunshine widgets.
         *
         * @access public
         */
        public function add_elementor_category() {

            \Elementor\Plugin::instance()->elements_manager->add_category( 'sunshine-elements', [
                'title' => __( 'Sunshine Elements', 'sunshine-companion' ),
            ], 1 );

        }

        /**
         * Enqueue Widgets Scripts
         *
         * Enqueue custom scripts required to run sunshine elementor widgets.
         *
         * @access public
         */
        public function enqueue_element_widgets_scripts() {
            // googlr map api key
            $apiKey  = sunshine_opt('sunshine_map_apikey');

            /*****************
                Enqueue Css
            ******************/

            // owl carousel slider css
            wp_enqueue_style( 'owl-carousel', plugins_url( 'assets/css/owl.carousel.min.css', __FILE__ ), array(), '2.0.0', 'all' );
            // magnific popup css
            wp_enqueue_style( 'magnific-popup', plugins_url( 'assets/css/magnific-popup.css', __FILE__ ), array(), '1.0', 'all' );
            // utility class
            wp_enqueue_style( 'sunshine-companion-utility', plugins_url( 'assets/css/utility.css', __FILE__ ), array(), '1.0', 'all' );

            /*****************
                Enqueue Js
            ******************/
                
            // google api js
            wp_register_script( 'maps-googleapis', '//maps.googleapis.com/maps/api/js?key='.$apiKey );
            // mailchimp validate js
            // wp_register_script( 'mc-validate', '//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js' );
            // owl carousel js
            // wp_enqueue_script( 'owl-carousel', plugins_url( 'assets/js/owl.carousel.min.js', __FILE__ ), array('jquery'), '1.1.3', true );
            // barfillerr js
            // wp_enqueue_script( 'barfiller', plugins_url( 'assets/js/barfiller.js', __FILE__ ), array('jquery'), '1.0.1', true );
            // youtube background js
            // wp_enqueue_script( 'jquery-youtubebackground', plugins_url( 'assets/js/jquery.youtubebackground.js', __FILE__ ), array('jquery'), '1.0.5', true );
            // progress loader canvas js
            // wp_register_script( 'progress-loader-canvas', plugins_url( 'assets/js/progress-loader-canvas.js', __FILE__ ), array('jquery'), '1.0', true );
            // waypoints js
            // wp_enqueue_script( 'waypoints', plugins_url( 'assets/js/waypoints.js', __FILE__ ), array('jquery'), '2.0.3', true );
            // jquery counterup js
            // wp_enqueue_script( 'jquery-counterup', plugins_url( 'assets/js/jquery.counterup.js', __FILE__ ), array('jquery'), '1.0', true );
            // imagesLoaded js
            // wp_enqueue_script( 'imagesLoaded', plugins_url( 'assets/js/imagesLoaded.js', __FILE__ ), array('jquery'), '4.1.3', true );
            // isotope js
            // wp_enqueue_script( 'isotope', plugins_url( 'assets/js/isotope.js', __FILE__ ), array('jquery'), '3.0.2', true );
            // plugins js
            // wp_register_script( 'plugins', plugins_url( 'assets/js/plugins.js', __FILE__ ), array('jquery'), '1.0.0', true );
            // map active js
            // wp_register_script( 'sunshine-map-active', plugins_url( 'assets/js/map-active.js', __FILE__ ), array('jquery'), '1.0', true );
            // sunshine companion main js
            wp_enqueue_script( 'sunshine-companion', plugins_url( 'assets/js/sunshine-companion-main.js', __FILE__ ), array('jquery'), '1.0', true );


        }

        /**
         * Register Widget Scripts
         *
         * Register custom scripts required to run.
         *
         * @access public
         */
        public function register_widget_scripts() {
            // Typing Effect
            //wp_register_script( 'typedjs', plugins_url( 'press-elements/libs/typed/typed.js' ), array( 'jquery' ) );
        }

        /**
         * Register Widget Styles
         *
         * Register custom styles required to run Sunshine.
         *
         * @access public
         */
        public function register_widget_styles() {
            // Typing Effect
            wp_enqueue_style( 'sunshine-companion-elementor-edit', plugins_url( '/assets/css/elementor-edit.css', __FILE__ ) );
        }


        /**
         * Register Admin Styles
         *
         * Register custom styles required to Sunshine Companion WordPress Admin Dashboard.
         *
         * @access public
         */
        public function register_admin_styles() {
        }

        /**
         * Register New Widgets
         *
         * Include Sunshine Companion widgets files and register them in Elementor.
         *
         * @since 1.0.0
         * @since 1.7.1 The method moved to this class.
         *
         * @access public
         */
        public function on_widgets_registered() {
            $this->include_widgets();
            $this->register_widgets();
        }

        /**
         * Include Widgets Files
         *
         * Load sunshine companion widgets files.
         *
         * @since 1.0.0
         * @since 1.7.1 The method moved to this class.
         *
         * @access private
         */
        private function include_widgets() {
            
            require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/hero-section.php';
            require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/wedding-countdown.php';
            require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/love-story.php';
            require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/gallery.php';
            require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/practice-area.php';
            require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/review-section.php';
            require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/home-appointment.php';
            // require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/departments.php';
            // require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/business-expert-item.php';
            // require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/business-expert.php';
            // require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/emergency-contact-section.php';
            // require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/single-event.php';
            // require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/clients.php';
            // require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/faq-section.php';
            // require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/projects.php';
            require_once SUNSHINE_COMPANION_EW_DIR_PATH . 'widgets/contact.php';
        }

        /**
         * Register Widgets
         *
         * Register sunshine companion widgets.
         *
         * @since 1.0.0
         * @since 1.7.1 The method moved to this class.
         *
         * @access private
         */
        private function register_widgets() {
            // Site Elements
            
           
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Hero() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Wedding_Countdown() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Love_Story() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Gallery() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Practice_Area() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Review_Contents() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Home_Appointment() ); 
            // \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Departments() ); 
            // \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Business_Expert_Tab_Items() ); 
            // \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Business_Expert() ); 
            // \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Emergency_Contact_Section() ); 
            // \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Single_Event() ); 
            // \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Client_Contents() ); 
            // \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Faq_Section() ); 
            // \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Projects() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sunshineelementor\Widgets\Sunshine_Contact() ); 
        }

    }
}
// Make sure the same function is not loaded twice in free/premium versions.



if ( !function_exists( 'sunshine_el_widgets_load' ) ) {
    /**
     * Load Sunshine elementor widget
     *
     * Main instance of Press_Elements.
     *
     * @since 1.0.0
     * @since 1.7.0 The logic moved from this function to a class method.
     */
    function sunshine_el_widgets_load() {
        return Sunshine_El_Widgets::instance();
    }

    // Run sunshine elementor widget
    sunshine_el_widgets_load();
}


add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style('elementor-global');
});
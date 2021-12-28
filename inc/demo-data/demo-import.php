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

// demo import file
function sunshine_import_files() {
	
	$demoImg = '<img src="'.plugins_url( 'screen-image.jpg', __FILE__ ) .'" alt="'.esc_attr__( 'Demo Preview Imgae', 'sunshine-companion' ).'" />';
	
  return array(
    array(
      'import_file_name'             => 'Sunshine Demo',
      'local_import_file'            => SUNSHINE_COMPANION_DEMO_DIR_PATH .'sunshine-demo.xml',
      'local_import_widget_file'     => SUNSHINE_COMPANION_DEMO_DIR_PATH .'sunshine-widgets-demo.wie',
      'import_customizer_file_url'   => plugins_url( 'sunshine-customizer.dat', __FILE__ ),
      'import_notice' => $demoImg,
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'sunshine_import_files' );


// demo import setup
function sunshine_after_import_setup() {
	// Assign menus to their locations.
	$main_menu    = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	$footer_menu  = get_term_by( 'name', 'Footer Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary-menu' => $main_menu->term_id,
			'footer-menu' => $footer_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Homepage' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );
	update_option( 'posts_per_page', 3 );

	// Update the post to draft after import is done
	sunshine_update_the_followed_post_page_status();

	// Add an option to check after import is done
	update_option( 'sunshine-import-data', true );

}
add_action( 'pt-ocdi/after_import', 'sunshine_after_import_setup' );

//disable the branding notice after successful demo import
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

//change the location, title and other parameters of the plugin page
function sunshine_import_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'sunshine-companion' );
	$default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'sunshine-companion' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'sunshine-demo-import';

	return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'sunshine_import_plugin_page_setup' );

// Enqueue scripts
function sunshine_demo_import_custom_scripts(){
	
	
	if( isset( $_GET['page'] ) && $_GET['page'] == 'sunshine-demo-import' ){
		// style
		wp_enqueue_style( 'sunshine-demo-import', plugins_url( 'css/demo-import.css', __FILE__ ), array(), '1.0', false );
	}
	
	
}
add_action( 'admin_enqueue_scripts', 'sunshine_demo_import_custom_scripts' );

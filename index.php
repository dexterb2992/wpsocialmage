<?php
/*
Plugin Name: WP Social Mage
Plugin URI: http://topdogwpsocialmage.com
Description: Find images, create memes and clickable images and post your creations automatically to your Facebook wall, groups and pages.
Version: 1.3.8
Author: Rob Maggs
Author URI: http://stealthymarketer.co.uk/about/
*/


if( !defined('ABSPATH') ) die ("Oops! This is a WordPress plugin and should not be called directly.\n");

if (!defined('WP_SM_VERSION_KEY'))
    define('WP_SM_VERSION_KEY', 'wp_sm_version');

if (!defined('WP_SM_VERSION_NUM'))
    define('WP_SM_VERSION_NUM', '1.0.0');

add_option(WP_SM_VERSION_KEY, WP_SM_VERSION_NUM);

add_option('wp_sm_version', '1.0.0');

add_action( 'admin_menu', 'wp_social_mage_admin_menu' );
add_action( 'wp_en queue_scripts', 'wp_social_mage_plugin_styles' );

$new_version = '1.3.8';  // change this to update version

if (get_option(WP_SM_VERSION_KEY) != $new_version) {
  // Execute your upgrade logic here

  // Then update the version value
  update_option(WP_SM_VERSION_KEY, $new_version);
}

function wp_social_mage_admin_menu() {
  /* Add our plugin menu and administration screen */
	$page_hook_suffix = add_menu_page(
		__( 'WP Social Mage Dashboard', 'dashboard' ),          	// The menu title
		__( 'WP Social Mage', 'dashboard' ),                    	// The screen title
		'manage_options',                                    			// The capability required for access to this menu
		'wp-social-mage-dashboard',                                    		// The slug to use in the URL of the screen
		'wp_social_mage_manage_menu'                                   		// The function to call to display the screen

  );

    /**
    *  Use the retrieved $page_hook_suffix to hook the function that links our script.
    *  This hook invokes the function only on our plugin administration screen
    *  see: http://codex.wordpress.org/Administration_Menus#Page_Hook_Suffix
    */


    /* Register our script. */
    wp_register_script( 'moment.js', plugins_url( '/js/moment.js', __FILE__ ) );
    wp_register_script( 'bootstrap-material-datetimepicker.js', plugins_url( '/js/bootstrap-material-datetimepicker.js', __FILE__ ) );
    wp_register_script( 'mui.min.js', plugins_url( '/js/mui.min.js', __FILE__ ) );
    wp_register_script( 'jquery.form.js', plugins_url( '/js/jquery.form.js', __FILE__ ) );
    wp_register_script( 'snackbar.min.js', plugins_url( '/js/snackbar.min.js', __FILE__ ) );
    wp_register_script( 'jquery-ui.js', plugins_url( '/js/jquery-ui.js', __FILE__ ) );
    wp_register_script( 'colorpicker.js', plugins_url( '/js/colorpicker.js', __FILE__ ) );
    wp_register_script( 'select2.min.js', plugins_url( '/js/select2.min.js', __FILE__ ) );
    wp_register_script( 'caman.js', plugins_url( '/js/caman.js', __FILE__ ) );
    wp_register_script('fb-all.js', '//connect.facebook.net/en_US/all.js');
    wp_register_script( 'jcanvas.js', plugins_url( '/js/jcanvas.js', __FILE__ ) );
    wp_register_script( 'canvas2image.js', plugins_url( '/js/canvas2image.js', __FILE__ ) );
    wp_register_script( 'jquery.contextmenu.js', plugins_url( '/js/jquery.contextmenu.js', __FILE__ ) );
    wp_register_script( 'html2canvas.js', plugins_url( '/js/html2canvas.js', __FILE__ ) );
    wp_register_script( 'rasterizeHTML.allinone.js', plugins_url( '/js/rasterizeHTML.allinone.js', __FILE__ ) );
    wp_register_script( 'wp-social-mage-script', plugins_url( '/js/app.js', __FILE__ ) );


    /* Register style sheet. */
    wp_register_style( 'bootstrap-material-datetimepicker.css', plugins_url( '/css/bootstrap-material-datetimepicker.css', __FILE__ ) );
    wp_register_style( 'snackbar.min.css', plugins_url( '/css/snackbar.min.css', __FILE__ ) );
    wp_register_style( 'material.css', plugins_url( '/css/material.css', __FILE__ ) );
    wp_register_style( 'jquery-ui.css', plugins_url( '/css/jquery-ui.css', __FILE__ ) );
    wp_register_style( 'mui.min.css', plugins_url( '/css/mui.min.css', __FILE__ ) );
    wp_register_style( 'caman.css', plugins_url( '/css/caman.css', __FILE__ ) );
    wp_register_style( 'source-code-pro-raleway.css', plugins_url( '/css/source-code-pro-raleway.css', __FILE__ ) );
    wp_register_style( 'colorpicker.css', plugins_url( '/css/colorpicker.css', __FILE__ ) );
    wp_register_style( 'select2.min.css', plugins_url( '/css/select2.min.css', __FILE__ ) );
    wp_register_style( 'jquery.contextmenu.css', plugins_url( '/css/jquery.contextmenu.css', __FILE__ ) );
    
    wp_register_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
    wp_register_style( 'bootstrap.min.css', plugins_url( 'css/bootstrap.min.css', __FILE__ ) );
    wp_register_style( 'wp-social-mage-style', plugins_url( '/css/style.css', __FILE__ ) );



    add_action('admin_print_scripts-' . $page_hook_suffix, 'wp_social_mage_admin_scripts');
    add_action('admin_print_styles-' . $page_hook_suffix, 'wp_social_mage_plugin_styles');

    /* let's create our uploads directory */
    $upload = wp_upload_dir();
    $upload_dir = $upload['basedir'];
    $upload_dir = $upload_dir . '/wp-social-mage/';
    if (! is_dir($upload_dir)) {
        mkdir( $upload_dir, 0755 );
    }

    if( is_dir($upload_dir) ){
        // create each user's uploads directory
        $user_upload_path = $upload_dir.'user_'.get_current_user_id().'/';
        if( !is_dir($user_upload_path) ){
            mkdir($user_upload_path, 0755);
        }
    }
}


function wp_social_mage_admin_scripts() {
  
    /* Link our already registered script to a page */
    wp_enqueue_script( 'moment.js' );
    wp_enqueue_script( 'bootstrap-material-datetimepicker.js' );
    wp_enqueue_script( 'mui.min.js' );
    wp_enqueue_script( 'jquery.form.js' );
    wp_enqueue_script( 'snackbar.min.js' );
    wp_enqueue_script( 'jquery-ui.js' );
    wp_enqueue_script( 'colorpicker.js' );
    wp_enqueue_script( 'select2.min.js' );
    wp_enqueue_script( 'caman.js' );
    wp_enqueue_script( 'fb-all.js' );
    wp_enqueue_script( 'jcanvas.js' );
    wp_enqueue_script( 'canvas2image.js' );
    wp_enqueue_script( 'jquery.contextmenu.js' );
    wp_enqueue_script( 'html2canvas.js' );
    wp_enqueue_script( 'rasterizeHTML.allinone.js' );
    wp_enqueue_script( 'wp-social-mage-script' );
}


/**
 * Register style sheet.
 */
function wp_social_mage_plugin_styles() {
	/* Link our already registered style to a page */
    wp_enqueue_style( 'bootstrap-material-datetimepicker.css' );
    wp_enqueue_style( 'snackbar.min.css' );
    wp_enqueue_style( 'material.css' );
    wp_enqueue_style( 'jquery-ui.css' );
    wp_enqueue_style( 'mui.min.css' );
    wp_enqueue_style( 'caman.css' );
    wp_enqueue_style( 'source-code-pro-raleway.css' );
    wp_enqueue_style( 'colorpicker.css' );
    wp_enqueue_style( 'select2.min.css' );
    wp_enqueue_style( 'jquery.contextmenu.css' );
    wp_enqueue_style( 'font-awesome' );
    wp_enqueue_style( 'bootstrap.min.css' );
    wp_enqueue_style( 'wp-social-mage-style' );
}


function wp_social_mage_manage_menu() {
    /* Display our administration screen */
    include('dashboard.php');

}

/* Create our table where we can store the data from specific searches */

add_action( 'init', 'wp_social_mage_register_activity_log_table', 1 );
add_action( 'switch_blog', 'wp_social_mage_register_activity_log_table' );


function wp_social_mage_register_activity_log_table() {
  global $wpdb;
  $wpdb->wp_social_mage_activity_log = "{$wpdb->prefix}wp_social_mage_activity_log";
  $wpdb->wp_social_mage_settings = "{$wpdb->prefix}wp_social_mage_settings";
}



function wp_social_mage_create_tables() {
    // Code for creating a table goes here
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    global $wpdb;
    global $charset_collate;


    // Call this manually as we may have missed the init hook
    wp_social_mage_register_activity_log_table();

    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != "{$wpdb->wp_social_mage_activity_log}") {
      // if wp_social_mage_activity_log table is not created, we can create the table here.

      ob_start();
        $sql_create_table = "CREATE TABLE {$wpdb->wp_social_mage_activity_log} (
          id bigint(20) unsigned NOT NULL auto_increment,
          wp_user_id int NOT NULL,
          url varchar(255),
          title varchar(255) NOT NULL,
          message longtext,
          description longtext,
          is_create_album int(1) NOT NULL default 0,
          album_name varchar(255),
          album varchar(255),
          where_to_post varchar(255),
          where_to_post_page varchar(255),
          image_filename varchar(255),
          schedule datetime NOT NULL,
          date_added timestamp NOT NULL default CURRENT_TIMESTAMP,
          is_posted int(1) NOT NULL default 0,
          date_deleted timestamp,
          PRIMARY KEY  (id)
        ) $charset_collate; ";

     
        dbDelta( $sql_create_table );

        ob_flush();
    }

    $wpdb->wp_social_mage_settings = $wpdb->prefix."wp_social_mage_settings";

    if( $wpdb->get_var("SHOW TABLES LIKE '{$wpdb->wp_social_mage_settings}'") != "{$wpdb->wp_social_mage_settings}" ){
      ob_start();
        $sql_create_table2 = "CREATE TABLE {$wpdb->wp_social_mage_settings}(
          id bigint(20) unsigned NOT NULL auto_increment primary key,
          wp_user_id int NOT NULL,
          user_domain varchar(255),
          timezone varchar(50),
          fb_app_id varchar(255),
          fb_app_secret varchar(255),
          fb_user_id varchar(255),
          fb_auth_token longtext,
          created_at TIMESTAMP default CURRENT_TIMESTAMP,
          updated_at TIMESTAMP,
          deleted_at TIMESTAMP
        ) $charset_collate;";
        
        dbDelta( $sql_create_table2 );
      ob_flush();
    }
}


function wp_social_mage_uninstall(){
  require_once( ABSPATH . '/wp-config.php' );
  global $wpdb;
  $wpdb->query( "DROP TABLE IF EXISTS $wpdb->wp_social_mage_settings" );

  delete_option('wp_sm_email');
  delete_option('wp_sm_lkey');
  delete_option('wp_social_mage_key');
  delete_option('wp_social_mage_lkey');

}
  
// Create tables on plugin activation
register_activation_hook( __FILE__, 'wp_social_mage_create_tables' );

register_deactivation_hook( __FILE__, 'wp_social_mage_uninstall' );

register_uninstall_hook(__FILE__,'wp_social_mage_uninstall');


// let's do the ajax thing here
add_action( 'wp_ajax_WpSocialMageAjax', 'WpSocialMageAjax' );

function WpSocialMageAjax() {
  // die( plugin_dir_path( __FILE__ ) );
  include( plugin_dir_path( __FILE__ ).'js/ajax.php' );
}

?>
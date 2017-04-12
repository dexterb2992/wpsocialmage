<?php
global $CURRENT_SETTINGS;

if( !defined('ABSPATH') ){
	include( dirname( dirname ( dirname( dirname( dirname(__FILE__) ) ) ) )."/wp-load.php" );
}

define('WP_SM_FOLDER_NAME', basename( dirname( dirname(__FILE__) ) )."/" );
define('WP_SM_CONTENT_URL', dirname( dirname ( dirname( dirname( dirname(__FILE__) ) ) ) ).'/wp-content/');
define('WP_SM_PLUGINS_PATH', dirname( dirname ( dirname( dirname( dirname(__FILE__) ) ) ) ).'/wp-content/plugins/');
// define('WP_SM_ABS_PATH', dirname( dirname ( dirname( dirname( dirname(__FILE__) ) ) ) ).'/wp-content/plugins/'.WP_SM_FOLDER_NAME);
define('WP_SM_ABS_PATH', plugin_dir_path( dirname( __FILE__ ) ));
define('WP_SM_CLASSES_FOLDER', WP_SM_ABS_PATH."classes/");
define('WP_SM_BASE_URL',  plugins_url(WP_SM_FOLDER_NAME));
define('WP_SM_HOST_NAME', dirname( dirname( dirname(WP_SM_BASE_URL) ) ));
define('WP_SM_UPLOADS_FOLDER', WP_SM_BASE_URL.'uploads/');
define('WP_SM_IMAGES_FOLDER', WP_SM_BASE_URL.'images/');
define('WP_SM_UPLOADS_FOLDER_ABS_PATH', WP_SM_ABS_PATH."uploads/");

define('WP_SM_PIXABAY_USERNAME', 'dexterb2992');
define('WP_SM_PIXABAY_KEY', '1362230-a0032011b620800873c110448');

/**
 * returns array or json object
 */
if( !function_exists('get_social_mage_current_settings') ){
	function get_social_mage_current_settings($dataType = 'json'){
		global $wpdb;

		$user_id = get_current_user_id();
		$sql = "SELECT * FROM $wpdb->wp_social_mage_settings WHERE wp_user_id=".get_current_user_id()." LIMIT 1";
		$settings = $wpdb->get_results($sql, ARRAY_A);
		if( $dataType == 'json' )
			return json_encode($settings);
		return $settings;

	}
}

$CURRENT_SETTINGS = get_social_mage_current_settings('array');

define('WP_SM_FB_APP_ID', isset($CURRENT_SETTINGS[0]['fb_app_id']) ? $CURRENT_SETTINGS[0]['fb_app_id'] : '' );
define('WP_SM_FB_APP_SECRET', isset($CURRENT_SETTINGS[0]['fb_app_secret']) ? $CURRENT_SETTINGS[0]['fb_app_secret'] : ''); 
define('WP_SM_CURRENT_TIMEZONE', isset($CURRENT_SETTINGS[0]['timezone']) ? $CURRENT_SETTINGS[0]['timezone'] : ''); 
?>
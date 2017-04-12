<?php 
if( !function_exists('plugin_dir_path') ){
	include "../classes/config.php"; 
}
include( dirname( plugin_dir_path( __FILE__ ) ).'/classes/config.php' );
include WP_SM_CLASSES_FOLDER."functions.php"; // this is where we can find all the functions being used below 

$q = $_POST['q'];

if( $q == "save_canvas" ){

	echo saveCanvas($_POST['imgBase64'], $_POST);
	die();

}else if( $q == "save_schedule" ){

	echo saveSchedule($_POST);
	die();

}else if( $q == "get_long_live_token" ){
	echo getLongLiveFBToken($_POST);
	die();

}elseif( $q == "generate_longlive_token" ){
	echo generateLongLiveFBToken($_POST);
	die();

}elseif( $q == "image_search" ){
	echo searchImages($_POST['query']);
	die();

}elseif ( $q == "delete_image" ) {

	echo deleteImage($_POST['filename']);
	die();

}elseif ( $q == "grab_image_from_url" ) {

	echo grabImageFromUrl($_POST['src']);
	die();

}elseif ( $q == "get_user_type" ){
	echo getUserAccess($_POST['type']);
	die();

}else if( $q == "set_timezone" ){

	echo setTimezone($_POST['timezone']);
	die();

}else if( $q == "get_settings" ){

	echo get_social_mage_current_settings();
	die();

}else if( $q == "update_settings" ){

	echo updateSettings($_POST);
	die();

}

?>

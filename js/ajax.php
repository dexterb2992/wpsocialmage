<?php 
if( !function_exists('plugin_dir_path') ){
	include "../classes/config.php"; 
}
include( dirname( plugin_dir_path( __FILE__ ) ).'/classes/config.php' );
include WP_SM_CLASSES_FOLDER."functions.php"; // this is where we can find all the functions being used below 

$q = $_POST['q'];
$response = "{}";

if( $q == "save_canvas" ){

	$response = saveCanvas($_POST['imgBase64'], $_POST);

}else if( $q == "save_schedule" ){

	$response = saveSchedule($_POST);

}else if( $q == "get_long_live_token" ){
	$response = getLongLiveFBToken($_POST);

}elseif( $q == "generate_longlive_token" ){
	$response = generateLongLiveFBToken($_POST);

}elseif( $q == "image_search" ){
	$response = searchImages($_POST['query']);

}elseif ( $q == "delete_image" ) {

	$response = deleteImage($_POST['filename']);

}elseif ( $q == "grab_image_from_url" ) {

	$response = grabImageFromUrl($_POST['src']);

}elseif ( $q == "get_user_type" ){
	$response = getUserAccess($_POST['type']);

}else if( $q == "set_timezone" ){

	$response = setTimezone($_POST['timezone']);

}else if( $q == "get_settings" ){

	$response = get_social_mage_current_settings();

}else if( $q == "update_settings" ){

	$response = updateSettings($_POST);

}

echo trim($response);
die;

?>

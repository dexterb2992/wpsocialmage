<?php 
if( !function_exists('plugin_dir_path') ){
	include "../classes/config.php"; 
}
include( dirname( plugin_dir_path( __FILE__ ) ).'/classes/config.php' );
include WP_SM_CLASSES_FOLDER."functions.php"; // this is where we can find all the functions being used below 

$q = $_POST['q'];
$response = "{}";

switch ($q) {
	case 'save_canvas':
		$response = saveCanvas($_POST['imgBase64'], $_POST);
		break;
	
	case 'save_schedule':
		$response = saveSchedule($_POST);
		break;

	case 'get_long_live_token':
		$response = getLongLiveFBToken($_POST);
		break;

	case 'generate_longlive_token':
		$response = generateLongLiveFBToken($_POST);
		break;

	case 'image_search':
		$response = searchImages($_POST['query']);
		break;

	case 'delete_image':
		$response = deleteImage($_POST['filename']);
		break;

	case 'grab_image_from_url':
		$response = grabImageFromUrl($_POST['src']);
		break;

	case 'get_user_type':
		$response = getUserAccess($_POST['type']);
		break;

	case 'set_timezone':
		$response = setTimezone($_POST['timezone']);
		break;

	case 'get_settings':
		$response = get_social_mage_current_settings();
		break;

	case 'update_settings':
		$response = updateSettings($_POST);
		break;

	case 'upload_image':
		if(!isset($_FILES['image'])){
			$response = array(
				'status' => 'failed',
				'msg' => 'No image specified.'
			);
			break;
		}


		if ( 0 < $_FILES['image']['error'] ) {
		    $response = array('status' => 'failed', 'msg' => 'Error: '.$_FILES['image']['error'].'<br>'); 
		}else {
			if( file_exists($_FILES['image']['name']) ){
				$var = explode('.', $_FILES['image']['name']);
				$_FILES['image']['name'] = $var[0].time().$var[1];
			}

			$target = WP_SM_UPLOADS_FOLDER_ABS_PATH . $_FILES['image']['name'];

		    if( move_uploaded_file($_FILES['image']['tmp_name'], $target) ){
		    	$response = array(
		    		'status' => 'success', 
		    		'msg' => $_FILES['image']['name']." uploaded successfully.", 
		    		'filename' => $_FILES['image']['name']
		    	);
		    }else{
		    	$response = array(
		    		'status' => 'failed', 
		    		'msg' => 'Unable to upload image to target path.', 
		    		'info' => array('target' => $target)
		    	);
		    }
		}


		$response = json_encode($response);
		break;

}

echo trim($response);

die;

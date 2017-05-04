<?php 
if( !function_exists('is_connected') ){
	// determines whether the user is connected to the internet or not
	function is_connected(){
	    $connected = @fsockopen("www.example.com", 80); 
	                                        //website, port  (try 80 or 443)
	    if ($connected){
	        $is_conn = true; //action when connected
	        fclose($connected);
	    }else{
	        $is_conn = false; //action in connection failure
	    }
	    return $is_conn;

	}
}

if( !function_exists('getPageData') ){
	function getPageData($url, $allowsHeader = false){
		if(!function_exists('curl_init')){
			return @file_get_contents($url);
		}

		$curl = curl_init();
		$cookie = tempnam ("/tmp", "CURLCOOKIE");

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; CrawlBot/1.0.0)");

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);
	    curl_setopt($curl, CURLOPT_HEADER, $allowsHeader);
	    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT , 5);
	    curl_setopt($curl, CURLOPT_TIMEOUT, 5);
	    curl_setopt($curl, CURLOPT_ENCODING, "");
	    curl_setopt($curl, CURLOPT_AUTOREFERER, true);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    # required for https urls
	    curl_setopt($curl, CURLOPT_MAXREDIRS, 15);  

		$html = curl_exec($curl);
		$status = curl_getinfo($curl);
		curl_close($curl);

		if($status['http_code']!=200){
		    if($status['http_code'] == 301 || $status['http_code'] == 302) {
		        list($header) = explode("\r\n\r\n", $html, 2);
		        $matches = array();
		        preg_match("/(Location:|URI:)[^(\n)]*/", $header, $matches);

		        $url = trim(str_replace($matches[1],"",$matches[0]));
		        $url_parsed = parse_url($url);
		        // return $header;
		        return (isset($url_parsed))? getPageData($url):'';
		    }

		    // LOG IF ERRORS EXISTS
		    $oline='';
		    foreach($status as $key=>$eline){
		    	@$oline.='['.$key.']'.$eline.' ';
		    }
		    $line =$oline." \r\n ".$url."\r\n-----------------\r\n";
		    $handle = fopen('./curl.error.log', 'a');
		    fwrite($handle, $line);
		    return FALSE;
		}
		return $html;
	}

}

if( !function_exists('pre') ){
	function pre($str){
		echo "<pre>";
		print_r($str);
		echo "</pre>";
	}
}

if( !function_exists('date_time') ){
	function date_time( $date ) {
	    if( $date == "" ){
	        return "";
	    } else {
	        $my_date  = DateTime::createFromFormat( 'd/m/Y H:i', $date );
	        $new_date = $my_date->format( 'Y-m-d H:i' );
	        return $new_date;
	    }
	}
}

if( !function_exists('getFonts') ){
	function getFonts(){
		return array(
			"Impact, sans-serif",
			"'Alfa Slab One', cursive",
			"'Bangers', cursive",
			"'Nosifer', cursive",
			"'Permanent Marker', cursive",
			"'Fredericka the Great', cursive",
			"'PT Sans', sans-serif",
			"'Cabin Sketch', cursive",
			"'Limelight', cursive",
			"'Lobster', cursive",
			"'Waiting for the Sunrise', cursive",
			"'Shojumaru', cursive",
			"'Reenie Beanie', cursive",
			"'Londrina Outline', cursive",
			"'Shadows Into Light', cursive",
			"'Passero One', cursive",
			"'Frijole', cursive",
			"'Fontdiner Swanky', cursive",
			"'UnifrakturCook', cursive",
			"'Metal Mania', cursive",
			"'Gloria Hallelujah', cursive",
			"'Great Vibes', cursive",
			"'Ceviche One', cursive",
			"'Nova Square', cursive",
			"'Uncial Antiqua', cursive",
			"'Rye', cursive",
			"'Special Elite', cursive",
			"'Satisfy', cursive",
			"'Freckle Face', cursive",
			"'Pacifico', cursive",
			"'Pirata One', cursive",
			"'Dancing Script', cursive",
			"'Open Sans Condensed', sans-serif",
			"'Kranky', cursive",
			"'Piedra', cursive",
			"'Indie Flower', cursive",
			"'Luckiest Guy', cursive",
			"'Joti One', cursive",
			"'Orbitron', sans-serif",
			"'Bangers', cursive",
			"'Rock Salt', cursive",
			"'Trykker', serif",
			"'Slabo 27px', serif",
			"'MedievalSharp', cursive",
			"'Cinzel', serif"
		);
	}
}

if( !function_exists('saveSchedule') ){
	function saveSchedule($_INPUT){
		global $wpdb;
		
		$is_create_album = $_INPUT['optionsAlbum'] == "create" ? 1 : 0;
		date_default_timezone_set(WP_SM_CURRENT_TIMEZONE);


		$save = date_time($_INPUT['schedule']);
		$my_dt = new DateTime( $save );

		//Modify error
		$schedule = $my_dt->format( 'Y-m-d H:i:s' );

		$vals = array(
			'wp_user_id' => get_current_user_id(),
			'url' => $_INPUT['url'], 
			'message' => $_INPUT['message'],
			'title' => $_INPUT['title'],
			'description' => $_INPUT['description'],
			'album_name' => $is_create_album == 1 ? $_INPUT['album_name'] : '',
			'album' => $is_create_album == 0 ? $_INPUT['select_album'] : '',
			'is_create_album' => $is_create_album,
			'image_filename' => WP_SM_UPLOADS_FOLDER.$_INPUT['image'],
			'schedule' => $schedule,
			'where_to_post' => $_INPUT['whereToPost'],
			'where_to_post_page' => $_INPUT['whereToPostPage']

		);

		if( $wpdb->insert($wpdb->wp_social_mage_activity_log, $vals) )
			return json_encode(array("status_code"=>"200", "msg" => "Success!"));
	    
	    return json_encode(array("status_code"=>"500", "msg" => "Sorry, something went wrong. Please try again later. 
	    	Tablename: {$wpdb->wp_social_mage_activity_log}", "error" =>  $wpdb->print_error(), "more_info" => $wpdb->last_query));
		
		

	}
}

if( !function_exists('saveCanvas') ){
	function saveCanvas($img, $_INPUT){
		global $wpdb;

		if( isset($_INPUT['data_action']) && $_INPUT['data_action'] == "save" ){
			if( isset($_INPUT['filename']) ){
				$filename = pathinfo($_INPUT['filename'], PATHINFO_BASENAME);
				
				if( file_exists( WP_SM_UPLOADS_FOLDER_ABS_PATH . $filename) ){
					unlink($file_path);
				}
			}
		}

		$filename = get_current_user_id()."_".time().'.png';
		$file_path = WP_SM_UPLOADS_FOLDER_ABS_PATH . $filename;

		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$fileData = base64_decode($img);
		//saving
		
		$fp = fopen($file_path,'x');
		fwrite($fp, $fileData);
		fclose($fp); 

		if( file_exists($file_path) ){
			return json_encode( array( 'status' => 'success', 'user_id' => get_current_user_id(), 'filename' => $filename ) );
		}
		
		$php_errormsg = error_get_last();

		return json_encode( array( 
			'status' => 'failed', 'user_id' => get_current_user_id(), 'filename' => $filename,
			"msg" => "Sorry, we can't process your request right now. Please make sure to disable open_basedir in your php configuration file.",
			"error" => $php_errormsg
		) );
		
	}
}


// let's renew the user's access token every time the user logs in.
if( !function_exists('update_user_access_token') ){
	function update_user_access_token($longlive_token){
		global $wpdb;
		global $CURRENT_SETTINGS;

		$vals = array(
			'fb_auth_token' => $longlive_token
		);

		if( !empty($CURRENT_SETTINGS[0]) ){
			$res = $wpdb->update($wpdb->wp_social_mage_settings, $vals, array('wp_user_id' => $CURRENT_SETTINGS[0]['wp_user_id']));
		}

		if( $res )
			return json_encode( array("status_code"=>"200", "msg" => "Success!") );
		return json_encode( 
	    	array(
	    		"status_code"=>"500", 
	    		"msg" => "Sorry, something went wrong. Please try again later.", 
	    		"error" =>  $wpdb->print_error(), 
	    		"more_info" => $wpdb->last_query
	    	) 
	    );
	}
	
}


if( !function_exists('generateLongLiveFBToken') ){
	function generateLongLiveFBToken($_INPUT){
		$shortLiveToken = $_INPUT['fb_shortlive_auth_token'];

		$app_id = isset($_INPUT['fb_app_id']) ? $_INPUT['fb_app_id'] : WP_SM_FB_APP_ID;
		$app_secret = isset($_INPUT['fb_app_secret']) ? $_INPUT['fb_app_secret'] : WP_SM_FB_APP_SECRET;

		$url = "https://graph.facebook.com/oauth/access_token?client_id=$app_id&client_secret=$app_secret&grant_type=fb_exchange_token&fb_exchange_token=".$shortLiveToken;
		$data = json_decode(getPageData($url));


		if( $data->access_token !== null && $data->access_token != "" ){
			updateSettings(array("fb_auth_token" => $data->access_token));
			return json_encode( 
				array( 
					'status' => '200', 
					"longLiveAccessToken" => $data->access_token, 
					"expiresIn" => null, 
					"shortLiveAccessToken" => $shortLiveToken
				)
			);

		}

		return json_encode( array('status' => '500', 'data' => $data, 'longLiveAccessToken' => null, 'expiresIn' => null, 'msg' => 'Sorry, we can\'t generate a longlive access token right now. Please make sure your App ID and App Secret are correct.') );

	}
}


// get the longlive access token 
if( !function_exists('getLongLiveFBToken') ){
	function getLongLiveFBToken($_INPUT){
		return generateLongLiveFBToken($_INPUT);
	}
}

if( !function_exists('searchImages') ){
	function searchImages($q){
		$q = str_replace('.', " ", str_replace("'", " ", $q) );
		$data = getPageData('https://pixabay.com/api/?username='.WP_SM_PIXABAY_USERNAME.'&key='.WP_SM_PIXABAY_KEY.'&q='.urlencode($q).'&per_page=200');
		return str_replace('https://', "http://", $data);
	}
}


if( !function_exists('deleteImage') ){
	function deleteImage($filename){
		if( unlink(WP_SM_UPLOADS_FOLDER_ABS_PATH . $filename) ){
			return json_encode( array("status" => "success") );
		}
		return json_encode( array("status" => "failed", "msg" => "Sorry, we can't process your request right now. Please make sure to disable open_basedir in your php configuration file.") );
	}
}

if( !function_exists('grabImage') ){
	function grabImage($url,$saveto){
	    $ch = curl_init ($url);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
	    $raw=curl_exec($ch);
	    curl_close ($ch);
	    if(file_exists($saveto)){
	        unlink($saveto);
	    }
	    $fp = fopen($saveto,'x');
	    fwrite($fp, $raw);
	    fclose($fp);
	}
}

if( !function_exists('grabImageFromUrl') ){
	function grabImageFromUrl($src){
		$php_errormsg = error_get_last();
		
		if( !is_connected() ){
			return json_encode( array(
				"status" => "failed", 
				"msg" => "Please make sure you are connected to the internet.",
				"error" => $php_errormsg
			) );
		}

	  	// let's get the image original extension
	  	$ext = pathinfo($src, PATHINFO_EXTENSION);

		$filename = trim( get_current_user_id()."_".time().'.'.$ext );

		grabImage($src, WP_SM_UPLOADS_FOLDER_ABS_PATH . $filename);

		if( file_exists( WP_SM_UPLOADS_FOLDER_ABS_PATH . $filename ) ){
			return json_encode( array("status" => "success", "filename" => $filename, "error" => $php_errormsg) );
		}

		return json_encode( array(
			"status" => "failed", 
			"msg" => "Sorry, we can't process your request right now. Please make sure to disable open_basedir in your php configuration file.",
			"error" => $php_errormsg,
			"target" => WP_SM_UPLOADS_FOLDER_ABS_PATH . $filename,
			"image" => $image_data
			)
		);
		
		
	}
}

if( !function_exists('setTimezone') ){
	function setTimezone($timezone){
		if( file_put_contents(WP_SM_CLASSES_FOLDER."timezone.dx", $timezone) ){
			return json_encode( array("status" => "success") );
		}

		return json_encode( array("status" => "failed", "msg" => "Sorry, we can't process your request right now. Please try again later.") );
	}
}

if( !function_exists('updateSettings') ){
	function updateSettings($_INPUT){
		global $wpdb;
		global $CURRENT_SETTINGS;
		$wpdb->show_errors();

		$vals = array(
			'wp_user_id' => get_current_user_id(),
			'user_domain' => get_site_url()
		);

		if( isset($_INPUT['timezone']) )
			$vals['timezone'] = $_INPUT['timezone'];
		
		
		if( isset($_INPUT['fb_app_id']) )
			$vals['fb_app_id'] = $_INPUT['fb_app_id'];

		if( isset($_INPUT['fb_app_secret']) )
			$vals['fb_app_secret'] = $_INPUT['fb_app_secret'];
		

		if( isset($_INPUT['fb_user_id']) )
			$vals['fb_user_id'] = $_INPUT['fb_user_id'];
		

		if( isset($_INPUT['fb_auth_token']) )
			$vals['fb_auth_token'] = $_INPUT['fb_auth_token'];
		

		if( !empty($CURRENT_SETTINGS[0]) ){
			$res = $wpdb->update($wpdb->wp_social_mage_settings, $vals, array('wp_user_id' => $CURRENT_SETTINGS[0]['wp_user_id']));
		}else{
			$res = $wpdb->insert($wpdb->wp_social_mage_settings, $vals);
		}

		if( $res )
			return json_encode( array("status_code"=>"200", "msg" => "Success!") );
		
	    return json_encode( 
	    	array(
	    		"status_code"=>"500", 
	    		"msg" => "Sorry, something went wrong. Please try again later.", 
	    		"error" =>  $wpdb->print_error(), 
	    		"more_info" => $wpdb->last_query
	    	) 
	    );
		
	}
}

function get_upgrade_link($type){
	$data = json_decode(getPageData('http://topdogimsoftware.com/spyvideos/urls.php?prod=wp_social_mage&type='.$type));
	return isset($data[0]) ? $data[0]->url : '#';

}

function csna_manual_decrypt($str, $key, $pltype = 'standard'){
	$key = $key.$pltype;

	$data = base64_decode($str);
	$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));
	$response = rtrim(
		@mcrypt_decrypt(
			MCRYPT_RIJNDAEL_128,
			hash('sha256', $key, true),
			substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),
			MCRYPT_MODE_CBC,
			$iv
		),
		"\0"
	);

	$exp = explode(' ', $response);
	return count($exp) >= 2 ? array('email' => $exp[0], 'key' => $exp[1]) : array('email' => 'invalid', 'key' => 'invalid');
}

function getUserAccess($pl_type = 'standard_wl'){
	$path = WP_SM_ABS_PATH.'classes/sec/';
	require_once($path.'lic.php');

	$pl_types = explode(',', $pl_type);

	$success_limit = count($pl_types);
	$current_success = 0;
	$current_pl_type = $pl_types[0];

	foreach ($pl_types as $key => $value) {
		$lic = new CSNA_lic(array(
			'prefix' => 'wp_social_mage_wl_', 
			'pl_type' => $value, //standard, pro, standard_wl, pro_wl
			'url'  => 'http://topdogimsoftware.com/socialmage/index.php?', 
		));

		if( $value == 'pro' ){
			$key = get_option('01_sc_mg_pro_key_01');
			$lkey = get_option('01_sc_mg_pro_lkey_01');
		}else if( $value == "standard_wl" ){
			$key = get_option($lic->prefix."key");
			$lkey = get_option($lic->prefix."lkey");
		}

		$res =  csna_manual_decrypt($lkey, $key, $value);
		
		$email = $res['email'];
		$lic_key = $res['key'];

		if( !empty($email) && !empty($lic_key) && ($email != "invalid" || $lic_key != "invalid") ) {
			if($lic->validate($email, $lic_key)){
				$current_success++;
				$current_pl_type = $value;
			}
				
		}
	}

	if( $current_success > 0 )
		return json_encode( array("type" => $current_pl_type, 'status' => 'valid') );

	return json_encode( array('status' => 'invalid', 'type' => 'invalid') );
}

if( !function_exists('wp_smage_get_plugin_info') ){
	function wp_smage_get_plugin_info($specific_index = null){
		$info = @get_plugin_data( WP_SM_ABS_PATH."index.php", $markup = true, $translate = true );
		if( $specific_index == "" || $specific_index == null){
			return $info;
		}else if( isset($info[$specific_index]) ){
			return $info[$specific_index];
		}else{
			return "[Index not found.]";
		}
	}
}


?>
<style type="text/css">
	#wm span img {
	    opacity: 0.5;
	}
	#wm {
	    float: right;
	    padding: 15px;
	    font-size: small;
	    color: #666;
	    background-color: rgba(0, 160, 210, 0.15);
	    text-shadow: 0px -1px 0px rgba(0,0,0,.5);
	}
</style>

<?php 
	// Note: this file requires config.php and functions.php 

	$email = "n/a";
	$path = WP_SM_CLASSES_FOLDER."sec/";

	
	$key = get_option('wp_social_mage_key');
	$lkey = get_option('wp_social_mage_lkey');

	$res =  csna_manual_decrypt($lkey, $key, 'standard');

	$email = isset($res['email']) && ($res['email'] != "invalid") ? $res['email'] : 'n/a';

	$txt = "This plugin is licensed to ".$email;
	$domain = "http://api.img4me.com/?text=".urlencode($txt)."&font=%22Raleway%22,%20%22Helvetica%20Neue%22,%20Helvetica,%20Arial,%20sans-serif&fcolor=666666&size=10&bcolor=D9F1F8&type=png";

	$wm = getPageData($domain);
?>
<script type="text/javascript">
	// we'll use native javascript in prepending to body
	document.body.insertAdjacentHTML('afterbegin', 
		'<div id="wm"><span><img src="<?php echo $wm; ?>"></span></div>');
</script>

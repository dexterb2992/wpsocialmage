<?php 
	include "classes/config.php";
	include "classes/functions.php";
?>

<script type="text/javascript">
	var imagesUrl = "<?php echo plugins_url( '/images/', __FILE__ ); ?>";
	var uploadsUrl = "<?php echo WP_SM_UPLOADS_FOLDER; ?>";
	var channelUrl = "<?php echo plugins_url( '/js/fb/channel.php', __FILE__ ); ?>";
	var $image_width = 500, $image_height = 500, $w = 500, $h = 500;
	window.fbAppId = "<?php echo WP_SM_FB_APP_ID; ?>";
	window.fbLimit = 100;
	window.fbHost = "https://graph.facebook.com/";
	window.whiteLabelUrl = 'http://topdogimsoftware.com/whitelabel-platform/';
	var currentTimezone = '<?php echo WP_SM_CURRENT_TIMEZONE; ?>';
	window.$imageFilename = "<?php echo isset($_GET['image']) ? $_GET['image'] : ''; ?>";
	var currentUser = "<?php echo get_current_user_id(); ?>";
</script>


<link href='http://fonts.googleapis.com/css?family=Nosifer|Permanent+Marker|Fredericka+the+Great|PT+Sans|Cabin+Sketch|Limelight|Lobster|Waiting+for+the+Sunrise|Shojumaru|Reenie+Beanie|Londrina+Outline|Shadows+Into+Light|Passero+One|Frijole|Fontdiner+Swanky|UnifrakturCook:700|Metal+Mania|Great+Vibes|Ceviche+One|Nova+Square|Uncial+Antiqua|Rye|Special+Elite|Satisfy|Freckle+Face|Pirata+One|Dancing+Script|Open+Sans+Condensed:300|Kranky|Piedra|Indie+Flower|Luckiest+Guy|Joti+One|Orbitron|Bangers|Rock+Salt|Trykker|Slabo+27px|MedievalSharp|Cinzel' rel='stylesheet' type='text/css'>

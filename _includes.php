<?php 
	include "classes/config.php";
	include "classes/functions.php";
?>

<script type="text/javascript">
	var wpSocialMageAjaxUrl = "<?php echo plugins_url( '/js/ajax.php', __FILE__ ); ?>";
	var wpSocialMageUploadUrl = "<?php echo plugins_url( '/js/upload.php', __FILE__ ); ?>";
	var imagesUrl = "<?php echo plugins_url( '/images/', __FILE__ ); ?>";
	var uploadsUrl = "<?php echo plugins_url( '/uploads/', __FILE__ ); ?>";
	var channelUrl = "<?php echo plugins_url( '/js/fb/channel.php', __FILE__ ); ?>";
	var $image_width = 500, $image_height = 500, $w = 500, $h = 500;
	var fbAppId = "<?php echo WP_SM_FB_APP_ID; ?>";
	var currentTimezone = '<?php echo WP_SM_CURRENT_TIMEZONE; ?>';
</script>


<link href='http://fonts.googleapis.com/css?family=Nosifer|Permanent+Marker|Fredericka+the+Great|PT+Sans|Cabin+Sketch|Limelight|Lobster|Waiting+for+the+Sunrise|Shojumaru|Reenie+Beanie|Londrina+Outline|Shadows+Into+Light|Passero+One|Frijole|Fontdiner+Swanky|UnifrakturCook:700|Metal+Mania|Great+Vibes|Ceviche+One|Nova+Square|Uncial+Antiqua|Rye|Special+Elite|Satisfy|Freckle+Face|Pirata+One|Dancing+Script|Open+Sans+Condensed:300|Kranky|Piedra|Indie+Flower|Luckiest+Guy|Joti+One|Orbitron|Bangers|Rock+Salt|Trykker|Slabo+27px|MedievalSharp|Cinzel' rel='stylesheet' type='text/css'>

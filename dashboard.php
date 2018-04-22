<!-- START Dashboard -->
<?php 
	include "_includes.php";
	$path = WP_SM_CLASSES_FOLDER.'sec/';

	require_once($path.'lic.php');

	$lic = new CSNA_lic(array(
		'prefix' => 'wp_social_mage_', 
		'pl_type' => 'standard', //standard, pro, standard_wl, pro_wl
		'url'  => WP_SM_LICENSE_HOST, 
	));

	if($_POST && !empty($_POST['set_lic_key'])) {
		if(!empty($_POST['email']) && !empty($_POST['lic_key'])) {
			if($lic->validate($_POST['email'],$_POST['lic_key'])) {
				$lic->setLic();
				//Below is a way to redirect the page to plugin's admin URL.
				echo '<script>window.location.href="'. admin_url( 'admin.php?page=wp-social-mage-dashboard' ) .'";</script>';
				exit;
			}
		}
		else {
			$lic->setMessage( 'Please fill in the required fields.' );
		}
	}

	if(!$lic->check()) {
		$lic->renderDefaultCss();
		$lic->renderExpirationBox();
	?>
	<div class="wp-social-mage-wrapper">
		<div class="mui-container">
			<?php include "templates/_header.php"; ?>
			<?php $lic->renderForm(); ?>
		</div>
	</div>
		
	<?php	
	}else { 

		if( WP_SM_FB_APP_ID != "" && isset( $_GET['action'] ) && $_GET['action'] == "add_filters" ){
			include "templates/_header.php";
			include "templates/image-filters.php";

		}else if( isset( $_GET['action'] ) && $_GET['action'] == "get-support" ){
			?>
			<div class="wp-social-mage-wrapper">
				<div class="mui-container">
					<?php include "templates/_header.php"; ?>

					<iframe height="100%" width="100%" style="height: 1172px !important;" class="video" src="http://cjsuccessteam.net/support/index.php?a=add"></iframe>
					
					<div class="mui-clearfix"></div>
				</div>
			</div>
			<?php
		}else if( isset( $_GET['action'] ) && $_GET['action'] == "get-training" ){
			include "templates/_tutorials.php";
		}else if( isset( $_GET['action'] ) && $_GET['action'] == "settings" ){
			include "templates/_settings.php";
		}else if( WP_SM_FB_APP_ID != "" ){
?>

		<div class="wp-social-mage-wrapper">
			<div class="mui-container">
				<?php 
				include "templates/_header.php"; 

					if( !isset($_GET['image']) ){
						include 'templates/empty-landing.php';
					}else{
						include "templates/builder.php";
					}

				include "templates/_quotes.php";
				?>
				
				<div class="mui-clearfix"></div>
			</div>
		</div>

<?php 
		}else{
			include "templates/_settings.php";
		}
	}
	include WP_SM_CLASSES_FOLDER."sec/e_w_m_.php";

?>

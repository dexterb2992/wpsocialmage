<div class="wp-social-mage-wrapper">
	<div class="mui-container">
		<style type="text/css">
			#connect_to_facebook{ display: none !important; }
		</style>
		<?php 
			include "_header.php"; 
		?>

		<div class="mui-row">
			<div class="mui-col-md-6">
				<div class="mui-text-subhead mui-text-accent mui-pull-left mui-text-left mui-align-top">
					
				</div>
			</div>
		</div>

		<div class="mui-row">
			<div class="mui-col-md-4">
				<div class="mui-text-subhead mui-text-black mui-pull-left mui-text-left mui-align-top">
					Your current timezone: 
				</div>
				<div class="mui-text-title mui-text-black mui-text-right mui-align-top" id="WP_SM_CURRENT_TIMEZONE"> 
					<?php 
						echo isset($CURRENT_SETTINGS[0]['timezone']) && $CURRENT_SETTINGS[0]['timezone'] != "" ? $CURRENT_SETTINGS[0]['timezone'] : '[Not set]';
					?>
				</div>
			</div>
			<div class="mui-col-md-5"></div>
		</div>
		<div class="mui-row" style="margin-top:20px;">
			<div class="mui-col-md-4">
				<div class="mui-form-group">
					<label>Set your timezone</label>
					<select class="mui-form-control select2" id="timezone_setting">
						<?php 
							$timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
							foreach ( $timezones as $key => $value) {
								echo '<option value="'.$value.'">'.$value.'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="mui-col-md-5"></div>		
		</div>
		<div class="mui-row">
			<div class="mui-col-md-4">
				<iframe id="remember" name="remember" src="about:blank" style="display:none;"></iframe>
				<form id="form_settings" method="post" action="" target="remember">
					<div class="mui-form-group">
						<label>Facebook App ID</label>
						<input type="text" name="fb_app_id" class="mui-form-group number-light" title="Enter your Facebook App ID" value="<?php echo WP_SM_FB_APP_ID;?>">
					</div>		
					<div class="mui-form-group">
						<label>Facebook App Secret</label>
						<input class="mui-form-group" type="text" name="fb_app_secret" value="<?php echo WP_SM_FB_APP_SECRET;?>"/>
					</div>
					<div class="mui-form-group">
						<button class="mui-btn-primary mui-btn" id="wp_sm_save_settings">Save & Connect to Facebook</button>
					</div>
				</form>
			</div>
			<div class="mui-col-md-4"></div>
		</div>
		<?php include "_quotes.php"; ?>
		<div class="mui-clearfix"></div>
	</div>
</div>
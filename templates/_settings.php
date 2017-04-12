<div class="box-header">
	<p class="lead">Settings </p>
</div>
<div class="box-body">
	<div class="box-content">
		<style type="text/css">
			#connect_to_facebook{ display: none !important; }
		</style>
		<?php 
			include "_header.php"; 
		?>

		<div class="row">
			<div class="col-md-6">
				<div class="text-subhead text-accent pull-left text-left align-top">
					
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="text-subhead text-black pull-left text-left align-top">
					Your current timezone: 
				</div>
				<div class="text-title text-black text-right align-top" id="WP_SM_CURRENT_TIMEZONE"> 
					<?php 
						echo isset($CURRENT_SETTINGS[0]['timezone']) && $CURRENT_SETTINGS[0]['timezone'] != "" ? $CURRENT_SETTINGS[0]['timezone'] : '[Not set]';
					?>
				</div>
			</div>
			<div class="col-md-5"></div>
		</div>
		<div class="row" style="margin-top:20px;">
			<div class="col-md-4">
				<div class="form-group">
					<label>Set your timezone</label>
					<select class="form-control select2" id="timezone_setting">
						<?php 
							$timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
							foreach ( $timezones as $key => $value) {
								echo '<option value="'.$value.'">'.$value.'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-md-5"></div>		
		</div>
		<div class="row">
			<div class="col-md-4">
				<iframe id="remember" name="remember" src="about:blank" style="display:none;"></iframe>
				<form id="form_settings" method="post" action="" target="remember">
					<div class="form-group">
						<label>Facebook App ID</label>
						<input type="text" name="fb_app_id" class="form-control number-light" data-toggle="tooltip" data-original-title="Enter your Facebook App ID" value="<?php echo WP_SM_FB_APP_ID;?>">
					</div>		
					<div class="form-group">
						<label>Facebook App Secret</label>
						<input class="form-control" type="text" name="fb_app_secret" data-toggle="tooltip" data-original-title="Enter your App Secret" value="<?php echo WP_SM_FB_APP_SECRET;?>"/>
					</div>
					<div class="form-group">
						<button class="btn-primary btn btn-flat" id="save_settings"><i class="fa fa-facebook-official"></i> Save & Connect to Facebook</button>
					</div>
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
		<?php include "_quotes.php"; ?>
		<div class="clearfix"></div>
	</div>
</div>
<!-- <div id="fb-root"></div> -->
<div class="mui-row">
	<div class="updated mui-col-md-10 header">
		<div class="row">
			<div class="mui-col-md-5">
				<div class="mui-text-left">
					<a href="?page=wp-social-mage-dashboard" class="mui-text-display1 mui-text-black no-text-decoration" title="Go to Dashboard">
						<?php echo wp_smage_get_plugin_info('Name'); ?>
					</a>
					<div style="margin-top:16px;">
						<a href="" target="_blank" class="mui-text-caption mui-text-black">
							<?php echo wp_smage_get_plugin_info('PluginURI'); ?>
						</a>	
					</div>
				</div>
			</div>
			<div class="mui-col-md-7 rd-icon-container">
				<div class="rd-icon rd-icon-training <?php echo isset( $_GET['action'] ) && $_GET['action'] == 'get-training' ? 'rd-icon-selected' : ''; ?>">
					<span>
						<a href="?page=wp-social-mage-dashboard&action=get-training">Training</a>
					</span>
				</div>
				<div class="rd-icon rd-icon-support <?php echo isset( $_GET['action'] ) && $_GET['action'] == 'get-support' ? 'rd-icon-selected' : ''; ?>">
					<span>
						<a href="?page=wp-social-mage-dashboard&action=get-support">Support</a>
					</span>
				</div>
				<div class="rd-icon rd-icon-settings <?php echo isset( $_GET['action'] ) && $_GET['action'] == 'settings' ? 'rd-icon-selected' : ''; ?>">
					<span>
						<a href="?page=wp-social-mage-dashboard&action=settings">Settings</a>
					</span>
				</div>
				<div class="rd-icon rd-icon-home <?php echo !isset( $_GET['action'] ) || $_GET['action'] == 'home' ? 'rd-icon-selected' : ''; ?>">
					<span>
						<a href="?page=wp-social-mage-dashboard&action=home">Home</a>
					</span>
				</div>
			</div>
		</div>
		
	</div>
	<div class="mui-col-md-2"></div>	
</div>
<div class="mui-form-group">
	<!-- <img id="connect_to_facebook" src="<?php echo WP_SM_IMAGES_FOLDER.'login-button.png'; ?>"> -->
	<div class="fb-login-button" data-max-rows="1" data-size="icon" data-show-faces="false" data-auto-logout-link="false"></div>
</div>
<div class="mui-form-group"></div>

<div id="pro_upgrade" style="display:none;">
	<div class="row">
		<div class="mui-col-md-12">
			<div class="mui-panel">
				<div class="mui-text-headline">Purchase <span class="mui-text-headline mui-text-accent">PRO Version</span> </div>
				<div class="mui-divider"></div>
				<br/>
				<div class="mui-text-subhead mui-text-primary">You must have the pro version to use this feature.</div>
				<div>
					<a href="<?php echo get_upgrade_link('pro');?>" target="_blank" class="mui-btn mui-btn-accent mui-pull-right">UPGRADE NOW</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="wl_upgrade" style="display:none;">
	<div class="row">
		<div class="mui-col-md-12">
			<div class="mui-panel">
				<div class="mui-text-headline">Purchase <span class="mui-text-headline mui-text-accent">White Label Version</span> </div>
				<div class="mui-divider"></div>
				<br/>
				<div class="mui-text-subhead mui-text-primary">You must purchase a White Label version to use this feature.</div>
				<div>
					<a href="<?php echo get_upgrade_link('pro_wl');?>" id="link_for_upgrade" target="_blank" class="mui-btn mui-btn-accent mui-pull-right">PURCHASE NOW</a>
				</div>
			</div>
		</div>
	</div>
</div>

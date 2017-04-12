<div class="form-group">
	<img id="connect_to_facebook" src="<?php echo WP_SM_IMAGES_FOLDER.'login-button.png'; ?>">
</div>
<div class="form-group"></div>

<div id="pro_upgrade" style="display:none;">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="text-headline">Purchase <span class="text-headline text-accent">PRO Version</span> </div>
				<div class="divider"></div>
				<br/>
				<div class="text-subhead text-primary">You must have the pro version to use this feature.</div>
				<div>
					<a href="<?php echo get_upgrade_link('pro');?>" target="_blank" class="btn btn-accent pull-right">UPGRADE NOW</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="wl_upgrade" style="display:none;">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="text-headline">Purchase <span class="text-headline text-accent">White Label Version</span> </div>
				<div class="divider"></div>
				<br/>
				<div class="text-subhead text-primary">You must purchase a White Label version to use this feature.</div>
				<div>
					<a href="<?php echo get_upgrade_link('pro_wl');?>" id="link_for_upgrade" target="_blank" class="btn btn-accent pull-right">PURCHASE NOW</a>
				</div>
			</div>
		</div>
	</div>
</div>

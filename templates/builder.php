<div class="mui-row">	

	<div class="mui-col-md-5">	
		<div class="mui-row">
			<div class="mui-col-md-12">
				<?php 
					if( isset($_GET['image']) ){

						$img = WP_SM_UPLOADS_FOLDER.$_GET['image'];

						if( !file_exists(WP_SM_UPLOADS_FOLDER_ABS_PATH.$_GET['image']) ){
							die('Image not found.');
						}

						list($width, $height) = getimagesize(WP_SM_UPLOADS_FOLDER_ABS_PATH.$_GET['image']);

						if( $height > 255 ){
							$image_height = 500;
							$image_width = 500;
						}else{
							$image_height = 255;
							$image_width = 487;
						}

						
						if($width > 550){
							echo '<div class="reload-page mui-text-accent mui-text-subhead">Ops, Image hasn\'t loaded successfully. Please reload this page.<br/>
									<small>If problem persist, click "Cancel" and switch between image dimensions (Meme/Clickable)</div>';
						}
						
						$uploaded = true;
						$w = $image_width;
						$width = $image_width;

						$h = $image_height;
						$height = $image_height;

						

						?>
						<script type="text/javascript">
							var $from_php_width = '<?php echo $width; ?>';
							var $from_php_height = '<?php echo $height; ?>';
							var $image_width = '<?php echo $image_width; ?>';
							var $image_height = '<?php echo $image_height; ?>';
							var $raw_image_width = '<?php echo $image_width; ?>';
							var $raw_image_height = '<?php echo $image_height; ?>';
							var $w = '<?php echo $w; ?>';
							var $h = '<?php echo $h; ?>';
						</script>
						<div class="image-holder-outer">
							<div class="image-holder" style="<?php echo 'width:'.$image_width.'px; height:'.$image_height.'px;';?>"> 
								<img id="image_preview"  class="image-preview" data-filename="<?php echo $img; ?>"
									src="<?php echo $img; ?>" data-src="<?php echo $img; ?>">
							</div>
						</div>
						<?php
					}else{
						?>
						<div class="image-holder" style="border:1px black solid;">
							<img id="image_preview" class="image-preview" src="">
						</div>
						<?php
					}
				?>
				<div class="mui-form-group mui-text-center">
					<!-- <label>Background Size</label> -->
					<button type="button" id="image_preview_increase_bg" class="mui-btn mui-btn-primary">Increase</button>
					<button type="button" id="image_preview_decrease_bg" class="mui-btn mui-btn-accent">Decrease</button>
				</div>
			</div>
		</div>
	</div>
	<div class="mui-col-md-2">
		<div class="rd-icon-lg-container">
			<div class="rd-icon-lg rd-icon-save">
				<span>
					<a href="javascript:void(0)" id="update_image" title="Save and proceed" data-action="save">Save Image</a>
				</span>
			</div>
			<div class="rd-icon-lg rd-icon-download">
				<span>
					<a href="javascript:void(0)" id="download_image" title="Download">Download</a>
				</span>
			</div>
			<div class="rd-icon-lg rd-icon-post">
				<span>
					<a href="javascript:void(0)" id="post_to_fb" title="Post to Facebook">Post</a>
				</span>
			</div>
			<div class="rd-icon-lg rd-icon-schedule">
				<span>
					<a href="javascript:void(0)" id="schedule_post">Schedule</a>
				</span>
			</div>
			<div class="rd-icon-lg rd-icon-cancel">
				<span>
					<a href="?page=wp-social-mage-dashboard&q=imagefilters&action=add_filters&image=<?php echo $_GET['image']; ?>">Cancel</a>
				</span>
			</div>
		</div>
	</div>
	<div class="mui-col-md-5">
		<?php include "_sidebar.php"; ?>
	</div>
</div>
		
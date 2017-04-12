<div class="wp-social-mage-wrapper">
	<div class="mui-container">
		<?php include "_header.php"; ?>
		<div class="mui-row">	
			<div class="mui-col-md-5">	
				<div class="mui-row">
					<div class="mui-col-md-12">
						<?php 
							if( isset($_GET['image']) ){
								
								$uploaded = true;
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

								// $image_height = 500;
								// $image_width = 500;

								?>
								<script type="text/javascript">
									var $from_php_width = '<?php echo $width; ?>';
									var $from_php_height = '<?php echo $height; ?>';
									var $image_width = '<?php echo $image_width; ?>';
									var $image_height = '<?php echo $image_height; ?>';
									var $raw_image_width = '<?php echo $image_width; ?>';
									var $raw_image_height = '<?php echo $image_height; ?>';
									var $w = '<?php echo $image_width; ?>';
									var $h = '<?php echo $image_height; ?>';
								</script>
								<div class="image-holder-outer">
									<div class="image-holder" style="<?php echo 'width:500px; height: 500px;';?>"> 
										<img id="image_preview"  class="image-preview" data-filename="<?php echo $_GET['image']; ?>"
											src="<?php echo $img; ?>" data-src="<?php echo $img; ?>">
									</div>
								</div>
								<?php
							}else{
								?>
								<div class="image-holder-outer">
									<div class="image-holder">
										<img id="image_preview" class="image-preview" src="">
									</div>
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
					<div class="mui-row">
						<div class="mui-col-md-4"></div>
						<div class="mui-col-md-4">
							<div class="mui-form-group">
								<select class="mui-form-control mui-select" id="image_size" data-source="sidebar">
									<option value="500x500" data-id="1" title="Meme Size (500 x 500)" selected>Meme</option>
									<option value="487x255" data-id="2" title="Clickable Size (487 x 255)">Clickable</option>
								</select>
								<label class="mui-form-floating-label">Image Size</label>
							</div>
						</div>
						<div class="mui-col-md-4"></div>
					</div>
				</div>
			</div>
			<div class="mui-col-md-2">
				<div class="rd-icon-lg-container">
					<div class="rd-icon-lg rd-icon-effects">
						<span>
							<a href="javascript:void(0);" id="filter_types" data-value="interactive">Effects</a>
						</span>
					</div>
					<div class="rd-icon-lg rd-icon-save">
						<span>
							<a href="javascript:void(0)" id="update_image" title="Save and proceed" data-action="update">Save</a>
						</span>
					</div>
					<div class="rd-icon-lg rd-icon-download">
						<span>
							<a href="javascript:void(0)" id="download_image" title="Download">Download</a>
						</span>
					</div>
					<div class="rd-icon-lg rd-icon-cancel">
						<span>
							<a href="?page=wp-social-mage-dashboard">Cancel</a>
						</span>
					</div>
				</div>
			</div>
			<div class="mui-col-md-5">
				<?php
				 include "_imagefilters_sidebar.php"; 
				?>

			</div>
		</div>
		<?php include "_quotes.php"; ?>
	</div>
</div>

<div class="mui-clearfix"></div>

		
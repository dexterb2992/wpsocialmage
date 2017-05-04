<div class="box-header">
	<p class="lead">Image Filters </p>
</div>
<div class="box-body">
	<div class="box-content">
		<div class="row">	
			<div class="col-md-5">	
				<div class="row">
					<div class="col-md-12">
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
						<div class="form-group text-center">
							<!-- <label>Background Size</label> -->
							<button type="button" id="image_preview_increase_bg" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Increase</button>
							<button type="button" id="image_preview_decrease_bg" class="btn btn-warning btn-flat"><i class="fa fa-minus"></i> Decrease</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3">
							<label class="form-floating-label">Image Size</label>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<select class="form-control select" id="image_size" data-source="sidebar">
									<option value="500x500" data-id="1" title="Meme Size (500 x 500)" selected>Meme (500 x 500)</option>
									<option value="487x255" data-id="2" title="Clickable Size (487 x 255)">Clickable (487 x 255)</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
								<button class="btn-info btn btn-flat" id="btn_update_image"><i class="fa fa-refresh"></i> Update Image</button>
						</div>
					</div>
					<div class="row">
						<div class="com-md-12">
							<small class="pull-right"><b>Note: You can't drag the background if the original image size is 487x255</b></small>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="rd-icon-lg-container">
					<div class="rd-icon-lg rd-icon-effects">
						<span>
							<a href="javascript:void(0);" id="filter_types" data-value="interactive" data-toggle="tooltip" data-original-title="Image effects">Effects</a>
						</span>
					</div>
					<div class="rd-icon-lg rd-icon-save">
						<span>
							<a href="javascript:void(0)" id="update_image" data-toggle="tooltip" data-original-title="Save and proceed" data-action="update">Save</a>
						</span>
					</div>
					<div class="rd-icon-lg rd-icon-download">
						<span>
							<a href="javascript:void(0)" id="download_image" data-toggle="tooltip" data-original-title="Download">Download</a>
						</span>
					</div>
					<div class="rd-icon-lg rd-icon-cancel">
						<span>
							<a href="?page=wp-social-mage-dashboard" data-toggle="tooltip" data-original-title="Cancel & go back to Home">Cancel</a>
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<?php
				 include "_imagefilters_sidebar.php"; 
				?>

			</div>
		</div>
		<?php include "_quotes.php"; ?>
	</div>
</div>

<div class="clearfix"></div>

		
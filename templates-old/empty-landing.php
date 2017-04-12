<?php var_dump(WP_SM_UPLOADS_FOLDER_ABS_PATH); ?>
<div class="mui-row">
	<div class="mui-col-md-7" id="wp_social_mage_results">
		
		<div class="library-images">
			<div class="row">
				<h4>Your uploaded images...</h4>
			</div>
			<div class="rd-gallery">
			<?php 
				// if ( !file_exists(WP_SM_ABS_PATH."uploads/user_".get_current_user_id()) ) {
				//     mkdir(WP_SM_ABS_PATH."uploads/user_".get_current_user_id()."/", 0755, true);
				// }

				$files = glob(WP_SM_UPLOADS_FOLDER_ABS_PATH . '*.{jpg,png}', GLOB_BRACE);

				if( count($files) < 1 ){
					echo '<h4>No image available.</h4>';
				}else{
					foreach($files as $file) {
						$pathinfo = pathinfo($file);
						$filename = $pathinfo['basename'];
						?>
						<div class="rd-gallery-item" data-filename="<?php echo $filename; ?>" title="Right click for more options">
							<img src="<?php echo WP_SM_UPLOADS_FOLDER.$filename; ?>">
							<a href="?page=wp-social-mage-dashboard&action=add_filters&image=<?php echo $filename;?>" data-src="<?php echo WP_SM_UPLOADS_FOLDER.$filename;?>" class="select cmenu">Use this image</a>
						</div>
						<?php
					}
				}
				
			?>
			</div>
		</div>
		
		<div class="mui-row" id="inner_results" style="display:none;">
			<div class="rd-gallery" style="margin-top: 66px;text-align: center;">
				<div class="mui-text-caption mui-text-black">
					<b>We have nothing to show here... <br/> Type any keyword and click "Image Search".</b>
				</div>
			</div>
		</div>
		
	</div>
	<div class="mui-col-md-5">
		<div class="mui-row" style="margin-top: 54px;">
			<div class="mui-col-md-6">
				<input type="text" id="img_search" placeholder="Enter keyword" name="keyword" />
			</div>
			<div class="mui-col-md-6">	
				<div class="rd-icon-search rd-icon-lg mui-pull-right">
					<span>
						<a href="javascript:void(0)" id="btn_img_search">Image Search</a>
					</span>
				</div>
			</div>
			<a href="javascript:void(0)" class="mui-text-body2 mui-text-black mui-pull-right" id="btn_show_results" title="Show search results" style="display:none; margin-right: 14px;">Show search results</a>
		</div>

		<form id="form_upload_image" action="js/upload.php" method="post" enctype="multipart/form-data" class="mui-form-inline" style="margin-bottom: 12px;">
			<input type="hidden" name="q" value="upload_image" />
			<input type="hidden" name="action" value="WpSocialMageAjax" />
			<div class="mui-row">
				<div class="mui-col-md-12" style="margin-bottom: 5px;">
					<input type="file" name="image" id="select_image" class="mui-form-control" accept="image/gif,image/jpeg,image/png">
					<label class="mui-text-body2 mui-text-black" id="image_name"></label><br/>
					<div class="progress mui-invisible">
					    <div class="bar"></div >
					    <div class="percent">0%</div >
					</div>
					<div id="status"></div>
					
				</div>
			</div>
			<div class="mui-row">
				<div class="mui-col-md-12">
					<div class="rd-icon-container mui-pull-left">	
						<a title="Add filters to your selected image" href="?page=wp-social-mage-dashboard&q=imagefilters&action=add_filters" id="btn_add_filter"  style="display:none;">	
							IMAGE FILTERS
						</a>
						<div class="rd-icon-browse rd-icon-lg">
							<span>
								<a href="javascript:void(0)" id="btn_browse" title="Browse images">Browse Images</a>
							</span>
						</div>
						<div class="rd-icon-upload rd-icon-lg" style="display:none;">
							<span>
								<button type="submit" id="btn_upload" class="mui-btn mui-btn-flat" title="Upload">Upload</button>
							</span>
						</div>
						<div class="rd-icon-browse-library rd-icon-lg">
							<span>
								<a href="javascript:void(0)" id="btn_select_library">Select from Library</a>
							</span>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="mui-row top20">
	<div class="mui-col-md-3"><!-- Image Size -->
		<div class="mui-form-group">
			<select class="mui-form-control mui-select" id="image_size" data-source="sidebar">
				<option value="500x500" data-id="1" title="Meme Size (500 x 500)" selected>Meme</option>
				<option value="518x270" data-id="2" title="Clickable Size (487 x 255)">Clickable</option>
			</select>
			<label class="mui-form-floating-label">Image Size</label>
		</div>
	</div>
	<div class="mui-col-md-6">
		<div class="mui-text-title mui-text-accent label-filter-settings">Create Content</div>
	</div>
</div>

<div class="mui-row">

	<form style="margin-left: 15px;" id="wp_social_mage_form" method="post" action="">
		<div class="mui-col-md-6">
			<div class="mui-row">
				<div class="mui-col-md-7">
					<div class="mui-dropdown">
						<div class="mui-form-group">
							<select class="mui-form-control mui-select" id="font_family">
								<?php 
									$font_family = getFonts();

									foreach ($font_family as $key => $value) {
										$val = $value;
										$x = explode(",", $value);
										$y = str_replace("'", "", $x[0]);
										if( isset($_GET['font']) && $_GET['font'] == $value ){
											echo '<option value="'.$val.'" style="font-family:'.$val.';" selected>'.$y.'</option>';
										}else{
											echo '<option  value="'.$val.'" style="font-family:'.$val.';">'.$y.'</option>';
										}
									}
								?>
							</select>
							<label class="mui-form-floating-label">Font</label>
						</div>
					</div>
				</div>
				<div class="mui-col-md-5">
					<div class="mui-form-group">
			    		<input type="text" id="font_color" class="mui-form-control mui-not-empty" value="#fff" readonly />
			    		<label class="mui-form-floating-label">Font Color</label>
			    	</div>
				</div>
			</div>

			<div class="mui-form-group">
				<label>Font Size</label>
			</div>
			<div class="mui-row">
				<div class="mui-col-md-6">
					<button id="image_preview_increase_font" class="mui-btn mui-btn-primary" data-mui-size="small" type="button">Increase</button>
				</div>
				<div class="mui-col-md-6">
					<button id="image_preview_decrease_font" class="mui-btn mui-btn-accent" data-mui-size="small" type="button">Decrease</button>
				</div>
			</div>

			<div class="mui-row">
				<div class="mui-col-md-6">
					<div class="mui-form-group">
						<select class="mui-form-control select2 mui-select min-62" id="stroke_size">
							<?php 
								for($x = 1; $x <= 8; $x++){
									if( ( isset($_GET['stroke_size']) && $_GET['stroke_size'] == $x ) || $x == 2){
										echo '<option selected>'.$x.'</option>';
									}else{
										echo '<option>'.$x.'</option>';
									}
								}
							?>
						</select>
						<label class="mui-form-floating-label">Stroke Size</label>
					</div>
				</div>	
				<div class="mui-col-md-6">
					<div class="mui-form-group">
			    		<input type="text" id="text_shadow" class="mui-form-control mui-not-empty" value="#000000" readonly />
			    		<label class="mui-form-floating-label">Stroke Color</label>
			    	</div>
				</div>
			</div>

			<div class="mui-form-group">
				<textarea id="text_over_image" class="mui-form-control" title='Tip: use "Enter" to control word breaks, and "Space" to control spaces.'></textarea>
				<label class="mui-form-floating-label">Top Text</label>
			</div>
			<div class="mui-form-group">
				<textarea class="mui-form-control" name="bottom_text" id="bottom_text" title='Tip: use "Enter" to control word breaks, and "Space" to control spaces.'></textarea>
				<label class="mui-form-floating-label">Bottom Text</label>
			</div>
			<div class="mui-form-group">
				<textarea class="mui-form-control" title="Add your custom water mark (example: wwww.mywebsite.com)" id="bottom_watermark"></textarea>
				<label class="mui-form-floating-label">Watermark</label>
			</div>
		</div>

		<div class="mui-col-md-6">
			<div class="mui-form-group">
				<input type="url" class="mui-form-control" name="url" id="target_url" required>
				<label class="mui-form-floating-label">Target URL</label>
			</div>
			<div class="mui-form-group hidden">
				<!-- <input type="text" class="mui-form-control" name="message" id="post_message"> -->
				<textarea class="mui-form-control" name="message" id="post_message"></textarea>
				<label class="mui-form-floating-label">What's on your mind?</label>
			</div>
			<div class="mui-form-group">
				<!-- <input type="text" class="mui-form-control" name="title" id="post_title" required> -->
				<textarea class="mui-form-control" name="title" id="post_title"></textarea>
				<label class="mui-form-floating-label">What's on your mind?</label>
			</div>
			<div class="mui-form-group hidden">
				<textarea class="mui-form-control" name="description" id="post_description" required></textarea>
				<label class="mui-form-floating-label">Description</label>
			</div>
			
			
			<div class="mui-radio">
				<label>
					<input type="radio" name="optionsAlbum" title="Where should we upload this photo?" id="options_album_create" value="create" checked>
					Create new album
				</label>
			</div>
			<div class="mui-radio">
				<label>
					<input type="radio" name="optionsAlbum" title="Where should we upload this photo?" id="options_album_choose" value="choose">
					Choose existing album
				</label>
			</div>

			<div class="mui-form-group" id="div_create_new_album">
				<input type="text" class="mui-form-control" id="album_name" name="album_name" />
				<label class="mui-form-floating-label">Album Name</label>
			</div>
			<div class="mui-form-group mui-invisible" style="display:none;" id="div_choose_existing_album" name="album"> 
				<select class="mui-form-control mui-select mui-not-empty select2" id="album" name="select_album" title="Select an album where do you want to upload"></select>
				<label class="mui-form-floating-label">Select Album</label>
			</div>

			<div class="mui-form-group">
				<select class="mui-form-control mui-select mui-not-empty js-example-basic-multiple select2" name="where_to_post" id="where_to_post" multiple="multiple" title="Ctrl + Click to select multiple items">
					<option value="me">My Wall</option>
				</select>
				<label class="mui-form-floating-label" title="Select where do you want us to post this status">Post to</label>
			</div>
			
			<div class="mui-form-group mui-invisible">
				<input type="text" class="date-picker mui-form-control mui-not-empty" id="schedule" name="schedule" title="Schedule Date for Posting" placeholder="dd/mm/yyyy hh:mm" readonly="readonly">
				<label class="mui-form-floating-label">Date and Time</label>
			</div>
			<input type="hidden" name="image" value="<?php echo $_GET['image'];?>">
			<input type="hidden" name="q" value="save_schedule">
			<input type="hidden" name="_fbtoken" id="_fbtoken" value="">
		</div>
	</form>
</div>
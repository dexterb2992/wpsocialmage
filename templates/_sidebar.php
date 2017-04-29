<div class="row top20">
	<div class="col-md-6"><!-- Image Size -->
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="form-floating-label">Image Size</label>
					<select class="form-control select" id="image_size" data-source="sidebar">
						<option value="500x500" data-id="1" title="Meme Size (500 x 500)" selected>Meme (500 x 500)</option>
						<option value="518x270" data-id="2" title="Clickable Size (487 x 255)">Clickable (487 x 255)</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="text-title text-accent label-filter-settings lead">Create Content</div>
	</div>
</div>

<div class="row">

	<form id="wp_social_mage_form" method="post" action="">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="form-floating-label">Font</label>
						<select class="form-control select" id="font_family">
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
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="form-floating-label">Font Color</label>
			    		<input type="text" id="font_color" class="form-control not-empty" value="#fff" readonly />
			    	</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Font Size</label>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-5">
					<button id="image_preview_increase_font" class="btn btn-sm btn-flat btn-primary" data-size="small" type="button">Increase </button>
				</div>
				<div class="col-md-5">
					 <button id="image_preview_decrease_font" class="btn btn-sm btn-flat btn-warning" data-size="small" type="button"> Decrease</button>
				</div>
				<div class="col-md-2"></div>
			</div>
			<br/>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="form-floating-label">StrokeSize</label>

						<select class="form-control select2 select min-62" id="stroke_size">
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
					</div>
				</div>	
				<div class="col-md-6">
					<div class="form-group">
			    		<label class="form-floating-label">StrokeColor</label>
			    		<input type="text" id="text_shadow" class="form-control not-empty" value="#000000" readonly />
			    	</div>
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="form-floating-label">Top Text</label>
						<textarea id="text_over_image" class="form-control" data-toggle="tooltip" data-original-title='Tip: use "Enter" to control word breaks, and "Drag" text to position anywhere.'></textarea>
						
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="form-floating-label">Bottom Text</label>

						<textarea class="form-control" name="bottom_text" id="bottom_text" data-toggle="tooltip" data-original-title='Tip: use "Enter" to control word breaks, and  "Drag" text to position anywhere'></textarea>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="form-floating-label">Watermark</label>

						<textarea class="form-control" data-toggle="tooltip" data-original-title="Add your custom water mark (example: wwww.mywebsite.com)" id="bottom_watermark"></textarea>
					</div>
				</div>	
			</div>
			
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="form-floating-label">Target URL</label>

				<input type="url" class="form-control" name="url" id="target_url" required>
			</div>
			<!-- <div class="form-group">
				<label class="form-floating-label">What's on your mind?</label>
				<textarea class="form-control" name="message" id="post_message"></textarea>
			</div> -->
			<div class="form-group">
				<label class="form-floating-label">What's on your mind?</label>
				<textarea class="form-control" name="title" id="post_title"></textarea>
			</div>
			<div class="form-group hidden">
				<label class="form-floating-label">Description</label>

				<textarea class="form-control" name="description" id="post_description" required></textarea>
			</div>
			
			
			<!-- <div class="form-group">
				<input type="radio" name="optionsAlbum" title="Where should we upload this photo?" id="options_album_create" value="create" checked>
				<label for="options_album_create">
					Create new album
				</label>
			</div>
			<div class="form-group">
				<input type="radio" name="optionsAlbum" title="Where should we upload this photo?" id="options_album_choose" value="choose">
				<label for="options_album_choose">
					Existing album
				</label>
			</div>
			<div class="form-group">
				<input type="radio" name="optionsAlbum" title="Where should we upload this photo?" id="options_album_none" value="none" />
				<label for="options_album_none">
					Post directly
				</label>
			</div> -->

			<!-- <div class="form-group" id="div_create_new_album">
				<label class="form-floating-label">Album Name</label>

				<input type="text" class="form-control" id="album_name" name="album_name" />
			</div> -->
			<!-- <div class="form-group invisible" style="display:none;" id="div_choose_existing_album" name="album"> 
				<label class="form-floating-label">Select Album</label>

				<select class="form-control select not-empty select2" id="album" name="select_album" title="Select an album where do you want to upload"></select>
			</div> -->

			<div class="form-group">
				<label class="form-floating-label" data-toggle="tooltip" data-original-title="Select where do you want us to post this status">Post to</label>

				<select class="form-control select not-empty js-example-basic-multiple select2" name="where_to_post" id="where_to_post" multiple="multiple" title="Ctrl + Click to select multiple items">
					<option value="me">My Wall</option>
				</select>
			</div>
			
			<div class="form-group invisible">
				<label class="form-floating-label">Date and Time</label>

				<input type="text" class="date-picker form-control not-empty" id="schedule" name="schedule" title="Schedule Date for Posting" placeholder="dd/mm/yyyy hh:mm" readonly="readonly">
			</div>
			<input type="hidden" name="image" value="<?php echo $_GET['image'];?>">
			<input type="hidden" name="q" value="save_schedule">
			<input type="hidden" name="_fbtoken" id="_fbtoken" value="">
		</div>
	</form>
</div>
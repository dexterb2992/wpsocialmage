<div class="wp-social-mage-wrapper">
	<div class="mui-container">
		<?php 
			include "_header.php"; 

			$data = @json_decode(getPageData("http://topdogimsoftware.com/spyvideos/tuts.php?type=standard&plugin=wpsocialmage"));

			foreach ($data as $key) {
			?>
				<div class="mui-row mui-divider-bottom tutorials">
					<div class="mui-col-md-7">
						<?php 
							@preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $key->link, $matches);
							
						?>
						<iframe class="video" width="640" height="390" src="http://youtube.com/embed/<?php echo $matches[0]; ?>">
						</iframe>
					</div>
					<div class="mui-col-md-4">
						<div class="mui-text-headline mui-text-black mui-pull-right tutorial-title"><?php echo $key->title;?></div>
						<div class="mui-text-title mui-text-black mui-pull-right mui-text-right mui-align-top">
							<?php echo $key->content; ?>
						</div>
					</div>
					<div class="mui-col-md-1"></div>		
				</div>
				<?php
			}

			include "_quotes.php";
		?>
		<div class="mui-clearfix"></div>
	</div>
</div>
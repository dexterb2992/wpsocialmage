<div class="box-header">
	<p class="lead">Tutorials </p>
</div>
<div class="box-body">
	<div class="box-content">
		<?php 
			include "_header.php"; 

			$data = @json_decode(@file_get_contents("http://topdogimsoftware.com/spyvideos/tuts.php?type=standard&plugin=wpsocialmage"));

			foreach ($data as $key) {
			?>
				<div class="row divider-bottom tutorials">
					<div class="col-md-7">
						<?php 
							@preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $key->link, $matches);
							
						?>
						<iframe class="video" width="640" height="390" src="http://youtube.com/embed/<?php echo $matches[0]; ?>">
						</iframe>
					</div>
					<div class="col-md-4">
						<div class="lead text-black pull-right tutorial-title"><?php echo $key->title;?></div>
						<div class="text-title text-black pull-right text-right align-top">
							<?php echo $key->content; ?>
						</div>
					</div>
					<div class="col-md-1"></div>		
				</div>
				<?php
			}

			include "_quotes.php";
		?>
		<div class="clearfix"></div>
	</div>
</div>

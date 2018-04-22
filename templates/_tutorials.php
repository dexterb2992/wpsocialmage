<div class="box-header">
	<p class="lead">Tutorials </p>
</div>
<div class="box-body">
	<div class="box-content">
		<?php 
			include "_header.php"; 

			// $data = @json_decode(@file_get_contents("http://topdogimsoftware.com/spyvideos/tuts.php?type=standard&plugin=wpsocialmage"));

			// foreach ($data as $key):
			?>
				<!-- <div class="row divider-bottom tutorials"> -->
					<!-- <div class="col-md-7"> -->
						<?php 
							// @preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $key->link, $matches);
							
						?>
						<!-- <iframe class="video" width="640" height="390" src="http://youtube.com/embed/<?php //echo $matches[0]; ?>">
						</iframe> -->
						

					<!-- </div> -->
					<!-- <div class="col-md-4">
						<div class="lead text-black pull-right tutorial-title"><?php //echo $key->title;?></div>
						<div class="text-title text-black pull-right text-right align-top">
							<?php //echo $key->content; ?>
						</div>
					</div>
					<div class="col-md-1"></div>		
				</div> -->

				<div class="row divider-bottom tutorials">
					<div class="col-md-7">
						<img class="img-responsive" src="<?php echo WP_SM_IMAGES_FOLDER.'tuts/step1.jpg'; ?>">
						<img class="img-responsive" src="<?php echo WP_SM_IMAGES_FOLDER.'tuts/step1p2.jpg'; ?>">
					</div>
					<div class="col-md-4">
						<div class="lead text-black pull-right tutorial-title">
							Step 1: Login to Facebook Developers and Create your Facebook App
						</div>
						<div class="text-title text-black pull-right text-right align-top">
							First, you need to login to <a href="https://developers.facebook.com" target="_blank">Facebook Developers</a>, then after you are logged in, create your new Facebook App <a href="https://developers.facebook.com/apps/" target="_blank">here</a>
						</div>
					</div>
					<div class="col-md-1"></div>		
				</div>

				<div class="row divider-bottom tutorials">
					<div class="col-md-4">
						<div class="lead text-black pull-right tutorial-title">
							Step 2: Add Facebook Login product to your Facebook App
						</div>
						<div class="text-title text-black pull-right text-right align-top">
							After you created your app, you will then be redirected on your app's page where you can see on the screenshot. You just have to click on Setup under the <strong>Facebook Login</strong> product. You will then be asked to choose the platform for your app, then you'll have to select <strong>www</strong>.
						</div>
					</div>
					<div class="col-md-7">
						<img class="img-responsive" src="<?php echo WP_SM_IMAGES_FOLDER.'tuts/step2.jpg'; ?>">
						<img class="img-responsive" src="<?php echo WP_SM_IMAGES_FOLDER.'tuts/step2p2.jpg'; ?>">
						<img class="img-responsive" src="<?php echo WP_SM_IMAGES_FOLDER.'tuts/step2p3.jpg'; ?>">
					</div>
					<div class="col-md-1"></div>		
				</div>

				<div class="row divider-bottom tutorials">
					<div class="col-md-7">
						<img class="img-responsive" src="<?php echo WP_SM_IMAGES_FOLDER.'tuts/step3.jpg'; ?>">
					</div>
					<div class="col-md-4">
						<div class="lead text-black pull-right tutorial-title">
							Step 3: Add your site URL to Facebook Login <i>Valid OAuth Redirect URIs</i>
						</div>
						<div class="text-title text-black pull-right text-right align-top">
							On the left side menus, under <strong>Facebook Login</strong>, click on <strong>Settings</strong> and follow the settings on the screenshot.
							<br><br><br>
							<strong>Note: <i>All new Apps created as of 2018 enforces using HTTPS on Valid OAuth Redirect URIs, <a href="https://developers.facebook.com/docs/facebook-login/security/#https" target="_blank">more info</a>.</i></strong>
						</div>
					</div>
					
					<div class="col-md-1"></div>		
				</div>

				<div class="row divider-bottom tutorials">
					<div class="col-md-4">
						<div class="lead text-black pull-right tutorial-title">
							Step 4: Get your <strong>App ID</strong> and <strong>App Secret</strong>
						</div>
						<div class="text-title text-black pull-right text-right align-top">
							On the main left side menus, under <strong>Settings</strong>, click on <strong>Basic</strong> and get your App ID and App Secret, and back to WP Social Mage plugin page, go to Settings and set your App ID and App Secret.
						</div>
					</div>
					<div class="col-md-7">
						<img class="img-responsive" src="<?php echo WP_SM_IMAGES_FOLDER.'tuts/step4.jpg'; ?>">
					</div>
					<div class="col-md-1"></div>		
				</div>
				

				<div class="row divider-bottom tutorials">
					<div class="col-md-7">
						<iframe class="video" width="640" height="390" src="https://www.youtube.com/embed/B0BZty89xI0?ecver=2">
						</iframe>
					</div>
					<div class="col-md-4">
						<div class="lead text-black pull-right tutorial-title">
							WP Social Mage Demo
						</div>
						<div class="text-title text-black align-top text-right"><br><br><br><br>
    
							See it in action.
						</div>
					</div>
					<div class="col-md-1"></div>		
				</div>
				<?php
			// endforeach;

			include "_quotes.php";
		?>
		<div class="clearfix"></div>
	</div>
</div>

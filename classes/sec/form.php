<div class="<?php echo $prefix?>form-section">
	<form id="<?php echo $prefix?>lic-form" method="post">
		<?php 
			if($message) { echo '<div id="'. $prefix .'lic-message">'. $message .'</div>'; }
			else { echo '<div class="'. $prefix .'header">Validation Form.</div>'; }
		?>
		<table>
		<tr><th>Your Email:</th><td><input type="email" name="email" value="" /></td></tr>
		<tr><th>License Key:</th><td><input type="text" name="lic_key" value="" /></td></tr>
		</table>
		<div class="<?php echo $prefix?>input-group submit">
			<input type="submit" class="button-primary" name="set_lic_key" value="Submit" />
		</div>
	</form>
</div>
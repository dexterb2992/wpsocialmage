<div class="<?php echo $prefix?>expsection">
	<div class="<?php echo $prefix?>explabel"><img src="<?php echo $this->uri.'img/clock.png' ?>" /></div>
	<div class="<?php echo $prefix?>expdatetime">
		<div class="<?php echo $prefix?>inner"><?php echo date('Y-m-d H:i:s', $this->getExp())?></div>
	</div>
</div>
<script>jQuery('<?php echo '.',$prefix?>explabel').on('click', function(){jQuery('<?php echo '.',$prefix?>expsection').toggleClass('active');})</script>
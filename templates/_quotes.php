<div class="rebrand-div mui-pull-left mui-text-body2 mui-text-black">
	<button class="mui-btn-default mui-btn-raised mui-btn" data-mui-size="small" title="Rebrand this plugin" id="rebrand">REBRAND PLUGIN</button>
</div>
<div class="daily-quote mui-pull-right mui-text-body2 mui-text-black mui-text-right">
	<?php 
		$q_types = array(
			"quotebr",
			"quotear",
			"quotefu",
			"quotelo",
			"quotena"
		);

		$qoute = $q_types[array_rand($q_types)];
	?>
	<script type="text/javascript" src="http://www.brainyquote.com/link/<?php echo $qoute;?>.js?iwp=1"></script>
</div>
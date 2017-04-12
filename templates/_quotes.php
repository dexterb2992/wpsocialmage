<div class="row">
	<div class="col-md-12">
		<div class="daily-quote pull-right">
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
	</div>
</div>
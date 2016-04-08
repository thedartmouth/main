<?php
	function show_oncampus_web_ad( $width, $height, $auid, $id ){
		$random_number = rand(10000, getrandmax());
		?>

		<script type="text/javascript">
			var OX_ads = OX_ads || [];
			OX_ads.push({ "auid" : "<?php echo $auid; ?>" });
		</script>
		<script type="text/javascript">
			document.write('<scr'+'ipt src="//oncampusweb-d.openx.net/w/1.0/jstag"><\/scr'+'ipt>');
		</script>
		<noscript>
			<iframe id="<?php echo $id; ?>" name="<?php echo $id; ?>" src="//oncampusweb-d.openx.net/w/1.0/afr?auid=<?php echo $auid; ?>&cb=<?php echo $random_number; ?>" frameborder="0" scrolling="no" width="<?php echo $width; ?>" height="<?php echo $height; ?>">
				<a href="//oncampusweb-d.openx.net/w/1.0/rc?cs=<?php echo $id; ?>&cb=<?php echo $random_number; ?>" ><img src="//oncampusweb-d.openx.net/w/1.0/ai?auid=<?php echo $auid; ?>&cs=<?php echo $id; ?>&cb=<?php echo $random_number; ?>" border="0" alt=""></a>
			</iframe>
		</noscript>
	<?php
	}
?>
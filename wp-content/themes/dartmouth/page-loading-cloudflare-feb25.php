<!DOCTYPE html>

<html>

<head>
	<title>The Dartmouth</title>
	<style>
	html, body
{
    height: 100%;
    margin:0;
    padding:0;
}

div {
    position:relative;
    height: 100%;
    width:100%;
}

div img {
    position:absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
    margin:auto;
}


	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script>
		$(function () {
    	 $(".logo").hide().fadeIn(7000);     
 			});
	</script>

</head>

<body>
	<div class ="logo"><img src="<?php bloginfo('url');?>/wp-content/uploads/2016/02/theDLogo.png"></div>

<p style="display:none">Error: ::IM_UNDER_ATTACK_BOX:: </p>

</body>
</html>
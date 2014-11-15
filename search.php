<?php

include("included.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>The Dartmouth - Search</title>
	<?php include("includes/htmlhead.php"); ?>
  </head>
  <body>
		<!-- navs -->
  		<?php include("includes/navs.php"); ?>

		<!--content-->
		<div class="content container">
			<div class="row-fluid">
				<div class="span9" id="staticcontent">
                    <gcse:searchresults-only></gcse:searchresults-only>
				</div>
                <?php include("includes/aboutnav.php"); ?>
			</div>
		</div>

		<!--footer-->
		<div class="row-fluid">
			<div id="footer">
				<?php include("includes/footer.php"); ?>
			</div>
		</div>

  </body>
</html>

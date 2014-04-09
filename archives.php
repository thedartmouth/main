<?php

include("included.php");

if(isset($_GET['limit'])){
	$limit = $_GET['limit'];
} else {
	$limit = 0;
}

if($_REQUEST['datekey'] == 3141){
	$date = $_REQUEST['date'];
	$month = $_REQUEST['month'];
	$year = $_REQUEST['year'];

	$month = date("m", strtotime($month));

	$datestamp = mktime(0,0,0,$month, $date, $year); //format the date
} else {
	$datestamp = -1;
}

$limitnext = $limit+7;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>The Dartmouth - Archives</title>
	<?php include("includes/htmlhead.php"); ?>
  </head>
  <body>

		<!-- navs -->
  		<?php include("includes/navs.php"); ?>

		<!--content-->
		<div class="content container">


			<div id="container">
				<div id="content" role="main">

				</div><!-- #content -->
			</div><!-- #container -->

			<div class="row-fluid">
				<div class="span9" id="staticcontent">
						<h1>Archives</h1>
						                <form id="datepicker" action="<?= $_SERVER['PHP_SELF']  ?>">
                	<input type="hidden" name="datekey" value="3141" />
                	<select name="date" id="date" class="input-mini">
                    	<?php

						for($i = 1; $i <= 30; $i++){
							echo "<option value='$i'>$i</option>";
						}

						?>
                    </select>
                	<select name="month" id="month" class="input-small">
                    	<?php

						for($i = 1; $i <= 12; $i++){
							$m = date("M", mktime(0, 0, 0, $i, 0, 0));
							echo "<option value='$m'>$m</option>";
						}

						?>
                    </select>
                	<select name="year" id="year" class="input-small">
                    	<?php

						for($i = date("Y", time())-20; $i <= date("Y", time()); $i++){
							echo "<option value='$i'>$i</option>";
						}

						?>
                    </select>
                    <input type="submit" value="Go" />
                </form>

                <?php
				if($datestamp != -1){
					echo "All posts on: ".date("d M, Y", $datestamp);
					$mysqldate = date( 'Y-m-d H:i:s', $datestamp );
					// Test for # of rows
					$limit11 = $limitnext+1; // test for one after the 10 shown on page

					$cxn = get_database_cxn();

					$postIDsQ = mysqli_query($cxn,"SELECT * FROM `wp_posts` WHERE `post_status`='publish' AND `post_date` BETWEEN '$mysqldate' AND DATE_ADD('$mysqldate', INTERVAL 1 DAY) LIMIT $limit,10");

									//echo "SELECT * FROM `wp_posts` WHERE `post_status`='publish' AND `post_date` BETWEEN '$mysqldate' AND DATE_SUB('$mysqldate', INTERVAL 1 DAY) LIMIT $limit,10";


						while($article = mysqli_fetch_array($postIDsQ)) {
							$articleID = $article['ID'];
								$title = htmlentities($article['post_title'], ENT_QUOTES, 'cp1252');
								$summary = str_replace("\n", "<br/>", $article['post_excerpt']);
								$summary = htmlentities(str_replace("<br/>", "", $summary), ENT_QUOTES, 'cp1252');
								$authorID = $article['post_author'];

								$authors = getAuthorsArticle($articleID);
								$authorsOut = "";

								foreach($authors as $author){
									$authorQ = mysqli_query($cxn,"SELECT `display_name` FROM `wp_users` WHERE `ID`='$author' LIMIT 1");
									$authorRow = mysqli_fetch_array($authorQ);
									$displayName = $authorRow['display_name'];
									$authorsOut .= $displayName.", ";
								}

								$authorsOut = substr($authorsOut,0,count($authorsOut)-3);

								// find the right date format
								$dateInt = strtotime($article['post_date']);
								$date = date("F j, Y", $dateInt);

								echo "
								<h3><a href='article.php?id=$articleID'>$title</a></h3>
									<p><span class='byline'>by $authorsOut <span class='green'>$date</span></span></p>
									<p>$summary</p>";
							}
				}

				?>
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

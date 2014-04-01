<?php

include('included.php');

$id = 1;
if(isset($_GET['id'])){
  $id = intval($_GET['id']);  
}

$limit = 0;
if(isset($_GET['limit'])){
  $limit = intval($_GET['limit']);  
}

$cxn = get_database_cxn();
$userR = mysqli_query($cxn, "SELECT `display_name`,`user_url` FROM `wp_users` WHERE `ID`='$id'");
$user = mysqli_fetch_array($userR);

$metaR = mysqli_query($cxn, "SELECT * FROM `wp_usermeta` WHERE `user_id`='$id' AND (`meta_key`='description' OR `meta_key`='userphoto_image_file')");
$meta = array();

while($row = mysqli_fetch_array($metaR)){
	$meta[$row['meta_key']]=$row['meta_value'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>The Dartmouth</title>
	<?php include("includes/htmlhead.php"); ?>
  </head>
  <body>
		<!-- navs -->
  		<?php include("includes/navs.php"); ?>
		
		<!--content-->
		<div class="content container">
			<div class="row">
				<div class="span9" id="staticcontent">
						<h1><?= $user['display_name'] ?> <small><?= $user['user_url'] ?></small></h1>
						<p><?=  $meta['description'] ?></p>
						
					<br />

					<?php
					
					$sqlQuery = "SELECT * FROM `wp_posts` WHERE `post_status`='publish' AND `post_type`='post' AND `post_author`='$id' LIMIT ".abs($limit).",10";
					$postsQ = mysqli_query($cxn, $sqlQuery) or die(mysqli_error($cxn)); 
							
							if(mysqli_num_rows($postsQ) < 1){
								/*echo "No articles by this author were found. Maybe he is a business staffer.";*/
							}
							
							
							while($article = mysqli_fetch_array($postsQ)){
								$articleID = $article['ID'];
								$title = htmlentities($article['post_title'], ENT_QUOTES, 'cp1252');
								$summary = str_replace("\n", "<br/>", $article['post_excerpt']);
								$summary = htmlentities(str_replace("<br/>", "", $summary), ENT_QUOTES, 'cp1252');
								$authorID = $article['post_author'];
								
								$authors = getAuthorsArticle($articleID);
								$authorsOut = "";
								
								foreach($authors as $author){
									$authorQ = mysqli_query($cxn, "SELECT `display_name` FROM `wp_users` WHERE `ID`='$author' LIMIT 1");
									$authorRow = mysqli_fetch_array($authorQ);
									$displayName = strtoupper($authorRow['display_name']);
									$authorsOut .= "<a href='staff.php?id=$author'>$displayName</a>, ";
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
					
					?>
				<div class="pagination">
				<ul>
				  <li>
					<a href="staff.php?id=<?= $id ?>&limit=<?=$limit+7?>">&larr; Previous</a>
				  </li>
				  <li>
					<a href="staff.php?id=<?= $id ?>&limit=<?=$limit-7?>">Next &rarr;</a>
				  </li>
				</ul>
				</div>
				</div>

				<div class="span3" id="rightcol">
				</div>
			</div>
		</div>
		
		<!--footer-->
		<div class="row">
			<div id="footer">
            	
				<?php include("includes/footer.php"); ?></div>
		</div>
	
  </body>
</html>

	<?php
	include("included.php");
	//@Nook
		$cxn = mysqli_connect('allyourdatabase.cbqrfpzjvnzv.us-east-1.rds.amazonaws.com', 'thedadmin', 'u7UY4Mm7xgxB', 'thed_production');
	    header("Content-Type: application/rss+xml; charset=ISO-8859-1");
	    //$cxn = get_database_cxn();
		$postsQ = mysqli_query(mysqli_connect('allyourdatabase.cbqrfpzjvnzv.us-east-1.rds.amazonaws.com', 'thedadmin', 'u7UY4Mm7xgxB', 'thed_production'), "SELECT * FROM `wp_posts`ORDER BY `ID` DESC LIMIT 500");
	    $rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
	    $rssfeed .= '<rss version="2.0">';
	    $rssfeed .= '<channel>';
	    $rssfeed .= '<title>The Dartmouth</title>';
	    $rssfeed .= '<link>http://www.thedartmouth.com</link>';
	    $rssfeed .= '<description>The Dartmouth.com</description>';
	    $rssfeed .= '<language>en-us</language>';
	    $rssfeed .= '<copyright>Copyright (C) 2013 The Dartmouth</copyright>';


	    	while($article = mysqli_fetch_array($postsQ)) {
	        extract($row);

		       	$articleID = $article['ID'];
				$title = htmlentities($article['post_title'], ENT_QUOTES, 'cp1252');
				$summary = str_replace("\n", "<br/>", $article['post_excerpt']);
				$summary = htmlentities(str_replace("<br/>", "", $summary), ENT_QUOTES, 'cp1252');
				$authorID = $article['post_author'];

				$authors = getAuthorsArticle($articleID);

				// find the right date format
				$dateInt = strtotime($article['post_date']);
				$date = date("D, d M Y H:i:s O", $dateInt);

				$authorsOut = "";
	         	$staff = "The Dartmouth"; // store the most senior staff
							foreach($authors as $author){

								$authorQ = mysqli_query(mysqli_connect('allyourdatabase.cbqrfpzjvnzv.us-east-1.rds.amazonaws.com', 'thedadmin', 'u7UY4Mm7xgxB', 'thed_production'), "SELECT `display_name` FROM `wp_users` WHERE `ID`='$author' LIMIT 1");
								$authorRow = mysqli_fetch_array($authorQ);
											$displayName = strtoupper($authorRow['display_name']);

								$authorsOut .= "$displayName ";

								$currStaff = getStaff($author);
								if($currStaff == "The Dartmouth Senior Staff"){
									$staff = $currStaff;
								} else if ($staff=="The Dartmouth" && $currStaff = "The Dartmouth Staff"){
									$staff = $currStaff;
								}
							}

				//$authorsOut = (substr($authorsOut,0,count($authorsOut)-3));

				if($authorsOut == " "){
				//echo "FAIL\n";
				continue;
				}



	        $rssfeed .= '<item>';
	        $rssfeed .= '<title><![CDATA[' . $title . ']]></title>';
	      //  $rssfeed .= '<description>' . $summary . '</description>';
	        $rssfeed .= '<link><![CDATA[http://thedartmouth.com/article.php?id=' . $articleID . ']]></link>';
			$rssfeed .= '<author>'. $authorsOut . '</author>';
	        $rssfeed .= '<pubDate>' . $date . '</pubDate>';
	        $rssfeed .= '</item>';

	    }

	    $rssfeed .= '</channel>';
	    $rssfeed .= '</rss>';

	    echo $rssfeed;
	?>
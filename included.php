<?

error_reporting(0);

// Include configuration file and utilities file
require_once 'configure.php';
require_once 'utilities.php';

$title = SITE_TITLE;

function getCategory($catID, $lim){
	$cxn = get_database_cxn();
	// Selects most recent post IDs from wp_term_relationships table, from category specified with limits specified


	$postIDsQ=mysqli_query($cxn, "SELECT DISTINCT ID FROM wp_posts LEFT JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id WHERE wp_term_relationships.term_taxonomy_id = '$catID' AND `post_status`='publish' ORDER BY `post_date` DESC LIMIT $lim"); 


	#$postIDsQ = mysqli_query($cxn, "SELECT DISTINCT `object_id` FROM `wp_term_relationships` WHERE `term_taxonomy_id` = '$catID' ORDER BY `object_id` DESC LIMIT $lim");

	$x = 0;
	$articles=array();
	$noimageyet=true;
	while($postIDs = mysqli_fetch_array($postIDsQ)) {
		$objectID = $postIDs['ID'];
	
		$postsQ = mysqli_query($cxn, "SELECT * FROM `wp_posts` WHERE `ID`='$objectID' AND `post_status`='publish' LIMIT 1");
		
		
		if(mysqli_num_rows($postsQ) < 1){
			continue;
		}
		
		$article = mysqli_fetch_array($postsQ);
		
		
		$db = false;
		if(strstr($article['post_title'],"Daily Debriefing")){
			$db = true;
		}
	
	
		$title = htmlentities($article['post_title'], ENT_QUOTES, 'cp1252');
		$summary = str_replace("\n", "<br/>", $article['post_excerpt']);
		$summary = htmlentities(str_replace("<br/>", "", $summary), ENT_QUOTES, 'cp1252');
		
		// new author code
		
		$authors = getAuthorsArticle($objectID);
		$authorsOut = "";
		
		foreach($authors as $author){
			$authorQ = mysqli_query($cxn, "SELECT `display_name` FROM `wp_users` WHERE `ID`='$author' LIMIT 1");
			$authorRow = mysqli_fetch_array($authorQ);
			$displayName = strtoupper($authorRow['display_name']);
			$authorsOut .= "<a href='staff.php?id=$author'>$displayName</a>, ";
		}
		
		$authorsOut = substr($authorsOut,0,count($authorsOut)-3);
		
		// end new author code
		
		/*
		$authorID = $article['post_author'];
		
		$authorQ = mysqli_query($cxn, "SELECT `display_name` FROM `wp_users` WHERE `ID`='$authorID' LIMIT 1");
		$authorRow = mysqli_fetch_array($authorQ);
		$authorsOut = $authorRow['display_name'];
		
		*/
		
		// find the right date format
		$dateInt = strtotime($article['post_date']);
		$date = date("F j", $dateInt);
		
		// Grab post image
		$imageQ = mysqli_query($cxn, "SELECT `guid` FROM `wp_posts` WHERE `post_type`='attachment' AND `post_parent`='$objectID' LIMIT 1");
			
			$image = mysqli_fetch_array($imageQ);
			$imageURL = $image['guid'];
											
		$articles[$x]['title']=$title;
		$articles[$x]['summary']=$summary;
		$articles[$x]['author']=$authorsOut;
		$articles[$x]['date']=$date;
		$articles[$x]['image']=$imageURL;
		$articles[$x]['id']=$objectID;
		$articles[$x]['index']=$x;
		//$articles[$x]['authorID']=$authorID;
		
		
		if($imageURL!=""){
			if($noimageyet) {
				$articles['feature']=$articles[$x];
				$noimageyet=false;
			}
		}

				
		$x++;
	}
	

	return $articles;
}

function getCategoryCached($catID, $lim){
	
	$articles=array();

		$cacheName .= 'cached';
		$cacheName .= strval($catID);
		$cacheName .= strval($lim);
		
		if($articles= apc_fetch($cacheName)){
			
			return $articles;
		//	echo $cacheName;
			//	echo "[cached]";
		}
		else {
			$articles= getCategory($catID, $lim);
		apc_add($cacheName,$articles,1200);
	}

		return $articles;
}

function printMostPopular(){
    $cxn = get_database_cxn();

    $two_weeks_ago = mktime(0, 0, 0, date("m"), date("d") - 14, date("Y"));

    $sqlqr = "SELECT * FROM `wp_posts` WHERE post_type='post' AND post_date >= FROM_UNIXTIME(" . $two_weeks_ago . ") ORDER BY viewcount DESC LIMIT 5";

	$mostViewedPosts = mysqli_query($cxn, $sqlqr);
	 $x=1;
	 while($mvPost = mysqli_fetch_array($mostViewedPosts)){
		$mvPostID = $mvPost['ID'];
		$mvPostTitle = htmlentities($mvPost['post_title'], ENT_QUOTES, 'cp1252');
		$mvDate = $mvPost['post_date'];
		
		echo "<p>$x. <a href='article.php?postID=$mvPostID'>$mvPostTitle</a></p>\n";
		$x++;
	 }
}

function getStaff($userID){
        $cxn = get_database_cxn();
	$meta = mysqli_query($cxn, "SELECT `meta_value` FROM `wp_usermeta` WHERE `user_id`='$userID' AND `meta_key`='wp_capabilities' LIMIT 1");
	$staffA = mysqli_fetch_array($meta);
	$staff = $staffA['meta_value'];
	
	if(strstr($staff, "senior_staff")){
		return "The Dartmouth Senior Staff";
	} else if(strstr($staff, "staff")){
		return "The Dartmouth Staff";
	} else {
		return "The Dartmouth";
	}
}

function getAuthorID($authorName){
        $cxn = get_database_cxn();
	$query = mysqli_query($cxn, "SELECT `ID` FROM `wp_users` WHERE `display_name` LIKE '%$authorName%' LIMIT 1");
	$row = mysqli_fetch_array($row);
	return $row['ID'];
}

function getAuthorsArticle($articleID){
        $cxn = get_database_cxn();
	$authors=array();
	$x=0;
	$query = mysqli_query($cxn, "SELECT `term_taxonomy_id`,`term_order` FROM `wp_term_relationships` WHERE `object_id`='$articleID' ORDER BY `term_order`");
	while($row = mysqli_fetch_array($query)){
		if($row['term_order']!=0){
			$termID=$row['term_taxonomy_id'];
			
			// then, look up a name in the terms taxonomy table
			
			$nextquery = mysqli_query($cxn, "SELECT `description` FROM `wp_term_taxonomy` WHERE `term_id`='$termID' LIMIT 1");
			$nextrow = mysqli_fetch_array($nextquery);
			
			$items = explode(" ",$nextrow['description']);
			
			
			foreach($items as $item){
				if(preg_match("/^[0-9]*$/", $item)&&$item!=""&&$item!=" "){ // regex search for the ID in the string of names and emails and shit
					$authors[$x]=$item;
					$x++;
					break;
				}
			}
			
		}
	}
	
	if(count($authors)==0){
		// we aren't using multiple authors so just get the author regularly
		
		$postsQ = mysqli_query($cxn, "SELECT `post_author` FROM `wp_posts` WHERE `ID`='$articleID' AND `post_status`='publish' LIMIT 1");
		
		$article = mysqli_fetch_array($postsQ);
		
		$authorID = $article['post_author'];
		
		$authors[0]=$authorID;
	}
	
	return $authors;
}

function getAuthorsArticleCached($articleID){
	
	$cacheName .= 'author';
	$cacheName .= strval($articleID);

	if($authors = apc_cache_fetch($cacheName)){
		
	}
	else{
		$authors = getAuthorsArticle($articleID);
		apc_add($cacheName,$authors,8000);
	}
	return $authors;
}

function getTwitter() {
        // Set your username and password here
        $user = 'YOUREMAILADDRESS';
        $password = 'YOURPASSWORD';

        $ch = curl_init("https://twitter.com/statuses/user_timeline.xml");
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch,CURLOPT_TIMEOUT, 30);
        curl_setopt($ch,CURLOPT_USERPWD,$user . ":" . $password);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $result=curl_exec ($ch);
        $data = strstr($result, '<?');

        $xml = new SimpleXMLElement($data);

        return $xml;
}

?>

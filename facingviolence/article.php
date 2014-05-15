<?php

include("../included.php");

$postID = '1';
if(isset($_GET['id'])){
   $postID =  preg_replace("/[^a-zA-Z0-9\_]/","", $_GET['id']);
   $url = get_article_url($postID);
}elseif(isset($_GET['postID'])){
    $postID =  preg_replace("/[^a-zA-Z0-9\_]/","", $_GET['postID']);
    $url = get_article_url($postID);
}elseif(isset($_GET['url_string'])){
    $postID = get_article_id($_GET['url_string']);
}
if($postID==''){
	header('HTTP/1.0 404 Not Found');
}

      //fetch article, set up title @Nook moved this here because we need it in the header
      $cxn = get_database_cxn();

	$postsQ = mysqli_query($cxn, "SELECT * FROM `wp_posts` WHERE `ID`='$postID' LIMIT 1");
	$article = mysqli_fetch_array($postsQ);

	$title = htmlspecialchars_decode(htmlentities($article['post_title'], ENT_QUOTES, 'cp1252'));


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <base href="<?php print DIR_WS_ROOT; ?>" target="_self" />
	<title>
	 The Dartmouth - <?= $title ?>
	</title>
	<?php include("../includes/htmlhead.php");?>
      <link href="includes/facingviolence.css" rel="stylesheet">


  </head>
  <body>
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
		<!-- navs -->
  		<?php include("includes/nav.php"); ?>


		<div class="content container-fluid">
                                        <div class="ad">
                                            <!-- LeaderboardSection -->
                                            <!--/* OpenX JavaScript tag */-->

                                            <!-- /*
                                             * The tag in this template has been generated for use on a
                                             * non-SSL page. If this tag is to be placed on an SSL page, change the
                                             * 'http://ox-d.oncampusweb.com/...'
                                             * to
                                             * 'https://ox-d.oncampusweb.com/...'
                                             */ -->

                                            <script type="text/javascript">
                                            if (!window.OX_ads) { OX_ads = []; }
                                            OX_ads.push({ "auid" : "536871729" });
                                            </script>
                                            <script type="text/javascript">
                                            document.write('<scr'+'ipt src="http://ox-d.oncampusweb.com/w/1.0/jstag"><\/scr'+'ipt>');
                                            </script>
                                            <noscript><iframe id="a33db12fcb" name="a33db12fcb" src="http://ox-d.oncampusweb.com/w/1.0/afr?auid=536871729&cb=INSERT_RANDOM_NUMBER_HERE" frameborder="0" scrolling="no" width="728" height="90"><a href="http://ox-d.oncampusweb.com/w/1.0/rc?cs=a33db12fcb&cb=INSERT_RANDOM_NUMBER_HERE" ><img src="http://ox-d.oncampusweb.com/w/1.0/ai?auid=536871729&cs=a33db12fcb&cb=INSERT_RANDOM_NUMBER_HERE" border="0" alt=""></a></iframe></noscript>
                                        </div>
			<div class="row-fluid">
				<div class="span9" id="staticcontent">
				<?php

				// Selects given post ID from wp_posts
                //                $cxn = get_database_cxn();
			//	$postsQ = mysqli_query($cxn, "SELECT * FROM `wp_posts` WHERE `ID`='$postID' LIMIT 1");

			//		$article = mysqli_fetch_array($postsQ);
			//		$title = htmlspecialchars_decode(htmlentities($article['post_title'], ENT_QUOTES, 'cp1252'));
					$content = htmlspecialchars_decode(htmlentities($article['post_content'], ENT_QUOTES, 'cp1252'));
						$content = str_replace("\n", "<br/>", $content);
					$count = $article['viewcount']; //  this is a custom field we added
					$summary = $article['post_excerpt'];
						$summary = htmlspecialchars_decode(htmlentities($summary, ENT_QUOTES, 'cp1252'));
					$count ++;

					$content = str_replace("&trade;", "'", $content);
					$content = str_replace("&oelig;", "'", $content);
					$content = str_replace("&acirc;&euro;", "'", $content);

					$dateInt = strtotime($article['post_date']);
					$date = date("F j, Y", $dateInt);

					// new author code

					$authors = getAuthorsArticle($postID);
					$authorsOut = "";

					$staff = "The Dartmouth"; // store the most senior staff
					foreach($authors as $author){
						$authorQ = mysqli_query($cxn, "SELECT `display_name` FROM `wp_users` WHERE `ID`='$author' LIMIT 1");
						$authorRow = mysqli_fetch_array($authorQ);
									$displayName = strtoupper($authorRow['display_name']);
						$authorsOut .= "<a href='staff.php?id=$author'>$displayName</a>, ";

						$currStaff = getStaff($author);
						if($currStaff == "The Dartmouth Senior Staff"){
							$staff = $currStaff;
						} else if ($staff=="The Dartmouth" && $currStaff == "The Dartmouth Staff"){
							$staff = $currStaff;
						}
					}

					$authorsOut = (substr($authorsOut,0,count($authorsOut)-3));

					// end new author code

					/*
					$authorID = $article['post_author'];

					$authorQ = mysqli_query($cxn, "SELECT `display_name` FROM `wp_users` WHERE `ID`='$authorID' LIMIT 1");
					$authorRow = mysqli_fetch_array($authorQ);
					$authorsOut = $authorRow['display_name'];

					*/

					// Grab post image and caption
					$imageQ = mysqli_query($cxn, "SELECT `guid`, `post_excerpt`,`post_title` FROM `wp_posts` WHERE `post_type`='attachment' AND `post_parent`='$postID' LIMIT 1");

						$image = mysqli_fetch_array($imageQ);
						$imageURL = $image['guid'];
						$photographer = $image['post_excerpt'];
						$imageCaption = $image['post_title'];
						$imageCaption = htmlspecialchars_decode(htmlentities($imageCaption, ENT_QUOTES, 'cp1252'));
					echo "<h1>$title</h1>";
					//echo "<p>$summary<br/></p>";
					?>

					<div id="articlepic">
					<?
					if ($imageURL != ""){
								echo "<p><img src='$imageURL' width='700' /></p><div style='margin: 0; max-width:700px'><p class='caption pull-right'>By $photographer</p><p class='caption'>$imageCaption</span></p><div class='clearfix'></div></div>";
					}
					?>
					</div>

					<?

					echo "<p class='byline'>By $authorsOut";
					if($staff!="The Dartmouth")
						echo ", $staff";
					echo "<br />
						<span class='green'>$date</span> </p>";
					echo "<div id='social'>";


					$localURL = DIR_WS_ROOT;


						?>

						<ul class="nav nav-list">
							<li class="nav-header">Share This</li>
							<div id="fb-root"></div>
                                                                                            <script>(function(d, s, id) {
                                                                                              var js, fjs = d.getElementsByTagName(s)[0];
                                                                                              if (d.getElementById(id)) return;
                                                                                              js = d.createElement(s); js.id = id;
                                                                                              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                                                                                              fjs.parentNode.insertBefore(js, fjs);
                                                                                            }(document, 'script', 'facebook-jssdk'));</script>
                                                                                            <div class="fb-share-button" data-type="button_count"></div>

							<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                                                                                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                                                                            <div></div>

							<!-- Place this tag where you want the +1 button to render. -->
                                                                                            <div class="g-plusone"></div>

                                                                                            <!-- Place this tag after the last +1 button tag. -->
                                                                                            <script type="text/javascript">
                                                                                              (function() {
                                                                                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                                                                                po.src = 'https://apis.google.com/js/platform.js';
                                                                                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                                                                                              })();
                                                                                            </script>
						</ul>

						<?
					echo "</div>";
					echo "<p>$content</p>";

					mysqli_query($cxn, "UPDATE `wp_posts` SET `viewcount`='$count' WHERE `ID`='$postID' LIMIT 1") or die(mysqli_error());

					?>
					<div class='clearfix'></div>
                                    	<div class="row"><div class="line">&nbsp;</div><br /></div>

                                                <div id="disqus_thread"></div>
                                                <script type="text/javascript">
                                                    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                                                    var disqus_shortname = 'thedartmouth'; // required: replace example with your forum shortname

                                                    /* * * DON'T EDIT BELOW THIS LINE * * */
                                                    (function() {
                                                        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                                                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                                                    })();
                                                </script>
                                                <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                                <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>

				</div>

				<!--</div>-->
				<div class="span3" id="rightcol">

                                                        <div class="ad">
                                                            <!-- Right Square Box -->
                                                            <!--/* OpenX JavaScript tag */-->

                                                            <!-- /*
                                                             * The tag in this template has been generated for use on a
                                                             * non-SSL page. If this tag is to be placed on an SSL page, change the
                                                             * 'http://ox-d.oncampusweb.com/...'
                                                             * to
                                                             * 'https://ox-d.oncampusweb.com/...'
                                                             */ -->

                                                            <script type="text/javascript">
                                                            if (!window.OX_ads) { OX_ads = []; }
                                                            OX_ads.push({ "auid" : "537085606" });
                                                            </script>
                                                            <script type="text/javascript">
                                                            document.write('<scr'+'ipt src="http://ox-d.oncampusweb.com/w/1.0/jstag"><\/scr'+'ipt>');
                                                            </script>
                                                            <noscript><iframe id="d66a14328a" name="d66a14328a" src="http://ox-d.oncampusweb.com/w/1.0/afr?auid=537085606&cb=INSERT_RANDOM_NUMBER_HERE" frameborder="0" scrolling="no" width="250" height="250"><a href="http://ox-d.oncampusweb.com/w/1.0/rc?cs=d66a14328a&cb=INSERT_RANDOM_NUMBER_HERE" ><img src="http://ox-d.oncampusweb.com/w/1.0/ai?auid=537085606&cs=d66a14328a&cb=INSERT_RANDOM_NUMBER_HERE" border="0" alt=""></a></iframe></noscript>
                                                        </div>

                                                        <div class="ad">
                                                            <!-- WideSkyscraperSection -->
                                                            <!--/* OpenX JavaScript tag */-->

                                                            <!-- /*
                                                             * The tag in this template has been generated for use on a
                                                             * non-SSL page. If this tag is to be placed on an SSL page, change the
                                                             * 'http://ox-d.oncampusweb.com/...'
                                                             * to
                                                             * 'https://ox-d.oncampusweb.com/...'
                                                             */ -->

                                                            <script type="text/javascript">
                                                            if (!window.OX_ads) { OX_ads = []; }
                                                            OX_ads.push({ "auid" : "536871731" });
                                                            </script>
                                                            <script type="text/javascript">
                                                            document.write('<scr'+'ipt src="http://ox-d.oncampusweb.com/w/1.0/jstag"><\/scr'+'ipt>');
                                                            </script>
                                                            <noscript><iframe id="139a109648" name="139a109648" src="http://ox-d.oncampusweb.com/w/1.0/afr?auid=536871731&cb=INSERT_RANDOM_NUMBER_HERE" frameborder="0" scrolling="no" width="160" height="600"><a href="http://ox-d.oncampusweb.com/w/1.0/rc?cs=139a109648&cb=INSERT_RANDOM_NUMBER_HERE" ><img src="http://ox-d.oncampusweb.com/w/1.0/ai?auid=536871731&cs=139a109648&cb=INSERT_RANDOM_NUMBER_HERE" border="0" alt=""></a></iframe></noscript>
                                                        </div>
                                                    </div>
			</div>
		</div>

		<!--footer-->
		<div class="row">
			<div id="footer">

				<?php include("../includes/footer.php"); ?></div>
		</div>

  </body>
</html>

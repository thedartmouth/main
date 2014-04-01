<?php
print_r(apc_cache_info());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>The Dartmouth - America's Oldest College Newspaper</title>
	<?php include("includes/htmlhead.php");

					include("included.php"); ?>

	<!-- OpenX header script -->
	<script type="text/javascript" src="http://ox-d.oncampusweb.com/w/1.0/jstag"></script>

	<script type="text/javascript">
	    var OX_c7b6d8b209 = OX();
	    OX_c7b6d8b209.addPage("536870979");
	    OX_c7b6d8b209.fetchAds();
	</script>
	<!-- end generated tag -->



	<script type="text/javascript" language="javascript">
		var currentel=0;
		var interval;

		function rotate(el){
			currentel=el;
			$(".rotate_item").hide();
			$("#rotate"+currentel).fadeIn(400);
			clearInterval(interval);
			interval=window.setInterval(autorotate,7500);
		}

		function prev(){
			currentel--;

			if(currentel<0){
				currentel=3;
			}

			rotate(currentel);
		}

		function next(){
			currentel++;

			if(currentel>3){
				currentel=0;
			}

			rotate(currentel);
		}

		function autorotate(){
			rotate((currentel+1)%4);
			currentel++;
		}

		$(document).ready(function(){
			interval=window.setInterval(autorotate,7500);
		});

		function dismissBreaking(){
			$("#breaking").slideUp(250);
		}
	</script>
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
<?php include("includes/navs.php"); ?>

<!--content-->
<div class="content container-fluid" style="max-width: 1300px;">
<!-- 	<div class="row-fluid" id="abovefold">
		<div class="span9" id="breaking">
			<button type="button" class="close" onclick="javascript:dismissBreaking()">&times;</button>
			<h4>Welcome to The Dartmouth's new website! Please bear with us as we fully transition to the new site.</h4>
		</div>
	</div> -->

	<div class="row-fluid" id="abovefold">
		<div class="span3" id="leftcol">
		<div id="dailynews">
		<?php

		// GET NEWS
		//CACHE GETCATEGORY DIRECTLY?
		$news = array_reverse(getCategoryCached(1,5));
		$opinion = getCategoryCached(2,5);

		?>
		<?php

		// get all the dates

		foreach($news as $key=>$row){
			$date[$key] = $row['date'];
		}
		array_multisort($volume, SORT_DESC, $news);

		rsort($date);

		// select the most decent date
		$mostrecent = $date[0];


		unset($news['feature']);

				?>

				<?php
				$x=0; //keep track of how many stories so far

				while($article = array_pop($news)){

					// if($article['date'] != $mostrecent){ continue; }

					// if it's daily debriefing, push it until the end
					if(strstr($article['title'], 'debrief')){
						array_unshift($news, $article);
					} else {
						?>

						<div class="story">
						<h4><a href="article.php?id=<?= $article['id'] ?>">
						<?= $article['title'] ?>
						</a></h4><p class="byline">By <?= ($article['author'])."" ?> <span class='green'><?= $article['date'] ?></span></p>
						<?

						if($x < 1){ // only show one more lead
							?><p><?= $article['summary'] ?></p><?
						}
						?>
						</div>

						<?
						$x++;
					}
				}

				?>
			</div>
		</div>

		<div class="span6" id="centrecol featured">

                 <?php
				// CENTER FEATURED IMAGE SLIDER
				$navs = "";

				// Selects most recent post IDs from wp_term_relationships table, from category specified with limits specified
                                    $cxn = get_database_cxn();
				$postIDsQ = mysqli_query($cxn, "SELECT `object_id` FROM `wp_term_relationships` WHERE `term_taxonomy_id` = '1131' ORDER BY `object_id` DESC LIMIT 4") or die(mysqli_error());
					$x = 0;

					while($postIDs = mysqli_fetch_array($postIDsQ)) {
						$objectID = $postIDs['object_id'];

						$postsQ = mysqli_query($cxn, "SELECT * FROM `wp_posts` WHERE `ID`='$objectID' AND `post_status`='publish'") or die(mysqli_error());

						$article = mysqli_fetch_array($postsQ);

						$title = htmlentities($article['post_title'], ENT_QUOTES, 'cp1252');
						$summary = str_replace("\n", "<br/>", $article['post_excerpt']);
						$summary = htmlentities(str_replace("<br/>", "", $summary), ENT_QUOTES, 'cp1252');

						// Grab post image
						$imageQ = mysqli_query($cxn, "SELECT `guid` FROM `wp_posts` WHERE `post_type`='attachment' AND `post_parent`='$objectID' LIMIT 1") or die(mysqli_error());

							$image = mysqli_fetch_array($imageQ);
							$imageURL = $image['guid'];

						?>
							<div id="rotate<?= $x ?>" class="rotate_item<? if($x > 0) echo " hide"; ?>"> <img src="<?= $imageURL ?>" />
								<div class="rotate_headline"> <a href="article.php?id=<?= $objectID ?>">
									<h1 class="featured"><?= $title ?></h1>
									</a>
									<p><?= $summary ?></p>
								</div>
							</div>
						<?
						$navs .= "<a href='javascript:rotate($x)'><img src='$imageURL' width='110'></a>";

						$x++;
					}


				?>
			<br/><center class="scroll-images">
				<a href="javascript:prev()"><img src="img/left-arrow.png" /></a>
				<?php
				echo $navs;
			?>
				<a href="javascript:next()"><img src="img/right-arrow.png" /></a>
			</center>
			</td>

			<div class="ad">
				<!-- OpenX body script -->
				<script type="text/javascript">
				    OX_f3a1519f80.showAdUnit("536875766");
				</script><noscript><iframe id="f3a1519f80" name="f3a1519f80" src="http://ox-d.oncampusweb.com/w/1.0/afr?auid=536875766&cb=INSERT_RANDOM_NUMBER_HERE" frameBorder="0" frameSpacing="0" scrolling="no" width="728" height="90"><a href="http://ox-d.oncampusweb.com/w/1.0/rc?cs=f3a1519f80&cb=INSERT_RANDOM_NUMBER_HERE"><img src="http://ox-d.oncampusweb.com/w/1.0/ai?auid=536875766&cs=f3a1519f80&cb=INSERT_RANDOM_NUMBER_HERE" border="0" alt=""></a></iframe></noscript>
			</div>
		</div>

		<div class="span3 tweets" id="rightcol">

			<div class="ad">
				<!-- OpenX body script -->
				<script type="text/javascript">
				    OX_24ac13e05c.showAdUnit("536875612");
				</script><noscript><iframe id="24ac13e05c" name="24ac13e05c" src="http://ox-d.oncampusweb.com/w/1.0/afr?auid=536875612&cb=INSERT_RANDOM_NUMBER_HERE" frameBorder="0" frameSpacing="0" scrolling="no" width="300" height="250"><a href="http://ox-d.oncampusweb.com/w/1.0/rc?cs=24ac13e05c&cb=INSERT_RANDOM_NUMBER_HERE"><img src="http://ox-d.oncampusweb.com/w/1.0/ai?auid=536875612&cs=24ac13e05c&cb=INSERT_RANDOM_NUMBER_HERE" border="0" alt=""></a></iframe></noscript>
			</div>

				<h2>Twitter</h2>
				<div id="twitter" class="up">
				<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/thedartmouth" data-widget-id="291269316375093248">Tweets by @thedartmouth</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div><br />

			<!--	<h2>Dartbeat</h2>
				<div id="dartbeat"> -->
                  <?php /*
                     $ch = curl_init();

                     curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
                     curl_setopt($ch,CURLOPT_MAXREDIRS,10);
                     curl_setopt($ch, CURLOPT_URL, 'http://dartbeat.com/rss');
                     curl_setopt($ch, CURLOPT_HEADER, 0);
                     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                     $data = curl_exec($ch);
                     curl_close($ch);

                     $rss = new SimpleXMLElement($data);

                     $items = 3;

                     for($i=0;$i<$items;$i++) {
                     	echo "<p> » <a href='".$rss->channel->item[$i]->link."' target=\"_blank\">".$rss->channel->item[$i]->title."</a></p>";
                     } */

                     ?>
		<!--	</div>-->
		</div>
	<div class="clearfix"></div>
	</div>
	<div class="row-fluid"><div class="line">&nbsp;</div><br /></div>
	<div id="belowfold">
	<div class="clearfix"></div>
		<div class="row-fluid">
			<div class="span3" id="leftcol">
				<h2 class="green">Opinion</h2>

				<?php

				$current = $opinion['feature'];
				unset($opinion[$current['index']]);
				unset($opinion['feature']);

				if($current != "" && $current != null ) {


				?>
				<div class="story"><h4 class="first"><a href="article.php?id=<?= $current['id'] ?>">
				<?= $current['title'] ?>
				</a></h4>
				<div class="clearfix"></div>
				<p class="byline">By <?= ($current['author'])."" ?> <span class='green'><?= $current['date'] ?></span></p>
				<p><?= $current['summary'] ?></p>
				</div>

				<?php

				}

				foreach($opinion as $article){

					?>

					<div class="story">
					<h4><a href="article.php?id=<?= $article['id'] ?>">
					<?= $article['title'] ?>
					</a></h4><p class="byline">By <?= ($article['author'])."" ?> <span class='green'><?= $article['date'] ?></span></p></div>
					<?
				}

				?>
			<br />
        <?php
                        $cxn = get_database_cxn();
			$linkResultPaper = mysqli_query($cxn, "SELECT `post_content` FROM `wp_posts` WHERE `ID`='101604' LIMIT 1");


			$linkResultMirror = mysqli_query($cxn, "SELECT `post_content` FROM `wp_posts` WHERE `ID`='101603' LIMIT 1");


			if($paper= apc_fetch('paper_d')){

			}
			else{
			$paper = mysqli_fetch_array($linkResultPaper);
			}
			if($mirror= apc_fetch('mirror_d')){

				}
			else{
					$mirror = mysqli_fetch_array($linkResultMirror);
				}


			?>


				<h2 class="nobg">Today's Paper</h2>
				<center>
				<?= $paper['post_content']; ?></center>
				<br/>
				<h2 class="nobg"> Mirror</h2>
				<center>
				<?= $mirror['post_content']; ?></center>
				<div class="ad">
				<!-- OpenX body script -->
				<script type="text/javascript">
				    OX_c7b6d8b209.showAdUnit("536871734");
				</script><noscript><iframe id="c7b6d8b209" name="c7b6d8b209" src="http://ox-d.oncampusweb.com/w/1.0/afr?auid=536871734&cb=INSERT_RANDOM_NUMBER_HERE" frameBorder="0" frameSpacing="0" scrolling="no" width="250" height="250"><a href="http://ox-d.oncampusweb.com/w/1.0/rc?cs=c7b6d8b209&cb=INSERT_RANDOM_NUMBER_HERE"><img src="http://ox-d.oncampusweb.com/w/1.0/ai?auid=536871734&cs=c7b6d8b209&cb=INSERT_RANDOM_NUMBER_HERE" border="0" alt=""></a></iframe></noscript>
				</div>
			<br/>
				<div class="ad">
					<!-- OpenX body script -->
					<script type="text/javascript">
					    OX_c5d2d6ac3b.showAdUnit("536875764");
					</script><noscript><iframe id="c5d2d6ac3b" name="c5d2d6ac3b" src="http://ox-d.oncampusweb.com/w/1.0/afr?auid=536875764&cb=INSERT_RANDOM_NUMBER_HERE" frameBorder="0" frameSpacing="0" scrolling="no" width="160" height="600"><a href="http://ox-d.oncampusweb.com/w/1.0/rc?cs=c5d2d6ac3b&cb=INSERT_RANDOM_NUMBER_HERE"><img src="http://ox-d.oncampusweb.com/w/1.0/ai?auid=536875764&cs=c5d2d6ac3b&cb=INSERT_RANDOM_NUMBER_HERE" border="0" alt=""></a></iframe></noscript>
				</div>

			</div>

		<div class="span6" id="centrecol">
				<?php
				include("included.php");
				$sports = getCategoryCached(3,3);
				$arts = getCategoryCached(4,3);
				//print_r($sports)
				?>

				<h2 class="green">Sports</h2>
				<div class="row-fluid">

				<div class="span6">
					<?php

					$current = $sports['feature'];
					if($current == null){
						$current = $sports[0];
						unset($sports[0]);
					} else {

					unset($sports[$current['index']]);
					unset($sports['feature']);
					}



					?>
						<img src="<?= $current['image'] ?>" />
						<h4><a href="article.php?id=<?= $current['id'] ?>">
						<?= $current['title'] ?>
						</a></h4>
						<p class="byline">By <?= ($current['author'])."" ?> <span class='green'><?= $current['date'] ?></span></p>
						<p><?= $current['summary'] ?></p>
					</div>
				<div class="span6">
						<?

						foreach($sports as $article){

							?>

							<h5><a href="article.php?id=<?= $article['id'] ?>">
							<?= $article['title'] ?>
							</a></h5><p class="byline">By <?= ($article['author'])."" ?> <span class='green'><?= $article['date'] ?></span></p>
						<p><?= $article['summary'] ?></p>

							<?
						}

						?>
					</div>
			</div>
			<div><div class="line">&nbsp;</div></div>
			<div class="ad">
				<!-- OpenX body script -->
				<script type="text/javascript">
				    OX_c7b6d8b209.showAdUnit("536874059");
				</script><noscript><iframe id="c7b6d8b209" name="c7b6d8b209" src="http://ox-d.oncampusweb.com/w/1.0/afr?auid=536874059&cb=INSERT_RANDOM_NUMBER_HERE" frameBorder="0" frameSpacing="0" scrolling="no" width="728" height="90"><a href="http://ox-d.oncampusweb.com/w/1.0/rc?cs=c7b6d8b209&cb=INSERT_RANDOM_NUMBER_HERE"><img src="http://ox-d.oncampusweb.com/w/1.0/ai?auid=536874059&cs=c7b6d8b209&cb=INSERT_RANDOM_NUMBER_HERE" border="0" alt=""></a></iframe></noscript>

				</div>
			<div><div class="line">&nbsp;</div></div>
			<br />

				<h2 class="green">Arts</h2>
				<div class="row-fluid">
				<div class="span6"><?php

					$current = $arts['feature'];
					if($current == null){
						$current = $arts[0];
						unset($arts[0]);
}					 else {

					unset($arts[$current['index']]);
					unset($arts['feature']);
				}



					?>
						<img src="<?= $current['image'] ?>" />
						<h4><a href="article.php?id=<?= $current['id'] ?>">
						<?= $current['title'] ?>
						</a></h4>
						<p class="byline">By <?= ($current['author'])."" ?> <span class='green'><?= $current['date'] ?></span></p>
						<p><?= $current['summary'] ?></p>
					</div>
				<div class="span6">
						<?


						foreach($arts as $article){

							?>

							<h5><a href="article.php?id=<?= $article['id'] ?>">
							<?= $article['title'] ?>
							</a></h5><p class="byline">By <?= ($article['author'])."" ?> <span class='green'><?= $article['date'] ?></span></p>
						<p><?= $article['summary'] ?></p>

							<?
						}


						?>
					</div>
			</div>

			<div><div class="line">&nbsp;</div></div>
			<br />
				<div class="ad">
					<!-- OpenX body script -->
					<script type="text/javascript">
					    OX_02091ab835.showAdUnit("536875613");
					</script><noscript><iframe id="02091ab835" name="02091ab835" src="http://ox-d.oncampusweb.com/w/1.0/afr?auid=536875613&cb=INSERT_RANDOM_NUMBER_HERE" frameBorder="0" frameSpacing="0" scrolling="no" width="728" height="90"><a href="http://ox-d.oncampusweb.com/w/1.0/rc?cs=02091ab835&cb=INSERT_RANDOM_NUMBER_HERE"><img src="http://ox-d.oncampusweb.com/w/1.0/ai?auid=536875613&cs=02091ab835&cb=INSERT_RANDOM_NUMBER_HERE" border="0" alt=""></a></iframe></noscript>

				</div>

			<div><div class="line">&nbsp;</div></div>
			<br />
					<?php

					$media = getCategoryCached(1130,3);

					?>
				<h2 class="green"><a href="multimedia.php">Multimedia</a></h2>
				<div class="row-fluid">
				<!--				<div class="span3"><?php

					$current = $media['feature'];
					unset($media[$current['index']]);
					unset($media['feature']);


					?>
						<img src="<?= $current['image'] ?>" />
						<h4><a href="article.php?id=<?= $current['id'] ?>">
						<?= $current['title'] ?>
						</a></h4>
						<p class="byline">By <?= ($current['author'])."" ?> <span class='green'><?= $current['date'] ?></span></p>
						<p><?= $current['summary'] ?></p>
					</div>
				<div class="span2">
						<?


						foreach($media as $article){

							?>

							<h5><a href="article.php?id=<?= $article['id'] ?>">
							<?= $article['title'] ?>
							</a></h5><p class="byline">By <?= ($article['author'])."" ?> <span class='green'><?= $article['date'] ?></span></p>
						<p><?= $article['summary'] ?></p>

							<?
						}


						?>
					</div>-->
				<div class="span12"><iframe scrolling="no" marginheight="0" frameborder="0" width="480" src="https://ytchannelembed.com/gallery.php?vids=9&amp;user=TheDartmouthVideo&amp;row=3&amp;width=150&amp;hd=1&amp;margin_right=15&amp;desc=100&amp;desc_color=9E9E9E&amp;title=30&amp;title_color=000000&amp;views=0&amp;likes=0&amp;dislikes=0&amp;fav=0&amp;playlist=" style="height: 728px;"></iframe></div>
			</div>
			</div>
		<div class="span3" id="rightcol">
				<div id="popular">
				<h2 class="nobg">Most Popular</h2>
                  <?php


                     printMostPopular();

                  ?>

			</div>
			<!--<div class="fb" style="height:400px"><div class="fb-recommendations" data-site="thedartmouth.com" data-width="270" data-height="400" data-header="true" data-font="segoe ui"></div><div class="clearfix"></div></div>
-->
			<br/>
			<div class="ad">
				<!-- OpenX body script -->
				<script type="text/javascript">
				    OX_c7b6d8b209.showAdUnit("536871726");
				</script><noscript><iframe id="c7b6d8b209" name="c7b6d8b209" src="http://ox-d.oncampusweb.com/w/1.0/afr?auid=536871726&cb=INSERT_RANDOM_NUMBER_HERE" frameBorder="0" frameSpacing="0" scrolling="no" width="200" height="200"><a href="http://ox-d.oncampusweb.com/w/1.0/rc?cs=c7b6d8b209&cb=INSERT_RANDOM_NUMBER_HERE"><img src="http://ox-d.oncampusweb.com/w/1.0/ai?auid=536871726&cs=c7b6d8b209&cb=INSERT_RANDOM_NUMBER_HERE" border="0" alt=""></a></iframe></noscript>

			</div>
			<div class="ad">
			<!-- OpenX body script -->
			<script type="text/javascript">
			    OX_c7b6d8b209.showAdUnit("536871731");
			</script><noscript><iframe id="c7b6d8b209" name="c7b6d8b209" src="http://ox-d.oncampusweb.com/w/1.0/afr?auid=536871731&cb=INSERT_RANDOM_NUMBER_HERE" frameBorder="0" frameSpacing="0" scrolling="no" width="160" height="600"><a href="http://ox-d.oncampusweb.com/w/1.0/rc?cs=c7b6d8b209&cb=INSERT_RANDOM_NUMBER_HERE"><img src="http://ox-d.oncampusweb.com/w/1.0/ai?auid=536871731&cs=c7b6d8b209&cb=INSERT_RANDOM_NUMBER_HERE" border="0" alt=""></a></iframe></noscript>

			</div>

			<div class="ad">
			<!-- OpenX body script -->
			<script type="text/javascript">
			    OX_3a1d294b19.showAdUnit("536875765");
			</script><noscript><iframe id="3a1d294b19" name="3a1d294b19" src="http://ox-d.oncampusweb.com/w/1.0/afr?auid=536875765&cb=INSERT_RANDOM_NUMBER_HERE" frameBorder="0" frameSpacing="0" scrolling="no" width="160" height="600"><a href="http://ox-d.oncampusweb.com/w/1.0/rc?cs=3a1d294b19&cb=INSERT_RANDOM_NUMBER_HERE"><img src="http://ox-d.oncampusweb.com/w/1.0/ai?auid=536875765&cs=3a1d294b19&cb=INSERT_RANDOM_NUMBER_HERE" border="0" alt=""></a></iframe></noscript>
			</div><br />
	</div>
	</div>
	</div>

<!--footer-->
<div class="row-fluid">
<div id="footer">
		<div id="footer_inner" class="container">
		<?php include("includes/footer.php"); ?>
	</div>
	</div>
</body>
</html>

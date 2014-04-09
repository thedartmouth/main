<?php

$catID = 4;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>The Dartmouth - Arts</title>
	<?php include("includes/htmlhead.php"); ?>

  </head>
  <body>
		<!-- navs -->
  		<?php include("includes/navs.php"); ?>

		<!--content-->
		<div class="content container-fluid">
			<div class="row-fluid">
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
				<div id="staticcontent">
					<div class="span9">

						<h1>Arts</h1><div class="row-fluid">
						<?php

						include("included.php");

						$cat = getCategoryCached($catID,11);
						$current = $cat['feature'];
						if ($current == null) {
							$current = $cat[0];
							unset($cat[0]);
						} else {
							unset($cat[$current['index']]);
							unset($cat['feature']);
						}

						?>

						<?php

						$output = array();
						$index =  true;
						$x = 0;

						foreach($cat as $article){
							$output[$index][$x]=$article;

							if($index){
								$x++;
							}

							$index  = !$index;

						}


						?>

						<div class="span6">
							<p><img src="<?= $current['image'] ?>" /></p>
							<h3 class="first"><a href="/article.php?id=<?= $current['id'] ?>"><?= $current['title'] ?></a></h3>
							<p class="byline">By <?= ($current['author'])."" ?> <span class='green'><?= $current['date'] ?></span></p>
							<p><?= $current['summary'] ?></p>
							<p>&nbsp;</p>


						<?php
						$countLeft = 0;
						foreach($output[0] as $article){ ?>

							<h3><a href="/article.php?id=<?= $article['id'] ?>">
							<?= $article['title'] ?>
							</a></h3><p class="byline">By <?= ($article['author'])."" ?> <span class='green'><?= $article['date'] ?></span></p>
							<? if($countLeft < 2){ ?><p><?= $article['summary'] ?></p><? } ?>
							<p>&nbsp;</p>

							<?

							$countLeft++;

						} ?>
						</div>
						<div class="span6">
						<?php
						$countRight = 0;
						foreach($output[1] as $article){ ?>

							<h3><a href="/article.php?id=<?= $article['id'] ?>">
							<?= $article['title'] ?>
							</a></h3><p class="byline">By <?= ($article['author'])."" ?> <span class='green'><?= $article['date'] ?></span></p>
							<? if($countRight < 4){ ?><p><?= $article['summary'] ?></p><? } ?>
							<p>&nbsp;</p>

							<?

							$countRight ++;
						} ?>
						</div>


						</div>
					</div>
					<div class="span3" id="rightcol">
						<?php include("includes/topstories.php"); ?>

						<div class="ad">
							<!-- SquareSection -->
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
							OX_ads.push({ "auid" : "536871734" });
							</script>
							<script type="text/javascript">
							document.write('<scr'+'ipt src="http://ox-d.oncampusweb.com/w/1.0/jstag"><\/scr'+'ipt>');
							</script>
							<noscript><iframe id="72571c226d" name="72571c226d" src="http://ox-d.oncampusweb.com/w/1.0/afr?auid=536871734&cb=INSERT_RANDOM_NUMBER_HERE" frameborder="0" scrolling="no" width="250" height="250"><a href="http://ox-d.oncampusweb.com/w/1.0/rc?cs=72571c226d&cb=INSERT_RANDOM_NUMBER_HERE" ><img src="http://ox-d.oncampusweb.com/w/1.0/ai?auid=536871734&cs=72571c226d&cb=INSERT_RANDOM_NUMBER_HERE" border="0" alt=""></a></iframe></noscript>
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
		</div>
	<!--footer-->
	<div class="row-fluid">
		<div id="footer">

			<?php include("includes/footer.php"); ?></div>
	</div>

  </body>
</html>

<?php 

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}

?>

<div>
	<div class="container-fluid">
		<div class="collapse-nav">
			<a class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		    	<span>Sections</span>
		    </a>
			<button class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		      <span class="icon-bar icon-white"></span>
		      <span class="icon-bar icon-white"></span>
		      <span class="icon-bar icon-white"></span>
		    </button>
		
		</div>

		<div class="nav-collapse">
			<ul class="navbar-nav">
				<li><a href="news.php" <?=echoActiveClassIfRequestMatches("news")?>>News</a></li>
				<li><a href="opinion.php" <?=echoActiveClassIfRequestMatches("opinion")?>>Opinion</a></li>
				<li><a href="sports.php" <?=echoActiveClassIfRequestMatches("sports")?>>Sports</a></li>
				<li><a href="arts.php" <?=echoActiveClassIfRequestMatches("arts")?>>Arts</a></li>
				<li><a href="mirror.php" <?=echoActiveClassIfRequestMatches("mirror")?>>Mirror</a></li>
				<li><a href="dartbeat.php" <?=echoActiveClassIfRequestMatches("dartbeat")?>>Dartbeat</a></li>
				<li><a href="http://www.youtube.com/user/TheDartmouthVideo/" <?=echoActiveClassIfRequestMatches("media")?>>Media</a></li>
				<li>
					<form action="search.php"  method="get" class="form-search">
						<input type="text" name="search" class="input-medium search-query" />
						<input type="hidden" name="order" value="rel" />
						<button type="submit" class="btn">Search</button>
					</form>
				</li>
			</ul>
		</div>
	</div>
</div>
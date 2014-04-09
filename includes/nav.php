<?php

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if (strpos($_SERVER['REQUEST_URI'], $requestUri) !== false) {
        echo 'class="active"';
    }
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
				<li><a href="/news" <?=echoActiveClassIfRequestMatches("news")?>>News</a></li>
				<li><a href="/opinion" <?=echoActiveClassIfRequestMatches("opinion")?>>Opinion</a></li>
				<li><a href="/sports" <?=echoActiveClassIfRequestMatches("sports")?>>Sports</a></li>
				<li><a href="/arts" <?=echoActiveClassIfRequestMatches("arts")?>>Arts</a></li>
				<li><a href="/mirror" <?=echoActiveClassIfRequestMatches("mirror")?>>Mirror</a></li>
				<li><a href="/dartbeat" <?=echoActiveClassIfRequestMatches("dartbeat")?>>Dartbeat</a></li>
				<li><a href="http://www.youtube.com/user/TheDartmouthVideo/" <?=echoActiveClassIfRequestMatches("media")?>>Media</a></li>
				<li>
					<form action="/search.php"  method="get" class="form-search">
						<input type="text" name="search" class="input-medium search-query" />
						<input type="hidden" name="order" value="rel" />
						<button type="submit" class="btn">Search</button>
					</form>
				</li>
			</ul>
		</div>
	</div>
</div>

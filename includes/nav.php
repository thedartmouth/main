<?php

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if (strpos($_SERVER['REQUEST_URI'], $requestUri) !== false) {
        echo 'class="active"';
    }
}

?>

<script>
  (function() {
    var cx = '013493263980530339291:ujvbczpbozc';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>

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
				<li class="form-search">
					<gcse:searchbox-only resultsUrl="/search.php" newWindow="false"></gcse:searchbox-only>
				</li>
			</ul>
		</div>
	</div>
</div>

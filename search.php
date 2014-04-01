<?php

include("included.php");

$query = (isset($_REQUEST['search']) ? $_REQUEST['search'] : '');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>The Dartmouth - Search</title>
	<?php include("includes/htmlhead.php"); ?>
        <script type="text/javascript" src="search/js/core.js"></script>
    <link type="text/css" href="search/css/core.css" rel="stylesheet" />
  </head>
  <body>
		<!-- navs -->
  		<?php include("includes/navs.php"); ?>
		
		<!--content-->
		<div class="content container">
			<div class="row-fluid">
				<div class="span9" id="staticcontent">
                                    <h1>Search</h1>
                                    <div id="search_box">
                                        <form method="get" action="" name="search_form" id="search_form" class="form-inline">
                                        <input type="text" name="query" id="search_input" size="40" maxlength="100" value="<?php print $query; ?>" class="input-large search-query"  />
                                        <select name="order" id="search_select" class="input-small">
                                            <option value="none" selected="selected">Sort by...</option>
                                            <option value="rel">Relevance</option>
                                            <option value="date_asc">Date (Ascending)</option>
                                            <option value="date_desc">Date (Descending)</option>
                                        </select>
                                        <input type="submit" id="search_submit" name="submit" class="btn" value="Search" />
                                        </form>
                                    </div>
                                    <div id="search_results">
                                        <div class="content">
                                            <div id="search_results_wrapper">
                                                
                                            </div>
                                            <div id="no_results">Sorry, no results could be found.</div>
                                            <div id="loading_search_results"></div>
                                            <div id="more_search_results">more</div>
                                        </div>                                        
                                    </div>
				</div>
				<div class="span3" id="rightcol">
					<h2 class="nobg">About Us</h2>
					<p><a href="about.php">About The Dartmouth</a></p>
					<p><a href="advertise.php">Advertise</a></p>
					<p><a href="donate.php">Donate</a></p>
					<p> <a href="subscribe.php">Subscribe</a></p>
					<p><a href="policies.php">Policies</a></p>
				</div>
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

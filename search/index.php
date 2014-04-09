<?php

/*
 * Search example
 *
 *
 */


require_once '../configure.php';
require_once '../utilities.php';
require_once 'helpers.php';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Search Example | <?php print SITE_TITLE ?></title>
    <meta http-equiv="content-language" content="en-us" />
    <base href="<?php print DIR_WS_RELATIVE_BASE ?>search/" target="_self" />
    <link type="text/css" href="css/reset.css" rel="stylesheet" />
    <link href="http://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet" type="text/css" />
    <link type="text/css" href="css/fonts.css" rel="stylesheet" />
    <link type="text/css" href="css/core.css" rel="stylesheet" />
    <link type="text/css" href="css/ie.css" rel="stylesheet" />
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery.ui.all.css" rel="stylesheet" />
    <script type="text/javascript" src="js/core.js"></script>
    <script type="text/javascript" src="js/frame_breaker.js"></script>
    <script type="text/javascript" src="js/detect_ie.js"></script>
</head>
<body id="body">
    <div id="header">
        <div class="title">Search Example</div>
    </div>
    <div id="main_wrapper">
        <div id="main">
            <div class="section" id="search_query">
                <div class="content">
                    <form method="get" action="" name="search_form" id="search_form">
                    <input type="text" name="query" id="search_input" size="40" maxlength="100"  />
                    <select name="order" id="search_select">
                        <option value="none">Sort by...</option>
                        <option value="rel">Relevance</option>
                        <option value="date_asc">Date (Ascending)</option>
                        <option value="date_desc" selected="selected">Date (Descending)</option>
                    </select>
                    <input type="submit" id="search_submit" name="submit" value="Search" />
                    </form>
                </div>
            </div>
            <div class="section" id="search_results">
                <div class="content">
                    <div id="search_results_wrapper">

                    </div>
                    <div id="no_results">Sorry, no results could be found.</div>
                    <div id="loading_search_results"></div>
                    <div id="more_search_results">more</div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">

    </div>
</body>
</html>

<?php

/*
 * Migration dashboard
 *
 * Lets an admin import the legacy articles and reformat them
 *
 */

 
require_once '../configure.php';
require_once '../utilities.php';
require_once 'utilities.php';

// Check to make sure the logged-in user is allowed access to the migration scripts
if(!is_migration_user()){
    exit;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Migration Dashboard | <?php print SITE_TITLE ?></title>
    <meta http-equiv="content-language" content="en-us" />
    <base href="<?php print DIR_WS_RELATIVE_BASE ?>migration/" target="_self" />	
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
        <div class="title">Migration Dashboard</div>
    </div>
    <div id="main_wrapper">
        <div id="main">
            <div class="section" id="wipe_clean">
                <div class="title">Wipe all data</div>
                <div class="content">
                    <div class="progress_bar" id="wipe_progress_bar">
                        <div class="progress-label">
                            <div class="progress_counter" id="wipe_progress_counter"><span class="value">0</span>% Complete</div>
                        </div>
                    </div>
                    <div class="button" id="wipe_now">Wipe Clean</div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="section" id="import_articles">
                <div class="title">Import all legacy data</div>
                <div class="content">
                    <div class="progress_bar" id="import_progress_bar">
                        <div class="progress-label">
                            <div class="progress_counter" id="import_progress_counter"><span class="value">0</span>% Complete</div>
                        </div>
                    </div>
                    <div class="button" id="import_now">Import Articles</div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="section" id="process_articles">
                <div class="title">Process the imported data</div>
                <div class="content">
                    <div class="progress_bar" id="process_progress_bar">
                        <div class="progress-label">
                            <div class="progress_counter" id="process_progress_counter"><span class="value">0</span> articles left to process</div>
                        </div>
                    </div>

                    <div class="button" id="process_now">Start processing</div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        
    </div>
</body>
</html>
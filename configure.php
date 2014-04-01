<?php

/*
 * Centralized configuration file
 *
 * Contains all database settings, and other options necessary for WP installation and the migration scripts
 *
 */
 
// General settings
define('SITE_TITLE', 'The Dartmouth');
define('DB_PREFIX', 'wp_');  
define('TMP_PREFIX', 'quarantine_');

// Language
define('STANDARD_ERROR', 'Sorry an error has occured with one of the migration scripts');
define('STANDARD_ERROR_MIGRATION', 'Sorry an error has occured');
  
//@CASPIAR Host-specific settings 
switch($_SERVER['HTTP_HOST']){
    
    // localhost
    case 'localhost:8888' :
    case 'localhost' :	
        $ws_root = 'http://localhost:8888/';
        $ws_relative_base = '/';
        # Primary DB
        $db_host = 'localhost';
        $db_username = 'root';
        $db_password = 'root';
        $db_name = 'the_dartmouth';
        # Legacy DB
        $db_host_legacy = 'localhost';
        $db_username_legacy = 'root';
        $db_password_legacy = 'root';
        $db_name_legacy = 'the_dartmouth_legacy';
        # AWS
        $aws_key = ''; ## Only needed if AWS search index utilized
        $aws_secret = ''; ## Only needed if AWS search index utilized
        $aws_index_table = ''; ## Only needed if AWS search index utilized
        $aws_index_queue = ''; ## Only needed if AWS search index utilized
        
    break;

    // // staging server (AWS)
    //  case '23.21.136.221' :	
    //      $ws_root = 'http://23.21.136.221/';
    //      $ws_relative_base = '/';
    //      # Primary DB 
    //      $db_host = 'localhost';
    //      $db_username = 'root';
    //      $db_password = 'vGkXtCCxZ0373L5';
    //      $db_name = 'the_dartmouth';
    //      # Legacy DB        
    //      $db_host_legacy = 'localhost'; ## LEGACY HOST
    //      $db_username_legacy = 'root'; ## LEGACY USERNAME
    //      $db_password_legacy = 'vGkXtCCxZ0373L5'; ## LEGACY PW
    //      $db_name_legacy = 'legacy'; ## LEGACY DB NAME
    //      # AWS
    //      $aws_key = ''; ## Only needed if AWS search index utilized
    //      $aws_secret = ''; ## Only needed if AWS search index utilized
    //      $aws_index_table = ''; ## Only needed if AWS search index utilized
    //      $aws_index_queue = ''; ## Only needed if AWS search index utilized
    //      
    //  break;
 
case '23.21.136.221' :	
     $ws_root = 'http://23.21.136.221/';
     $ws_relative_base = '/';
     # Primary DB 
     $db_host = 'allyourdatabase.cbqrfpzjvnzv.us-east-1.rds.amazonaws.com';
     $db_username = 'thedadmin';
     $db_password = 'u7UY4Mm7xgxB';
     $db_name = 'thed_production';
     # Legacy DB        
     $db_host_legacy = 'localhost'; ## LEGACY HOST
     $db_username_legacy = 'root'; ## LEGACY USERNAME
     $db_password_legacy = 'vGkXtCCxZ0373L5'; ## LEGACY PW
     $db_name_legacy = 'legacy'; ## LEGACY DB NAME
     # AWS
     $aws_key = ''; ## Only needed if AWS search index utilized
     $aws_secret = ''; ## Only needed if AWS search index utilized
     $aws_index_table = ''; ## Only needed if AWS search index utilized
     $aws_index_queue = ''; ## Only needed if AWS search index utilized
     
break;


    // production (thedartmouth.com)
    case 'thedartmouth.com' :
    case 'www.thedartmouth.com' :
        $ws_root = 'http://thedartmouth.com/';
        $ws_relative_base = '/';
        # Primary DB
    //    $db_host = 'localhost';
     //   $db_username = 'root';
      //  $db_password ='vGkXtCCxZ0373L5'; 
      //  $db_name = 'the_dartmouth';
		$db_host = 'allyourdatabase.cbqrfpzjvnzv.us-east-1.rds.amazonaws.com';
	    $db_username = 'thedadmin';
	    $db_password ='u7UY4Mm7xgxB'; 
	    $db_name = 'thed_production';
        # Legacy DB        
        $db_host_legacy = 'localhost';
        $db_username_legacy = 'root';
        $db_password_legacy = 'vGkXtCCxZ0373L5';
        $db_name_legacy = 'the_dartmouth_legacy';
        # AWS
        $aws_key = ''; ## Only needed if AWS search index utilized
        $aws_secret = ''; ## Only needed if AWS search index utilized
        $aws_index_table = ''; ## Only needed if AWS search index utilized
        $aws_index_queue = ''; ## Only needed if AWS search index utilized
        
    break;
    
    //     case 'direct.thedartmouth.com':	
    //     $ws_root = 'http://direct.thedartmouth.com/';
    //     $ws_relative_base = '/';
    //     # Primary DB
    //     $db_host = 'localhost';
    //     $db_username = 'root';
    //     $db_password ='vGkXtCCxZ0373L5'; 
    //     $db_name = 'the_dartmouth';
    //     # Legacy DB        
    //     $db_host_legacy = 'localhost';
    //     $db_username_legacy = 'root';
    //     $db_password_legacy = 'vGkXtCCxZ0373L5';
    //     $db_name_legacy = 'the_dartmouth_legacy';
    //     # AWS
    //     $aws_key = ''; ## Only needed if AWS search index utilized
    //     $aws_secret = ''; ## Only needed if AWS search index utilized
    //     $aws_index_table = ''; ## Only needed if AWS search index utilized
    //     $aws_index_queue = ''; ## Only needed if AWS search index utilized
    //     
    // break;

 case 'direct.thedartmouth.com':	
        $ws_root = 'http://direct.thedartmouth.com/';
        $ws_relative_base = '/';
        # Primary DB
        $db_host = 'allyourdatabase.cbqrfpzjvnzv.us-east-1.rds.amazonaws.com';
        $db_username = 'thedadmin';
        $db_password ='u7UY4Mm7xgxB'; 
        $db_name = 'thed_production';
        # Legacy DB        
        $db_host_legacy = 'localhost';
        $db_username_legacy = 'root';
        $db_password_legacy = 'vGkXtCCxZ0373L5';
        $db_name_legacy = 'the_dartmouth_legacy';
        # AWS
        $aws_key = ''; ## Only needed if AWS search index utilized
        $aws_secret = ''; ## Only needed if AWS search index utilized
        $aws_index_table = ''; ## Only needed if AWS search index utilized
        $aws_index_queue = ''; ## Only needed if AWS search index utilized
        
    break;


}
  

// //@NOOK
// // Host-specific settings
// switch($_SERVER['HTTP_HOST']){
//     
//     // localhost
//     case 'localhost:8888' :
//     case 'localhost' :	
//         $ws_root = 'http://localhost:8888/the_dartmouth/';
//         $ws_relative_base = '/the_dartmouth/';
//         # Primary DB
//         $db_host = 'localhost';
//         $db_username = 'root';
//         $db_password = 'root';
//         $db_name = 'the_dartmouth';
//         # Legacy DB
//         $db_host_legacy = 'localhost';
//         $db_username_legacy = 'root';
//         $db_password_legacy = 'root';
//         $db_name_legacy = 'the_dartmouth_legacy';
//         # AWS
//         $aws_key = ''; ## Only needed if AWS search index utilized
//         $aws_secret = ''; ## Only needed if AWS search index utilized
//         $aws_index_table = ''; ## Only needed if AWS search index utilized
//         $aws_index_queue = ''; ## Only needed if AWS search index utilized
//         
//     break;
// 
     // staging server (AWS)
     // case '23.21.136.221' :	
     //      $ws_root = 'http://23.21.136.221/';
     //      $ws_relative_base = '/';
     //      # Primary DB 
     //      $db_host = 'allyourdatabase.cbqrfpzjvnzv.us-east-1.rds.amazonaws.com';
     //      $db_username = 'thedadmin';
     //      $db_password = 'u7UY4Mm7xgxB';
     //      $db_name = 'thed_production';
     //      # Legacy DB        
     //      $db_host_legacy = 'localhost'; ## LEGACY HOST
     //      $db_username_legacy = 'root'; ## LEGACY USERNAME
     //      $db_password_legacy = 'vGkXtCCxZ0373L5'; ## LEGACY PW
     //      $db_name_legacy = 'legacy'; ## LEGACY DB NAME
     //      # AWS
     //      $aws_key = ''; ## Only needed if AWS search index utilized
     //      $aws_secret = ''; ## Only needed if AWS search index utilized
     //      $aws_index_table = ''; ## Only needed if AWS search index utilized
     //      $aws_index_queue = ''; ## Only needed if AWS search index utilized
     //      
     // break;
// 
//     // production (thedartmouth.com)
//     case 'thedartmouth.com' :
//     case 'www.thedartmouth.com' :
//         $ws_root = 'http://thedartmouth.com/';
//         $ws_relative_base = '/';
//         # Primary DB
//         $db_host = 'allyourdatabase.cbqrfpzjvnzv.us-east-1.rds.amazonaws.com';
//         $db_username = 'thedadmin';
//         $db_password ='u7UY4Mm7xgxB'; 
//         $db_name = 'thed_production';
//         # Legacy DB        
//         $db_host_legacy = 'localhost';
//         $db_username_legacy = 'root';
//         $db_password_legacy = 'vGkXtCCxZ0373L5';
//         $db_name_legacy = 'the_dartmouth_legacy';
//         # AWS
//         $aws_key = ''; ## Only needed if AWS search index utilized
//         $aws_secret = ''; ## Only needed if AWS search index utilized
//         $aws_index_table = ''; ## Only needed if AWS search index utilized
//         $aws_index_queue = ''; ## Only needed if AWS search index utilized
//         
//     break;
//     
//         case 'direct.thedartmouth.com':	
//         $ws_root = 'http://direct.thedartmouth.com/';
//         $ws_relative_base = '/';
//         # Primary DB
//         $db_host = 'allyourdatabase.cbqrfpzjvnzv.us-east-1.rds.amazonaws.com';
//         $db_username = 'thedadmin';
//         $db_password ='u7UY4Mm7xgxB'; 
//         $db_name = 'thed_production';
//         # Legacy DB        
//         $db_host_legacy = 'localhost';
//         $db_username_legacy = 'root';
//         $db_password_legacy = 'vGkXtCCxZ0373L5';
//         $db_name_legacy = 'the_dartmouth_legacy';
//         # AWS
//         $aws_key = ''; ## Only needed if AWS search index utilized
//         $aws_secret = ''; ## Only needed if AWS search index utilized
//         $aws_index_table = ''; ## Only needed if AWS search index utilized
//         $aws_index_queue = ''; ## Only needed if AWS search index utilized
//         
//     break;
// }

  
// Define Primary DB Connection
define('DB_HOST', $db_host);
define('DB_USERNAME', $db_username);
define('DB_PASSWORD', $db_password);
define('DB_NAME', $db_name);
 
// Define Legacy DB Connection
define('DB_HOST_LEGACY', $db_host_legacy);
define('DB_USERNAME_LEGACY', $db_username_legacy);
define('DB_PASSWORD_LEGACY', $db_password_legacy);
define('DB_NAME_LEGACY', $db_name_legacy);

// Define AWS settings
define('AWS_KEY', $aws_key);
define('AWS_SECRET', $aws_secret);
define('AWS_INDEX_TABLE', $aws_index_table);
define('AWS_INDEX_QUEUE', $aws_index_queue);

// Web system constants
$current_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
define('CURRENT_URL', $current_url);
define('STANDARD_PROTOCOL', 'http://');
define('SECURE_PROTOCOL', 'http://');		
define('DIR_WS_ROOT', $ws_root);
define('DIR_WS_RELATIVE_BASE', $ws_relative_base);

// File system constants
define('DIR_FS_ROOT', realpath(dirname(__FILE__)).'/');
define('DIR_FS_INCLUDES', DIR_FS_ROOT . 'includes/');
define('DIR_FS_CLASSES', DIR_FS_ROOT . 'classes/');		
define('DIR_FS_TMP', DIR_FS_ROOT . 'tmp/');


// Unset variables
unset($current_url);
unset($ws_root);
unset($ws_relative_base);
unset($db_host);
unset($db_username);
unset($db_password);
unset($db_name);
unset($db_host_legacy);
unset($db_username_legacy);
unset($db_password_legacy);
unset($db_name_legacy);
unset($aws_key);
unset($aws_secret);

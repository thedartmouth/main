<?php

/*
 * Centralized utilities file
 *
 * Defines useful functions used in other scripts
 *
 */
 
require_once 'configure.php'; 

// Get mysqli connection object for primary DB
function get_database_cxn(){
    // Connect to database
    $cxn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die (STANDARD_ERROR_MIGRATION.' Could not establish connection to local db');
    return $cxn;
}

// Get mysqli connection object for legacy DB
function get_database_cxn_legacy(){
    // Connect to database
    $cxn = mysqli_connect(DB_HOST_LEGACY, DB_USERNAME_LEGACY, DB_PASSWORD_LEGACY, DB_NAME_LEGACY) or die (STANDARD_ERROR_MIGRATION.' Could not establish connection to remote db');
    return $cxn;
}

// Random string generator
function random_string($stringLength = 10, $upperCase = TRUE, $lowerCase = TRUE, $numbers = TRUE){
    // If requested string-length to short, reset to default length (10)	
    $stringLength = intval($stringLength);
    if($stringLength < 1){
        $stringLength = 10;
    }		
    // If user turned off all options, turn all back on (return to default settings)
    if(($upperCase == FALSE)&&($lowerCase == FALSE)&&($numbers == FALSE)){
        $uppercaseCase = TRUE;
        $lowerCase = TRUE;
        $numbers = TRUE;
    }
    // Compile list total character-list (The list of available characters to build the new string out of).	
    $characterList = '';
    if($upperCase == TRUE){
        $characterList.='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }		
    if($lowerCase == TRUE){
        $characterList.='abcdefghijklmnopqrstuvwxyz';
    }	
    if($numbers == TRUE){
        $characterList.='1234567890';
    }
    // Create new string and return it.
    srand((double)microtime()*1000000);
    $newString = '';
    $counter = 1;
    while($counter <= $stringLength){
        $newString.= substr($characterList,(rand()%(strlen($characterList))), 1); 
        $counter++;
    }
    return $newString;		
}

// Get article url from id
function get_article_url($id = false){
    $url = '';
    if($id){
        $cxn = get_database_cxn();
        $category = get_article_category($id);
        $query = "SELECT post_name, post_date FROM `wp_posts` where ID = '$id' limit 1";
        $result = mysqli_query($cxn, $query) or die ('mysql select failure'); 
        while($row = mysqli_fetch_array($result)){
            $post_name = $row['post_name'];
            $post_date = $row['post_date'];
            $post_time = strtotime($post_date);
            $year = date('Y', $post_time);
            $month = date('m', $post_time);
            $day = date('d', $post_time);
            $url = DIR_WS_ROOT.$year.'/'.$month.'/'.$day.'/'.$category.'/'.$post_name;
        }
    }
    return $url;
}

// Get article id from url
function get_article_id($url = false){
    $id = null;
    if($url){
        $cxn = get_database_cxn();
        $url_string =  trim($_GET['url_string'], '/');
        $full_url = DIR_WS_ROOT.$url_string;
        $url_array = explode('/', $url_string);
        $url_slug = end($url_array);
        $post_ids = array();
        $query = "select id as post_id from wp_posts where post_name = '$url_slug'";
        $result = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
        while($row = mysqli_fetch_assoc($result)){
            extract($row);
            $post_ids[] = $post_id;
        }
        if(count($post_ids) > 1){
            foreach($post_ids as $post_id){
                $tmp_url = get_article_url($post_id);
                if($tmp_url == $full_url){
                    $id = $post_id;
                }
            }
            if(is_null($id)){
                $id = $post_ids[0];
            }
        } elseif(count($post_ids == 1)){
            $id = $post_ids[0];
        }
    }
    return $id;
}

// Get article category
function get_article_category($id){
    $category = null;
    if($id){
        $category_names = array();
        $cxn = get_database_cxn();
        $query = "select DISTINCT term_taxonomy_id from wp_term_relationships where object_id = $id";
        $result2 = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
        while($row2 = mysqli_fetch_assoc($result2)){
            extract($row2);
            $query = "select DISTINCT term_id from wp_term_taxonomy where term_taxonomy_id = $term_taxonomy_id AND taxonomy = 'category'";
            $result3 = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
            while($row3 = mysqli_fetch_assoc($result3)){
                extract($row3);
                $query = "select slug from wp_terms where term_id = $term_id";
                $result4 = mysqli_query($cxn, $query) or die(mysqli_error($cxn).'Query: '.$query);
                $row4 = mysqli_fetch_assoc($result4);
                if($row4 != false){
                    extract($row4);
                    $category_names[] = $slug;
                }
            }                       
        }
        $category = (empty($category_names) ? '' : $category_names[0]);
    }
    return $category;
}
<?php

/*
 * Get article preview
 * Accepts an article ID, returns enough article-data to create a search-results preview
 *
 */

// Include required scripts
require_once '../configure.php';
require_once '../utilities.php';
require_once 'helpers.php';
include('../included.php');
 
// Create response array
$response = array();
$response['type'] = 'fail';
$response['message'] = '';
$response['data'] = array();
$response['data']['headline'] = '';
$response['data']['content'] = '';
$response['data']['date'] = '';
$response['data']['authors'] = '';
$response['data']['id'] = '';
$response['data']['url'] = '#';

// Grab articleID
$article_id = (isset($_GET['id']) ? preg_replace("/[^0-9]/","", urldecode($_GET['id'])) : 0);
$response['data']['id'] = $article_id;

// Pull article data
$query = "SELECT * FROM `wp_posts` where ID = '$article_id' limit 1";
$cxn = get_database_cxn();
$result = mysqli_query($cxn, $query) or ($response['message'] = 'mysql select failure'); 
$response['type'] = 'success';
while($row = mysqli_fetch_array($result)){
    $response['data']['headline'] = $row['post_title'];
    $summary = $row['post_excerpt'];
    if(strlen($summary) < 1){
        $summary = $row['post_content'];
    }
    $summary = preg_replace('~(*BSR_ANYCRLF)\R~', "", $summary);
    $summary = str_replace('<br />', '', $summary);
    $summary = str_replace('<br>', '', $summary);
    $summary = strip_tags($summary);
    $response['data']['content'] = substr($summary, 0, 255);  
    $authors = getAuthorsArticle($article_id);
    foreach($authors as $author){
            $authorQ = mysqli_query($cxn, "SELECT `display_name` FROM `wp_users` WHERE `ID`='$author' LIMIT 1");
            $author_row = mysqli_fetch_array($authorQ);
            $display_name = strtoupper($author_row['display_name']);
            if(strlen($display_name) < 1){
                $display_name = 'The Dartmouth Staff';
            }
            $response['data']['authors'][] = array('id' => $author, 'name' => $display_name);
        
    }
    $dateInt = strtotime($row['post_date']);
    $response['data']['date'] = date("F j, Y", $dateInt);
    # Put in real URL
    $response['data']['url'] = get_article_url($article_id);
}
    

        
include 'output_json.php';
?>
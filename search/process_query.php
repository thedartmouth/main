<?php

/*
 * Search query processing script
 * Accepts a search query, strips it of non-essential words, queries dynamoDB for matching article IDs, then runs fuller search on mysql based on filter/sort parameters, then resturns ordered list of article IDs
 *
 */

// Include required scripts
require_once '../configure.php';
require_once '../utilities.php';
require_once 'helpers.php';
 
// Create response array
$response = array();
$response['type'] = 'fail';
$response['message'] = '';
$response['data'] = array();
$response['data']['article_count'] = 0;
$response['data']['article_ids'] = array();

// Grab search query
$query_array = array();
if(isset($_GET['query'])){
    $user_query = trim(preg_replace("/[^a-zA-Z0-9\s]/","", urldecode($_GET['query'])));
    $query_array_tmp = explode(' ', $user_query);
    $additions = array('', 's', 'ing', 'ed');
    foreach($query_array_tmp as $snippet){
        $snippet = trim(strtolower($snippet));
        if(word_should_be_filtered($snippet) == false){
            foreach($additions as $addition){
                $query_array[] = $snippet.$addition;   
            }
        }
    }
}

// If none of the words submitted in the query string were useable, pass back response
if(count($query_array) == 0){
    $response['type'] =  'success';
    $response['message'] = 'None of the query parameters were useable';
} else {
    /*
    // Instantiate AWS dynamoDB
    require_once 'sdk.class.php';
    $dynamo_db = new AmazonDynamoDB();
    // For each keyword, grab matching articles
    $article_pool = array();
    foreach($query_array as $keyword){
        $get_response = $dynamo_db->get_item(array(
            'TableName' => AWS_INDEX_TABLE,
            'Key' => array('HashKeyElement' => array(AmazonDynamoDB::TYPE_STRING => $keyword))
        ));	
        if($get_response->status == '200'){
            if(isset($get_response->body->Item->articles->NS)){
                $new_articles_array = $get_response->body->Item->articles->NS;
                foreach($new_articles_array as $key => $value){
                    $value = (string)$value;
                    if(!in_array($value, $article_pool)){
                        $article_pool[] = $value;
                        $response['data']['article_count']++;
                    }
                }
            }
        }else{
           $response['message'] = 'An error occured while connected to AWS';
        }        
    }
    */
    $response['data']['article_count'] = -1;
    if($response['data']['article_count'] == 0){
        # If no articles were found via AWS, pass back response
        $response['type'] =  'success';
        $response['message'] = 'No articles found in AWS';        
    } else {
        # Perform complex query on new article pool in order to sort them
        //$query_pool_section = trim(implode(',', $article_pool));
        //$query_pool_query = (strlen($query_pool_section) > 0 ? 'ID in ('.$query_pool_section.') AND' : '');
        $query_pool_query = '';
        $cxn = get_database_cxn();
        $query = "SELECT ID as article_id FROM `wp_posts` where  $query_pool_query `post_status`='publish' AND `post_type`='post' AND ((`post_title` like '%$user_query%')  OR (`post_content` like '%$user_query%') )";
        $authorQ = mysqli_query($cxn, "SELECT `ID` FROM `wp_users` WHERE `user_nicename` LIKE '%$user_query%' OR `display_name` LIKE '%$user_query%'");
        $rows = mysqli_num_rows($authorQ);
        $user_id = array();
        if($rows == 0){
            $user_id[0] = 0;
        }else{
            for ($i = 0; $rowArray = mysqli_fetch_array($authorQ); $i++){
                $user_id[$i] = $rowArray['ID'];
            }
        }
        if(count($user_id)>0 && $user_id[0]!=0){
            $query .= "OR (";
            for ($i = 0; $i < count($user_id); $i++) {
                if($i > 0)
                    $query .= " OR ";             
                $query .= "`post_author` = ".$user_id[$i];     
            }
            $query .= ")";
        }        
        
 

        $order = (isset($_GET['order']) ? $_GET['order'] : null);
        $limit = 100;
        switch($order){
            case 'date_asc' :
                $query.= " ORDER BY `post_date` ASC LIMIT $limit";
            break;
        
            case 'date_desc' :
                $query.= " ORDER BY `post_date` DESC LIMIT $limit";
            break;
        
            default:
                $query.= " LIMIT $limit";
        }
        $response['type'] = 'success';
        $result = mysqli_query($cxn, $query) or die (mysqli_error($cxn).$query);
        while($row = mysqli_fetch_array($result)){
            extract ($row);
            $response['data']['article_ids'][] = $article_id;
        }
        $new_count = count($response['data']['article_ids']);
        $response['data']['article_count'] = $new_count;
    }
}

        
include 'output_json.php';
?>
<?php

/*
 * Queue Processor
 * Pulls down items from SQS queue, adds the words/snippets to the dynamo index
 *
 */

// Stop notices from aws scripts
error_reporting(E_ALL ^ E_NOTICE);

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
$response['data']['total_processed'] = 0;

// Grab item from queue
require_once 'sdk.class.php';
$dynamo_db = new AmazonDynamoDB();
$sqs = new AmazonSQS();
$dynamo_db = new AmazonDynamoDB();
$queue_url = AWS_INDEX_QUEUE;
$getMessageResponse = $sqs->receive_message($queue_url);
if(isset($getMessageResponse->body->ReceiveMessageResult->Message->ReceiptHandle)){
    $messageId = (string)$getMessageResponse->body->ReceiveMessageResult->Message->ReceiptHandle;
    $messageContent = (string)$getMessageResponse->body->ReceiveMessageResult->Message->Body;
    $messageContentArray = explode(':', $messageContent);
    $post_id = intval(trim($messageContentArray[0]));
    $new_strings = $messageContentArray[1];
    $old_strings = $messageContentArray[2];
    # Send each word to dynamodb
    $new_strings_array = explode(',', $new_strings);
    foreach($new_strings_array as $keyword){
        $keyword = strtolower($keyword);
        $article_pool = array();
        $get_response = $dynamo_db->get_item(array(
            'TableName' => AWS_INDEX_TABLE,
            'Key' => array('HashKeyElement' => array(AmazonDynamoDB::TYPE_STRING => $keyword))
        ));	
        if($get_response->status == '200'){
            if(isset($get_response->body->Item->articles->NS)){
                $new_articles_array = $get_response->body->Item->articles->NS;
                foreach($new_articles_array as $key => $value){
                    $value = intval($value);
                    if(!in_array($value, $article_pool)){
                        $article_pool[] = $value;
                    }
                }
            }            
            if(!in_array($post_id, $article_pool)){
                if(count($article_pool) < 100){
                    $article_pool[] = intval($post_id); 
                } 
            }
            // Send update dynamo index for keyword
            $value_array = array('word' => $keyword, 'articles' => $article_pool);					
            $aws_response = $dynamo_db->put_item(array(
                    'TableName' => AWS_INDEX_TABLE, 
                    'Item' => $dynamo_db->attributes($value_array)
            ));
            $response['type'] = 'success';
        }else{
           $response['message'] = 'An error occured while connected to AWS';
        }        
    }

    # Delete item from queue
    $deleteMessageResponse = $sqs->delete_message($queue_url, $messageId);
    $response['data']['total_processed']++;
}


        
//include 'output_json.php';
?>
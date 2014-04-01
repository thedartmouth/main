<?php

/*
 * Cron to trigger the process_queue.php script
 *
 *
 */



// CURL
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, 'http://166.78.183.181/search/process_queue.php'); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($ch); 
curl_close($ch);  

?>
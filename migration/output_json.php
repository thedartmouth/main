<?php

/*
 * JSON outputter
 *
 * Takes $response array and outputs it as JSON
 *
 */

// Make sure required components of response array are set
$response = (isset($response) ? $response : array());
$response['type'] = (isset($response['type']) ? $response['type'] : 'fail');


// Send JSON headers
header("Cache-Control: no-cache, must-revalidate"); # Don't cache
header("Expires: Sat, 19 Jan 2013 00:00:00 GMT"); # Expired in the past
header('Content-type: application/json'); # JSON content


# Output the JSON
$response_content = array('response' => $response);
echo json_encode($response_content);
exit;
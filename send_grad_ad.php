<?php

if(!$_POST['submit']) die("0");

require_once 'configure.php';
require_once "dropbox-sdk/Dropbox/autoload.php";

// Set unique filename
$now = time();
while(file_exists($uploadFilename = $_POST['billingName'] .' for '.$_POST['studentName']))
{
    $now++;
}

// Upload image to dropbox
$dbxClient = new \Dropbox\Client(DROPBOX_TOKEN, "PHP-Example/1.0");
$f = fopen($_FILES['image']['tmp_name'], "rb");
$result = $dbxClient->uploadFile("/$uploadFilename", \Dropbox\WriteMode::add(), $f);
fclose($f);
$imageURL = $dbxClient->createShareableLink($result['path']);

// Add new row to spreadsheet
// Zend library include path
set_include_path(get_include_path() . PATH_SEPARATOR . "$_SERVER[DOCUMENT_ROOT]/ZendGdata-1.12.6/library");
include_once("includes/Google_Spreadsheet.php");
$ss = new Google_Spreadsheet(GDOCS_USERNAME, GDOCS_PASSWORD);

$ss->useSpreadsheet("graduation-ads");

// if not setting worksheet, "Sheet1" is assumed
// $ss->useWorksheet("worksheetName");

$row = array
(
    "Your Name" => $_POST['billingName']
    , "Your Email" => $_POST['billingEmail']
    , "Student's Name" => $_POST['studentName']
    , "Message" => $_POST['message']
    , "Image" => $imageURL
);

$ss->addRow($row);

// Send email
//define the receiver of the email
$to = 'publisher@thedartmouth.com';
//define the subject of the email
$subject = "[NEW GRAD AD] $uploadFilename";
//create a boundary string. It must be unique
//so we use the MD5 algorithm to generate a random hash
$random_hash = md5(date('r', time()));
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: thedartmouth@gmail.com\r\nReply-To: thedartmouth@gmail.com";
//add boundary string and mime type specification
$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";
//define the body of the message.
$message = $_POST['message'] . "\n\n\n\n". $imageURL;

//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );

?>

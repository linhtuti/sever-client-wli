<?php
require 'vendor/autoload.php';
require_once('/path/to/twilio-php/Services/Twilio.php');
header('Content-Type: text/xml');

$from     = $_REQUEST['From'];
$callee   = $_REQUEST['callee'];
$callerId = $_REQUEST['callerId'];
$digits   = $_REQUEST['Digits'];

# user chose their callee using <Gather>
if (isset($digits) && !$callee) {
    $callee = $_REQUEST[$digits];
}

$response = new Services_Twilio_Twiml();

if ($callee) {
#     $response->dial($callee, array('callerId'=>$callerId));

    $response->account->outgoing_caller_ids->create(callee, array(   
	'FriendlyName' => "841646540128+aqu" 
)); 
} 

print $response;
?>

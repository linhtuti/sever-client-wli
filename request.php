<?php
require 'vendor/autoload.php';
header('Content-type: application/json');
$accountSid = getenv('TWILIO_ACCOUNT_SID');
$authToken = getenv('TWILIO_AUTH_TOKEN');

$appSid = getenv('TWILIO_APP_SID');


$requestFunction = $_REQUEST['requestFunction'];
	$numberPhone = $_REQUEST['numberPhone'];

function ValidateNumber($numberPhone,$accountSid,$authToken){
	$client = new Services_Twilio($accountSid, $authToken);
	$response = $client->account->outgoing_caller_ids->create($numberPhone, array(   
	'FriendlyName' => "mathiu"));

	echo json_encode(array($numberPhone=>$accountSid, $authToken=>'shit'));
}

function getNumberValidated($accountSid, $authToken){	
	$client = new Services_Twilio($accountSid, $authToken);
	
	$callers = $client->account->outgoing_caller_ids->getIterator(0, 50, array()); 
 
	foreach ($callers as $caller_id) {
		$arrayObject[] = $caller_id->friendly_name;
	}
	echo json_encode(array('friendly_name'=>$arrayObject));
}

function getListRecord($numberPhone,$accountSid,$authToken){	
    $client = new Services_Twilio($accountSid, $authToken);
	$arrayObject = array();
    foreach($client->account->recordings as $recording) {
        $arrayObject[] = $recording->uri;
    }

	echo json_encode($arrayObject);
}



if($requestFunction == 'requestValid'){
	ValidateNumber($numberPhone,$accountSid,$authToken);
} else if($requestFunction == 'requestValidList'){
	getNumberValidated($accountSid, $authToken);
} else if($requestFunction == 'requestListRecord'){
	getListRecord($numberPhone,$accountSid,$authToken);
} 
?>

<?php
require 'vendor/autoload.php';
header('Content-type: application/json');
$accountSid = getenv('TWILIO_ACCOUNT_SID');
$authToken = getenv('TWILIO_AUTH_TOKEN');

$appSid = getenv('TWILIO_APP_SID');


$requestFunction = $_POST['requestFunction'];
	$numberPhone = $_POST['numberPhone'];

function ValidateNumber(){
//   $client = new Services_Twilio($accountSid, $authToken);
//	$response = $client->account->outgoing_caller_ids->create($numberPhone, array(   
//	'FriendlyName' => "mathiu"));



	echo json_encode(array('numberPhone'=>$numberPhone, 'numberPhone'=>'12357'));
}

function getNumberValidated(){	
	$client = new Services_Twilio($accountSid, $authToken);
	$arrayObject = array('numberPhone'=>$numberPhone);
	
	$callers = $client->account->outgoing_caller_ids->getIterator(0, 50, array()); 
 
	foreach ($callers as $caller_id) {
		$arrayObject[] = $caller_id->friendly_name;
	}
	echo json_encode($arrayObject);
}

function getListRecord(){	
    $client = new Services_Twilio($accountSid, $authToken);
	$arrayObject = array();
    foreach($client->account->recordings as $recording) {
        $arrayObject[] = $recording->uri;
    }

	echo json_encode($arrayObject);
}



if($requestFunction == 'requestValid'){
// 	ValidateNumber();
} else if($requestFunction == 'requestValidList'){
	getNumberValidated();
} else if($requestFunction == 'requestListRecord'){
	getListRecord();
}
	ValidateNumber();
?>

<?php
include_once('message/messageDB.php');
include_once('message/communication.php');

	if(!empty($_POST['number'])){
		echo "number: ".$_POST['number'];
		echo "   sms: ".$_POST['send_message'];
	}

	// if(!empty($_POST['received_message']) && $_POST['dbOps'] == "read message"){
	// 	$filterMessage = DBOperations::filterMessageDetails($_POST['received_message']);
	// 	DBOperations::sendMessageDetails($filterMessage);
	// }

	if(!empty($_POST['number']) && !empty($_POST['send_message'])){
		$mobileNumber = Communication::prepareNumber($_POST['number']);
		Communication::sendMessage($_POST['send_message'], $mobileNumber);
	}

	//DBOperations::receiveMessages("hgsr hjk", "94713535362"); //Supplier request message
	//DBOperations::displayMessageTable();
	//DBOperations::receiveTicketMachine("0001 20", "94713535362"); //ticket machine message
?>
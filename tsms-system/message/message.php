<!DOCTYPE html>
<html>
<head>
	<title>Message</title>
</head>
<body>
	<form method="post" action="">
		<label id="received_message">Received Message: </label>
		<textarea name="received_message" rows="4" cols="15"></textarea>
		<input type="submit" name="dbOps" value="read message">
		<br/><br/>

		<label id="to">to: </label>
		<input type="text" name="number" maxlength="10"></input><br/>
		<label id="write_message">Write Message: </label>
		<textarea name="send_message" rows="4" cols="15"></textarea>
		<input type="submit" name="send" value="send message">
		<br/><br/>

		<input type="submit" name="receive" value="Read Receive Messages">
	</form><br/>
</body>
</html>

<?php
	include_once('messageDB.php');
	include_once('communication.php');

	if(!empty($_POST['received_message']) && $_POST['dbOps'] == "read message"){
		$filterMessage = DBOperations::filterMessageDetails($_POST['received_message']);
		DBOperations::sendMessageDetails($filterMessage);
	}

	if(!empty($_POST['number']) && !empty($_POST['send_message']) && $_POST['send'] == "send message"){
		$mobileNumber = Communication::prepareNumber($_POST['number']);
		Communication::sendMessage($_POST['send_message'], $mobileNumber);
	}

	//DBOperations::receiveMessages("hgsr hjk", "94713535362"); //Supplier request message
	DBOperations::displayMessageTable();
	//DBOperations::receiveTicketMachine("0001 20", "94713535362"); //ticket machine message
?>
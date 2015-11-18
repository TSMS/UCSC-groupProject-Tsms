<?php

include_once("communication.php");

class DBOperations{

	private $servername = "localhost";
	private $dbname = "tsms";
	private $username = "root";
	private $password = "";
	




	//Below function is to filter message detaills to messagerCode, supplierCode, value and quantity from the text message
	/*
	Supplier should send messages according below conditions
	[*] advance:- 	supCode adv value
	[*] loan:-    	supCode lon value
	[*] fertilizer:-supCode fer quantity category
	[*] teapackets:-supCode tea quantity category
	[*] chemicals:-	supCode che quantity category
	*/
	public function filterMessageDetails($message){
		$prepare = explode(" ", $message);
		$messageDetails = null;
		$word = "";
		if(count($prepare)>1){
			$word = $prepare[1];
		}else if(count($prepare) == 1){
			$word = $prepare[0];
		}else{
			$word = "";
		}
		switch ($word) {
			case 'adv':
				if(DBOperations::isSupCodeValid($prepare[0])){
					if(is_int((int)$prepare[2])){
						$messageDetails = array("supplierCode"=>$prepare[0], "messageCode"=>$prepare[1],  "value"=>(int)$prepare[2]);
					}else{
						echo "<script> alert('Error Message!')</script>";
					}
				}else{
					echo "<script> alert('supplier does not exists!'); </script>";
				}
				break;
			
			case 'lon':
				if(DBOperations::isSupCodeValid($prepare[0])){
					if(is_int((int)$prepare[2])){
						$messageDetails = array("supplierCode"=>$prepare[0], "messageCode"=>$prepare[1],  "value"=>(int)$prepare[2]);
					}else{
						echo "<script> alert('Error Message!')</script>";
					}
				}else{
					echo "<script> alert('supplier does not exists!'); </script>";
				}
				break;

			case 'fer':
				if(DBOperations::isSupCodeValid($prepare[0])){
					if(is_int((int)$prepare[2])){
						$messageDetails = array("supplierCode"=>$prepare[0], "messageCode"=>$prepare[1],  "quantity"=>(int)$prepare[2], "category"=>$prepare[3]);
					}else{
						echo "<script> alert('Error Message!')</script>";
					}
				}else{
					echo "<script> alert('supplier does not exists!'); </script>";
				}
				break;

			case 'tea':
				if(DBOperations::isSupCodeValid($prepare[0])){
					if(is_int((int)$prepare[2])){
						$messageDetails = array("supplierCode"=>$prepare[0], "messageCode"=>$prepare[1],  "quantity"=>(int)$prepare[2], "category"=>$prepare[3]);
					}else{
						echo "<script> alert('Error Message!')</script>";
					}
				}else{
					echo "<script> alert('supplier does not exists!'); </script>";
				}
				break;

			case 'che':
				if(DBOperations::isSupCodeValid($prepare[0])){
					if(is_int((int)$prepare[2])){
						$messageDetails = array("supplierCode"=>$prepare[0], "messageCode"=>$prepare[1],  "quantity"=>(int)$prepare[2], "category"=>$prepare[3]);
					}else{
						echo "<script> alert('Error Message!')</script>";
					}
				}else{
					echo "<script> alert('supplier does not exists!'); </script>";
				}
				break;

			default:
				echo "<script> alert('Error Message!')</script>";
				break;
		}
		return $messageDetails;
	}





	//Below function check the supplier is a valid supplier
	public function isSupCodeValid($code){
		$dbOps = new DBOperations();
		try{
			$con = new mysqli($dbOps->servername, $dbOps->username, $dbOps->password, $dbOps->dbname); //create the db connection
			$query = "SELECT * FROM suppliers WHERE supplier_code = {$code}";
			$result = $con->query($query);
			if($result->num_rows > 0){
				return true;
			}else{
				return false;
			}
		}catch(mysqli_sql_exception $e){
			echo "In the isMessageValid: ".$e;
		}

	}





	//Below function is to send message details to the message temp table
	public function sendMessageDetails($message = array()){
		$dbOps = new DBOperations();
		$query = null;
		try{
			if(!empty($message)){
				$con = new mysqli($dbOps->servername, $dbOps->username, $dbOps->password, $dbOps->dbname); //create the db connection
				date_default_timezone_set('Asia/Colombo'); //set the time zone to Colombo time
				$dt = new DateTime(); //create DateTime object
				//create queries to send data
				if($message['messageCode'] == "adv"){
					$query = "INSERT INTO message_temp(message_code, supplier_code, value, date, time) VALUES ('".$message['messageCode']."', '".$message['supplierCode']."', '".$message['value']."', '".$dt->format('y-m-d')."', '".$dt->format('H:i:s')."') ";
				}else if($message['messageCode'] == "lon"){
					$query = "INSERT INTO message_temp(message_code, supplier_code, value, date, time) VALUES ('".$message['messageCode']."', '".$message['supplierCode']."', '".$message['value']."', '".$dt->format('y-m-d')."', '".$dt->format('H:i:s')."')";
				}else if($message['messageCode'] == "fer"){
					$query = "INSERT INTO message_temp(message_code, supplier_code, quantity, category, date, time) VALUES ('".$message['messageCode']."', '".$message['supplierCode']."', '".$message['quantity']."', '".$message['category']."', '".$dt->format('y-m-d')."', '".$dt->format('H:i:s')."')";
				}else if($message['messageCode'] == "tea"){
					$query = "INSERT INTO message_temp(message_code, supplier_code, quantity, category, date, time) VALUES ('".$message['messageCode']."', '".$message['supplierCode']."', '".$message['quantity']."', '".$message['category']."', '".$dt->format('y-m-d')."', '".$dt->format('H:i:s')."')";
				}else if($message['messageCode'] == "che"){
					$query = "INSERT INTO message_temp(message_code, supplier_code, quantity, category, date, time) VALUES ('".$message['messageCode']."', '".$message['supplierCode']."', '".$message['quantity']."', '".$message['category']."', '".$dt->format('y-m-d')."', '".$dt->format('H:i:s')."')";
				}

				if($con->connect_error){
					die("connection failed: ".$con->connect_error);
				}else{
					if($con->query($query) === TRUE){
						echo "<script> alert(\"New record entered successful!\") </script>";
					}else{
						echo "sendMessageDetails: ".$con->error;
					}
				}
			}
		}catch(mysqli_sql_exception $e){
			echo "In the sendMessageDetails: ".$e;
		}
	}





	//display message table
	public function displayMessageTable(){
		$dbOps = new DBOperations();
		$con = new mysqli($dbOps->servername, $dbOps->username, $dbOps->password, $dbOps->dbname); //create the db connection
		if($con->connect_error){
			die("connection failed: ".$con->connect_error);
		}else{
			$query = "SELECT * FROM message_temp INNER JOIN message_info ON message_temp.message_code = message_info.message_code INNER JOIN suppliers ON message_temp.supplier_code = suppliers.supplier_code ORDER BY date";
			$result = $con->query($query);
			//below part is for table head of tep_message table
			echo "<table border='1'>
			<tr>
			<th>Supplier Code</th>
			<th>Supplier Name</th>
			<th>Request Type</th>
			<th>Value</th>
			<th>Quantity</th>
			<th>Category</th>
			<th>Date</th>
			<th>Time</th>
			<th>Approve</th>
			</tr>";
			//below part load the data for temp_message
			while($row = mysqli_fetch_array($result)){
				echo "<tr>
				<tr>
				<td>".$row['supplier_code']."</td>
				<td>".$row['f_name']." ".$row['l_name']."</td>
				<td>".$row['request']."</td>
				<td>".$row['value']."</td>
				<td>".$row['quantity']."</td>
				<td>".$row['category']."</td>
				<td>".$row['date']."</td>
				<td>".$row['time']."</td>
				<td>".$row['approve']."</td>
				</tr>";	
			}
			echo "</table>";
		}
		mysqli_close($con);
	}







	//This function can get the replies *** this function should run infinitely
	public function receiveMessages($text, $phone){
		$dbOps = new DBOperations();
		$con = new mysqli($dbOps->servername, $dbOps->username, $dbOps->password, $dbOps->dbname); //create the db connection
		if($con->connect_error){
			die("connection failed: ".$con->connect_error);
		}else{
			$validMessages = 0;
			$invalidMessages = 0;
			$message = DBOperations::filterMessageDetails($text);

			if($message != null){
				$validMessages++;
				DBOperations::sendMessageDetails($message);

			}else{
				$invalidMessages++;
				$query = "INSERT INTO invalid_messages(phone_number, message) VALUES ('".$phone."', '".$text."')";
				if($con->connect_error){
					die("connection failed: ".$con->connect_error);
				}else{

					if($con->query($query) === TRUE){
						$returnMessage = "Your request was invalid!";
						Communication::sendMessage($returnMessage, $phone);
					}else{
						echo "receiveMessages: ".$con->error;
						echo "<script> alert(\"Message did not sent\") </script>";
					}
				}

			}

			$receiveMessages = array("valid"=>$validMessages, "invalid"=>$invalidMessages);
		}
		mysqli_close($con);
	}






	//This function use to check the supplier_code already exists in the today_supply table
	public function supplierCodeExists($code){
		$dbOps = new DBOperations();
		$con = new mysqli($dbOps->servername, $dbOps->username, $dbOps->password, $dbOps->dbname); //create the db connection
		if($con->connect_error){
			die("connection failed: ".$con->connect_error);
		}else{
			$query = "SELECT * FROM today_supply WHERE supplier_code = {$code}";
			$result = $con->query($query);
			if($result->num_rows > 0){
				return true;
			}else{
				return false;
			}
		}
	}






	//This function use to read ticket machines' messages
	/*
	[*] TICKET MACHINE MESSAGE CODE
	[*] supCode approvedKGs units supKGs
	*/
	public function receiveTicketMachine($message, $phone){

		$dbOps = new DBOperations();
		$con = new mysqli($dbOps->servername, $dbOps->username, $dbOps->password, $dbOps->dbname); //create the db connection
		$query = "";

		if($con->connect_error){
			die("connection failed: ".$con->connect_error);
		}else{

			//Get the suitable serial_number for phone_number from ticket_machine table
			$queryGetEditer = "SELECT * FROM ticket_machine WHERE phone_number = {$phone}";
			$result = $con->query($queryGetEditer);
			$editer = "";
			while($row = mysqli_fetch_array($result)){
				$editer = $row['serial_number'];
			}

			//set the time zone to Colombo time
			date_default_timezone_set('Asia/Colombo');
			$dt = new DateTime(); //create DateTime object

			$prepare = explode(" ", $message); // split the ticket machine into array

			//Example Code: supCode approvedKGs units suppliedKGs
			if(count($prepare) == 4){
				if(is_numeric($prepare[1]) && is_numeric($prepare[2]) && is_numeric($prepare[3])){		//check the approvedKGs units suppliedKGs are integers
					
					if(!supplierCodeExists($prepare[0])){
						//Example Code: supCode approvedKGs units suppliedKGs
						if(DBOperations::isSupCodeValid($prepare[0])){ 		//Check the supplier code valid or invalid
							$query = "INSERT INTO today_supply(supplier_code, date, approved_kgs, units, supplied_kgs, editer) VALUES ('".$prepare[0]."', '".$dt->format('y-m-d')."', '".$prepare[1]."', '".$prepare[2]."', '".$prepare[3]."', '".$editer."')";
							$con->query($query);
						}else{
							//If the supplier code invalid then send error message
							Communication::sendMessage("Supplier code is invalid !", $phone);
						}
					}else{
						//If the supplier code exists then send error message
						Communication::sendMessage("Supplier code is already exists the system !", $phone);
					}

					
				}else{
					//reply again to the ticket machine
					Communication::sendMessage("Sent message is invalid.", $phone);	
				}
				
			//Example Code: supCode approvedKGs suppliedKGs
			//Example Code: supCode approvedKGs units
			}else if(count($prepare) == 3){
				if(is_numeric($prepare[1]) && is_numeric($prepare[2])){	//check the integers as above

					if(!supplierCodeExists($prepare[0])){
						if($prepare[1] <= $prepare[2]){
							//Example Code: supCode approvedKGs suppliedKGs
							if(DBOperations::isSupCodeValid($prepare[0])){ 		//Check the supplier code valid or invalid
								$query = "INSERT INTO today_supply(supplier_code, date, approved_kgs, supplied_kgs, editer) VALUES ('".$prepare[0]."', '".$dt->format('y-m-d')."', '".$prepare[1]."', '".$prepare[2]."', '".$editer."')";
								$con->query($query);
							}else{
								//If the supplier code invalid then send error message
								Communication::sendMessage("Supplier code is invalid !", $phone);
							}

						}else{
							//Example Code: supCode approvedKGs units
							if(DBOperations::isSupCodeValid($prepare[0])){ 		//Check the supplier code valid or invalid
								$query = "INSERT INTO today_supply(supplier_code, date, approved_kgs, units, editer) VALUES ('".$prepare[0]."', '".$dt->format('y-m-d')."', '".$prepare[1]."', '".$prepare[2]."', '".$editer."')";
								$con->query($query);
							}else{
								//If the supplier code invalid then send error message
								Communication::sendMessage("Supplier code is invalid !", $phone);
							}
						}
					}else{
						//If the supplier code exists then send error message
						Communication::sendMessage("Supplier code is already exists the system !", $phone);
					}
					
				}else{
					//reply again to the ticket machine
					Communication::sendMessage("Sent message is invalid.", $phone);
				}

			//Example Code: supCode approvedKGs
			}else if(count($prepare) == 2){
				if(is_numeric($prepare[1])){

					if(!DBOperations::supplierCodeExists($prepare[0])){
						//Example Code: supCode approvedKGs
						if(DBOperations::isSupCodeValid($prepare[0])){ 		//Check the supplier code valid or invalid
							$query = "INSERT INTO today_supply(supplier_code, date, approved_kgs, editer) VALUES ('".$prepare[0]."', '".$dt->format('y-m-d')."', '".$prepare[1]."', '".$editer."')";
							$con->query($query);
						}else{
							//If the supplier code invalid then send error message
							Communication::sendMessage("Supplier code is invalid !", $phone);
						}
					}else{
						//If the supplier code exists then send error message
						Communication::sendMessage("Supplier code is already exists the system !", $phone);
					}
					
				}else{
					//reply again to the ticket machine
					Communication::sendMessage("Sent message is invalid.", $phone);
				}

			//Example Code: without above codes
			}else{
				//reply again to the ticket machine
				Communication::sendMessage("Sent message is invalid.", $phone);
			}
		}
	}
}
?>
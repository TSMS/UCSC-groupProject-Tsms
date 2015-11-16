<?php
	
	include_once('messageDB.php');

	class Communication{

		//This function prepare the mobile number in the correct way
		public function prepareNumber($localNumber){
			if(strlen($localNumber) == 10 && is_int((int)$localNumber) && $localNumber[0] == 0){
				$preparedNumber = str_replace($localNumber[0], "94", $localNumber);
				return $preparedNumber;

			}else if(strlen($localNumber) == 0){
				echo "<script> alert(\" Please enter a number ! \"); </script>";
			}else{
				echo "<script> alert(\" You entered invalid mobile number! \"); </script>";
			}
		}

		//This function can send messages to the suppliers
		public function sendMessage($message, $to){
			$user = "94713535362";//In here, should gives a registered number of textit.biz site(My number 94713535362)
			$password = "4504"; //password 4504
			$text = urlencode($message);
			//$to = "94713535362";//94712097337 malith

			//echo "$text<br/>";
			$baseurl ="http://www.textit.biz/sendmsg";
			$url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text&url=www.mytsms.x10host.com/msgTesting.php";

			$ret = file($url);

			$res= explode(":",$ret[0]);

			if (trim($res[0])=="OK")
			{
				//echo "Message Sent - ID : ".$res[1];
				echo "<script> alert(\"Message sent successfullly!\")</script>";
			}else{
				//echo "Sent Failed - Error : ".$res[1];
				echo "<script> alert(\"Error Occurred!\")</script>";
			}
		}

		//This function can get the replies
		public function receiveMessages(){
			$validMessages = 0;
			$invalidMessages = 0;
			
		}
		
	}
?>
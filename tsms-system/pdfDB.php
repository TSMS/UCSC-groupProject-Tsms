<?php

	include_once("bill.php");
	
	class PDFDBOperations{

		private $servername = "localhost";
		private $dbname = "tsms";
		private $username = "root";
		private $password = "";

		//get the values from the monthly_bill table and supplier table according to the input supplier code parameter
		public function getValues($pdf, $code, $unformatedDate){//$unformateddate="2016-01";
			$dbOps = new PDFDBOperations();
			$startDate="'".$unformatedDate."-01'";
			$endDate="'".$unformatedDate."-31'";
			if($code==""){//get data for all suppliers
				try{
					$con = new mysqli($dbOps->servername, $dbOps->username, $dbOps->password, $dbOps->dbname);
					$query = "SELECT * FROM monthly_bill INNER JOIN suppliers ON suppliers.supplier_code = monthly_bill.supp_code WHERE date BETWEEN {$startDate} AND {$endDate}";
					$result = $con->query($query);
					while($row = mysqli_fetch_array($result)){
						PDF::createPage($pdf, $row);
					}
				}catch(mysqli_sql_exception $e){
					echo "getValues : ".$e;
				}
			}else{//get data for perticular supplier
				try{
					$con = new mysqli($dbOps->servername, $dbOps->username, $dbOps->password, $dbOps->dbname);
					$query = "SELECT * FROM monthly_bill INNER JOIN suppliers ON suppliers.supplier_code = monthly_bill.supp_code WHERE supp_code = {$code} AND date BETWEEN {$startDate} AND {$endDate}";
					$result = $con->query($query);
					while($row = mysqli_fetch_array($result)){
						PDF::createPage($pdf, $row);
					}
				}catch(mysqli_sql_exception $e){
					echo "getValues : ".$e;
				}
			}				
		}

		//check the supplier code valid or invalid from the supplier table
		public function isSupCodeValid($code){
			$dbOps = new PDFDBOperations();
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

		//check the supplier code exists the monthly_bill table
		public function isExists($code){
			$dbOps = new PDFDBOperations();
			try{
				$con = new mysqli($dbOps->servername, $dbOps->username, $dbOps->password, $dbOps->dbname); //create the db connection
				$query = "SELECT * FROM monthly_bill WHERE supp_code = {$code}";
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
	}
?>
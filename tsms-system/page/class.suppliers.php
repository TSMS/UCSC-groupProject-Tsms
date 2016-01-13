<?php

require_once '../DB/dbconfig.php';

class Supplier
{	
	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
	}

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function register($supcode,$fname,$lname,$addr,$nic,$mobile,$email,$editor)
	{
		try
		{							
			$stmt = $this->conn->prepare("INSERT INTO suppliers(supplier_code,f_name,l_name,address_1,nic_no,mobile_no,e_mail,joined,last_edit_date,editor) 
			                                            VALUES(:supp_code,:first_name,:last_name,:address,:nic,:mobile,:email,NOW(),NOW(),:editor)");
			$stmt->bindparam(":supp_code",$supcode);
			$stmt->bindparam(":first_name",$fname);
			$stmt->bindparam(":last_name",$lname);
			$stmt->bindparam(":address",$addr);
			$stmt->bindparam(":nic", $nic);
			$stmt->bindparam(":mobile", $mobile);
			$stmt->bindparam(":email", $email);
			$stmt->bindparam(":editor", $editor);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	function getmytodaysupply($code){
		$sql= "SELECT * FROM `today_supply` WHERE supplier_code = $code";
		$getdata = Supplier::runQuery($sql);
		$getdata->execute();
		$todaysupply = 0;
		if(!empty($code)){
		  if($getdata->rowCount() > 0)
		  {
			while($row=$getdata->FETCH(PDO::FETCH_ASSOC))
			{
			  return $row['approved_kgs'];
			}
		  }else{
			  return 0;
		  }
		  
		}
	}
	function sendmessagetosys($supplier_code,$message_code,$value,$quantity,$category){
		
		try
		{							
			$stmt = $this->conn->prepare("INSERT INTO `message_temp`(`supplier_code`, `message_code`, `value`, `quantity`, `category`, `date`, `time`, `approve`) VALUES
		
			(:supp_code,:message_code,:value,:quantity,:category,CURDATE(),CURTIME(),0)");
			$stmt->bindparam(":supp_code",$supplier_code);
			$stmt->bindparam(":message_code",$message_code);
			$stmt->bindparam(":value",$value);
			$stmt->bindparam(":quantity",$quantity);
			$stmt->bindparam(":category", $category);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
		
	}
	
	function myTotalSupplyOf6Months($code){//to get total supply for perticular supplier in LAST 6 months
		$resarr=array();
		$curyear=substr($formateddate,0,4);
		$curmonth=substr($formateddate,5,7);
		$lstrunningmonth=substr($formateddate,5,7);
		for($i=1;$i<7;$i++){
			$lstrunningmonth=$curmonth-$i;
			$m=($curmonth-$i);
			if($lstrunningmonth=="0"){
				$curyear=$curyear-1;
				$m=(12+($curmonth-$i));
			}			
			if($lstrunningmonth<0){
				$m=(12+($curmonth-$i));
			}
			if(strlen($m)==1){
				$m="0".$m;
			}
			$startday=$curyear."-".$m."-01"; 
			$enddate=$curyear."-".$m."-31";
			
			$condition="SELECT *FROM daily_supply WHERE supplier_code='".$code."' AND date BETWEEN '".$startday."' AND '".$enddate."'";
			$getdata = Supplier::runQuery($sql);
			$getdata->execute();
			
			$total=0;		
			if($getdata->rowCount() > 0){
				while($row=$getdata->FETCH(PDO::FETCH_ASSOC)){
					$total=$total+$row['approved_kgs'];
				}
				$resarr[$i-1]=$total;
			}else{
				$resarr[$i-1]=0;
			}		
		}
		return $resarr;		
	}
	
	
	
	
	
	
}

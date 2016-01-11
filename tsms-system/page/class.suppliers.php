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
}
<?php

require_once 'DB/dbconfig.php';

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

	public function register($supcode,$fname,$lname,$addr,$editor)
	{
		try
		{							
			$stmt = $this->conn->prepare("INSERT INTO suppliers(supplier_code,f_name,l_name,address_1,joined,editor) 
			                                         VALUES(:supp_code,:first_name,:last_name,:address,NOW(),:editor)");
			$stmt->bindparam(":supp_code",$supcode);
			$stmt->bindparam(":first_name",$fname);
			$stmt->bindparam(":last_name",$lname);
			$stmt->bindparam(":address",$addr);
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
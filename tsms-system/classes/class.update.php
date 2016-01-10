<?php

require_once 'DB/dbconfig.php';

class Update
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

	public function addrecord($supcode,$appkgs,$supkgs,$unit,$editor)
	{
		try
		{							
			$stmt = $this->conn->prepare("INSERT INTO today_supply(supplier_code,date,approved_kgs,supplied_kgs,units,editer) 
			                                            VALUES(:supp_code,NOW(),:appkgs,:supkgs,:unit,:editor)");
			$stmt->bindparam(":supp_code",$supcode);
			$stmt->bindparam(":appkgs",$appkgs);
			$stmt->bindparam(":supkgs",$supkgs);
			$stmt->bindparam(":unit",$unit);
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
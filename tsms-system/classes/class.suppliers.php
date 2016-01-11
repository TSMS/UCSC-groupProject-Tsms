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

	public function register($scode, $fname, $lname, $nic, $iCheck, $email, $address_1, $mobile, $estate, $estate_name, 
    $reg_no, $size_of_estate, $estate_address, $bankn, $branch, $account, $bankacc, $editor)
	{
		try
		{	
			$password = md5($nic);						
			$stmt = $this->conn->prepare("INSERT INTO suppliers(supplier_code, f_name, l_name, address_1, nic_no,
				mobile_no, e_mail, joined, gender, estate_name, reg_no, size_of_estate, address_of_estate, account_name, 
				account_no, bank, branch, last_edit_date, editor, user_pass) 
			    VALUES(:supp_code, :first_name, :last_name, :address, :nic, :mobile, :email, NOW(), :gender, :estate_name, 
			    	:reg_no, :size_of_estate, :estate_address, :account, :bankacc, :bankn, :branch, NOW(), :editor,:user_pass)");
			$stmt->bindparam(":supp_code",$scode);
			$stmt->bindparam(":first_name",$fname);
			$stmt->bindparam(":last_name",$lname);
			$stmt->bindparam(":address",$address_1);
			$stmt->bindparam(":nic", $nic);
			$stmt->bindparam(":mobile", $mobile);
			$stmt->bindparam(":email", $email);
			$stmt->bindparam(":gender", $iCheck);
			$stmt->bindparam(":estate_name", $estate_name);
			$stmt->bindparam(":reg_no", $reg_no);
			$stmt->bindparam(":size_of_estate", $size_of_estate);
			$stmt->bindparam(":estate_address", $estate_address);
			$stmt->bindparam(":account", $account);
			$stmt->bindparam(":bankacc", $bankacc);
			$stmt->bindparam(":bankn", $bankn);
			$stmt->bindparam(":branch", $branch);
			$stmt->bindparam(":editor", $editor);
			$stmt->bindparam(":user_pass",$password);
			$stmt->execute();	
			return $stmt;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
}
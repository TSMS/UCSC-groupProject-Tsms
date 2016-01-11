<?php
//all functions are written and tested by malith dilshan 19/10/2015. don't change the content.
include_once("dbconfig.php"); 

class DBmain{

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function arraytostr($arr=array()){//convert array to a single string(for database fields) separate with ,---,---
		$str="";
		foreach($arr as $param){
            $str=$str.$param.",";
        }	
		return (substr($str,0,(strlen($str)-1)));
	}
	public function arraytostr2($arr=array()){//convert array to a single string(for data) separate with ,"---","----",
		$str="";
		foreach($arr as $param){
            $str=$str."'".$param."',";
        }	
		return (substr($str,0,(strlen($str)-1)));
	}
	public function mixingforupdatequery($data=array(),$fields=array()){//convert 2 arrays to single string according to mysql update syntax
		$str="";
		$index=0;
		foreach($data as $d){
			$str=$str." ".$fields[$index]."='".$d."',";
			$index++;
		}
		return (substr($str,0,(strlen($str)-1)));
	}
	
	
	
	public function checkDataExist($tablename,$condition){
		
		$query="SELECT * FROM ".$tablename.$condition;
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				return true;
			}
			return false;
		}catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	public function selectData($tablename,$selectrows=array(),$condition){//select Data
			
		$selectrowsstr=DBmain::arraytostr($selectrows);
		$query="SELECT ".$selectrowsstr." FROM ".$tablename." ".$condition;
		try {
			// set the PDO error mode to exception
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			$arr=array();//create outer array
			if($stmt->rowCount() > 0){
				$count=0;
				while($row=$stmt->fetch(PDO::FETCH_ASSOC)){					
					$arr[$count]=$row;//inner associative array ($row) is emberd to outer array
					$count++;	
				}
			}
			return $arr;
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	public function selectAllData($tablename,$fullcondition){//select all data
		
		$query="SELECT * FROM ".$tablename." ".$fullcondition;
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			$arr=array();//create outer array
			if($stmt->rowCount() > 0){
				$count=0;
				while($row=$stmt->fetch(PDO::FETCH_ASSOC)){					
					$arr[$count]=$row;//inner associative array ($row) is emberd to outer array
					$count++;	
				}
			}
			return $arr;
		}catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	public function edit($tablename,$datafields=array(),$tablefields=array(),$condition){//edit data
	
		
		$set=DBmain::mixingforupdatequery($datafields,$tablefields);
		try {
			$sql = "UPDATE ".$tablename." SET ".$set." ".$condition."";
			// use exec() because no results are returned
			$this->conn->exec($sql);
		}catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
		}
		$conn = null;
	}
	public function insert($tablename,$datafields=array(),$tablefields=array()){//insert data
	
		$datafld=DBmain::arraytostr2($datafields);//convert array to a single string separate with ","
		$tablefld=DBmain::arraytostr($tablefields);
		try {
			$sql = "INSERT INTO ".$tablename." (".$tablefld.") VALUES (".$datafld.")";
			// use exec() because no results are returned
			
			$this->conn->exec($sql);
			return true;
		}catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			return false;
		}
		
		$conn = null;
	}
	public function delete($tablename,$condition){//delete data
		
		try {
			$sql = "DELETE FROM ".$tablename." WHERE (".$condition.")";
			// use exec() because no results are returned
			$this->conn->exec($sql);
			return true;
		}catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			return false;
		}
		
		$conn = null;
		
	}
	
	public function procedure($query){//select all data
		
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute();

			return $res;
		}catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	public function selectDataCommen($query){//select Data
		
		$selectrowsstr=DBmain::arraytostr($selectrows);
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute();

			// set the resulting array to associative
			//$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$arr=array();//create outer array
			if($stmt->rowCount() > 0){
				$count=0;
				while($row=$stmt->fetch(PDO::FETCH_ASSOC)){					
					$arr[$count]=$row;//inner associative array ($row) is emberd to outer array
					$count++;	
				}
			}
			return $arr;
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	
}
?> 
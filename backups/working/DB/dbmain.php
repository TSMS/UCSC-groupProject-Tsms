<?php
//all functions are written and tested by malith dilshan 19/10/2015. don't change the content.
include_once("dbconfig.php"); 

class DBmain{	
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
		$dbconfig = new DBconfig;		
		$host=$dbconfig->host();
		$user=$dbconfig->username();
		$pwd=$dbconfig->pwd();
		$db=$dbconfig->db();
		
		$query="SELECT * FROM ".$tablename.$condition;
		try {
			$conn = new PDO("mysql:host=$host;dbname=$db",$user,$pwd);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare($query);
			$res=$stmt->execute();
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
	
		$dbconfig = new DBconfig;		
		$host=$dbconfig->host();
		$user=$dbconfig->username();
		$pwd=$dbconfig->pwd();
		$db=$dbconfig->db();
		
		$selectrowsstr=DBmain::arraytostr($selectrows);
		$query="SELECT ".$selectrowsstr." FROM ".$tablename." ".$condition;
		try {
			$conn = new PDO("mysql:host=$host;dbname=$db",$user,$pwd);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare($query);
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
	public function selectAllData($tablename,$fullcondition){//select all data
	
		$dbconfig = new DBconfig;		
		$host=$dbconfig->host();
		$user=$dbconfig->username();
		$pwd=$dbconfig->pwd();
		$db=$dbconfig->db();
		
		$query="SELECT * FROM ".$tablename." ".$fullcondition;
		try {
			$conn = new PDO("mysql:host=$host;dbname=$db",$user,$pwd);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare($query);
			$res=$stmt->execute();
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
	
		$dbconfig = new DBconfig;		
		$host=$dbconfig->host();
		$user=$dbconfig->username();
		$pwd=$dbconfig->pwd();
		$db=$dbconfig->db();
		
		$set=DBmain::mixingforupdatequery($datafields,$tablefields);
		try {
			$conn = new PDO("mysql:host=$host;dbname=$db",$user,$pwd);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE ".$tablename." SET ".$set." WHERE ".$condition."";
			// use exec() because no results are returned
			$conn->exec($sql);
		}catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
		}
		$conn = null;
	}
	public function insert($tablename,$datafields=array(),$tablefields=array()){//insert data
	
		$dbconfig = new DBconfig;		
		$host=$dbconfig->host();
		$user=$dbconfig->username();
		$pwd=$dbconfig->pwd();
		$db=$dbconfig->db();
		
		$datafld=DBmain::arraytostr2($datafields);//convert array to a single string separate with ","
		$tablefld=DBmain::arraytostr($tablefields);
		try {
			$conn = new PDO("mysql:host=$host;dbname=$db",$user,$pwd);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO ".$tablename." (".$tablefld.") VALUES (".$datafld.")";
			// use exec() because no results are returned
			$conn->exec($sql);
			return true;
		}catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			return false;
		}
		
		$conn = null;
	}
	public function delete($tablename,$condition){//delete data
	
		$dbconfig = new DBconfig;		
		$host=$dbconfig->host();
		$user=$dbconfig->username();
		$pwd=$dbconfig->pwd();
		$db=$dbconfig->db();
		
		try {
			$conn = new PDO("mysql:host=$host;dbname=$db",$user,$pwd);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM ".$tablename." WHERE (".$condition.")";
			// use exec() because no results are returned
			$conn->exec($sql);
			return true;
		}catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			return false;
		}
		
		$conn = null;
		
	}
}
?> 
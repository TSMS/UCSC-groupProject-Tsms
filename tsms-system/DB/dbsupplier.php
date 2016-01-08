<?php
include("dbmain.php");
//all functions are written and tested by malith dilshan 19/10/2015. don't change the content. please use below format to parse parameters

//addSupplier(array("0005","m","d","a1","a2","a3","93231","0712","011","md@","","rubber","1","2","3","a na","a no","bnk","brch","0","1","05/06/2015","admin"));
//editSupplier(array("malith","dilshan"),array("f_name","l_name"),"0005")
//deleteSupplier("0005");
//getBasicSupData("0001");
//getAllSupplierData();


class DBSupplier{
	function checkSupplierExist($supcode){
		$dbmain = new DBmain();
		$condition=" WHERE supplier_code='".$supcode."'";
		$boolres=$dbmain->checkDataExist("suppliers",$condition);
		if($boolres==true){
			return true;
		}else{
			return false;
		}
	}
	function getSupplierName($supplierCode){
		$dbmain = new DBmain();
		$condition="WHERE supplier_code='".$supplierCode."'";
		$res=$dbmain->selectData("suppliers",array("f_name","l_name"),$condition);
		if(count($res) ==1){
			foreach($res as $r){					
				$fullname= $r['f_name']." ".$r['l_name'];		
			}
			return $fullname;
		}elseif(count($res) > 1){
			return (count($res)."suppliers exist");
		}else{
			return "supplier doesn't exist";
		}
		
	}
	function addSupplier($datafields){
		$dbmain = new DBmain();
		$arrfields=array('supplier_code', 'f_name', 'l_name', 'address_1', 'address_2', 'address_3', 'nic_no', 'mobile_no', 'phone_no', 'e_mail', 'birth_day', 'estate_name', 'reg_no', 'size_of_estate', 'address_of_estate', 'account_name', 'account_no', 'bank', 'branch', 'e_mail_send', 'sms_send', 'last_edit_date', 'editor');
		$boolres=$dbmain->insert("suppliers",$datafields,$arrfields);
		if($boolres==true){
			return true;
		}else{
			return false;
		}
	}
	function deleteSupplier($supcode){
		$dbmain = new DBmain();
		$condition="supplier_code='".$supcode."'";
		$boolres=$dbmain->delete("suppliers",$condition);
		if($boolres==true){
			return true;
		}else{
			return false;
		}
		
	}
	function editSupplier($datafields,$tablefields,$supcode){
		$dbmain = new DBmain();
		$condition="supplier_code='".$supcode."'";
		$boolres=$dbmain->edit("suppliers",$datafields,$tablefields,$condition);
		if($boolres==true){
			return true;
		}else{
			return false;
		}
	}
	
	function getBasicSupData($supcode){
		$dbmain = new DBmain();
		$condition="WHERE supplier_code='".$supcode."'";
		$res=$dbmain->selectData("suppliers",array("f_name","l_name","address_1","address_2","address_3","nic_no"),$condition);
		if(count($res)==1){
			foreach($res as $r){
				//print_r($r);
				return $r;		
			}
		}
	}
	
	
	
	function getAllSupplierDataUserView(){
		$dbmain = new DBmain();
		$query='SELECT suppliers.supplier_code, suppliers.f_name, suppliers.l_name,
		suppliers.address_1, suppliers.address_2, suppliers.address_3, suppliers.nic_no, 
		suppliers.mobile_no, suppliers.e_mail, suppliers.joined, suppliers.gender, suppliers.estate_name, 
		suppliers.reg_no, suppliers.size_of_estate, suppliers.address_of_estate, suppliers.account_name, suppliers.account_no, 
		suppliers.bank, suppliers.branch, suppliers.e_mail_send, suppliers.sms_send, suppliers.last_edit_date, users.username 
		FROM users,suppliers WHERE users.id=suppliers.editor';
		$res=$dbmain->selectDataCommen($query);
		if(count($res) ==1){
			foreach($res as $r){					
				$fullname= $r['f_name']." ".$r['l_name'];		
			}
			return $fullname;
		}elseif(count($res) > 1){
			return (count($res)."suppliers exist");
		}else{
			return "supplier doesn't exist";
		}
		
		
		return $res;
	}
	
	function getAllSupplierDataAdminView(){
		$dbmain = new DBmain();
		$query='
		SELECT suppliers.supplier_code, suppliers.f_name, suppliers.l_name,
		suppliers.address_1, suppliers.address_2, suppliers.address_3, suppliers.nic_no, 
		suppliers.mobile_no, suppliers.e_mail, suppliers.joined, suppliers.gender, suppliers.estate_name, 
		suppliers.reg_no, suppliers.size_of_estate, suppliers.address_of_estate, suppliers.account_name, suppliers.account_no, 
		suppliers.bank, suppliers.branch, suppliers.e_mail_send, suppliers.sms_send, suppliers.last_edit_date 
		FROM suppliers';		
		$res=$dbmain->selectDataCommen($query);
		if(count($res) ==1){
			foreach($res as $r){					
				$fullname= $r['f_name']." ".$r['l_name'];		
			}
			return $fullname;
		}elseif(count($res) > 1){
			return (count($res)."suppliers exist");
		}else{
			return "supplier doesn't exist";
		}
		
		
		return $res;
	} 
	
	
	
	
	
	
	
	
	
	
	
	//*****to edit in your choise
	function getSuppliersToTble(){
		$dbmain = new DBmain();
		$res=$dbmain->selectAllData("suppliers","LIMIT 0,25");
		foreach($res as $r){					
			echo $r['f_name'];		
		}
	}
	
}
?> 
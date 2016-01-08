<?php
include("dbmain.php");
//all functions are written and tested by malith dilshan 19/10/2015. don't change the content. please use below format to parse parameters

	function todayAllSupply(){
		$dbmain = new DBmain();
		$res=$dbmain->procedure("CALL total_supply_of_today();");
		if(count($res) > 0){
			//return $res;			
		}else{
			return 0;
		}		
	}
	
	
	
	
	
	function addTodaySupply($datafields){
		$dbmain = new DBmain();
		$arrfields=array("date", "supplier_code", "approved_kgs", "supplied_kgs", "units", "editor");
		$boolres=$dbmain->insert("today_supply",$datafields,$arrfields);
		if($boolres==true){
			return true;
		}else{
			return false;
		}
	}
	function deleteTodaySupply($supcode){
		$dbmain = new DBmain();
		$condition="supplier_code='".$supcode."'";
		$boolres=$dbmain->delete("today_supply",$condition);
		if($boolres==true){
			return true;
		}else{
			return false;
		}
	}
	function editTodaySupply($datafields,$tablefields,$supcode){
		$dbmain = new DBmain();
		$condition="supplier_code='".$supcode."'";
		$boolres=$dbmain->edit("today_supply",$datafields,$tablefields,$condition);
		if($boolres==true){
			return true;
		}else{
			return false;
		}
	}
		
	function getTodayAllSupply(){
		$dbmain = new DBmain();
		$res=$dbmain->selectAllData("today_supply");		
		return $res;
	}
	function getTodayTotalSupply(){
		$dbmain = new DBmain();
		$res=$dbmain->selectData("today_supply",array("approved_kgs")," ");
		$total=0;
		if(count($res) > 0){
			foreach($res as $r){					
				$total=$total + $r['approved_kgs'];		
			}
			return $total;
		}		
	}
	//*****to edit in your choise
	function getTodayAllSupplyToTble(){
		$dbmain = new DBmain();
		$res=$dbmain->selectAllData("today_supply");
		foreach($res as $r){					
			echo $r['f_name'];		
		}
	}
	
echo(todayAllSupply());
?> 
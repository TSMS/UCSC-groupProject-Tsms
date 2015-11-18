<?php
include("dbmain.php");
//all functions are written and tested by malith dilshan 19/10/2015. don't change the content. please use below format to parse parameters
//myTotalSupplyOfaMonth("0001","2015-02-19");	
class DBDailySupply{
	function checkBeforeSupplied($supcode){
		$dbmain = new DBmain();
		$condition=" WHERE supplier_code='".$supcode."'";
		$boolres=$dbmain->checkDataExist("daily_supply",$condition);
		if($boolres==true){
			return true;
		}else{
			return false;
		}
	}
//******basic add,edit,delete******
	function addToDailySupply($datafields){
		$dbmain = new DBmain();
		$arrfields=array("date", "supplier_code", "approved_kgs", "supplied_kgs", "units", "editor","approved_by","last_editor","last_edit_date");
		$boolres=$dbmain->insert("daily_supply",$datafields,$arrfields);
		if($boolres==true){
			return true;
		}else{
			return false;
		}
	}
	function editDailySupply($datafields,$tablefields,$supcode,$date){
		$dbmain = new DBmain();
		$condition="supplier_code='".$supcode."' AND date='".$date."'";
		$boolres=$dbmain->edit("daily_supply",$datafields,$tablefields,$condition);
		if($boolres==true){
			return true;
		}else{
			return false;
		}
	}
	function deleteDailySupply($supcode,$date){
		$dbmain = new DBmain();
		$condition="supplier_code='".$supcode."' AND date='".$date."'";
		$boolres=$dbmain->delete("daily_supply",$condition);
		if($boolres==true){
			return true;
		}else{
			return false;
		}
	}
	
//******data as totals value******
	
	function myThisMonthTotalSupply($supcode,$todaydate){//to get this month total supply for perticular supplier
		$dbmain = new DBmain();
		$startday=substr($todaydate,0,7)."-01";       // like "2015-10-01"
		$condition=" WHERE supplier_code='".$supcode."' AND date >= '".$startday."'";
		$res=$dbmain->selectData("daily_supply",array("approved_kgs"),$condition);
		$total=0;
		if(count($res) > 0){
			foreach($res as $r){					
				$total=$total+$r['approved_kgs'];	
			}
			return $total;
		}else{
			return $total;
		}
	}
	function myTotalSupplyOfaMonth($supcode,$formateddate){//to get total supply for perticular supplier in perticular month
		$dbmain = new DBmain();
		$startday=substr($formateddate,0,7)."-01"; 
		$enddate=substr($formateddate,0,7)."-31";
		$condition=" WHERE supplier_code='".$supcode."' AND date BETWEEN '".$startday."' AND '".$enddate."'";
		$res=$dbmain->selectData("daily_supply",array("approved_kgs"),$condition);
		$total=0;
		if(count($res) > 0){
			foreach($res as $r){					
				$total=$total+$r['approved_kgs'];
			}
			return $total;
		}else{
			return $total;
		}
	}
	function myTotalSupplyOf6Months($supcode){//to get total supply for perticular supplier in LAST 6 months
		$dbmain = new DBmain();
		$formateddate=date("Y-m-d");
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
			
			$condition=" WHERE supplier_code='".$supcode."' AND date BETWEEN '".$startday."' AND '".$enddate."'";
			$res=$dbmain->selectData("daily_supply",array("approved_kgs"),$condition);
			$total=0;
			if(count($res) > 0){
				foreach($res as $r){					
					$total=$total+$r['approved_kgs'];
				}
				$resarr[$i-1]=$total;
			}else{
				$resarr[$i-1]=0;
			}
		}
		return $resarr;		
	}
	function factoryTotalSupplyOfaMonth($formateddate){//to get total supply for factory in perticular month
		$dbmain = new DBmain();
		$startday=substr($formateddate,0,7)."-01"; 
		$enddate=substr($formateddate,0,7)."-31";
		$condition=" date BETWEEN '".$startday."' AND '".$enddate."'";
		$res=$dbmain->selectData("daily_supply",array("approved_kgs"),$condition);
		$total=0;
		if(count($res) > 0){
			foreach($res as $r){					
				$total=$total+$r['approved_kgs'];
			}
			return $total;
		}else{
			return $total;
		}
	}
//******data for views(for tables)*******
	function getDailyAllSupply(){
		$dbmain = new DBmain();
		$res=$dbmain->selectAllData("daily_supply");		
		return $res;
	}
	function getMonthlyMySupply($supcode){//pending
		$dbmain = new DBmain();
		$condition=" WHERE supplier_code='".$supcode."' ";
		$res=$dbmain->selectData("daily_supply",array("approved_kgs"),$condition);
		if(count($res) > 0){
			foreach($res as $r){					
				$total=$r['approved_kgs'];
				return $total;
			}			
		}else{
			return 0;
		}		
	}	
	
	function getThisMonthTotalSupply(){
		$dbmain = new DBmain();
		$res=$dbmain->selectData("daily_supply",array("approved_kgs")," ");
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
		$res=$dbmain->selectAllData("daily_supply");
		foreach($res as $r){					
			echo $r['f_name'];		
		}
	}

}
?> 
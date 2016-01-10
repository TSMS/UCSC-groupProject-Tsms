<?php
include("dbmain.php");
//all functions are written and tested by malith dilshan 19/10/2015. don't change the content. please use below format to parse parameters
class DBupdates{
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
			return (count($res)."more suppliers exist");
		}else{
			return "supplier doesn't exist";
		}		
	}
	function getMyNIC($supplierCode){
		$dbmain = new DBmain();
		$condition="WHERE supplier_code='".$supplierCode."'";
		$res=$dbmain->selectData("suppliers",array("nic_no"),$condition);
		if(count($res) ==1){
			foreach($res as $r){					
				$fullname= $r['nic_no'];		
			}
			return $fullname;
		}elseif(count($res) > 1){
			return (count($res)."suppliers exist");
		}else{
			return "supplier doesn't exist";
		}		
	}
	function getTodayMySupply($supcode){
		$dbmain = new DBmain();
		$condition=" WHERE supplier_code='".$supcode."'";
		$res=$dbmain->selectData("today_supply",array("approved_kgs"),$condition);
		if(count($res) > 0){
			foreach($res as $r){					
				$total=$r['approved_kgs'];
				return $total;
			}			
		}else{
			return 0;
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
	function thisMonthPayForMe($supcode){
		$dbmain = new DBmain();
		$formateddate=date('Y-m-d');
		$startday=substr($formateddate,0,7)."-01"; 
		$enddate=substr($formateddate,0,7)."-31";
		$condition=" WHERE supp_code='".$supcode."' AND date BETWEEN '".$startday."' AND '".$enddate."'";
		$res=$dbmain->selectData("service",array("total_amount"),$condition);
		$total=0;
		if(count($res) > 0){
			foreach($res as $r){					
				$total=$total+$r['total_amount'];
			}
			return $total;
		}else{
			return $total;
		}
	}
	
	function todayPayForMe($supcode){
		$dbmain = new DBmain();
		$formateddate=date('Y-m-d');
		$startday=substr($formateddate,0,7)."-01"; 
		$enddate=substr($formateddate,0,7)."-31";
		$condition=" WHERE sup_code='".$supcode."' AND date BETWEEN '".$startday."' AND '".$enddate."'";
		$res=$dbmain->selectData("today_service",array("total_amount"),$condition);
		$total=0;
		if(count($res) > 0){
			foreach($res as $r){					
				$total=$total+$r['total_amount'];
			}
			return $total;
		}else{
			return $total;
		}
	}
	function thisMonthTeaRate(){
		$dbmain = new DBmain();
		$formateddate=date('Y-m-d');
		$startday=substr($formateddate,0,7)."-01"; 
		$enddate=substr($formateddate,0,7)."-31";

		$condition=" WHERE date BETWEEN '".$startday."' AND '".$enddate."'";
		$res=$dbmain->selectData("settings",array("approxi_tea_rate","fixed_tea_rate"),$condition);
		
		if(count($res) ==1){
			foreach($res as $r){					
				$approx= $r['approxi_tea_rate'];
				$real= $r['fixed_tea_rate'];	
				if($real != NULL || $real != 0){
					return $real;
				}else{
					return $approx;
				}
			}
		}elseif(count($res) > 1){
			$approx= "";
			$real= "";
			foreach($res as $r){					
				$approx= $r['approxi_tea_rate'];
				$real= $r['fixed_tea_rate'];	
			}
			return $real;
		}else{
			return 0;
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




	
}
?> 










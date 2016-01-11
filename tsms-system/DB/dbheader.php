<?php
include("dbmain.php");
//all functions are written and tested by malith dilshan 19/10/2015. don't change the content. please use below format to parse parameters

class DBheader{
		
	function getDashboardTeaRate(){
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
			return "Not Inserted";
		}		
	}

	function factoryTotalSupplyOf12Months(){    //HELPER FUNCTION
		$dbmain = new DBmain();
		$formateddate=date("Y-m-d");
		$resarr=array();
		$curyear=substr($formateddate,0,4);
		$curmonth=substr($formateddate,5,7);
		$lstrunningmonth=substr($formateddate,5,7);
		for($i=1;$i<13;$i++){
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
			
			$condition=" WHERE date BETWEEN '".$startday."' AND '".$enddate."'";
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
	
	function getThisMonthTotalSupply(){   //HELPER FUNCTION
		$dbmain = new DBmain();
		$res=$dbmain->selectData("daily_supply",array("approved_kgs")," ");
		$total=0;
		if(count($res) > 0){
			foreach($res as $r){					
				$total=$total + $r['approved_kgs'];		
			}
			return $total;
		}
		return $total;
	}
	function thisMonthSupplyPrecentage(){
		$arr=DBDashboard::factoryTotalSupplyOf12Months();
		$val=DBDashboard::getThisMonthTotalSupply();
		$count=0;
		for($i=0;$i<12;$i++){
			$count=$count+(($arr[$i])*1);
		}
		$count=($val/$count)*100;
		
		return round($count,2);
	}

	
	function unReadSMScount(){
		$dbmain = new DBmain();
		$condition="WHERE date=CURDATE() AND approve=0";
		$res=$dbmain->selectData("message_temp",array("message_id"),$condition);
		if(count($res)>0){
			$counts=0;
			foreach($res as $r){
				$counts=$counts+1;		
			}
			return $counts;
		}
		return 0;
	}
	function totalValueofLast365Days(){
		$arr=DBDashboard::factoryTotalSupplyOf12Months();
		$count=0;
		for($i=0;$i<12;$i++){
			$count=$count+(($arr[$i])*1);
		}
		return $count;
	}
	
	function todayCurSupplyPrecentage(){
		$arr=DBDashboard::factoryTotalSupplyOf12Months();
		$tot=DBDashboard::getTodayTotalSupply();
		$count=0;
		for($i=0;$i<12;$i++){
			$count=$count+(($arr[$i])*1);
		}
		$count=$count/(12*30);
		$count=($tot/$count)*100;
		
		return round($count,2);
	}

	function getTodayTotalSupply(){//HELPER FUNCTION
		$dbmain = new DBmain();
		$condition="WHERE date=CURDATE()";
		$res=$dbmain->selectData("today_supply",array("approved_kgs"),$condition);
		$total=0;
		if(count($res) > 0){
			foreach($res as $r){					
				$total=$total + $r['approved_kgs'];		
			}
			return $total;
		}
		return 0;		
	}
	
	function factoryTotalSupplyOf6Months(){
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
			
			$condition=" WHERE date BETWEEN '".$startday."' AND '".$enddate."'";
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
	function realTeaRatesOfLast6Months(){
		$dbmain = new DBmain();
		$formateddate=date("Y-m-d");
		$resarr=array();
		$curyear=substr($formateddate,0,4);
		$curmonth=substr($formateddate,5,7);
		$curmonth=($curmonth*1)+1;
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
			
			$condition=" WHERE date BETWEEN '".$startday."' AND '".$enddate."'";
			$res=$dbmain->selectData("settings",array("fixed_tea_rate"),$condition);
			$total=0;
			if(count($res) > 0){
				foreach($res as $r){					
					$total=$total+$r['fixed_tea_rate'];
				}
				$resarr[$i-1]=$total;
			}else{
				$resarr[$i-1]=0;
			}
		}
		return $resarr;	
	}
	

	function approxTeaRatesOfLast6Months(){
		$dbmain = new DBmain();
		$formateddate=date("Y-m-d");
		$resarr=array();
		$curyear=substr($formateddate,0,4);
		$curmonth=substr($formateddate,5,7);
		$curmonth=($curmonth*1)+1;
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
			
			$condition=" WHERE date BETWEEN '".$startday."' AND '".$enddate."'";
			$res=$dbmain->selectData("settings",array("approxi_tea_rate"),$condition);
			$total=0;
			if(count($res) > 0){
				foreach($res as $r){					
					$total=$total+$r['approxi_tea_rate'];
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
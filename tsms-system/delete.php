<?php
session_start();
require_once 'classes/class.user.php';
$user_home = new USER();



if(!empty($_GET["delete_id"])) {
	$uname = $_GET["delete_id"];
	for($i=0;$i<4;$i++){
		if(strlen($uname)!=4){
			$uname ="0".$uname;
		}

	}
	$s = $user_home->runQuery("DELETE FROM `today_supply` WHERE supplier_code= :uname");
	$s->execute(array(":uname"=>$uname));
	$user_home->redirect('update.php');
}

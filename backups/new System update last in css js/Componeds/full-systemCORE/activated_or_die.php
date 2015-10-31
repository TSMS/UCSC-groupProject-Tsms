<?php
require_once 'core/init.php';
$user = new User();

$u_id = $_GET['u_id'];
$type = $_GET['type'];

if($type=='2'){
	DB::getInstance()->query("UPDATE users SET user_approved=1 WHERE id=$u_id");
	Redirect::to('usersettings.php?type=user');
}else if($type=='1'){
	DB::getInstance()->query("UPDATE users SET user_approved=2 WHERE id=$u_id");
	Redirect::to('usersettings.php?type=user');
}


?>
<?php
require_once 'classes/class.user.php';
$user = new USER();
//groups = 1   not a user
//groups = 2 user
$u_id = $_GET['u_id'];
$type = $_GET['type'];

if($type=='2'){
	$q1 = $user->runQuery("UPDATE users SET groups=1 WHERE id=$u_id");
	$q1->execute();
	$user->redirect('home.php');
}else{
	$q1 = $user->runQuery("UPDATE users SET groups=2 WHERE id=$u_id");
	$q1->execute();
	$user->redirect('home.php');
}

/*
if($user_home->admin($row['id'])){
	what you need to hide from others
}
*/
?>
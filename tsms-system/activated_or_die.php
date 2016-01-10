<?php
require_once 'classes/class.user.php';
$user = new USER();

$u_id = $_GET['u_id'];
$type = $_GET['type'];

if($type=='3'){
	$q1 = $user->runQuery("UPDATE users SET user_approved=2 WHERE id=$u_id");
	$q1->execute();
	//$user->redirect('index.php');
}else if($type=='2'){
	$q1 = $user->runQuery("UPDATE users SET user_approved=3 WHERE id=$u_id");
	$q1->execute();
	//$user->redirect('index.php');
}

?>
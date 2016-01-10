<?php
session_start();
require_once 'classes/class.user.php';
$user = new USER();

$user->logout();	
$user->redirect('changepass.php');
?>
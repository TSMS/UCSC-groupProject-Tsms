<?php
session_start();
require_once 'classes/class.user.php';
$user_home = new USER();
if(!$user_home->is_logged_in())
{
  echo "";
}

if(!empty($_POST["supcode"])) {
	$uname = $_POST["supcode"];
	$s = $user_home->runQuery("SELECT * FROM suppliers WHERE supplier_code= :uname");
	$s->execute(array(":uname"=>$uname));
	$userRow=$s->fetch(PDO::FETCH_ASSOC);	
	if($s->rowCount() == 1){
		echo "<span class='status-not-available'> Supplier code Not Available.</span>";
	}else{
		echo "<span class='status-available'> Supplier code is Available.</span>";
  }
}


if(!empty($_POST["username"])) {
	$uname = $_POST["username"];
	$s = $user_home->runQuery("SELECT * FROM users WHERE username= :uname");
	$s->execute(array(":uname"=>$uname));
	$userRow=$s->fetch(PDO::FETCH_ASSOC);	
	if($s->rowCount() == 1){
		echo "<span class='status-not-available'> Username Not Available.</span>";
	}
	// else{
	// 	echo "<span class='status-available'> Username is Available.</span>";
 //  }
}

// $msg=$_POST['fname'];
// //$msg=$_POST['text-msg'];

// echo $msg;

?>
<style type="text/css">

.status-not-available{
  color: #a94442;
  font-size: 0.8em;
}
.status-available{
  color: green;
}

</style>

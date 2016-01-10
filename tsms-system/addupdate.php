<?php
session_start();
require_once 'classes/class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
  $user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM users WHERE id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

require_once 'classes/class.update.php';

$update = new Update();

$scode = trim($_POST['supcode']);
$units = trim($_POST['units']);
$appkgs = trim($_POST['appkgs']);
$supkgs = trim($_POST['supkgs']);
$editor= $row['id'];

$stmt = $update->runQuery("SELECT * FROM today_supply WHERE supplier_code=:sup_code");
$stmt->execute(array(":sup_code"=>$scode));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if($stmt->rowCount() > 0)
{
  $msg = '<div class="alert alert-warning alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4>  <i class="icon fa fa-warning"></i> Sorry!</h4>
  Supply record Already added. 
</div>';
  // $msg = "
  //       <div class='alert alert-error'>
  //     <button class='close' data-dismiss='alert'>&times;</button>
  //       <strong>Sorry !</strong>  email allready exists , Please Try another one
  //     </div>
  //     ";
}
else
{
  if($update->addrecord($scode,$appkgs,$supkgs,$units,$editor))
  {     
    $msg = '<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4>  <i class="icon fa fa-check"></i> Successfuly!</h4>
  Supply record Successfuly added.
</div>
';
  }
  else
  {
    $msg = '<div class="alert alert-warning alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4>  <i class="icon fa fa-warning"></i>Sorry!</h4>
  This supplier not exists in our system.
</div><a href="update.php">';
  }   
}



?>

<?php 


if(isset($msg)){
  $_SESSION["mesage"] = $msg;
  $user_home->redirect('update.php');
}  


?>  


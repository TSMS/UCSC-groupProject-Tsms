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

require_once 'classes/class.suppliers.php';

$supplier = new Supplier();

$scode = trim($_POST['supcode']);
$fname = trim($_POST['fname']);
$lname = trim($_POST['lname']);
$addr1 = trim($_POST['address_1']);
$nic = trim($_POST['nic']);
$banka = trim($_POST['bankacc']);
$bankn = trim($_POST['bankn']);
$mobile= trim($_POST['mobile']);
$email  = trim($_POST['uemail']);
$editor= $row['id'];

$stmt = $supplier->runQuery("SELECT * FROM suppliers WHERE supplier_code=:sup_code");
$stmt->execute(array(":sup_code"=>$scode));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if($stmt->rowCount() > 0)
{
  $msg = '<div class="alert alert-warning alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4>  <i class="icon fa fa-check"></i> Sorry!</h4>
  supplier allready exists , Please Try another one.
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
  if($supplier->register($scode,$fname,$lname,$addr1,$nic,$mobile,$email,$editor))
  {     
    echo '<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4>  <i class="icon fa fa-check"></i> Successfuly!</h4>
  Supplier Successfuly added to the database.
</div>
<div class="col-md-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Supplier Settings</h3>
    </div>
    <div class="box-body">
      <p>Supplier Successfuly added to the database. Also You can change Supplier settings.</p>
      <a class="btn btn-app">
        <i class="fa fa-edit"></i> Edit
      </a>
      <a href="suppliers.php" class="btn btn-app">
        <i class="fa fa-user-plus"></i> Add Another
      </a>
      <a class="btn btn-app">
        <i class="fa fa-users"></i> View Suppliers
      </a>
    </div>
  </div>
</div>
';
  }
  else
  {
    echo "sorry , Query could no execute...";
  }   
}



?>

<?php 


if(isset($msg)) echo $msg;  


?>  


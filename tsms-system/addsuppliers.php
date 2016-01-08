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
	
if(isset($_POST['btn-register']))
{
  $scode = trim($_POST['supcode']);
  $fname = trim($_POST['fname']);
  $lname = trim($_POST['lname']);
  $addr1=trim($_POST['addr']);
  $editor= $row['id'];
  
  $stmt = $supplier->runQuery("SELECT * FROM suppliers WHERE supplier_code=:sup_code");
  $stmt->execute(array(":sup_code"=>$scode));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if($stmt->rowCount() > 0)
  {
    $msg = ' Sorry! supplier allready exists , Please Try another one';
    // $msg = "
    //       <div class='alert alert-error'>
    //     <button class='close' data-dismiss='alert'>&times;</button>
    //       <strong>Sorry !</strong>  email allready exists , Please Try another one
    //     </div>
    //     ";
  }
  else
  {
    if($supplier->register($scode,$fname,$lname,$addr1, $editor))
    {     
      echo "Successfuly";
    }
    else
    {
      echo "sorry , Query could no execute...";
    }   
  }
}



?>

<?php if(isset($msg)) echo $msg;  ?>  
<form method="post">
	<input  type="text" class="form-control" placeholder="Supplier Code" name="supcode" required>
	<input  type="text" class="form-control" placeholder="First Name" name="fname" required>
	<input  type="text" class="form-control" placeholder="Last Name" name="lname" required>
	<input  type="text" class="form-control" placeholder="Address" name="addr" required>
	<button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-register">Register</button>
</form>
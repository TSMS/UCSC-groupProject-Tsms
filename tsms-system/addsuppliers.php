<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="plugins/alert/dist/sweetalert.css">
  <script type="text/javascript" src="plugins/alert/dist/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="plugins/alert/dist/sweetalert.min.js"></script>
  <script type="text/javascript" src="plugins/alert/dist/sweetalert-dev.js"></script>
</head>
<body>

</body>
</html>
<?php
session_start();
include_once('message/communication.php');

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
$nic = trim($_POST['nic']);
$iCheck = trim($_POST['iCheck']);
$email  = trim($_POST['uemail']);
$address_1  = trim($_POST['address_1']);
$mobile = trim($_POST['mobile']);
$estate = trim($_POST['estate']);
$estate_name = trim($_POST['estate_name']);
$reg_no = trim($_POST['reg_no']);
$size_of_estate = trim($_POST['size_of_estate']);
$estate_address = trim($_POST['estate_address']);
$bankn = trim($_POST['bankn']);
$branch = trim($_POST['branch']);
$account = trim($_POST['account']);
$bankacc = trim($_POST['bankacc']);
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
  if($supplier->register($scode, $fname, $lname, $nic, $iCheck, $email, $address_1, $mobile, $estate, $estate_name, 
    $reg_no, $size_of_estate, $estate_address, $bankn, $branch, $account, $bankacc, $editor))
  {  
    $message = "Thalapalakanada Tea factory, username: 0001 password: $nic http://tsms.x10host.com/page/";

  if(!empty($mobile)){
    $mobileNumber = Communication::prepareNumber($mobile);
    Communication::sendMessage($message, $mobileNumber);
  }
    echo '
<div class="row">
<div class="col-md-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Supplier Settings</h3>
    </div>
    <div class="box-body">
      <p>Supplier Successfuly added to the database. Also You can change Supplier settings.</p>
      <a class="btn btn-app">
        <i href="supplieredit.php" class="fa fa-edit"></i> Edit
      </a>
      <a href="suppliers.php" class="btn btn-app">
        <i class="fa fa-user-plus"></i> Add Another
      </a>
      <a class="btn btn-app">
        <i href="view.php" class="fa fa-users"></i> View Suppliers
      </a>
    </div>
  </div>
</div>
</div>
';
  }
  else
  {
    echo "Error!", "Connection error occured.","error";
  }   
}



?>

<?php 


if(isset($msg)) echo $msg;  


?>  


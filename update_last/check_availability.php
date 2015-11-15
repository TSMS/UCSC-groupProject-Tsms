<?php
require_once 'core/init.php';

$supplier = new Supplier();
$update = new Update();

if(!empty($_POST["search"])){ 
  require_once 'db/dbdailysupply.php';
  $dailysupply = new DBDailySupply();

  $supplier_code = $_POST["search"];
  $name = DB::getInstance()->get('suppliers', array('supplier_code', '=', $_POST["search"]));
  if(!$name->count()){
     echo "<span class='status-not-available'> No supplier.</span>";
  }else{
    $code = $_POST["search"];
  }

  $arr = $dailysupply->myTotalSupplyOf6Months($supplier_code);
  $todaydate = date('Y-m-d');
  $todaydate = substr($todaydate,5, 7); // 2015-11-11

  $datemonth = date('Y-m-d');
  $datemonth = substr($datemonth, 0,8);
  $datemonth = $datemonth."01";//2015-11-02
  $sup_name  = $supplier->search('supplier_code', $supplier_code, 'f_name')." ".$supplier->search('supplier_code', $supplier_code, 'l_name');
  $aprate    = $update->search('settings', 'date', $datemonth, 'approx_rate');
  $thismonthkgs = DB::getInstance()->Getsum('approved_kgs','daily_supply',$supplier_code);
    echo '
    <dl class="dl-horizontal example1">
       <p>Supplier details<p>
       <dt>Code: </dt>
       <dd>'.$code.'</dd>
       <dt>Name: </dt>
       <dd>'.$sup_name.'</dd>
       <dt>NIC NO: </dt>
       <dd>'.$supplier->search('supplier_code', $supplier_code, 'nic_no').'</dd>
       <dt>Approximate tea Rate: </dt>
       <dd>Rs '.$aprate.'</dd>
       <dt>Supply kgs: </dt>
       <dd>'.$thismonthkgs.' Kg</dd>
       <dt>Total income: </dt>
       <dd>Rs '.$aprate*$thismonthkgs.'</dd>
       <dt>Paid: </dt>
       <dd>---</dd>
       <dt>remain balance: </dt>
       <dd>---</dd>
    </dl>
    ';
}


if(!empty($_POST["code"])) {
  $name = DB::getInstance()->get('suppliers', array('supplier_code', '=', $_POST["code"]));
  if(!$name->count()){
     echo "<span class='status-not-available'> no supplier.</span>";
 }else{
     foreach ($name->results() as $tag){
      $col =  $tag->f_name." ".$tag->l_name;
      echo "<span class='status-available'> ".$col."</span>";
     }
  }
} 

if(!empty($_POST["sup_code"])) {
  $name = DB::getInstance()->get('suppliers', array('supplier_code', '=', $_POST["sup_code"]));
  if($name->count()){
     echo "<span class='status-not-available'> Supplier Already exists in system.</span>";
  }else{
    echo "<span class='status-available'> Supplier Code is Available.</span>";
  }
}

if(!empty($_POST["nic_no"])) {

  $nic = $_POST["nic_no"];
  $nic_9 = substr($nic,0,9);
  $nic_11 = substr($nic,0,11);
  $v     = substr($nic, 9,10);
  if(strlen($nic) == 12 && is_numeric($nic_11)){
    echo "<span class='status-available'> recognize as a new nic number!.</span>";
  }else if(is_numeric($nic_9) && ($v =="v" || $v =="V" || $v =="X" || $v =="x")){
    echo "<span class='status-available'> Nic number is correct!.</span>";
  }else{
    echo "<span class='status-not-available'> Nic Number must be number.</span>";
  }
}


if(!empty($_POST["name"]) && is_numeric($_POST["name"])) {
    echo "<span class='status-not-available'> Name canot be Number!.</span>";
  
}

if(!empty($_POST["username"])) {
  $name = DB::getInstance()->get('users', array('username', '=', $_POST["username"]));
  if($name->count()){
     echo "<span class='status-not-available'> Username Not Available.</span>";
  }else{
     echo "<span class='status-available'> Username is Available.</span>";
  }
}
?>

<style type="text/css">

.status-not-available{
  color: red;
}
.status-available{
  color: green;
}

</style>
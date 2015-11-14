<?php
require_once("dbcontroller.php");
$db_handle = new DBController();


if(!empty($_POST["sup_code"])) {
  $result = mysql_query("SELECT count(*) FROM suppliers WHERE supplier_code='" . $_POST["sup_code"] . "'");
  $row = mysql_fetch_row($result);
  $user_count = $row[0];
  if($user_count>0) {
      echo "<span class='status-not-available'> Supplier Code Not Available.</span>";
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
  $result = mysql_query("SELECT count(*) FROM users WHERE username='" . $_POST["username"] . "'");
  $row = mysql_fetch_row($result);
  $user_count = $row[0];
  if($user_count>0) {
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
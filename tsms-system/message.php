<?php
session_start();
include_once('message/communication.php');
require_once 'classes/class.user.php';
$user_home = new USER();
require_once 'DB/dbsms.php';
$dbsms=new DBsms();
if(!$user_home->is_logged_in())
{
  $user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM users WHERE id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);




$supcode="";
$supname="";
$reqtype="";
$amount="";
$qty="";
$category="";

if(!empty($_GET["id"])){
  $id = $_GET["id"];
  
  ?>
  <script type="text/javascript" src="plugins/alert/dist/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="plugins/alert/dist/sweetalert.min.js"></script>
  <script type="text/javascript" src="plugins/alert/dist/sweetalert-dev.js"></script>
  <?php
  $getdata = $user_home->runQuery("SELECT t.supplier_code, s.f_name,s.l_name,t.message_code, t.value, t.quantity, t.category
  FROM message_temp t,suppliers s,message_info i WHERE (t.supplier_code= s.supplier_code) AND message_id=$id ");
  $getdata->execute();
  $data="";
  while($r=$getdata->FETCH(PDO::FETCH_ASSOC)){
    $data=$r;
  }
  $supcode=$data['supplier_code'];
  $supname=$data['f_name']." ".$data['l_name'];
  $reqtype=$data['message_code'];
  $amount=$data['value'];
  $qty=$data['quantity'];
  $category=$data['category'];
  switch ($reqtype) {
        case 'fer':$reqtype="Fertilizer";break;
        case 'adv':$reqtype="Advance";break;
        case 'bil':$reqtype="Bill";break;
        case 'lon':$reqtype="Loan";break;
        default:$reqtype='Chemical';break;
    }
  
  
  // CHART 1- BAR CHART
  $mysupply=$dbsms->myTotalSupplyOf6Months($supcode);
  $strbarchartvalues="[".$mysupply[5].",".$mysupply[4].",".$mysupply[3].",".$mysupply[2].",".$mysupply[1].",".$mysupply[0]."]";
  $formateddate=date("Y-m-d");
  $curmonth=substr($formateddate,5,7);
  $curmonth=($curmonth*1)-5;
  if($curmonth<0){
    $curmonth=$curmonth+12;
  }
  $strbarchartlabels="[";
  for($i=0;$i<6;$i++){
    switch($curmonth){
      case 1:$strbarchartlabels=$strbarchartlabels.'"January",';$curmonth=$curmonth+1;break;
      case 2:$strbarchartlabels=$strbarchartlabels.'"February",';$curmonth=$curmonth+1;break;
      case 3:$strbarchartlabels=$strbarchartlabels.'"March",';$curmonth=$curmonth+1;break;
      case 4:$strbarchartlabels=$strbarchartlabels.'"April",';$curmonth=$curmonth+1;break;
      case 5:$strbarchartlabels=$strbarchartlabels.'"May",';$curmonth=$curmonth+1;break;
      case 6:$strbarchartlabels=$strbarchartlabels.'"June",';$curmonth=$curmonth+1;break;
      case 7:$strbarchartlabels=$strbarchartlabels.'"July",';$curmonth=$curmonth+1;break;
      case 8:$strbarchartlabels=$strbarchartlabels.'"August",';$curmonth=$curmonth+1;break;
      case 9:$strbarchartlabels=$strbarchartlabels.'"September",';$curmonth=$curmonth+1;break;
      case 10:$strbarchartlabels=$strbarchartlabels.'"October",';$curmonth=$curmonth+1;break;
      case 11:$strbarchartlabels=$strbarchartlabels.'"November",';$curmonth=$curmonth+1;break;
      case 12:$strbarchartlabels=$strbarchartlabels.'"December",';$curmonth=$curmonth+1;break;
      default:$strbarchartlabels=$strbarchartlabels.'"January",';$curmonth=2;break;
    }
  }
  $strbarchartlabels=substr($strbarchartlabels,0,-1);
  $strbarchartlabels=$strbarchartlabels."]";
  
  //LINE CHART
  $myincome=$dbsms->myIncomeOf6Months($supcode);
  $strlinechartvalues="[".$myincome[5].",".$myincome[4].",".$myincome[3].",".$myincome[2].",".$myincome[1].",".$myincome[0]."]";  
  
  $mymiddlemonthpay=$dbsms->myMiddleMonthPaymentsOf6Months($supcode);
  $strlinechartvalues2="[".$mymiddlemonthpay[5].",".$mymiddlemonthpay[4].",".$mymiddlemonthpay[3].",".$mymiddlemonthpay[2].",".$mymiddlemonthpay[1].",".$mymiddlemonthpay[0]."]";
  
  $dbsms->setMessageAsRead($id);
}
$formateddate=date('Y-m-d');

/*Form submits -- start*/
//advance 
if(isset($_POST['submit_1'])){
	$supcode1=($_POST['hiddensupcode1']);
	$total_amount=($_POST['total_amount']);
	$des=($_POST['des']);
	$editor=$row['id'];
	if($dbsms->checkSupplierExist($supcode1)== true){
		$datafields=array($formateddate,$supcode1,"adv","","",$total_amount,"1",$total_amount,$des,$editor);
		$res=$dbsms->addTodayService($datafields);
		if($res==true){
			echo '<script>$(function(){ swal("Success!", "Successfully  Accepted","success")}); </script>';
		}else{
			echo "<script>alert ('Error of Connection !') </script>";
		}
		//echo($res);</script>
	}	
}
if(isset($_POST['submit_2'])){
	$supcode2=($_POST['hiddensupcode2']);	
	$loancode=($_POST['selectdd']);		
	$unit_price=($_POST['amountofaqty']);
	$qty=($_POST['qty']);
	$p_total_amount=($_POST['producttotal']);
	$p_installments=($_POST['productpaymentmonths']);
	$p_amountofinstallment=($_POST['productinstallment']);
	$des=($_POST['des']);
	if($dbsms->checkSupplierExist($supcode2)==true){
		$res=true;
		$dateMula=substr($formateddate,0,5);
		$dateMada=substr($formateddate,5,7);
		$dateAga=substr($formateddate,7);		
		for($i=0;$i<$p_installments;$i++){
			$dateMada=($dateMada/1)+$i;
			if(strlen($dateMada)<2){
				$dateMada="0".$dateMada;
			}
			if($dateMada==13){
				$dateMada="12";
				$dateMula=((substr($formateddate,0,4))+1)."-";
			}
			$dte=$dateMula.$dateMada.$dateAga;
			$datafields=array($dte,$supcode2,$loancode,$unit_price,$qty,$p_total_amount,$p_installments,$p_amountofinstallment,$des,$row['id']);
			$retres=$dbsms->addTodayService($datafields);
			if($res==false){
				$res=false;
			}				
		}
		if($res==true){
			echo '<script>$(function(){ swal("Success!", "Successfully Accepted","success")}); </script>';
		}else{
			echo '<script>$(function(){ swal("Error!",""Error of Connection...",error")}); </script>';
		}		
	}
}
if(isset($_POST['submit_3'])){
	
	$supcode3=($_POST['hiddensupcode3']);	
	$total_amount=($_POST['loanamount']);
	$installments=($_POST['loanmonths']);
	$amountofinstallment=($_POST['loanpay']);
	$des=($_POST['des']);
	
	if($dbsms->checkSupplierExist($supcode3)==true){
		$res=true;
		$dateMula=substr($formateddate,0,5);
		$dateMada=substr($formateddate,5,7);
		$dateAga=substr($formateddate,7);		
		for($i=0;$i<$installments;$i++){
			$dateMada=($dateMada/1)+$i;
			if(strlen($dateMada)<2){
				$dateMada="0".$dateMada;
			}
			if($dateMada==13){
				$dateMada="12";
				$dateMula=((substr($formateddate,0,4))+1)."-";
			}
			$dte=$dateMula.$dateMada.$dateAga;
			$datafields=array($dte,$supcode3,"lon","","",$total_amount,$installments,$amountofinstallment,$des,$row['id']);
			$retres=$dbsms->addTodayService($datafields);
			if($res==false){
				$res=false;
			}				
		}
		if($res==true){
			echo '<script>$(function(){ swal("Success!", "Successfully Accepted","success")}); </script>';
		}else{
			echo '<script>$(function(){ swal("Error!",""Error of Connection...",error")}); </script>';
		}		
	}
	
}
/*Form submits -- end*/

?>
<!DOCTYPE html>
<html>
<title>Message</title>
<?php include "include/head.php" ?>
  
    <div class="wrapper">

      <?php include "include/header.php" ?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul id="nav" class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
              <a href="home.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="active">
              <a href="message.php">
                <i class="fa fa-envelope"></i> <span>Message</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="update.php">
                <i class="fa fa-edit"></i> <span>Update</span>
              </a>
            </li>
            <li class="treeview">
              <a href="Supreg.html">
                <i class="fa fa-group"></i> <span>Suppliers</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="suppliers.php"><i class="fa fa-circle-o"></i> Registation</a></li>
                <li><a href="view.php"><i class="fa fa-circle-o"></i> View</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Edit</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="report.php">
                <i class="fa fa-print"></i> <span>Report</span>
              </a>
            </li>
            <li class="treeview">
              <a href="settings.php">
                <i class="fa fa-download"></i> <span>Settings</span>
              </a>
            </li>
          </ul><!-- /.sidebar-menu -->



        </section>
        <!-- /.sidebar -->
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <h1>
               Message
               <small>Request Accepting</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
               <li class="active">Message</li>
            </ol>
         </section>
         <!-- Main content -->
         <div id="content" class="content">
         
          <section class="content">
            <style>
             .login-dialog .modal-dialog {
                  width: 400px;
              }
          </style>
<?php 
  if(!empty($_POST['number']) && !empty($_POST['send_message']) && $_POST['send'] == "send message"){
    $mobileNumber = Communication::prepareNumber($_POST['number']);
    Communication::sendMessage($_POST['send_message'], $mobileNumber);
  }
 ?>
            <!-- Modal For Send message -->
            <div id="myModal" class="login-dialog modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Send message</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post">
                              <!-- text input -->
                              <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" name="number" placeholder="Enter Mobile number like 0772376512.">
                              </div>
                              <!-- textarea -->
                              <div class="form-group">
                                <label>Textarea</label>
                                <textarea class="form-control" rows="3" name="send_message" placeholder="Enter your message in here"></textarea>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
                                  <button type="submit" name="send" class="btn bg-navy btn-flat" value="send message">Send message</button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal For Reply message -->
            <div id="reply" class="login-dialog modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Reply message</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                              <!-- text input -->
                              <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" placeholder="Enter Mobile number like 0772376512.">
                              </div>
                              <!-- textarea -->
                              <div class="form-group">
                                <label>Textarea</label>
                                <textarea class="form-control" rows="3" placeholder="Enter your message in here"></textarea>
                              </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
                            <button type="button" class="btn bg-navy btn-flat">Send</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="box-body">
                  <p>Send Message to Suppliers</p>
                  <!-- Button HTML (to Trigger Modal) -->
                  <a href="#myModal" role="button" class="btn bg-navy btn-flat" data-toggle="modal"><i class="fa fa-envelope"></i>  Compose</a>
                  <a href="message.php" class="btn btn-app pull-right"><i class="fa fa-refresh"></i> Refresh</a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="box box-navy">
                  <div class="box-header with-border">
                    <h3 class="box-title">Inbox</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    <div class="mailbox-controls">
                      <!-- Check all button -->
                      <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        <a href="#reply" role="button" class="btn btn-default btn-sm" data-toggle="modal"><i class="fa fa-reply"></i></a>
                      </div><!-- /.btn-group -->
                      <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                      <div class="pull-right"><i class="fa fa-reply"></i>
                        1-50/200
                        <div class="btn-group">
                          <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                          <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                        </div><!-- /.btn-group -->
                      </div><!-- /.pull-right -->
                    </div>
                    <div class="table-responsive mailbox-messages">
                      <?php
                      $getdata = $user_home->runQuery("SELECT t.message_id, s.f_name,s.l_name,t.message_code, t.value, t.quantity, t.category, t.date, t.time, t.approve FROM message_temp t,suppliers s WHERE (t.supplier_code= s.supplier_code) AND t.approve=0 ORDER BY date DESC");
                      $getdata->execute();
                      ?>
                      <table class="table table-hover table-striped">
                        <tbody>
                        <?php 
                        if($getdata->rowCount() > 0)
                          {
                            $rowNo=0;
                           while($row=$getdata->FETCH(PDO::FETCH_ASSOC)){
                            $rowNo=$rowNo+1;
                            $type = $row['message_code'];
                            switch ($type) {
                                 case 'fer':
                                   $lable = 'btn-info';
                                   $mcode = 'fertilizer';
                                  
                                   break;
                                 case 'adv':
                                   $lable = 'btn-warning';
                                   $mcode = 'advance';
                                
                                   break;
                                 case 'bil':
                                   $lable = 'btn-default';
                                   $mcode = 'bills';
                                   break;
                                 case 'lon':
                                   $lable = 'btn-primary';
                                   $mcode = 'loan';
                                   $msgcode = "#loan";
                                   break;
                                 default:
                                   $lable = 'btn-success';
                                   $mcode = 'chemical';
                                  
                                   break;
                               }
                         ?>
                          <tr>
                            <td><input type="checkbox"></td>
                            <td class="mailbox-star"><?php print($rowNo); ?>).</td>
                            <td class="mailbox-name"><a href="message.php?id=<?php echo $row['message_id'];?>"><?php print($row['f_name']." ".$row['l_name']); ?></a></td>
                            <td class="mailbox-subject"><p class="btn <?php echo $lable?> btn-flat btn-xs"><?php echo $mcode; ?></td>
                            <td class="mailbox-date"><?php print($row['time']); ?></td>
                          </tr>
                             <?php
                               }
                              }
                              else
                              {
                               ?>
                                  <tr>
                                  <td><?php print("nothing here...");  ?></td>
                                  </tr>
                                  <?php
                              }
                              ?>
                        </tbody>
                      </table><!-- /.table -->
                    </div><!-- /.mail-box-messages -->
                  </div><!-- /.box-body -->
                  <div class="box-footer no-padding">
                    <div class="mailbox-controls">
                      <!-- Check all button -->
                      <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        <a href="#reply" role="button" class="btn btn-default btn-sm" data-toggle="modal"><i class="fa fa-reply"></i></a>
                      </div><!-- /.btn-group -->
                      <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                      <div class="pull-right">
                        1-50/200
                        <div class="btn-group">
                          <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                          <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                        </div><!-- /.btn-group -->
                      </div><!-- /.pull-right -->
                    </div>
                  </div>
                </div><!-- /. box -->
              </div><!-- /.col -->
              <?php  
              if(!empty($id)){
                ?>
              <div class="col-md-6">
                <div class="box box-navy">
                  <div class="box-header with-border">
                    <h3 class="box-title"> View Message</h3>
                    <div class="box-body">
                      <dl class="dl-horizontal example1">
                         <p>Request message
                         <p>
                         <dt>Supplier Code:</dt>
                         <dd><?php echo($supcode); ?> </dd>
                         <dt>Supplier Name: </dt>
                         <dd><?php echo($supname); ?> </dd>
             <dt>Request Type:</dt>
             <dd><?php echo($reqtype); ?> </dd>
             <p>
                         <dt>ammount: </dt>
                         <dd><?php echo($amount); ?> </dd>
                         <dt>Quantity: </dt>
             <dd><?php echo($qty); ?> </dd>
                         <dt>category: </dt>
             <dd><?php echo($category); ?> </dd>

                         <div class="supplier-ditails">
                            <!-- Bar Chart Start -->
                              <div class="box box-success">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Supply of last 6 month</h3>
                                  <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="box-body">
                                  <div class="chart">
                                    <canvas id="income" width="500" height="230"></canvas>
                                  </div>
                                </div><!-- /.box-body -->
                              </div><!-- /.box -->
                              <!-- Bar Chart End -->
                             <!-- line Chart Start -->
                              <div class="box box-success">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Income vs payment</h3>
                                  <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="box-body">
                                  <div class="chart">
                                    <canvas id="c" width="500" height="230"></canvas>
                                  </div>
                                </div><!-- /.box-body -->
                              </div><!-- /.box -->
                              <!-- Line Chart End -->
                         </div>
                        

                         <!-- <div class="is-accept">
                            <div class="col-md-6">
                              <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Acceptability</span>
                                  <div class="progress">
                                    <div class="progress-bar" style="width: 70%"></div>
                                  </div>
                                  <span class="progress-description">
                                    70% Increase in 30 Days
                                  </span>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="info-box bg-red">
                                <span class="info-box-icon"><i class="fa fa-thumbs-o-down"></i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Acceptability</span>
                                  <div class="progress">
                                    <div class="progress-bar" style="width: 30%"></div>
                                  </div>
                                  <span class="progress-description">
                                    23% Increase in 30 Days
                                  </span>
                                </div>
                              </div>
                            </div>
                         </div> -->



                       <?php 
                       switch ($reqtype) {
                                 case 'Fertilizer':
                                   $ecode = '#products';
                                   break;
                                 case 'Advance':
                                   $ecode = '#advance';
                                   break;
                                 case 'lon':
                                   $ecode = '#loan';
                                   break;
                                 case 'Chemical':
                                   $ecode = '#products';
                                   break;
                                 default:
                                   $ecode = 'null';
                                   break;
                               }
                        ?>
                      <div class="input-group">
                         <span class="input-group-btn">
                            <a href="<?php echo $ecode;?>" name="accept" class="btn bg-navy btn-flat pull-right" data-toggle="modal">Accept</a>                
                            <a href="http://localhost/tsms/message.php" type="reset" name="Reject" class="btn bg-denger btn-flat ">Reject</a>
                         </span>
                       </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
              } ?>
            </div>
          </section>
         </div> <!-- /.content -->
      </div>

      <!-- Accept button model -->
      <!-- 1 -->
        <div id="advance" class="login-dialog modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Accepting Supplier Adavance</h4>
                    </div>
                    <div class="modal-body">
                        
						<!-- Advance Start -->
                         <div class="panel-body ng-scope">
                                   <form action="" method="POST" name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required">
                                      <fieldset>
                                         <div class="form-group">
                                            <div class="col-sm-2">
                                               <label for="">Amount</label>
                                            </div>
                                            <div class="input-group col-sm-6">
                                               <span class="input-group-addon">Rs.</span>
                                               <input class="form-control" required="" name="total_amount" data-ng-model=""  type="text" value="" onkeypress="return isNumberKey(event)" maxlength="8">
                                               <span class="input-group-addon">.00</span>
											   <input type="hidden" value="<?php echo $supcode;?>" id="hiddensupcode1" name="hiddensupcode1" >
                                            </div>
                                         </div>
                                         <div class="form-group">
                                            <div class="col-sm-2">
                                               <label for="">Des</label>
                                            </div>
                                            <div class="input-group">
                                              <textarea class="form-control" rows="5"  id="des" rows="4" cols="35" name="des" placeholder="Comment"></textarea>
                                            </div>
                                         </div>
                                         <button type="submit" name="submit_1" class="btn bg-navy btn-flat">Submit</button>
                                      </fieldset>
                                   </form>
                                </div>     
						<!-- Advance End -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 2 -->
        <div id="products" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Accepting Factory Products for suppliers</h4>
                    </div>
                    <div class="modal-body">
                        
                      <!-- products start -->
                      <div class="panel-body ng-scope">
                               <form action="" method="POST" name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required">
                                  <fieldset>
                                     <div class="form-group">
										<div class="col-sm-4">
                                           <label for="">Product</label>
                                        </div>
											<span class="ui-select col-sm-4">
                                            <select name="selectdd" class="form-control">
										
												<option value="che">Chemical</option>
												<option value="fer">Fertilizer</option>
												<option value="tea">Tea Packets</option>
											
                                           </select>
                                        </span>
                                     </div>
                                     <div class="form-group">
										<div class="col-sm-2">
											<label for="">Amount of 1 qty</label>
										</div>
										<div class="input-group col-sm-4">
											<span class="input-group-addon">Rs.</span>
											<input type="text" id="amountofaqty" name="amountofaqty" class="form-control" onkeyup="call()" required="" data-ng-model="" onkeypress="return isNumberKey(event)" maxlength="8">
										</div>
									</div>
									<input type="hidden" value="<?php echo $supcode;?>" id="hiddensupcode2" name="hiddensupcode2" >
									<div class="form-group">
										<div class="col-sm-2">
											<label for="">Qty</labl>
										</div>
										<div class="input-group">
											<input type="text" id="qty" name="qty" class="form-control" onkeyup="call()" onkeypress="return isNumberKey(event)" maxlength="6" required="">
										</div>
									</div>
																		
									<div class="form-group ">
										<div class="col-sm-2">
											<label for="">Total</label>
										</div>
										<div class="input-group col-sm-6">
											<span class="input-group-addon">Rs.</span>
											<input type="text" id="producttotal" name="producttotal" class="form-control" required="" data-ng-model="" readonly="">
										</div>
									</div>	

									<div class="form-group">
										<div class="col-sm-2">
											<label for="">payment months</label>
										</div>
										<div class="input-group">
											<input id="productpaymentmonths" name="productpaymentmonths" class="form-control" type="text" onkeyup="ProductInstallmentCalculate()" maxlength="2" required="" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-2">
											<label for="">Interest</label>
										</div>
										<div class="input-group col-sm-6">
											<input id="productinterest" name="productinterest" class="form-control" required="" onkeyup="ProductInstallmentCalculate()" data-ng-model="" type="text" maxlength="2" onkeypress="return isNumberKey(event)">
											<span class="input-group-addon">% per month</span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-2">
											<label for="">Payment for month</label>
										</div>
										<div class="input-group col-sm-6">
											<span class="input-group-addon">Rs.</span>
											<input id="productinstallment" name="productinstallment" class="form-control" required="" data-ng-model="" type="text" readonly="">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-2">
											<label for="">Des</label>
										</div>
										<div class="input-group">
											<input class="form-control" type="text" name="des">
										</div>
									</div>
                                     <button type="submit" name="submit_2" class="btn bg-navy btn-flat">Submit</button>
                                  </fieldset>
                               </form>
						</div>
                      <!-- products End -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 3 -->
        <div id="loan" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Accepting loan for suppliers</h4>
                    </div>
                    <div class="modal-body">
                        
                      <!-- Loan Start -->
						<div class="panel-body ng-scope">
                                 <form action="" method="POST" name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required">
                                    <fieldset>
                                       <div class="form-group">
										<div class="col-sm-2">
											<label for="">Amount</label>
										</div>
										<div class="input-group col-sm-6">
											<span class="input-group-addon">Rs.</span>
											<input id="loanamount" name="loanamount" class="form-control" required="" data-ng-model="" type="text" maxlength="8" onkeypress="return isNumberKey(event)" onkeyup="LoanInstallmentCalculate()">
											<input type="hidden" value="<?php echo $supcode;?>" id="hiddensupcode3" name="hiddensupcode3">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-2">
											<label for="">Payment Months</label>
										</div>
										<div class="input-group">
											<input id="loanmonths" name="loanmonths" class="form-control" type="text" onkeypress="return isNumberKey(event)" onkeyup="LoanInstallmentCalculate()" maxlength="2"  required="">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-2">
											<label for="">Interest</label>
										</div>
										<div class="input-group col-sm-6">
											<input id="loanintrst" name="loanintrst" class="form-control" type="text" onkeypress="return isNumberKey(event)" onkeyup="LoanInstallmentCalculate()" maxlength="2" required="">
											<span class="input-group-addon">% per year</span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-2">
											<label for="">Total for Pay</label>
										</div>
										<div class="input-group col-sm-6">
											<span class="input-group-addon">Rs.</span>
											<input id="loantot" name="loantot" class="form-control" required="" data-ng-model="" type="text" readonly="">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-2">
											<label for="">Installment</label>
										</div>
										<div class="input-group col-sm-6">
											<span class="input-group-addon">Rs.</span>
											<input id="loanpay" name="loanpay" class="form-control" required="" data-ng-model="" type="text" readonly="">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-2">
											<label for="">Des</label>
										</div>
										<div class="input-group">
											<input class="form-control" type="text" name="des">
										</div>
									</div>
                                       <button type="submit" name="submit_3" class="btn bg-navy btn-flat">Submit</button>
                                    </fieldset>
                                 </form>
                </div>
            </div>
        </div>

      <!-- Accept button model END -->
      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          groups 5 ucsc
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">Company</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
     <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
     <!-- chartjs Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <!-- Page Script -->
      <script type="text/javascript">
     $(document).ready(function () {
      
     window.setTimeout(function() {
         $(".alert").fadeTo(1500, 0).slideUp(500, function(){
             $(this).remove(); 
         });
     }, 5000);
      
     });
  </script>
    <script>
      $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
          var clicks = $(this).data('clicks');
          if (clicks) {
            //Uncheck all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
          } else {
            //Check all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
          }
          $(this).data("clicks", !clicks);
        });
      });
    </script>
    <!-- Charts javaScript -->
        <!-- Charts javaScript -->
      <script>
      var ctx = document.getElementById("c").getContext("2d");
      var data = {
        labels: <?php echo($strbarchartlabels);?>,
        datasets: [{
          label: "My First dataset",
          fillColor: "rgba(220,220,220,0.2)",
          strokeColor: "rgba(220,220,220,1)",
          pointColor: "rgba(220,220,220,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: <?php echo($strlinechartvalues);?> 
        }, {
          label: "My Second dataset",
          fillColor: "rgba(151,187,205,0.2)",
          strokeColor: "rgba(151,187,205,1)",
          pointColor: "rgba(151,187,205,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(151,187,205,1)",
          data: <?php echo($strlinechartvalues2);?> 
        }]
      };
      var MyNewChart = new Chart(ctx).Line(data);
    </script>
    <!-- Line Chart JavaScript End -->
    <!-- Bar Chart JavaScript Start -->
    <script type="text/javascript">
      var barData = {
                labels : <?php echo($strbarchartlabels);?>,
                datasets : [
                    {
                        fillColor : "#48A497",
                        strokeColor : "#48A4D1",
                        data : <?php echo($strbarchartvalues);?>
                    }
                ]
            }
            // get bar chart canvas
            var income = document.getElementById("income").getContext("2d");
            // draw bar chart
            new Chart(income).Bar(barData);
    </script>
    <script>
	//scripts for calculations
		
    function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
			return false;
		return true;
	}
	
	function call(){
		var q=parseInt(document.getElementById("amountofaqty").value);
		var w=parseInt(document.getElementById("qty").value);
		var result=q*w;
		   if(isNaN(q)||isNaN(w)){
			   var ansD = document.getElementById("producttotal");
                ansD.value = result;
			}else{
				var ansD = document.getElementById("producttotal");
                ansD.value = result;
			}
	}
	function LoanInstallmentCalculate(){
		var p=parseInt(document.getElementById("loanamount").value);
		var q=parseInt(document.getElementById("loanintrst").value);
		var r=parseInt(document.getElementById("loanmonths").value);
		var totalinterest = (p*q*r)/1200;
		
		var lamount = parseInt(document.getElementById("loanamount").value);
		var loantot = document.getElementById("loantot");
		loantot.value = ((lamount/1) + (totalinterest/1)).toFixed(2);
		
		var loanpay = document.getElementById("loanpay");
		loanpay.value = (((lamount/1)+ (totalinterest/1))/r).toFixed(2) ;
	}
	
	function ProductInstallmentCalculate(){
		var p=parseInt(document.getElementById("producttotal").value);
		var q=parseInt(document.getElementById("productpaymentmonths").value);
		var monthinstall = (p/q).toFixed(2);
		var r=document.getElementById("productinstallment");
		var s=parseInt(document.getElementById("productinterest").value);
		r.value = (((monthinstall*s)/100) + (monthinstall/1)).toFixed(2);
	}

	</script>
  </body>
</html>

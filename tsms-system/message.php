<?php
session_start();
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
  
  //$dbsms->setMessageAsRead($id);
}
$formateddate=date('Y-m-d');


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

          <!-- Sidebar user panel (optional) -->
          <form name="form" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="name" class="form-control" placeholder="Supplier...">
              <span class="input-group-btn">
               <button type="button" name="search" onClick="get();" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
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
               <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
               <li class="active">Dashboad</li>
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
            <!-- Modal For Send message -->
            <div id="myModal" class="login-dialog modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Send message</h4>
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
                    <div class="box-tools pull-right">
                      <div class="has-feedback">
                        <input type="text" class="form-control input-sm" placeholder="Search Mail">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                      </div>
                    </div><!-- /.box-tools -->
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
                      $getdata = $user_home->runQuery("SELECT t.message_id, s.f_name,s.l_name,t.message_code, t.value, t.quantity, t.category, t.date, t.time, t.approve FROM message_temp t,suppliers s WHERE t.supplier_code= s.supplier_code ORDER BY date DESC");
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
                         <div class="is-accept">
                          <!-- here you can get idea about are you going to give this or not -->
                          <div class="col-md-6">
                            <div class="info-box bg-green">
                              <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">41,410</span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: 70%"></div>
                                </div>
                                <span class="progress-description">
                                  70% Increase in 30 Days
                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div><!-- /.col -->
                          <!-- if this mark apear then that means you can not offer anything to the supplier -->
                          <div class="col-md-6">
                            <div class="info-box bg-red">
                              <span class="info-box-icon"><i class="fa fa-thumbs-o-down"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">41,410</span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: 30%"></div>
                                </div>
                                <span class="progress-description">
                                  70% Increase in 30 Days
                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div><!-- /.col -->
                       </div>
                       <?php $btype = "#advance";?>
                       <div class="input-group">
                         <span class="input-group-btn">
                            <a href="<?php echo $btype;?>" name="accept" class="btn bg-navy btn-flat pull-right" data-toggle="modal">Accept</a>                
                            <button type="reset" name="Reject" class="btn bg-denger btn-flat ">Reject</button>
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
                                            <div class="col-sm-3">
                                               <label for="">Amount</label>
                                            </div>
                                            <div class="input-group">
                                               <span class="input-group-addon">Rs.</span>
                                               <input class="form-control" required="" name="total_amount" data-ng-model="" onkeyup="sum();" type="text" value="">
                                               <span class="input-group-addon">.00</span>
                                            </div>
                                         </div>
                                         <div class="form-group">
                                            <div class="col-sm-3">
                                               <label for="">Description</label>
                                            </div>
                                            <div class="input-group">
                                              <textarea class="form-control" rows="5" id="comment" rows="4" cols="35" name="des" placeholder="Comment"></textarea>
                                            </div>
                                         </div>
                                      </fieldset>
                                   </form>
                                </div>
                            <!-- Advance End -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit_1" class="btn bg-navy btn-flat">Submit</button>
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
                         <form name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required">
                            <fieldset>
                               <div class="form-group">
                                  <div class="col-sm-4">
                                     <label for="">Product</label>
                                  </div>
                                  <div class="input-group">
                                    <span class="ui-select">
                                     <select class="form-control">
                                        <option>Chemical</option>
                                        <option>Tea Packet</option>
                                        <option>Manure</option>
                                     </select>
                                  </span>
                                  </div>
                               </div>
                               <div class="form-group">
                                  <div class="col-sm-4">
                                     <label for="">Amount of 1 quntity</label>
                                  </div>
                                  <div class="input-group">
                                     <span class="input-group-addon">Rs.</span>
                                     <input type="text" name="unit_price" class="form-control" required="" data-ng-model="">
                                  </div>
                               </div>
                               <div class="form-group">
                                  <div class="col-sm-4">
                                     <label for="">
                                        Quntity</labl>
                                  </div>
                                  <div class="input-group">
                                  <input type="text" name="units" class="form-control" onkeyup="ProductTotal(this.form)" value="">
                                  </div>
                               </div>
                               <div class="form-group ">
                               <div class="col-sm-4">
                               <label for="">Total</label>
                               </div>
                               <div class="input-group">
                               <span class="input-group-addon">Rs.</span>
                               <input type="text" name="total_product_amount" class="form-control" required="" data-ng-model="" readonly="">
                               <span class="input-group-addon">.00</span>
                               </div>
                               </div>  
                               <div class="form-group">
                                  <div class="col-sm-4">
                                     <label for="">payment months</label>
                                  </div>
                                  <div class="input-group">
                                     <input name="productpaymentmonths" class="form-control" type="text" onkeyup="InstallmentCalculate(this.form)">
                                  </div>
                               </div>
                               <div class="form-group">
                                  <div class="col-sm-4">
                                     <label for="">Interest</label>
                                  </div>
                                  <div class="input-group">
                                     <input name="productinterest" class="form-control" required="" data-ng-model="" type="text">
                                     <span class="input-group-addon">% per month</span>
                                  </div>
                               </div>
                               <div class="form-group">
                                  <div class="col-sm-4">
                                     <label for="">Payment for month</label>
                                  </div>
                                  <div class="input-group">
                                     <span class="input-group-addon">Rs.</span>
                                     <input name="productinstallment" class="form-control" required="" data-ng-model="" type="text" readonly="">
                                     <span class="input-group-addon">.00</span>
                                  </div>
                               </div>
                               <div class="form-group">
                                  <div class="col-sm-4">
                                     <label for="">Description</label>
                                  </div>
                                  <div class="input-group">
                                    <textarea class="form-control" rows="5" id="comment" rows="4" cols="35" name="des" placeholder="Comment"></textarea>
                                  </div>
                               </div>
                            </fieldset>
                         </form>
                      </div>
                      <!-- products End -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-navy btn-flat">Submit</button>
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
                         <form name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required">
                            <fieldset>
                               <div class="form-group">
                                  <div class="col-sm-4">
                                     <label for="">Amount</label>
                                  </div>
                                  <div class="input-group col-sm-6">
                                     <span class="input-group-addon">Rs.</span>
                                     <input name="loan_amount" class="form-control" required="" data-ng-model="" type="text">
                                     <span class="input-group-addon">.00</span>
                                  </div>
                               </div>
                               <div class="form-group">
                                  <div class="col-sm-4">
                                     <label for="">Payment Months</label>
                                  </div>
                                  <div class="input-group">
                                     <input name="loanpaymentmonths" class="form-control" type="text">
                                  </div>
                               </div>
                               <div class="form-group">
                                  <div class="col-sm-4">
                                     <label for="">Interest</label>
                                  </div>
                                  <div class="input-group col-sm-4">
                                     <input class="form-control" type="text">
                                     <span class="input-group-addon">%</span>
                                  </div>
                               </div>
                               <div class="form-group">
                                  <div class="col-sm-4">
                                     <label for="">Total for Pay</label>
                                  </div>
                                  <div class="input-group col-sm-6">
                                     <span class="input-group-addon">Rs.</span>
                                     <input name="loantotalforpay" class="form-control" required="" data-ng-model="" type="text" readonly="">
                                     <span class="input-group-addon">.00</span>
                                  </div>
                               </div>
                               <div class="form-group">
                                  <div class="col-sm-4">
                                     <label for="">Installment</label>
                                  </div>
                                  <div class="input-group col-sm-6">
                                     <span class="input-group-addon">Rs.</span>
                                     <input name="loaninstallforpay" class="form-control" required="" data-ng-model="" type="text" readonly="">
                                     <span class="input-group-addon">.00</span>
                                  </div>
                               </div>
                               <div class="form-group">
                                  <div class="col-sm-4">
                                     <label for="">Description</label>
                                  </div>
                                  <div class="input-group">
                                     <input name="des3" class="form-control" type="text">
                                  </div>
                               </div>
                            </fieldset>
                         </form>
                      </div>
                      
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-navy btn-flat">Submit</button>
                    </div>
                </div>
            </div>
        </div>

      <!-- Accept button model END -->
      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Anything you want
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
    
  </body>
</html>

<?php
   session_start();
   require_once 'classes/class.user.php';
   $user_home = new USER();
   require_once 'DB/dbupdates.php';
   $dbupdates=new DBupdates();
   if(!$user_home->is_logged_in())
   {
     $user_home->redirect('index.php');
   }
   
   $stmt = $user_home->runQuery("SELECT * FROM users WHERE id=:uid");
   $stmt->execute(array(":uid"=>$_SESSION['userSession']));
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   ?>
<!DOCTYPE html>
<html>
   <title>Daily Update</title>
   <?php include "include/head.php" ?>
   <script type="text/javascript" src="plugins/alert/dist/jquery-1.11.3.min.js"></script>
   <script type="text/javascript" src="plugins/alert/dist/sweetalert.min.js"></script>
   <script type="text/javascript" src="plugins/alert/dist/sweetalert-dev.js"></script>
   <script type="text/javascript">
      // $(function(){
      
      // swal("Sweet Alert hureeeeee!");
      
      // });
   </script>
   <?php
      $code="";
      $supname="";
      $supnic="";
      $apptearate="";
      $suppkgs="";
      $totincome="";
      $paid="";
      $remainbalance="";
      
      $formateddate=date('Y-m-d');
      
      if(isset($_POST['search'])){
        $code=$_POST['code'];
        if($dbupdates->checkSupplierExist($code)== true){
          $supname=$dbupdates->getSupplierName($code);
          $supnic=$dbupdates->getMyNIC($code);
          $apptearate=$dbupdates->thisMonthTeaRate();
          
          $kgs1=$dbupdates->getTodayMySupply($code);
          $kgs2=$dbupdates->myTotalSupplyOfaMonth($code,$formateddate);
          
          $pay1=$dbupdates->thisMonthPayForMe($code);
          $pay2=$dbupdates->todayPayForMe($code);
          
          $suppkgs=($kgs1*1)+($kgs2*1);
          $pay=($pay1*1)+($pay2*1);
          
          $totincome=$suppkgs*$apptearate;
          $paid=($pay);
          $remainbalance=($totincome-$pay);
        
        
          // CHART 1- BAR CHART
        $mysupply=$dbupdates->myTotalSupplyOf6Months($code);
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
        $myincome=$dbupdates->myIncomeOf6Months($code);
        $strlinechartvalues="[".$myincome[5].",".$myincome[4].",".$myincome[3].",".$myincome[2].",".$myincome[1].",".$myincome[0]."]";  
        
        $mymiddlemonthpay=$dbupdates->myMiddleMonthPaymentsOf6Months($code);
        $strlinechartvalues2="[".$mymiddlemonthpay[5].",".$mymiddlemonthpay[4].",".$mymiddlemonthpay[3].",".$mymiddlemonthpay[2].",".$mymiddlemonthpay[1].",".$mymiddlemonthpay[0]."]";
        
        
        }else{
          $msg='<div class="callout callout-warning">
                          <h4>Supplier Does not exist!!</h4>
                        </div>';
        }
      }
      
      
      
      /*Form submits -- start*/
      //advance 
      if(isset($_POST['submit_1'])){
        $supcode1=($_POST['hiddensupcode1']);
        $total_amount=($_POST['total_amount']);
        $des=($_POST['des']);
        $editor=$row['id'];
        if($dbupdates->checkSupplierExist($supcode1)== true){
          $datafields=array($formateddate,$supcode1,"adv","","",$total_amount,"1",$total_amount,$des,$editor);
          $res=$dbupdates->addTodayService($datafields);
          if($res==true){
            echo '<script>$(function(){ swal("Success!", "Successfully inserted","success")}); </script>';
          }else{
            echo '<script>$(function(){ swal("Error!",""Error of Connection...",error")}); </script>';
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
        if($dbupdates->checkSupplierExist($supcode2)==true){
          $res=true;
          $dateMula=substr($formateddate,0,5);
          $dateMada=substr($formateddate,5,7);
          $dateAga=substr($formateddate,7);   
          for($i=0;$i<$p_installments;$i++){
            $dateMada=($dateMada/1)+$i;
            if(strlen($dateMada)==1){
              $dateMada="0".$dateMada;
            }
            if($dateMada==12){
              $dateMada="12";
              $dateMula=((substr($formateddate,0,4))+1)."-";
            }
            $dte=$dateMula.$dateMada.$dateAga;
            $datafields=array($dte,$supcode2,$loancode,$unit_price,$qty,$p_total_amount,$p_installments,$p_amountofinstallment,$des,$row['id']);
            $retres=$dbupdates->addTodayService($datafields);
            if($res==false){
              $res=false;
            }       
          }
          if($res==true){
            echo '<script>$(function(){ swal("Success!", "Successfully inserted","success")}); </script>';
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
        
        if($dbupdates->checkSupplierExist($supcode3)==true){
          $res=true;
          $dateMula=substr($formateddate,0,5);
          $dateMada=substr($formateddate,5,7);
          $dateAga=substr($formateddate,7);   
          for($i=0;$i<$installments;$i++){
            $dateMada=($dateMada/1)+$i;
            if(strlen($dateMada)==1){
              $dateMada="0".$dateMada;
            }
            if($dateMada==12){
              $dateMada="12";
              $dateMula=((substr($formateddate,0,4))+1)."-";
            }
            $dte=$dateMula.$dateMada.$dateAga;
            $datafields=array($dte,$supcode3,"lon","","",$total_amount,$installments,$amountofinstallment,$des,$row['id']);
            $retres=$dbupdates->addTodayService($datafields);
            if($res==false){
              $res=false;
            }       
          }
          if($res==true){
            echo '<script>$(function(){ swal("Success!", "Successfully inserted","success")}); </script>';
          }else{
            echo '<script>$(function(){ swal("Error!",""Error of Connection...",error")}); </script>';
          }   
        }
        
      }
      /*Form submits -- end*/
      
      
      ?>
   <div class="wrapper">
      <?php include "include/header.php" ?>
      <!-- Select2 -->
      <link rel="stylesheet" href="plugins/select2/select2.min.css">
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
               <li class="treeview">
                  <a href="message.php">
                  <i class="fa fa-envelope"></i> <span>Message</span>
                  <small class="label pull-right bg-yellow"></small>
                  </a>
               </li>
               <li class="active treeview">
                  <a href="home.html">
                  <i class="fa fa-edit"></i> <span>Updates</span>
                  <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                     <li><a href="update.php"><i class="fa fa-circle-o"></i>Daily Update</a></li>
                     <li class="active"><a href="service.php"><i class="fa fa-circle-o"></i>Service</a></li>
                  </ul>
               </li>
               <li class="treeview">
                  <a href="Supreg.html">
                  <i class="fa fa-group"></i> <span>Suppliers</span>
                  <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                     <li><a href="suppliers.php"><i class="fa fa-circle-o"></i> Registation</a></li>
                     <li><a href="view.php"><i class="fa fa-circle-o"></i> View</a></li>
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
            </ul>
            <!-- /.sidebar-menu -->
         </section>
         <!-- /.sidebar -->
         <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <h1>
               Update Area
               <small>Service Update</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="home.php"><i class="fa fa-dashboard"></i> Dashboad</a></li>
               <li><a href="update.php"><i class="fa fa-dashboard"></i> Update</a></li>
               <li class="active">Service</li>
            </ol>
         </section>
         <!-- Main content -->
         <div id="content" class="content">
            <div class="">
               <div class="box-body">
                  <div class="col-md-12">
                     <!-- Pass loan -->
                     <div class="row">
                        <!-- supplier descriptions -->
                        <div class="col-md-6">
                           <div class="box box-solid">
                              <div class="box-header with-border">
                                 <i class="fa fa-text-width"></i>
                                 <h3 class="box-title">Supplier Description</h3>
                                 <form name="search" method="post">
                                    <div class="input-group col-sm-5 pull-right">
                                       <input maxlength="4" type="search" name="code" class="form-control" placeholder="Search...">
                                       <span class="input-group-btn">
                                       <button type="submit" name="search"  id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                                       </span>
                                    </div>
                                 </form>
                              </div>
                              <?php 
                                 $supcode = "0001";
                                  ?>
                              <!-- /.box-header -->
                              <div class="box-body" id="search_rr">
                                 <dl class="dl-horizontal example1">
                                    <?php if(!empty($msg)){echo $msg;}?>
                                    <p>Supplier details
                                    <p>
                                    <dt>Code: </dt>
                                    <dd><?php echo($code);?></dd>
                                    <dt>Name: </dt>
                                    <dd><?php echo($supname);?></dd>
                                    <dt>NIC NO: </dt>
                                    <dd><?php echo($supnic);?></dd>
                                    <dt>Approximate tea Rate: </dt>
                                    <dd>Rs. <?php echo($apptearate);?></dd>
                                    <dt>Supply kgs: </dt>
                                    <dd> <?php echo($suppkgs);?>Kg</dd>
                                    <dt>Total income: </dt>
                                    <dd>Rs. <?php echo($totincome);?></dd>
                                    <dt>Paid: </dt>
                                    <dd>Rs.<?php echo($paid);?> </dd>
                                    <dt>remain balance: </dt>
                                    <dd>Rs.
                                       <?php echo($remainbalance);
                                          if($remainbalance<0){echo( "<p class='text-red'> No Sufficient Balance !<br>Rs. $remainbalance Should be paid for factory </p>");}
                                          ?>
                                    </dd>
                                 </dl>
                              </div>
                              <!-- /.box-body -->
                           </div>
                           <!-- /.box -->
                           <?php if($dbupdates->checkSupplierExist($code)==true){ ?>
                           <div class="supplier-ditails">
                              <!-- Bar Chart Start -->
                              <div class="box box-success">
                                 <div class="box-header with-border">
                                    <h3 class="box-title">Supply of last 6 months (kg)</h3>
                                    <div class="box-tools pull-right">
                                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                 </div>
                                 <div class="box-body">
                                    <div class="chart">
                                       <canvas id="income" width="500" height="230"></canvas>
                                    </div>
                                 </div>
                                 <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                              <!-- Bar Chart End -->
                              <!-- line Chart Start -->
                              <div class="box box-success">
                                 <div class="box-header with-border">
                                    <h3 class="box-title">Income vs middle month payments (Rs)</h3>
                                    <div class="box-tools pull-right">
                                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                 </div>
                                 <div class="box-body">
                                    <div class="chart">
                                       <canvas id="c" width="500" height="230"></canvas>
                                    </div>
                                 </div>
                                 <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                              <!-- Line Chart End -->
                           </div>
                           <?php } ?>
                        </div>
                        <!-- ./col -->
                        <!-- supplier descriptions END-->
                        <?php if($dbupdates->checkSupplierExist($code)==true){ ?>
                        <!--  advance -->
                        <div class="col-md-6">
                           <div class="nav-tabs-custom">
                              <ul class="nav nav-tabs">
                                 <li class="active"><a href="#advance" data-toggle="tab">Advance</a></li>
                                 <li><a href="#products" data-toggle="tab">Products</a></li>
                           <?php if($user_home->admin($row['id'])){?> <li><a href="#loan" data-toggle="tab">Loan</a></li>  <?php } ?>  
                              </ul>
                              <div class="tab-content">
                                 <div class="tab-pane active" id="advance">
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
                                                   <input type="hidden" value="<?php echo $code;?>" id="hiddensupcode1" name="hiddensupcode1" >
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
                                    <section class="content">
                                       <div class="box box-success color-palette-box">
                                          <div class="box-body">
                                             <?php
                                                $getdata = $user_home->runQuery("SELECT* FROM today_service WHERE sup_code=$code ORDER BY date DESC");
                                                $getdata->execute();
                                                ?>
                                             <table id="advance1" class="table table-bordered table-striped">
                                                <thead>
                                                   <tr>
                                                      <th>Amount</th>
                                                      <th>Description</th>
                                                      <th>State</th>
                                                      <th>Action</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <?php 
                                                      if($getdata->rowCount() > 0)
                                                        {
                                                         while($row=$getdata->FETCH(PDO::FETCH_ASSOC)){
                                                          ?>
                                                   <tr>
                                                      <td><?php print($row['total_amount']); ?></td>
                                                      <td><?php print($row['description']); ?></td>
                                                      <td>null</td>
                                                      <td>null</td>
                                                   </tr>
                                                   <?php
                                                      }
                                                      }
                                                      ?>
                                                </tbody>
                                             </table>
                                          </div>
                                       </div>
                                       <!-- /.box-body -->
                                    </section>
                                 </div>
                                 <!-- /.tab-pane -->
                                 <div class="tab-pane" id="products">
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
                                             <input type="hidden" value="<?php echo $code;?>" id="hiddensupcode2" name="hiddensupcode2" >
                                             <div class="form-group">
                                                <div class="col-sm-2">
                                                   <label for="">
                                                      Qty</labl>
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
                                    <section class="content">
                                       <div class="box box-success color-palette-box">
                                          <div class="box-body">
                                             <?php
                                                $getdata = $user_home->runQuery("SELECT sup_code, unit_price,total_amount,description FROM today_service WHERE sup_code= $code ORDER BY date DESC");
                                                $getdata->execute();
                                                ?>
                                             <table id="products1" class="table table-bordered table-striped">
                                                <thead>
                                                   <tr>
                                                      <th>Amount</th>
                                                      <th>Unit price</th>
                                                      <th>Description</th>
                                                      <th>State</th>
                                                      <th>Action</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <?php 
                                                      if($getdata->rowCount() > 0)
                                                        {
                                                         while($row=$getdata->FETCH(PDO::FETCH_ASSOC)){
                                                          ?>
                                                   <tr>
                                                      <td><?php print($row['total_amount']); ?></td>
                                                      <td><?php print($row['unit_price']);?></td>
                                                      <td><?php print($row['description']); ?></td>
                                                      <td>null</td>
                                                      <td>null</td>
                                                   </tr>
                                                   <?php
                                                      }
                                                      }
                                                      ?>
                                                </tbody>
                                             </table>
                                          </div>
                                          <!-- /.box-body -->
                                       </div>
                                       <!-- /.box -->
                                    </section>
                                    <!-- products End -->
                                 </div>
                                 <!-- /.tab-pane -->
                                 <div class="tab-pane" id="loan">
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
                                                   <input type="hidden" value="<?php echo $code;?>" id="hiddensupcode3" name="hiddensupcode3">
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
                                       <section class="content">
                                          <div class="box box-success color-palette-box">
                                             <div class="box-body">
                                                <?php
                                                   $getdata = $user_home->runQuery("SELECT sup_code,total_amount,description FROM today_service WHERE sup_code= $code ORDER BY date DESC");
                                                   $getdata->execute();
                                                   ?>
                                                <table id="loan1" class="table table-bordered table-striped">
                                                   <thead>
                                                      <tr>
                                                         <th>Amount</th>
                                                         <th>Description</th>
                                                         <th>State</th>
                                                         <th>Action</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php 
                                                         if($getdata->rowCount() > 0)
                                                           {
                                                            while($row=$getdata->FETCH(PDO::FETCH_ASSOC)){
                                                             ?>
                                                      <tr>
                                                         <td><?php print($row['total_amount']); ?></td>
                                                         <td><?php print($row['description']); ?></td>
                                                         <td>null</td>
                                                         <td>null</td>
                                                      </tr>
                                                      <?php
                                                         }
                                                         }
                                                         ?>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                          <!-- /.box-body -->
                                       </section>
                                    </div>
                                    <!-- Loan End -->
                                    
                                 </div>
                                 <!-- /.tab-pane -->
                              </div>
                              <!-- /.tab-content -->
                           </div>
                        </div>
                        <!-- loan advance End -->
                        <?php } ?>
                     </div>
                     <!-- Pass loan END -->
                  </div>
               </div>
            </div>
            <!-- /.row -->
            <!-- END Update TABS -->
            <div class="row">
               <div class="col-md-12">
                  <?php 
                     $s = "SELECT * FROM `today_service` WHERE date=curdate()";
                      $smgt = $user_home->runQuery($s);
                      $smgt->execute();
                      ?>
                  <div class="info-box">
                     <div class="box box-solid">
                        <div class="box-header with-border">
                           <h3 class="box-title">Today All approved services</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                           <div class="table-responsive">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>sup_code</th>
                                       <th>Loan code</th>
                                       <th>Unit price</th>
                                       <th>Units</th>
                                       <th>total_amount</th>
                                       <th>No Of Installment</th>
                                       <th>Amount Of Installment</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       if($smgt->rowCount() > 0)
                                         {
                                           while($roww=$smgt->FETCH(PDO::FETCH_ASSOC))
                                           {?>
                                    <tr>
                                       <td><?php echo $roww['sup_code'];?></td>
                                       <td><?php echo $roww['loan_code'];?></td>
                                       <td><?php echo $roww['unit_price'];?></td>
                                       <td><?php echo $roww['units'];?></td>
                                       <td><?php echo $roww['total_amount'];?></td>
                                       <td><?php echo $roww['no_of_installment'];?></td>
                                       <td><?php echo $roww['amount_of_installment'];?></td>
                                    </tr>
                                    <?php
                                       }
                                         } 
                                        ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.content -->
      </div>
      <!-- Main Footer -->
      <footer class="main-footer">
         <!-- To the right -->
         <div class="pull-right hidden-xs">
            groups 5 ucsc
         </div>
         <!-- Default to the left -->
         <strong>Copyright &copy; 2015 <a href="#">Company</a>.</strong> All rights reserved.
      </footer>
   </div>
   <!-- ./wrapper -->
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
   <!-- chartjs Scripts -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
   <!-- Bar Chart JavaScript Start -->
   <script type="text/javascript">
      var barData = {
                labels : ["January","February","March","April","May","June"],
                datasets : [
                    {
                        fillColor : "#48A497",
                        strokeColor : "#48A4D1",
                        data : [456,479,324,569,702,600]
                    }
                ]
            }
            // get bar chart canvas
            var income = document.getElementById("income").getContext("2d");
            // draw bar chart
            new Chart(income).Bar(barData);
   </script>
   <!-- Charts Ends -->
   <!-- Select2 -->
   <script src="plugins/select2/select2.full.min.js"></script>
   <!-- DataTables -->
   <script src="plugins/datatables/jquery.dataTables.min.js"></script>
   <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
   <!-- Data tabale JavaScript -->
   <script>
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
      
        $(function () {
          $("#products1").DataTable({
            "paging": false,
             "lengthChange": true,
             "searching": false,
             "ordering": false,
             "info": false,
             "autoWidth": true
          });
          $('#advance1').DataTable();
          $('#loan1').DataTable({
            "paging": false,
             "lengthChange": true,
             "searching": false,
             "ordering": false,
             "info": false,
             "autoWidth": true
          });
        });
   </script>
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
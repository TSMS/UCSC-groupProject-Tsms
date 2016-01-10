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
	if($dbupdates->checkSupplierExist($code)==true){
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
	}else{
		$msg='<div class="callout callout-warning">
                    <h4>Supplier Does not exist!!</h4>
                  </div>';
	}
	
	
	
	
}


?>


<!DOCTYPE html>
<html>
<title>Daily Update</title>
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
            <li class="treeview">
              <a href="message.php">
                <i class="fa fa-envelope"></i> <span>Message</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="active treeview">
              <a href="home.html">
                <i class="fa fa-edit"></i> <span>Update</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="update.php"><i class="fa fa-circle-o"></i>Daily Update</a></li>
                <li class="active"><a href="service.php"><i class="fa fa-circle-o"></i>Service</a></li>
                <li><a href="editupdate.php"><i class="fa fa-circle-o"></i>Edit</a></li>
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
               Update Area
               <small>Supply andService Update</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
               <li class="active">Dashboad</li>
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
                               <p>Supplier details<p>
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
                               <dd>Rs.<?php echo($remainbalance);if($remainbalance<=0){echo( "<p class='text-red'>No Enough Balance !");}?></dd>
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
                         <?php } ?>
                    </div><!-- ./col -->
                    <!-- supplier descriptions END-->
                    <?php if($dbupdates->checkSupplierExist($code)==true){ ?>
                    <!-- loan advance -->
                    <div class="col-md-6">
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#advance" data-toggle="tab">Advance</a></li>
                          <li><a href="#products" data-toggle="tab">Products</a></li>
                          <li><a href="#loan" data-toggle="tab">Loan</a></li>
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
                                               <input class="form-control" required="" name="total_amount" data-ng-model="" onkeyup="sum();" type="text" value="">
                                               <span class="input-group-addon">.00</span>
                                            </div>
                                         </div>
                                         <div class="form-group">
                                            <div class="col-sm-2">
                                               <label for="">Des</label>
                                            </div>
                                            <div class="input-group">
                                              <textarea class="form-control" rows="5" id="comment" rows="4" cols="35" name="des" placeholder="Comment"></textarea>
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
                                      else
                                      {
                                       print("nothing here...");  
                                      }
                                      ?>
                                </tbody>
                             </table>
                          </div>
                      </div>
                    <!-- /.box-body -->
                 </section>
                          </div><!-- /.tab-pane -->
                          <div class="tab-pane" id="products">
                            <!-- products start -->
                            <div class="panel-body ng-scope">
                               <form name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required">
                                  <fieldset>
                                     <div class="form-group">
                                        <div class="col-sm-4">
                                           <label for="">Product</label>
                                        </div>
                                        <span class="ui-select col-sm-4">
                                           <select class="form-control">
                                              <option>Chemical</option>
                                              <option>Tea Packet</option>
                                              <option>Manure</option>
                                           </select>
                                        </span>
                                     </div>
                                     <div class="form-group">
                                        <div class="col-sm-4">
                                           <label for="">Amount of 1 qty</label>
                                        </div>
                                        <div class="input-group col-sm-4">
                                           <span class="input-group-addon">Rs.</span>
                                           <input type="text" name="unit_price" class="form-control" required="" data-ng-model="">
                                        </div>
                                     </div>
                                     <div class="form-group">
                                        <div class="col-sm-4">
                                           <label for="">
                                              Qty</labl>
                                        </div>
                                        <div class="input-group">
                                        <input type="text" name="units" class="form-control" onkeyup="ProductTotal(this.form)" value="">
                                        </div>
                                     </div>
                                     <div class="form-group ">
                                     <div class="col-sm-4">
                                     <label for="">Total</label>
                                     </div>
                                     <div class="input-group col-sm-6">
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
                                        <div class="input-group col-sm-6">
                                           <input name="productinterest" class="form-control" required="" data-ng-model="" type="text">
                                           <span class="input-group-addon">% per month</span>
                                        </div>
                                     </div>
                                     <div class="form-group">
                                        <div class="col-sm-4">
                                           <label for="">Payment for month</label>
                                        </div>
                                        <div class="input-group col-sm-6">
                                           <span class="input-group-addon">Rs.</span>
                                           <input name="productinstallment" class="form-control" required="" data-ng-model="" type="text" readonly="">
                                           <span class="input-group-addon">.00</span>
                                        </div>
                                     </div>
                                     <div class="form-group">
                                        <div class="col-sm-4">
                                           <label for="">Des</label>
                                        </div>
                                        <div class="input-group">
                                           <input name="des2" class="form-control" type="text">
                                        </div>
                                     </div>
                                     <button type="submit" class="btn bg-navy btn-flat">Submit</button>
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
                                          else
                                          {
                                       print("nothing here...");  
                                      }
                                          ?>
                                    </tbody>
                                </table>
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
                          </section>
                            <!-- products End -->
                          </div><!-- /.tab-pane -->
                          <div class="tab-pane" id="loan">
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
                                       <button type="submit" class="btn bg-navy btn-flat">Submit</button>
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
                                      else
                                      {
                                       print("nothing here...");  
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
                          </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                      </div>
                      


                    </div>
                    <!-- loan advance End -->
                    <?php } ?>
                  </div>
                  <!-- Pass loan END -->

              </div>
            </div>
          </div> <!-- /.row -->
          <!-- END Update TABS -->

         </div> <!-- /.content -->
      </div>

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
    <!-- chartjs Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
     <!-- Charts javaScript -->
      <script>
      var ctx = document.getElementById("c").getContext("2d");
      var data = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
          label: "My First dataset",
          fillColor: "rgba(220,220,220,0.2)",
          strokeColor: "rgba(220,220,220,1)",
          pointColor: "rgba(220,220,220,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [65, 59, 80, 81, 56, 55, 40]
        }, {
          label: "My Second dataset",
          fillColor: "rgba(151,187,205,0.2)",
          strokeColor: "rgba(151,187,205,1)",
          pointColor: "rgba(151,187,205,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(151,187,205,1)",
          data: [28, 48, 40, 19, 86, 27, 90]
        }]
      };
      var MyNewChart = new Chart(ctx).Line(data);
    </script>
    <!-- Line Chart JavaScript End -->
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
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Data tabale JavaScript -->
    <script>
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
	
		function isNumberKey(evt){
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))//if (charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;
		}
		
      $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
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

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {
          e.preventDefault();
          //detect type
          var $this = $(this).find("a > i");
          var glyph = $this.hasClass("glyphicon");
          var fa = $this.hasClass("fa");

          //Switch states
          if (glyph) {
            $this.toggleClass("glyphicon-star");
            $this.toggleClass("glyphicon-star-empty");
          }

          if (fa) {
            $this.toggleClass("fa-star");
            $this.toggleClass("fa-star-o");
          }
        });
      });
    </script>
  </body>
</html>

<?php
session_start();
require_once 'classes/class.user.php';
$user_home = new USER();

require_once 'DB/dbdashboard.php';
$dbdashboard=new DBDashboard();

//dashboard square 1
$str=$dbdashboard->getDashboardTeaRate(); 
$rest1 = substr($str, 0, -3);
$rest2 = substr($str, -3,3);
//dashboard square 2
$res3=$dbdashboard->thisMonthSupplyPrecentage();
//dashboard square 3
$res4=$dbdashboard->unReadSMScount();
//dashboard square 4
$res5=$dbdashboard->todayCurSupplyPrecentage();

//chart - barchart
$resarray1=$dbdashboard->factoryTotalSupplyOf6Months();
$strbarchartvalues="[".$resarray1[5].",".$resarray1[4].",".$resarray1[3].",".$resarray1[2].",".$resarray1[1].",".$resarray1[0]."]";
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

//CHARTs  - line charts
$arrRes1=$dbdashboard->realTeaRatesOfLast6Months();
$arrRes2=$dbdashboard->approxTeaRatesOfLast6Months();
$strlinechartRealTRate="[".$arrRes1[5].",".$arrRes1[4].",".$arrRes1[3].",".$arrRes1[2].",".$arrRes1[1].",".$arrRes1[0]."]";
$strlinechartAppTRate="[".$arrRes2[5].",".$arrRes2[4].",".$arrRes2[3].",".$arrRes2[2].",".$arrRes2[1].",".$arrRes2[0]."]";




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
            <li class="active">
              <a href="dashboard.html">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
              <a href="message.html">
                <i class="fa fa-envelope"></i> <span>Message</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="supplyup.html">
                <i class="fa fa-edit"></i> <span>Update</span>
              </a>
            </li>
            <li class="treeview">
              <a href="Supreg.html">
                <i class="fa fa-group"></i> <span>Suppliers</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="sup_reg.php"><i class="fa fa-circle-o"></i> Registation</a></li>
                <li><a href="supplier_view.php"><i class="fa fa-circle-o"></i> View</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Edit</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="report.php">
                <i class="fa fa-print"></i> <span>Report</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-download"></i> <span>Back-Ups</span>
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
               Dashboad
               <small></small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
               <li class="active">Dashboad</li>
            </ol>
         </section>
         <!-- Main content -->                                     <!-- 4 .....................BOXes.................................. -->
		 
         <div id="content" class="content">
            <div id="search_r"></div>
            <!-- Brief status  -->
            <div class="row">
               <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-teal">
                     <div class="inner">
                        <h3>Rs.<?php  echo($rest1);?><sub style="font-size: 15px"><?php echo($rest2);?></sub></h3>
                        <p>Tea rate</p>
                     </div>
                     <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                     </div>
                     <a href="supply_update.php" class="small-box-footer">
                     More info <i class="fa fa-arrow-circle-right"></i>
                     </a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                     <div class="inner">
                        <h3><?php echo($res3); ?><sub style="font-size: 20px">%</sub></h3>
                        <p>Supply Rate:This Month</p>
                     </div>
                     <div class="icon">
                        <i class="fa fa-leaf"></i>
                     </div>
                     <a href="supply_update.php" class="small-box-footer">
                     More info <i class="fa fa-arrow-circle-right"></i>
                     </a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-olive">
					<div class="inner">
                        <h3><?php echo($res5); ?><sub style="font-size: 20px">%</sub></h3>
                        <p>Supply Rate:Today</p>
                     </div>
					 <div class="icon">
                        <i class="fa fa-circle-o-notch"></i>
                     </div>
                     <a href="message.php" class="small-box-footer">
                     More info <i class="fa fa-arrow-circle-right"></i>
                     </a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-blue">
                     <div class="inner">
                        <h3><?php echo($res4);?><sup style="font-size: 20px"></sup></h3>
                        <p>Supplier Requests</p>
                     </div>
                     <div class="icon">
                        <i class="fa fa-envelope"></i>
                     </div>
                     <a href="report.php" class="small-box-footer">
                     More info <i class="fa fa-arrow-circle-right"></i>
                     </a>
                  </div>
               </div><!-- ./col -->
            </div><!-- /.row -->
            <!-- Brief status END-->

            <!-- Suppliy rates charts -->                                               <!-- 4 .....................CHARTs.................................. -->
            <div class="col-md-6">
                <!-- Bar Chart Start -->
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Supply of Last 6 Months (kg)</h3>
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
              </div>
			<div class="row">
              <div class="col-md-6">
                <!-- line Chart Start -->
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Tea Rates of Last 6 Months (Rs)</h3>
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
            </div>
            <!-- Supply rates charts END -->

            <!-- User Details -->
            <div class="row">
              <div class="col-md-12">
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">User Ditails</h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <p>Helo user details Helo user details Helo user details Helo user details Helo user details</p>
                    <p>Helo user details Helo user details Helo user details Helo user details Helo user details</p>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div><!-- /.col -->
            </div>
            <!-- User Details End -->

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
	
	<!-- Bar Chart JavaScript Start -->
    <script type="text/javascript">
      var barData = {
                labels : <?php echo($strbarchartlabels); ?>,
                datasets : [
                    {
                        fillColor : "#48A497",
                        strokeColor : "#48A4D1",
                        data : <?php echo($strbarchartvalues); ?>
                    }
                ]
            }
            // get bar chart canvas
            var income = document.getElementById("income").getContext("2d");
            // draw bar chart
            new Chart(income).Bar(barData);
    </script>
    <!-- bar Chart JavaScript End -->
    <!-- Line Chart JavaScript -->
    <script>
      var ctx = document.getElementById("c").getContext("2d");
      var data = {
		labels: <?php echo($strbarchartlabels); ?>,
        
        datasets: [{
          label: "My First dataset",
          fillColor: "rgba(220,220,220,0.2)",
          strokeColor: "rgba(220,220,220,1)",
          pointColor: "rgba(220,220,220,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: <?php echo($strlinechartAppTRate); ?>
        }, {
          label: "My Second dataset",
          fillColor: "rgba(151,187,205,0.2)",
          strokeColor: "rgba(151,187,205,1)",
          pointColor: "rgba(151,187,205,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(151,187,205,1)",
          data: <?php echo($strlinechartRealTRate); ?>
        }]
      };
      var MyNewChart = new Chart(ctx).Line(data);
    </script>
    <!-- Line Chart JavaScript End -->
    
  </body>
</html>

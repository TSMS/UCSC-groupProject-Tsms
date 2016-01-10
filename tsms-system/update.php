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
      $code="Supplier Doesn't exist!";
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
                  <li class="active" ><a href="update.php"><i class="fa fa-circle-o"></i>Daily Update</a></li>
                  <li><a href="service.php"><i class="fa fa-circle-o"></i>Service</a></li>
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
         <small>Supply andService Update</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
         <li class="active">Dashboad</li>
      </ol>
   </section>
   <!-- Main content -->
   <div id="content" class="content">
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
        </div>
         <div class="box-body">
          <div class="col-md-6" id="info">
                <?php if(isset($_SESSION["mesage"])) 
                {
                  echo $_SESSION["mesage"];
                  unset($_SESSION['mesage']); 
                }?>
               </div>
            <div class="col-md-12">
               <div class="row">
                  <div class="form-group">
                     <label for="Date" class="control-label">Date</label>
                     <div class="col-sm-4">
                        <input type="Date" class="form-control" id="date" placeholder="Date">
                     </div>
                     <div id="update"></div>
                     <span id="loaderIcon"></span>
                  </div>
               </div>
               <form role="form" method="post" action="addupdate.php">
                  <div class="row">
                     <div class="col-md-2">
                        <label>Supplier Code: </label>
                        <input class="form-control" name="supcode" placeholder="Suplier Code" type="text" >
                     </div>
                     <div class="col-md-2">
                        <label>Quantity: </label>
                        <input class="form-control" name="units" placeholder="units" type="text" onkeypress="return isNumberKey(event)">
                     </div>
                     <div class="col-md-2">
                        <label>Approved kgs: </label>
                        <input class="form-control" name="appkgs" placeholder="kgs" type="text" required onkeypress="return isNumberKey(event)">
                     </div>
                     <div class="col-md-2">
                        <label>supplied kgs: </label>
                        <input class="form-control" name="supkgs" placeholder="sup-kgs" type="text"onkeypress="return isNumberKey(event)">
                     </div>
                     <div class="col-xs-2">
                        <br>
                        <button type="submit" name="submit" class="btn bg-navy btn-flat">Submit</button>
                     </div>
                  </div>
               </form>
            </div>
            <div class="col-md-12">
               <section class="content">
                  <div class="box-body">
                    <?php
                      $getdata = $user_home->runQuery("SELECT t.supplier_code, s.f_name,s.l_name,t.approved_kgs, t.supplied_kgs, t.units FROM today_supply t,suppliers s WHERE t.supplier_code= s.supplier_code ORDER BY date DESC");
                      $getdata->execute();
                      ?>
                     <table id="supplier-updates" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>Supplier Name</th>
                              <th>Units</th>
                              <th>Suuply kgs</th>
                              <th>Approved Kgs</th>
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
                              <td><?php print($row['f_name']." ".$row['l_name']); ?></td>
                              <td><?php print($row['units']); ?></td>
                              <td><?php print($row['approved_kgs']); ?></td>
                              <td><?php print($row['supplied_kgs']); ?></td>
                              <td>Status</td>
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
                     </table>
                  </div>
                  <!-- /.box-body -->
               </section>
            </div>
            <!-- /.tab-pane -->
         </div>
         <!-- /.content -->
      </div>
    </div>
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
   <!-- DataTables -->
   <script src="plugins/datatables/jquery.dataTables.min.js"></script>
   <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
   <!-- Data tabale JavaScript -->
   <script>
      $(function () {
        $('#supplier-updates').DataTable();
        // $('#supplier-updates2').DataTable({
        //   "paging": true,
        //   "lengthChange": false,
        //   "searching": false,
        //   "ordering": true,
        //   "info": true,
        //   "autoWidth": false
        // });
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
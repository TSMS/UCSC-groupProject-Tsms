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
?>
<!DOCTYPE html>
<html>
<title>View Suppliers</title>
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
              <a href="dashboard.html">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
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
            <li class="active treeview">
              <a href="Supreg.html">
                <i class="fa fa-group"></i> <span>Suppliers</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="suppliers.php"><i class="fa fa-circle-o"></i> Registation</a></li>
                <li class="active"><a href="view.php"><i class="fa fa-circle-o"></i> Edit</a></li>
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
               View Suppliers
               <small>View Supplier description & Edit</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="supplier.html"><i class="fa fa-dashboard"></i> Suppliers</a></li>
               <li class="active">view</li>
            </ol>
         </section>
         <!-- Main content -->
         <div id="content" class="content">
            
            <section class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-body">
                      <?php
                      $getdata = $user_home->runQuery("SELECT* FROM suppliers ORDER BY  joined DESC");
                      $getdata->execute();
                      ?>
                    <div class="table-responsive">
                      <table id="supplier-data" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Sup Code</th>
                            <th>Name</th>
                            <th>Aobile No</th>
                            <th>Address</th>
                            <th>Estate Name</th>
                            <th>Registaion No</th>
                            <th>Size of Estate</th>
                            <th>Estate Address</th>
                            <th>Account Name</th>
                            <th>Account No</th>
                            <th>Bank & Branch</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            if($getdata->rowCount() > 0)
                              {
                               while($row=$getdata->FETCH(PDO::FETCH_ASSOC)){
                                ?>
                          <tr>
                            <td><?php print($row['supplier_code']); ?></td>
                            <td><?php echo $row['f_name']." ".$row['l_name']; ?></td>
                            <td><?php echo $row['mobile_no'];?></td>
                            <td><?php echo $row['address_1'];?></td>
                            <td><?php echo $row['estate_name'];?></td>
                            <td><?php echo $row['reg_no'];?></td>
                            <td><?php echo $row['size_of_estate'];?></td>
                            <td><?php echo $row['address_of_estate'];?></td>
                            <td><?php echo $row['account_name'];?></td>
                            <td><?php echo $row['account_no'];?></td>
                            <td><?php echo $row['bank']." ".$row['branch'];?></td>
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
                    </div><!-- /.box-body -->
                  </div>
                </div>
              </div>  
            </section>

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
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Data tabale JavaScript -->
    <script>
      $(function () {
        $('#supplier-data').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": false,
          "autoWidth": true
        });
      });
    </script>

    <script>
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

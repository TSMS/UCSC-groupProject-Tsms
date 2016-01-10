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
<title>Suppliers</title>
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
                  User Profile
                  <small>user profile settings</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li><a href="#"><i class="fa fa-users"></i> Users</a></li>
                  <li class="active">User Details</li>
               </ol>
            </section>
            <!-- Main content -->
            <div id="content" class="content">
              <div class="row">
                <div class="col-md-9">
                  <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url('dist/img/photo1.png') center center;">
                  <h3 class="widget-user-username"><?php echo $row['name']; ?></h3>
                  <h5 class="widget-user-desc"><?php echo $row['email']; ?></h5>
                </div>
                <div class="widget-user-image">
                  <img class="img-circle" src="dist/img/avatar.png" alt="User Avatar">
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">36</h5>
                        <span class="description-text">Supply Update</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">13</h5>
                        <span class="description-text">Accept Supplier request</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div>
              </div><!-- /.widget-user -->
                </div>
                <div class="col-md-3">
                  <!-- About Me Box -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">About Me</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <strong><i class="fa fa-map-marker margin-r-5"></i>  Address</strong>
                      <p class="text-muted">
                        60, Kudagama, punchi hewa waththa, Deniyaya.
                      </p>
                      <hr>
                      <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                      <p>supplieer dds</p>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
               </div>
               <div class="col-md-9">
                <div class="info-box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Edit details</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Username</th>
                              <th>Address</th>
                              <th>Birth Day</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Argentina</td>
                              <td>Spanish (official), English, Italian, German, French</td>
                              <td>41,803,125</td>
                              <td>31.3</td>
                              <td><button><i class="fa fa-edit"></button></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
              </div><!-- /.nav-tabs-custom -->
              <div class="col-md-3">
                <div class="info-box">
                  <div class="box-body">
                    <p>Change your password</p>
                    <a href="password.php" class="btn bg-navy btn-flat">Change Password</a>
                  </div>
              </div>
            </div><!-- /.col -->
            </div>
            <!-- /.content -->
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
      <!-- chartjs Scripts -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
      <!-- jQuery validation -->
      <script type="text/javascript" src="plugins/jQuery/jquery.validate.js"></script>
   </body>
</html>
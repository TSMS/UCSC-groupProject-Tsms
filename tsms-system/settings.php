<?php
session_start();
require_once 'classes/class.user.php';
$user_home = new USER();
require_once 'DB/dbupdates.php';
include_once('backup.php');
$dbupdates=new DBupdates();
if(!$user_home->is_logged_in())
{
  $user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM users WHERE id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['submit_1'])){
	$v1=$_POST['tr1'];
	$v2=$_POST['tr2'];
	$v3=$_POST['tr3'];
	$date=date('Y-m-d');
	$startdate=substr($date,0,8)."-01";
	$nddate=substr($date,0,8)."-30";
	
	$getdata = $user_home->runQuery("SELECT * FROM settings WHERE date BETWEEN $startdate AND $nddate");
    $getdata->execute();
	if($getdata->rowCount() > 0){
        while($row=$getdata->FETCH(PDO::FETCH_ASSOC)){
			print_r($row);
		}
	}else{
			$getdata = $user_home->runQuery("UPDATE settings SET (date,approxi_tea_rate,fixed_tea_rate,max_loan_amount, edit_by) VALUES (".$date.",".$v1.",".$v2.",".$v3.",".$row['id'].")");
			$getdata->execute();		
	}
	
}

//backup creating
if(isset($_POST['backup'])){
    Backup::backup_tables("localhost","root","","tsms",$tables = '*');
}
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
                  <li class="treeview active">
                     <a href="#">
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
                  Settings
                  <small>ADD/ EDIT/ DELETE</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="home.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li class="active">Settings</li>
               </ol>
            </section>
            <!-- Main content -->
            <br>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-olive"><i class="fa fa-gear"></i></span>
                    <div class="row">
                      <br>
                      <div class="col-md-2">
                        <a href="suppliersedit.php" class="btn btn-app"><i class="fa fa-edit"></i> Edit Suppliers</a>
                      </div>
                       <div class="col-md-2">
                        <a class="btn btn-app"><i class="fa fa-edit"></i> Edit Users</a>
                      </div>
                       <div class="col-md-2">
                        <a class="btn btn-app"><i class="fa fa-edit"></i> Supply and Services</a>
                      </div>
                    </div>
                    
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-8">
                   <div class="info-box">
                      <div class="box-header with-border">
                         <h3 class="box-title">Set Tea Rates</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                         <form action="" method="POST" name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required">
                            <div class="form-group">
                               <div class="col-sm-4">
                                  <label for="">Approximation Tea rate</label>
                               </div>
                               <div class="input-group col-sm-6">
                                  <span class="input-group-addon">Rs.</span>
                                  <input type="text" id="amountofaqty" name="tr1" class="form-control" onkeyup="call()" required="" data-ng-model="" onkeypress="return isNumberKey(event)" maxlength="8">
                               </div>
                            </div>
                            <div class="form-group ">
                               <div class="col-sm-4">
                                  <label for="">Fixed tea rate</label>
                               </div>
                               <div class="input-group col-sm-6">
                                  <span class="input-group-addon">Rs.</span>
                                  <input type="text" id="producttotal" name="tr2" class="form-control" required="" data-ng-model="">
                               </div>
                            </div>
                            <div class="form-group">
                               <div class="col-sm-4">
                                  <label for="">Max Loan Amount per supplier</label>
                               </div>
                               <div class="input-group col-sm-6">
                                  <span class="input-group-addon">Rs.</span>
                                  <input id="productinstallment" name="tr3" class="form-control" required="" data-ng-model="" type="text">
                               </div>
                            </div>
                            <button type="submit" name="submit_1" class="btn bg-navy btn-flat">Submit</button>
                            </fieldset>
                         </form>
                      </div>
                      <!-- /.box-body -->
                   </div>
                   <!-- /.box -->
                </div>
                <div class="col-md-4">
                   <!-- Backup Box -->
                   <form method="post" action="">
                   <div class="info-box">
                      <div class="box-header with-border">
                         <h3 class="box-title">Make System Backup</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                         <strong><i class="glyphicon glyphicon-download-alt"></i>Send Backup</strong>
                         <p class="text-muted">
                         <div class="btn-group">
                            <input type="submit" name="backup" value="backup" class="btn bg-navy btn-flat">
                         </div>
                         <!-- /.btn-group -->
                         </p>
                         <hr>
                      </div>
                    </form>
                      <!-- /.box-body -->
                   </div>
                   <!-- /.box -->
                </div>

                <div class="col-md-12">
                  <?php 
                   $s = "SELECT * FROM `ticket_machine` WHERE 1";

                    $smgt = $user_home->runQuery($s);
                    $smgt->execute();
                    ?>
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">Registered Ticket Machine</h3>
                      </div><!-- /.box-header -->
                    <div class="table-responsive">          
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Serial No</th>
                            <th>Registered Date</th>
                            <th>User of Machine</th>
                            <th>GSM No of Machine</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if($smgt->rowCount() > 0)
                            {
                              while($roww=$smgt->FETCH(PDO::FETCH_ASSOC))
                              {?>
                          <tr>
                            <td><?php echo $roww['serial_number'];?></td>
                            <td><?php echo $roww['reg_date'];?></td>
                            <td><?php echo $roww['user_name'];?></td>
                            <td><?php echo $roww['phone_number'];?></td>
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
                  <div class="col-md-12">
                        <?php 
                         $s = "SELECT * FROM `settings` WHERE 1";

                          $smgt = $user_home->runQuery($s);
                          $smgt->execute();
                          ?>
                          <div class="info-box">
                            <div class="box-header with-border">
                               <h3 class="box-title">Tea rate</h3>
                            </div>
                          <div class="table-responsive">          
                            <table class="table">
                              <thead>
                                <tr>
                                  <th>Date</th>
                                  <th>Approximation tea rate</th>
                                  <th>Fixed tea rate</th>
                                  <th>Max loan amount per supplier</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                if($smgt->rowCount() > 0)
                                  {
                                    while($roww=$smgt->FETCH(PDO::FETCH_ASSOC))
                                    {?>
                                <tr>
                                  <td><?php echo $roww['date'];?></td>
                                  <td><?php echo $roww['approxi_tea_rate'];?></td>
                                  <td><?php echo $roww['fixed_tea_rate'];?></td>
                                  <td><?php echo $roww['max_loan_amount'];?></td>
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
			 
            
          
            <!-- /.content -->
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
      <!-- iCheck -->
      <script src="plugins/iCheck/icheck.min.js"></script>

      <script>
        $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('#supplierForm input[type="radio"]').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
      });
        </script>
      <!-- chartjs Scripts -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
      <!-- jQuery validation -->
      <script type="text/javascript" src="plugins/jQuery/jquery.validate.js"></script>
      <!-- Supplier validation -->
      <script type="text/javascript">
          jQuery.validator.addMethod("nicid",function(value,element,param)
          {
            if(this.optional(element))
              {//This is not a 'required' element and the input is empty
                return true;
              }
            if(/^([0-9]{9})+(v|V)$/.test(value))
              {
                return true;
              }
              return false;
          },"Please enter a valid nic Number");

         jQuery().ready(function() {
          
           // validate form on keyup and submit
           var v = jQuery("#supplierForm").validate({
             rules: {
               fname: {
                 required: true,
                 minlength: 2,
                 maxlength: 20
               },
               lname: {
                 required: true,
                 minlength: 2,
                 maxlength: 16
               },
               supcode: {
                 required: true,
                 minlength: 2,
                 maxlength: 5
               },
               uemail: {
                 minlength: 2,
                 email: true,
                 maxlength: 100,
               },
               adress: {
                 maxlength: 50
               },
               nic: {
                 nicid: true
               }
         
             },
             messages: {
                  fname: "Please enter your firstname",
                  lname: "Please enter your lastname",
                  nic: {
                      required: "Please enter NIC card number",
                      minlength: "Invalied Nic number",
                      maxlength: "Invalied Nic number"
                  },
                  email: "Please enter a valid email address",
              },

             errorElement: "span",
             errorClass: "help-inline-error",
           });
         
           $(".open1").click(function() {
             if (v.form()) {
               $(".frm").hide("fast");
               $("#sf2").show("slow");
             }
           });
         
           $(".open2").click(function() {
             if (v.form()) {
               $(".frm").hide("fast");
               $("#sf3").show("slow");
             }
           });
           
           $(".open3").click(function() {
             if (v.form()) {
               $("#loader").show();
                var form=document.getElementById("supplierForm");
                var dataString = $(form).serialize();

                $.ajax({
                    type:"post",
                    url:"addsuppliers.php",
                    data: dataString,
                    success:function(data){
                      $("#info").html(data);
                      form.reset();
                    }

                });
                // setTimeout(function(){
                //   $("#supplierForm").html('<h2>Thanks for your time.</h2>');
                // }, 1000);
               return false;
             }
           });
           
           $(".back2").click(function() {
             $(".frm").hide("fast");
             $("#sf1").show("slow");
           });
         
           $(".back3").click(function() {
             $(".frm").hide("fast");
             $("#sf2").show("slow");
           });
         
         });
      </script>
   </body>
</html>
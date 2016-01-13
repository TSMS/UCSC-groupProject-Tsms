<?php
   session_start();
   require_once 'classes/class.user.php';
   $user_home = new USER();
   include_once("bill.php");
   include_once("pdfDB.php");
   
   
   
   if(!$user_home->is_logged_in())
   {
     $user_home->redirect('index.php');
   }
   
   $stmt = $user_home->runQuery("SELECT * FROM users WHERE id=:uid");
   $stmt->execute(array(":uid"=>$_SESSION['userSession']));
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   if(isset($_POST['btnpdf'])){
		$year=$_POST['year'];
		$month=$_POST['month'];
		$supcode=$_POST['supcode'];
		$unformateddate=$year."-".$month;
		
		if(!empty($_POST['supcode'])){
			PDF::createAPDF($supcode,$unformateddate );
		}else{
			PDF::createAllPDF($unformateddate);
		} 
		
   }
   
   ?>
<!DOCTYPE html>
<html>
   <title>Suppliers</title>
   <?php include "include/head.php" ?>
   <link rel="stylesheet" href="plugins/select2/select2.min.css">
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
               <li class="treeview active">
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
               Report
               <small>  All Supply / All Services/ Bill Processing</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="home.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
               <li class="active">Report</li>
            </ol>
         </section>
         <!-- Main content -->
         <div id="content" class="content">
            <style>
               ul#stepForm, ul#stepForm li {
               margin: 0;
               padding: 0;
               }
               ul#stepForm li {
               list-style: none outside none;
               } 
               label{margin-top: 10px;}
               .help-inline-error{color:red;}
            </style>
            <div class="row">
               <div class="col-md-12">
                  <!-- notification -->
                  <div id="info">
                     <div class="box">
                        <div class="box-body">
                           <form name="supplierForm" id="supplierForm" method="post" class="form-horizontal">
                              <div id="sf1" class="frm">
                                 <fieldset>
                                    <legend>page 1 of 3  All Supply</legend>
                                    <div class="col-md-12">
                                       <section class="content">
                                          <div class="box-body">
                                             <?php
                                                $getdata = $user_home->runQuery("SELECT t.supplier_code,t.date, s.f_name,s.l_name,t.approved_kgs, t.supplied_kgs, t.units FROM daily_supply t,suppliers s WHERE t.supplier_code= s.supplier_code ORDER BY date DESC");
                                                $getdata->execute();
                                                ?>
                                             <table id="bill1" class="table table-bordered table-striped">
                                                <thead>
                                                   <tr>
                                                      <th>Date</th>
                                                      <th>Supplier Code</th>
                                                      <th>Supplier Name</th>
                                                      <th>Suuply kgs</th>
                                                      <th>Approved Kgs</th>
                                                      <th>Units</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <?php 
                                                      if($getdata->rowCount() > 0)
                                                        {
                                                         while($row=$getdata->FETCH(PDO::FETCH_ASSOC)){
                                                        ?>
                                                   <tr>
                                                      <td><?php print($row['date']); ?></td>
                                                      <td><?php print($row['supplier_code']); ?></td>
                                                      <td><?php print($row['f_name']." ".$row['l_name']); ?></td>
                                                      <td><?php print($row['approved_kgs']); ?></td>
                                                      <td><?php print($row['supplied_kgs']); ?></td>
                                                      <td><?php print($row['units']); ?></td>
                                                   </tr>
                                                   <?php
                                                      }
                                                      }
                                                      ?>
                                                </tbody>
                                             </table>
                                          </div>
                                          <!-- /.box-body -->
                                       </section>
                                    </div>
                                    <div class="clearfix" style="height: 10px;clear: both;"></div>
                                    <div class="form-group">
                                       <div class="col-lg-2 col-lg-offset-10">
                                          <button class="btn bg-navy btn-flat open1" type="button">Next <span class="fa fa-arrow-right"></span></button> 
                                       </div>
                                    </div>
                                 </fieldset>
                              </div>
                              <div id="sf2" class="frm" style="display: none;">
                                 <fieldset>
                                    <legend>page 2 of 3 All Services</legend>
                                    <div class="col-md-12">
                                       <section class="content">
                                          <div class="box-body">
                                             <?php
                                                $getdata = $user_home->runQuery("SELECT s.f_name,s.l_name,p.date, p.supp_code, p.loan_code, p.category, p.units, p.total_amount, p.no_of_installments, p.interest, p.amount_of_installment, p.coment FROM service p,suppliers s,users u WHERE p.supp_code= s.supplier_code ORDER BY date DESC");
                                                $getdata->execute();
                                                ?>
                                             <table id="bill2" class="table table-bordered table-striped">
                                                <thead>
                                                   <tr>
                                                      <th>Date</th>
                                                      <th>Supplier Code</th>
                                                      <th>Supplier Name</th>
                                                      <th>Loan Type</th>
                                                      <th>Category</th>
                                                      <th>Units</th>
                                                      <th>Total Amount</th>
                                                      <th>No of Installments</th>
                                                      <th>Interest(%)</th>
                                                      <th>Amount of Installment</th>
                                                      <th>Comment</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <?php 
                                                      if($getdata->rowCount() > 0)
                                                        {
                                                         while($row=$getdata->FETCH(PDO::FETCH_ASSOC)){
                                                        ?>
                                                   <tr>
                                                      <td><?php print($row['date']); ?></td>
                                                      <td><?php print($row['supp_code']); ?></td>
                                                      <td><?php print($row['f_name']." ".$row['l_name']); ?></td>
                                                      <td><?php print($row['loan_code']); ?></td>
                                                      <td><?php print($row['category']); ?></td>
                                                      <td><?php print($row['units']); ?></td>
                                                      <td><?php print($row['total_amount']); ?></td>
                                                      <td><?php print($row['no_of_installments']); ?></td>
                                                      <td><?php print($row['interest']); ?></td>
                                                      <td><?php print($row['amount_of_installment']); ?></td>
                                                      <td><?php print($row['coment']); ?></td>
                                                   </tr>
                                                   <?php
                                                      }
                                                      }
                                                      ?>
                                                </tbody>
                                             </table>
                                          </div>
                                          <!-- /.box-body -->
                                       </section>
                                    </div>
                                    <div class="clearfix" style="height: 10px;clear: both;"></div>
                                    <div class="clearfix" style="height: 10px;clear: both;"></div>
                                    <div class="form-group">
                                       <div class="col-lg-12">
                                          <button class="pull-left btn bg-orange btn-flat back2" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
                                          <button class="btn bg-navy btn-flat open2 pull-right" type="button">Next <span class="fa fa-arrow-right"></span></button> 
                                       </div>
                                    </div>
                                 </fieldset>
                              </div>
                              <div id="sf3" class="frm" style="display: none;">
                                 <fieldset>
                                 <legend>page 3 of 3</legend>
                                 <!-- bill Start -->
                                    <div class="col-md-12">
                                        <!-- Widget: user widget style 1 -->
                                        <div class="box box-widget widget-user">
                                          <!-- Add the bg color to the header using any of the bg-* classes -->
                                          <div class="widget-user-header bg-aqua-active">
                                            <h3 class="widget-user-username"><b>Supplier Bill Genarator<b></h3>
                                            <div class="row">
                                              <form method="post" id="bill">
                                                <div class="col-sm-2 border-right">
                                                  <div class="description-block">
                                                    <label>
                                                      <input onclick="document.getElementById('supcode').disabled=false;document.getElementById('field2').disabled=true;" type="radio" name="example" value="Yes" id="example_0" required>
                                                      One Supplier
                                                    </label>
                                                    <label>
                                                      <input onclick="document.getElementById('supcode').disabled=true;document.getElementById('field2').disabled=false;" type="radio" name="example" value="No" id="example_1" checked="" required>
                                                      All
                                                    </label>
                                                  </div>
                                                </div>
                                                <div class="col-sm-2 border-right">
                                                  <div class="description-block">
                                                    <input type="text" id="supcode" class="form-control" name="supcode" placeholder="Supplier Code" disabled="true" />
                                                  </div>
                                                </div>
                                                
                                                <div class="col-sm-2 border-right">
                                                  <div class="description-block">
                                                     <div class="form-group">
                                                      <select class="form-control select2" style="width: 90%;" name="year">
                                                        <option selected="selected">2015</option>
                                                        <option value="2014">2014</option>
                                                        <option value="2015">2015</option>
                                                        <option value="2016">2016</option>
                                                        <option value="2017">2017</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2020">2020</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2022">2022</option>
                                                        <option value="2022">2023</option>
                                                        <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                        <option value="2027">2027</option>
                                                        <option value="2028">2028</option>
                                                        <option value="2029">2029</option>
                                                      </select>
                                                    </div><!-- /.form-group -->
                                                  </div>
                                                </div>
                                                <div class="col-sm-2 border-right">
                                                  <div class="description-block">
                                                     <div class="form-group">
                                                      <select class="form-control select2" style="width: 90%;" name="month">
                                                        <option selected="selected">January</option>
                                                        <option value="01">January</option>
                                                        <option value="02">Feb</option>
                                                        <option value="03">March</option>
                                                        <option value="04">April</option>
                                                        <option value="05">May</option>
                                                        <option value="06">Juni</option>
                                                        <option value="07">July</option>
                                                        <option value="08">Aug</option>
                                                        <option value="09">Sept</option>
                                                        <option value="10">Oct</option>
                                                        <option value="11">Nov</option>
                                                        <option value="12">Dec</option>
                                                      </select>
                                                    </div><!-- /.form-group -->
                                                  </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                  <div class="description-block">
                                                   <button name="btnpdf" type="submit" style="width: 90%;" class="btn btn-default">Genarat</button>
                                                  </div>
                                                </div>
                                             </form>
                                            </div>  
                                          </div>
                                          <div class="box-footer">
                                          </div>
                                        </div><!-- /.widget-user -->
                                      </div>
                                 <!-- Bill end -->
                                 <div class="col-md-12">
                                       <section class="content">
                                          <div class="box-body">
                                             <?php
                                                $getdata = $user_home->runQuery("SELECT * FROM monthly_bill INNER JOIN suppliers ON suppliers.supplier_code = monthly_bill.supp_code WHERE 1");
                                                $getdata->execute();
                                                ?>
                                           <div class="table-responsive">     
                                             <table id="bill3" class="table table-bordered table-striped">
                                                <thead>
                                                   <tr>
                                                      <th>Date</th>
                                                      <th>Supplier Code</th>
                                                      <th>Supplier Name</th>
                                                      <th>Total Supply Kgs</th>
                                                      <th>direct adition</th>
                                                      <th>Other Addition</th>
                                                      <th>Total income</th>
                                                      <th>last month debt</th>
                                                      <th>debt</th>
                                                      <th>advance</th>
                                                      <th>manure</th>
                                                      <th>tea</th>
                                                      <th>transport</th>
                                                      <th>stationary</th>
                                                      <th>stamp</th>
                                                      <th>total subtactions</th>
                                                      <th>balance</th>
                                                      <th>process date</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <?php 
                                                      if($getdata->rowCount() > 0)
                                                        {
                                                         while($row=$getdata->FETCH(PDO::FETCH_ASSOC)){
                                                        ?>
                                                   <tr>
                                                      <td><?php print($row['date']); ?></td>
                                                      <td><?php print($row['supp_code']); ?></td>
                                                      <td><?php print($row['f_name']." ".$row['l_name']); ?></td>
                                                      <td><?php print($row['total_supp_kgs']); ?></td>
                                                      <td><?php print($row['direct_addition']); ?></td>
                                                      <td><?php print($row['other_addition']); ?></td>
                                                      <td><?php print($row['total_income']); ?></td>
                                                      <td><?php print($row['last_month_debt']); ?></td>
                                                      <td><?php print($row['debt']); ?></td>
                                                      <td><?php print($row['advance']); ?></td>
                                                      <td><?php print($row['manure']); ?></td>
                                                      <td><?php print($row['tea']); ?></td>
                                                      <td><?php print($row['transport']); ?></td>
                                                      <td><?php print($row['stationary']); ?></td>
                                                      <td><?php print($row['stamp']); ?></td>
                                                      <td><?php print($row['total_subtraction']); ?></td>
                                                      <td><?php print($row['balance']); ?></td>
                                                      <td><?php print($row['process_date']); ?></td>
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
                                          </div>
                                          <!-- /.box-body -->
                                       </section>
                                    </div>
                                 <div class="form-group">
                                    <div class="col-lg-10">
                                       <button class="btn bg-orange btn-flat back3 pull-left" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
                                       <img src="spinner.gif" alt="" id="loader" style="display: none">
                                    </div>
                                 </div>
                                  </fieldset>
                                </div>
                              </form>
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
   <!-- select2 -->
   <script src="plugins/select2/select2.full.min.js"></script>

    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
    </script>

    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Data tabale JavaScript -->
   
   <script type="text/javascript">
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
    <script>
       $(function () {
        $("#bill1").DataTable();
        $("#bill2").DataTable();
        $('#bill3').DataTable();
      });
    </script>
   </body>
</html>
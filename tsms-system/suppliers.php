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
                  <li class="treeview active">
                     <a href="Supreg.html">
                     <i class="fa fa-group"></i> <span>Suppliers</span>
                     <i class="fa fa-angle-left pull-right"></i>
                     </a>
                     <ul class="treeview-menu">
                        <li class="active"><a href="suppliers.php"><i class="fa fa-circle-o"></i> Registation</a></li>
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
                  Suppliers
                  <small>ADD</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                  <li class="active">Dashboad</li>
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

               <script type="text/javascript">
                   function checkAvailability() {
                       jQuery.ajax({
                       url: "check.php",
                       data:'supcode='+$("#supcode").val(),
                       type: "POST",
                       success:function(data){
                         $("#user-availability-status").html(data);
                       },
                       error:function (){}
                       });
                     }
               </script>
              <div class="row"> 
               <div class="col-md-8 col-md-offset-2">
                <!-- notification --><div id="info">
                  <div class="box">
                     <div class="box-body">
                        <form name="supplierForm" id="supplierForm" method="post" class="form-horizontal">
                           <div id="sf1" class="frm">
                              <fieldset>
                                 <legend>Step 1 of 3</legend>
                                 <h3> Person</h3>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label" for="fname">First Name: </label>
                                    <div class="col-lg-6">
                                       <input type="text" placeholder="Your First Name" id="fname" name="fname" class="form-control" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label" for="uname">Last Name: </label>
                                    <div class="col-lg-6">
                                       <input type="text" placeholder="Your Last Name" id="lname" name="lname" class="form-control" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label" for="supcode">Supplier Code: </label>
                                    <div class="col-lg-6">
                                       <span id="user-availability-status"></span> 
                                       <input type="text" placeholder="Supplier Code" id="supcode" name="supcode" class="form-control" autocomplete="off" onBlur="checkAvailability()" >
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label" for="nic">NIC: </label>
                                    <div class="col-lg-6">
                                       <input type="text" maxlength="10" placeholder="NIC" id="nic" name="nic" class="form-control" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label" for="sex">Sex: </label>
                                    <div class="col-lg-6">
                                       <input type="radio" name="iCheck" value="male"> Male
                                       <input type="radio" name="iCheck" value="female"> Female
                                    </div>
                                 </div>
                                 <div class="clearfix" style="height: 10px;clear: both;"></div>
                                 <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-3">
                                       <button class="btn bg-navy btn-flat open1" type="button">Next <span class="fa fa-arrow-right"></span></button> 
                                    </div>
                                 </div>
                              </fieldset>
                           </div>
                           <div id="sf2" class="frm" style="display: none;">
                              <fieldset>
                                 <legend>Step 2 of 3</legend>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label" for="uemail">Your Email: </label>
                                    <div class="col-lg-6">
                                       <input type="text" placeholder="Your Email" id="uemail" name="uemail" class="form-control" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Address: </label>
                                    <div class="col-lg-6">
                                       <input type="text" name="address_1" id="adress" value="" autocomplete="off" required="required" class="form-control" placeholder="Enter your address">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Phone: </label>
                                    <div class="col-lg-6">
                                       <input type="text"  maxlength="10" name="mobile" id="mobile" value="" autocomplete="off" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter Contact number">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Esate: </label>
                                    <div class="col-lg-6">
                                       <input type="text" name="estate" id="estate" value="" autocomplete="off" class="form-control" placeholder="Enter Estate">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Estate name: </label>
                                    <div class="col-lg-6">
                                       <input type="text" name="estate_name" id="estate_name" value="" autocomplete="off" class="form-control" placeholder="Enter Estate">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Registation Number: </label>
                                    <div class="col-lg-6">
                                       <input type="text" name="reg_no" id="reg_no" value="" autocomplete="off" class="form-control" placeholder="Enter Registation Number">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Size of Esate: </label>
                                    <div class="col-lg-6">
                                       <input type="text" name="size_of_estate" id="size_of_estate" value="" autocomplete="off" class="form-control" placeholder="Enter size of Estate">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Esate Address: </label>
                                    <div class="col-lg-6">
                                       <input type="text" name="estate_address" id="estate_address" value="" autocomplete="off" class="form-control" placeholder="Enter Estate address">
                                    </div>
                                 </div>
                                 <div class="clearfix" style="height: 10px;clear: both;"></div>
                                 <div class="clearfix" style="height: 10px;clear: both;"></div>
                                 <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-3">
                                       <button class="btn bg-orange btn-flat back2" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
                                       <button class="btn bg-navy btn-flat open2" type="button">Next <span class="fa fa-arrow-right"></span></button> 
                                    </div>
                                 </div>
                              </fieldset>
                           </div>
                           <div id="sf3" class="frm" style="display: none;">
                              <fieldset>
                                 <legend>Step 3 of 3</legend>
                                 <div class="form-group">
                                    <label class="col-lg-4 control-label" for="bank">Bank Name: </label>
                                    <div class="col-lg-6">
                                       <input type="text" placeholder="Bank Name" id="bankn" name="bankn" class="form-control" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-4 control-label" for="bank">Branch Name: </label>
                                    <div class="col-lg-6">
                                       <input type="text" placeholder="Branch Name" id="branch" name="branch" class="form-control" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-4 control-label" for="account">Yourv Bank Account Name: </label>
                                    <div class="col-lg-6">
                                       <input type="text" placeholder="Account Name" id="branch" name="account" class="form-control" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="clearfix" style="height: 10px;clear: both;"></div>
                                 <div class="form-group">
                                    <label class="col-lg-4 control-label" for="bankacc">Bank Account Number: </label>
                                    <div class="col-lg-6">
                                       <input type="text" placeholder="Bank account number" id="bankacc" name="bankacc" class="form-control" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="clearfix" style="height: 10px;clear: both;"></div>
                                 <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-3">
                                       <button class="btn bg-orange btn-flat back3" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
                                       <button class="btn bg-navy btn-flat open3" type="button">Submit </button> 
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
          jQuery.validator.addMethod("mobi",function(value,element,param) {
            if(this.optional(element))
              {//This is not a 'required' element and the input is empty
                return true;
              }
            if(/^[0-9-+]+$/.test(value))
              {
                return true;
              }
              return false;
          },"Please enter a valid nic Number");

          jQuery.validator.addMethod("nicid",function(value,element,param)  
          {
            if(this.optional(element))
              {//This is not a 'required' element and the input is empty
                return true;
              }
            if(/^([0-9]{9})+(v|V|x|X)$/.test(value))
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
                 required: true,
                 nicid: true
               },
               mobile:{
                 minlength:9,
                 maxlength:10,
                 number: true
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
      <script type="text/javascript">
      function isNumberKey(evt){
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
         return false;
      return true;
   }
      </script>
   </body>
</html>
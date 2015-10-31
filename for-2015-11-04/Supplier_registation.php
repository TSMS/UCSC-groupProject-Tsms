<?php
   require_once 'core/init.php';
   
   if(Session::exists('success')){
       echo Session::flash('success');
   }
   
   $user = new User();
   
   $x = escape($user->data()->name);
   
   if(Input::exists()){
       //if(Token::check(Input::get('token'))) {
         $supplier = new Supplier();
         try{
             $supplier->create(array(
                 'supplier_code'  => Input::get('sup_code'),
                 'f_name'         => Input::get('fname'),
                 'l_name'         => Input::get('lname'),
                 'address_1'      => Input::get('address1'),
                 'nic_no'         => Input::get('nic'),
                 'mobile_no'      => Input::get('mobile'),
                 'e_mail'         => Input::get('email'),
               //'birth_day'      => Input::get('birthday'),
                 'Gender'         => Input::get('gender'),
                 'estate_name'    => 'NULL',
                 'reg_no'         => 'NULL',
                 'size_of_estate' => 'NULL',
                 'address_of_estate' => 'NULL',
                 'account_name'   => Input::get('fname'),
                 'account_no'     => 'NULL',
                 'bank'           => 'HSBC',
                 'branch'         => 'Deniyaya',
                 'last_edit_date' => date("Y-m-d H:i:s"),
                 'e_mail_send'    => '0',
                 'sms_send'       => '1',
                 'editor'         => $x
             ));
         }catch (Exception $e){
             die($e->getMessage());
         }
         Session::flash('success');
         Redirect::to('Supplier_registation.php?inserted');
   }      
   ?>
<?php include 'includes/head.php';?>
<body class="hold-transition skin-blue sidebar-mini">
   <div class="wrapper">
      <!-- Main Header -->
      <?php include 'top_nav.php';?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php include 'includes/left_nav.php';?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <h1>
               Supplier
               <small>Optional description</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
               <li class="active">Registation</li>
            </ol>
         </section>
         <!-- Main content -->
         <div id="content" class="content">
            <!-- Your Page Content Here -->



            <?php
               if(isset($_GET['inserted']))
               {
                 ?>
            <div class="col-md-offset-2 col-xs-7">
                <div class="alert alert-success">
                Supplier Successefully added to the Factory database!
                </div>
            </div>
            <?php
               }
               ?>
            <!-- Small boxes (Stat box) -->
            <div class="container">
               <!-- if you neeed offset col-md-offset-1 -->
               <div class="stepwizard col-md-offset-2">
                  <div class="stepwizard-row setup-panel">
                     <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                        <p>Step 1</p>
                     </div>
                     <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                        <p>Step 2</p>
                     </div>
                     <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                        <p>Step 3</p>
                     </div>
                  </div>
               </div>
               <form role="form" action="" method="post">
                  <div class="row setup-content" id="step-1">
                     <div class="col-xs-6 col-md-offset-2">
                        <div class="col-md-12">
                           <h3> Person</h3>
                           <div class="form-group">
                              <label class="control-label">Suuplier Code</label>
                              <input maxlength="100" type="text" name="sup_code" value="<?php echo escape(Input::get('sup_code')); ?>" autocomplete="off" required="required" class="form-control" placeholder="Supplier Code">
                           </div>
                           <div class="form-group">
                              <label class="control-label">First Name</label>
                              <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" name="fname" value="<?php echo escape(Input::get('fname')); ?>" autocomplete="off">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Last Name</label>
                              <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Last Name" name="lname" value="<?php echo escape(Input::get('lname')); ?>" autocomplete="off">
                           </div>
                           <div class="form-group">
                              <label for="nic-id" class="control-label">NIC</label>              
                              <input class="form-control" name="nic" id="nic" required="required" placeholder="NIC" type="text" value="<?php echo escape(Input::get('nic')); ?>">
                           </div>
                           <div class="form-group">
                              <label for="gender" class="col-sm-2">Gender</label>
                              <label class="radio-inline">
                              <input name="gender" id="male" value="male" type="radio"> Male
                              </label>
                              <label class="radio-inline">
                              <input name="gender" id="female" value="female" type="radio"> Female
                              </label>
                           </div>
                           <!-- <div class="form_group">
                              <label for="dob" class="control-label">Date of Birth</label>                             
                              <input class="form-control" name="birthday" id="dob" value="Y-m-d" placeholder="Y-m-d" required="" type="text">
                              </div> -->
                           <br><br>
                           <button class="btn btn-primary nextBtn btn pull-right" type="button">Next</button>
                        </div>
                     </div>
                  </div>
                  <div class="row setup-content" id="step-2">
                     <div class="col-xs-6 col-md-offset-2">
                        <div class="col-md-12">
                           <h3> Address</h3>
                           <div class="form-group">
                              <label class="control-label">Address</label>
                              <input required="required" name="address1" value="<?php echo escape(Input::get('address2')); ?>" autocomplete="off" class="form-control" placeholder="Enter your address"\>
                           </div>
                           <div class="form-group">
                              <label class="control-label">Phone number</label>
                              <input maxlength="10" type="text" required="required" name="mobile" value="<?php echo escape(Input::get('mobile')); ?>" autocomplete="off" class="form-control"placeholder="Enter Phone Number" />
                           </div>
                           <div class="form-group">
                              <label class="control-label">Email Address</label>
                              <input maxlength="20" type="email" required="required" name="email" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off" class="form-control"placeholder="Email Adress"  />
                           </div>
                           <button class="btn btn-primary nextBtn btn pull-right" type="button">Next</button>
                        </div>
                     </div>
                  </div>
                  <div class="row setup-content" id="step-3">
                     <div class="col-xs-6 col-md-offset-2">
                        <div class="col-md-12">
                           <h3> Step 3</h3>
                           <br><br><br>
                           <center>Are You Sure? If you add wrong details to System<br>
                              it could be problem.<br>
                           </center>
                           <br><br>
                           <center>
                              <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>
                              <button class="btn btn-success btn" type="submit">Submit</button>
                           </center>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <style type="text/css">
               .stepwizard-step p {
               margin-top: 10px;
               }
               .stepwizard-row {
               display: table-row;
               }
               .stepwizard {
               display: table;
               width: 50%;
               position: relative;
               }
               .stepwizard-step button[disabled] {
               opacity: 1 !important;
               filter: alpha(opacity=100) !important;
               }
               .stepwizard-row:before {
               top: 14px;
               bottom: 0;
               position: absolute;
               content: " ";
               width: 100%;
               height: 1px;
               background-color: #ccc;
               z-order: 0;
               }
               .stepwizard-step {
               display: table-cell;
               text-align: center;
               position: relative;
               }
               .btn-circle {
               width: 30px;
               height: 30px;
               text-align: center;
               padding: 6px 0;
               font-size: 12px;
               line-height: 1.428571429;
               border-radius: 15px;
               }
            </style>
         </div>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <!-- Main Footer -->
      <?php include 'includes/main_footer.php';?>
      <!-- Control Sidebar -->
      <?php include 'includes/right_bar.php';?>
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
   </div>
   <!-- ./wrapper -->
   <!-- REQUIRED JS SCRIPTS -->
   <?php include 'includes/footer.php';?>
   <script type="text/javascript">
      $(document).ready(function () {
        var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn'),
              allPrevBtn = $('.prevBtn');
      
        allWells.hide();
      
        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                    $item = $(this);
      
            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });
        
        allPrevBtn.click(function(){
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");
      
                prevStepWizard.removeAttr('disabled').trigger('click');
        });
      
        allNextBtn.click(function(){
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;
      
            $(".form-group").removeClass("has-error");
            for(var i=0; i<curInputs.length; i++){
                if (!curInputs[i].validity.valid){
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }
      
            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });
      
        $('div.setup-panel div a.btn-primary').trigger('click');
      });
   </script>

<script type="text/javascript">
<!--
 
$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(1500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);
 
});
//-->
</script>
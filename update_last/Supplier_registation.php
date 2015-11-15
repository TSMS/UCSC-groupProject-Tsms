<?php
   require_once 'core/init.php';
   
   if(Session::exists('success')){
       echo Session::flash('success');
   }
   
   $user = new User();
   
if($user->isLoggedIn()){
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
<!-- get data to add_supplier.php -->
          <script type="text/javascript">
              function get(){
                 $.post('add_supplier.php', { 
                  supplier_code: supplier_form.supplier_code.value,
                  f_name: supplier_form.f_name.value,
                  l_name: supplier_form.l_name.value,
                  address_1: supplier_form.address_1.value,
                  nic_no: supplier_form.nic_no.value,
                  mobile_no: supplier_form.mobile_no.value,
                  e_mail: supplier_form.e_mail.value,
                  Gender: supplier_form.Gender.value
                   } , 
                    function(output){
                       $('#content').html(output).show();
                    });
              }
           </script>

         <div class="content" id="content">
            <!-- Your Page Content Here -->

            <!-- Small boxes (Stat box) -->
            <div class="container">
              <script>
              // <input value="" onkeypress="return isNumberKey(event)">
                function isNumberKey(evt) {
                    var charCode = (evt.which) ? evt.which : event.keyCode;
                    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
                        return false;
                    } else {
                        return true;
                    }      
                }
                function checkAvailability() {
                  $("#loaderIcon").show();
                  jQuery.ajax({
                  url: "check_availability.php",
                  data:'sup_code='+$("#supplier_code").val(),
                  type: "POST",
                  success:function(data){
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                  },
                  error:function (){}
                  });
                }

                function checknic() {
                  $("#loaderIcon").show();
                  jQuery.ajax({
                  url: "check_availability.php",
                  data:'nic_no='+$("#nic").val(),
                  type: "POST",
                  success:function(data){
                    $("#nic-number").html(data);
                    $("#loaderIcon").hide();
                  },
                  error:function (){}
                  });
                }

                function checkname() {
                  $("#loaderIcon").show();
                  jQuery.ajax({
                  url: "check_availability.php",
                  data:'name='+$("#l_name").val(),
                  type: "POST",
                  success:function(data){
                    $("#name-ck").html(data);
                    $("#loaderIcon").hide();
                  },
                  error:function (){}
                  });
                }
                </script>
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
               <form role="form" name="supplier_form" action="" method="post">
                  <div class="row setup-content" id="step-1">
                     <div class="col-xs-6 col-md-offset-2">
                        <div class="col-md-12">
                           <h3> Person</h3>

                           <div id="frmCheckUsername" class="form-group">
                              <label class="control-label">Supplier Code</label>
                              <input class="form-control" required="required" autocomplete="off" type="text" maxlength="4" name="suppleir_code" value="<?php echo escape(Input::get('supplier_code')); ?>" id="supplier_code" placeholder="Supplier Code" onBlur="checkAvailability()"><span id="user-availability-status"></span>  
                           </div>
                           <p><img src="LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>
                           <div class="form-group">
                              <label class="control-label">First Name</label>
                              <input maxlength="14" type="text" required="required" class="form-control" placeholder="Enter First Name" name="f_name" value="<?php echo escape(Input::get('f_name')); ?>" autocomplete="off">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Last Name</label>
                              <input class="form-control" required="required" autocomplete="off" type="text" maxlength="16" name="l_name" value="<?php echo escape(Input::get('l_name')); ?>" id="l_name" placeholder="Last Name" onBlur="checkname()"><span id="name-ck"></span>
                           </div>
                           <div class="form-group">
                              <label for="nic-id" class="control-label">NIC</label>
                              <input class="form-control" required="required" autocomplete="off" type="text" maxlength="12" name="nic_no" value="<?php echo escape(Input::get('nic_no')); ?>" id="nic" placeholder="Nic number" onBlur="checknic()"><span id="nic-number"></span>              
                           </div>
                           <div class="form-group">
                              <label for="gender" class="col-sm-2">Gender</label>
                              <label class="radio-inline">
                              <input name="Gender" id="male" value="male" type="radio"> Male
                              </label>
                              <label class="radio-inline">
                              <input name="Gender" id="female" value="female" type="radio"> Female
                              </label>
                           </div>
                           <!-- <div class="form_group">
                              <label for="dob" class="control-label">Date of Birth</label>                             
                              <input class="form-control" name="birthday" id="dob" value="Y-m-d" placeholder="Y-m-d" required="" type="text">
                              </div> -->
                           <br><br>
                           <button class="btn bg-navy btn-flat nextBtn pull-right" type="button">Next</button>
                        </div>
                     </div>
                  </div>
                  <div class="row setup-content" id="step-2">
                     <div class="col-xs-6 col-md-offset-2">
                        <div class="col-md-12">
                           <h3> Address</h3>
                           <div class="form-group">
                              <label class="control-label">Address</label>
                              <input type="text" name="address_1" value="<?php echo escape(Input::get('address_1')); ?>" autocomplete="off" required="required" class="form-control" placeholder="Enter your address">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Phone number</label>
                              <input onkeypress="return isNumberKey(event)" maxlength="10" type="text" name="mobile_no" value="<?php echo escape(Input::get('mobile_no')); ?>" autocomplete="off" class="form-control"placeholder="Enter Phone Number" />
                           </div>
                           <div class="form-group">
                              <label class="control-label">Email Address</label>
                              <input maxlength="20" type="e_mail"name="e_mail" value="<?php echo escape(Input::get('e_mail')); ?>" autocomplete="off" class="form-control"placeholder="Email Adress"  />
                           </div>
                           <button class="btn bg-navy btn-flat nextBtn pull-right" type="button">Next</button>
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
                              <button onClick="get();" class="btn btn-success btn-flat" type="button" name="update">Submit</button>
                           </center>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <style type="text/css">
                .status-not-available{
                  color: red;
                }
                .status-available{
                  color: green;
                }
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

<?php
}else{
    Redirect::to('404.php');
}
?>
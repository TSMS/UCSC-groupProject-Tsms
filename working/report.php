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
               Report
               <small>Optional description</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
               <li class="active">Report</li>
            </ol>
         </section>
         <!-- Main content -->
         <div class="content">
            <!-- Your Page Content Here -->
            <!-- Brief status  -->

            <!-- get data to update.php -->
                    <script type="text/javascript">
                         function daterange(){
                            $.post('check_availability.php', { data1: search.date1.value, data2: search.date2.value} , 
                               function(output){
                                  $('#date_r').html(output).show();
                               });
                         }
                      </script>
                     <form name="search">
                         <div class="col-sm-2">
                           <input type="search" name="date1" class="form-control" value="2015-02-02">
                        </div>
                        <div class="col-sm-2">
                           <input type="search" name="date2" class="form-control" value="2015-08-09">
                         </div>
                         <span class="input-group-btn">
                             <button type="button" name="search" onClick="daterange();" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                         </span>
                     </form>
                     <div id="date_r"></div>


          
         </div> <!-- /.content -->
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

<?php
}else{
    Redirect::to('404.php');
}
?>
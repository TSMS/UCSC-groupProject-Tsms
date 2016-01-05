<?php
   require_once 'core/init.php';
   
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
               Dashboad
               <small>Optional description</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
               <li class="active">Dashboad</li>
            </ol>
         </section>
         <!-- Main content -->
         <div id="content" class="content">
            <!-- Your Page Content Here -->
            <?php
               $view = DB::getInstance()->getall("suppliers");
                ?>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-xs-12">
                    <div class="table-responsive">
                     <!--  <div class="box"> -->
                     <div class="box-body">
                        <table id="example1" class="table table-hover table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>Supplier-code</th>
                                 <th>name</th>
                                 <th>Address</th>
                                 <th>NIC</th>
                                 <th>Tel</th>
                                 <th>E-mail</th>
                                 <th>Joined</th>
                                 <th>Gender</th>
                                 <th>Estate(E)Name</th>
                                 <th>E...Reg...No</th>
                                 <th>E-Size</th>
                                 <th>Bank-name</th>
                                 <th>Acount-name</th>
                                 <th>Branch</th>
                                 <th>E-mail Send</th>
                                 <th>Sms-Send</th>
                                 <th>......Editor................</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 if(!$view->count()){
                                     echo 'No user';
                                 }else{
                                     foreach ($view->results() as $tag){
                                         echo "<tr>";
                                         echo "<td>".$tag->supplier_code."</td>";
                                         echo "<td>".$tag->f_name." ".$tag->l_name."</td>";
                                         echo "<td>".$tag->address_1."</td>";
                                         echo "<td>".$tag->nic_no."</td>";
                                         echo "<td>".$tag->mobile_no."</td>";
                                         echo "<td>".$tag->e_mail."</td>";
                                         echo "<td>".$tag->joined."</td>";
                                         echo "<td>".$tag->gender."</td>";
                                         echo "<td>".$tag->estate_name."</td>";
                                         echo "<td>".$tag->reg_no."</td>";
                                         echo "<td>".$tag->size_of_estate."</td>";
                                         echo "<td>".$tag->bank."</td>";
                                         echo "<td>".$tag->account_name."</td>";
                                         echo "<td>".$tag->branch."</td>";
                                         echo "<td>".$tag->e_mail_send."</td>";
                                         echo "<td>".$tag->sms_send."</td>";
                                         echo "<td>".$tag->editor."</td>";
                                         echo "</tr>";
                                     }
                                 }
                                 ?>
                           </tbody>
                           <!-- <tfoot>
                              <tr>
                                 <th>Supplier Code</th>
                                 <th>approved_kgs</th>
                                 <th>supplied_kgs</th>
                                 <th>units</th>
                                 <th>Date</th>
                              </tr>
                           </tfoot> -->
                        </table>
                     </div>
                     <!-- /.box-body -->
                  </div>
                  <!-- /.col -->
                </div>
               </div>
               <!-- /.row -->
            </section>
            <!-- /.content -->
         </div>
         <!--/.col (left) -->
      </div>
      <!-- /.row -->
      </section>
      <!-- Small boxes (Stat box) -->
   </div>
   <!-- /.content -->
   </div><!-- /.content-wrapper -->
<?php
}else{
  Redirect::to('content/404.php');
}
?>
   <!-- Main Footer -->
   <?php include 'includes/main_footer.php';?>
   <!-- Control Sidebar -->
   <?php include 'includes/right_bar.php';?>
   <!-- /.control-sidebar -->
   <!-- Add the sidebar's background. This div must be placed
      immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
   </div><!-- ./wrapper -->
   <!-- REQUIRED JS SCRIPTS -->
   <?php include 'includes/footer.php';?>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    </script>
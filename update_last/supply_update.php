<?php
require_once 'core/init.php';
if(Session::exists('success')){
    echo Session::flash('success');
}

$user = new User();
$supplier  = new Supplier();
$update    = new Update();

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
               Update Area
               <small>Service/supply/view/edit/add/delete</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Update</a></li>
               <li class="active">supply</li>
            </ol>
         </section>
         <!-- Main content -->
         <div id="content" class="content">
            <!-- Your Page Content Here -->
            <!-- Brief status  -->
          
            <!-- Custom Tabs (Pulled to the right) -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1-1" data-toggle="tab">Daily Supply</a></li>
                  <li><a href="#tab_2-2" data-toggle="tab">Service update</a></li>
                  <li><a href="#tab_3-2" data-toggle="tab">Edit data</a></li>
                  <li class="pull-right header"><a href="supply_update.php"><i class="fa fa-refresh"></i></a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">

                    <!-- get data to update.php -->
                    <script type="text/javascript">
                      function get(){
                         $.post('update.php', { 
                          supplier_code: update_form.supplier_code.value,
                          approved_kgs: update_form.approved_kgs.value,
                          supplied_kgs: update_form.supplied_kgs.value,
                          units: update_form.units.value
                           } , 
                            function(output){
                               $('#update').html(output).show();
                            });
                      }
                   </script>

                    <!-- tab-1-1 in here-->
                    <section class="content">
                           <div class="row">
                              <!-- left column -->
                              <div class="col-md-12">
                                 <!-- general form elements -->
                                 <div class="box box-primary">
                                    <!-- form start -->
                                    <div class="row">
                                       <div class="form-group">
                                          <div class="callout">
                                             <p>Date is: <?php echo date('Y-m-d H:i:s');?></p>
                                           </div>
                                           <div id="update"></div>
                                       </div>
                                    </div>
                                    <!-- HERE IS UPDATE ALERT IN HERE -->
                                    <script type="text/javascript">
                                      function checkAvailability() {
                                        $("#loaderIcon").show();
                                        jQuery.ajax({
                                        url: "check_availability.php",
                                        data:'code='+$("#supplier_code").val(),
                                        type: "POST",
                                        success:function(data){
                                          $("#user-availability-status").html(data);
                                          $("#loaderIcon").hide();
                                        },
                                        error:function (){}
                                        });
                                      }
                                    </script>
                                    <div class="row">
                                       <form action="" name="update_form" method="post">
                                          <div class="box-body">
                                            <div class="row">
                                               <div class="col-xs-2">
                                                  <label>Date: </label>
                                                  <input type="date" name="date" class="form-control" value="<?php echo date("Y-m-d");?>">
                                               </div>
                                               <div class="col-xs-3">
                                                  <label>Supplier name: </label><br>
                                                  <span  class="form-control" id="user-availability-status"></span>
                                              </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                              <div id="frmCheckUsername" class="col-xs-2">
                                                <label class="control-label">Supplier Code</label>
                                              <input class="form-control" required="required" autocomplete="off" type="text" maxlength="4" name="suppleir_code" value="<?php echo escape(Input::get('supplier_code')); ?>" id="supplier_code" placeholder="Supplier Code" onBlur="checkAvailability()">  
                                              </div>
                                              <div class="col-xs-2">
                                                  <label>Quantity: </label>
                                                  <input class="form-control" name="units" placeholder="units" type="text"  value="<?php echo escape(Input::get('units')); ?>" >
                                              </div>
                                              <div class="col-xs-2">
                                                  <label>Approved kgs: </label>
                                                  <input class="form-control" name="approved_kgs" placeholder="kgs" type="text" value="<?php echo escape(Input::get('approved_kgs')); ?>" required>
                                              </div>
                                              <div class="col-xs-2">
                                                  <label>supplied kgs: </label>
                                                  <input class="form-control" name="supplied_kgs" placeholder="sup-kgs" type="text"  value="<?php echo escape(Input::get('supplied_kgs')); ?>" >
                                              </div>
                                              <div class="col-xs-2">
                                                  <br>
                                                  <button onClick="get();" type="button" name="submit" class="btn bg-navy btn-flat">Submit</button>
                                              </div>
                                            </div>
                                          </div><!-- /.box-body -->
                                          
                                       </form>
                                    </div>
                                    <!-- /.box -->
                                    <?php
                                       // $supplier = DB::getInstance()->getall("suppliers");
                                       //  echo '<h1>'.$supplier->first()->f_name.'</h1>';
                                       $view = DB::getInstance()->getall("today_supply");

                                    ?>
                                    <!-- Main content -->
                                    <section class="content">
                                       <div class="row">
                                          <div class="col-xs-12">
                                            <div class="table-responsive">
                                             <div class="box-body">
                                                <table id="example1" class="table table-bordered table-striped">
                                                   <thead>
                                                      <tr>
                                                         <th>Supplier Name</th>
                                                         <th>Supplier Code</th>
                                                         <th>approved_kgs</th>
                                                         <th>supplied_kgs</th>
                                                         <th>units</th>
                                                         <th>Date</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php
                                                         if(!$view->count()){
                                                             echo 'No user';
                                                         }else{
                                                             foreach ($view->results() as $tag){
                                                                 $code = $tag->supplier_code;
                                                                 $vri  = $supplier->search('supplier_code', $code, 'f_name'); //search suppliers name
                                                                 $vrii  = $supplier->search('supplier_code', $code, 'l_name');
                                                                 $k =  $vrii." ".$vri;
                                                                 echo "<tr>";
                                                                 echo "<td>".$k."</td>";
                                                                 //echo "<td>".$vri."</td>";
                                                                 echo "<td>".$tag->supplier_code."</td>";
                                                                 echo "<td>".$tag->approved_kgs."</td>";
                                                                 echo "<td>".$tag->supplied_kgs."</td>";
                                                                 echo "<td>".$tag->units."</td>";
                                                                 echo "<td>".$tag->date."</td>";
                                                                 echo "</tr>";
                                                             }
                                                         }
                                                         ?>
                                                   </tbody>
                                                   <tfoot>
                                                      <tr>
                                                         <th>Supplier Code</th>
                                                         <th>Name</th>
                                                         <th>approved_kgs</th>
                                                         <th>supplied_kgs</th>
                                                         <th>units</th>
                                                         <th>Date</th>
                                                      </tr>
                                                   </tfoot>
                                                </table>
                                              </div>
                                            </div>
                                             <!-- /.box-body -->
                                          </div>
                                          <!-- /.col -->
                                       </div>
                                       <!-- /.row -->
                                    </section>
                                    <!-- /.content -->
                                 </div>
                                 <!--/.col (left) -->
                              </div>
                              <!-- /.row -->
                        </section>
                    <!-- tab-1-1 END -->


                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2-2">
                    The European languages are members of the same family. Their separate existence is a myth.
                    For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                    in their grammar, their pronunciation and their most common words. Everyone realizes why a
                    new common language would be desirable: one could refuse to pay expensive translators. To
                    achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                    words. If several languages coalesce, the grammar of the resulting language is more simple
                    and regular than that of the individual languages.
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3-2">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting,
                    remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                    sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                    like Aldus PageMaker including versions of Lorem Ipsum.
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->



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
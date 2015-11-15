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
                                        <!-- http://www.johnmorrisonline.com/a-php-script-to-search-a-mysql-database/    http://www.vaaah.com/php/view/Search/29/How-to-search-and-retrieve-data-from-MySQL-database-using-PHP -->                    
                    <?php
                    $msg_id       = Input::get('id');
                    $supplier_code= $update->search('message_temp', 'message_id', $msg_id, 'supplier_code');
                    
                    require_once 'db/dbdailysupply.php';

                    $dailysupply = new DBDailySupply();

                    $arr = $dailysupply->myTotalSupplyOf6Months($supplier_code);
                    $todaydate = date('Y-m-d');
                    $todaydate = substr($todaydate,5, 7); // 2015-11-11

                       $sup_name     = $supplier->search('supplier_code', $supplier_code, 'f_name')." ".$supplier->search('supplier_code', $supplier_code, 'l_name');
                       $view         = DB::getInstance()->getall("message_temp");
                       $datemonth    = date('Y-m-d');
                       $datemonth    = substr($datemonth, 0,8);
                       $datemonth    = $datemonth."01";//2015-11-02
                       $thismonthkgs = DB::getInstance()->Getsum('approved_kgs','daily_supply',$supplier_code);
                       $code         = $supplier_code;
                       $reqval       = $update->search('message_temp', 'message_id', $msg_id, 'value');
                       $reqqnt       = $update->search('message_temp', 'message_id', $msg_id, 'quantity');
                       $reqcat       = $update->search('message_temp', 'message_id', $msg_id, 'category');
                       $aprate       = $update->search('settings', 'date', $datemonth, 'approx_rate');
                       $acti         = $update->search('message_temp', 'message_id', $msg_id, 'message_code');
                    ?>

                    <!-- Supplier details for search result -->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="box box-solid">
                                 <div class="box-header with-border">
                                    <i class="fa fa-text-width"></i>
                                    <h3 class="box-title">Supplier Description</h3>
                                    <!-- search form (Optional) -->
                                    <script type="text/javascript">
                                        function getsupplier(){
                                           $.post('check_availability.php', { search: search.code.value} , 
                                              function(output){
                                                 $('#search_rr').html(output).show();
                                              });
                                        }
                                     </script>
                                    <form name="search">
                                        <div class="input-group col-sm-5 pull-right">
                                          <input maxlength="4" type="search" name="code" class="form-control" placeholder="Search...">
                                          <span class="input-group-btn">
                                            <button type="button" name="search" onClick="getsupplier();" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                                          </span>
                                        </div>
                                    </form>
                                 </div>
                                 <!-- /.box-header -->
                                 <div class="box-body" id="search_rr">
                                    <dl class="dl-horizontal example1">
                                       <p>Request message
                                       <p>
                                       <dt>Message id: </dt>
                                       <dd><?php echo $msg_id;?></dd>
                                       <dt>ammount: </dt>
                                       <dd><?php echo $reqval;?></dd>
                                       <dt>Quantity: </dt>
                                       <dd><?php echo $reqqnt;?></dd>
                                       <dt>category: </dt>
                                       <dd><?php echo $reqcat;?></dd>
                                       <p>Supplier details
                                       <p>
                                       <dt>Code: </dt>
                                       <dd><?php echo $supplier_code;?></dd>
                                       <dt>Name: </dt>
                                       <dd><?php echo $sup_name;?></dd>
                                       <dt>NIC NO: </dt>
                                       <dd><?php echo $supplier->search('supplier_code', $supplier_code, 'nic_no')?></dd>
                                       <dt>Approximate tea Rate: </dt>
                                       <dd>Rs <?php echo $aprate;?></dd>
                                       <dt>Supply kgs: </dt>
                                       <dd><?php echo $thismonthkgs;?> Kg</dd>
                                       <dt>Total income: </dt>
                                       <dd>Rs <?php echo $aprate*$thismonthkgs;?></dd>
                                       <dt>Paid: </dt>
                                       <dd>---</dd>
                                       <dt>remain balance: </dt>
                                       <dd>---</dd>
                                    </dl>
                                 </div>
                                 <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                           </div>
                        </div><!-- end of row -->

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
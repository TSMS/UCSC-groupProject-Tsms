<?php
require_once 'core/init.php';
if(Session::exists('success')){
    echo Session::flash('success');
}

// get table link paramiters into input fields
if(isset($_GET)==true && empty($_GET)==false){ 
$sup_code = $_GET['sup_code'];
$sup_name = $_GET['sup_name'];
}else{
  $sup_code = "";
  $sup_name = "";
}


$supplier = new Supplier();

$user = new User();
$x = escape($user->data()->name);

if($user->isLoggedIn()){
if(Input::exists()){
            $update = new Update();

            try{
                $update->create(array(
                    'date'           => date("Y-m-d"),
                    'supplier_code'  => Input::get('sup_code'),
                    'approved_kgs'   => Input::get('app_kgs'),
                    'supplied_kgs'   => Input::get('sup_kgs'),
                    'units'          => Input::get('units'),
                    'editor'         => $x,
                    'approved_by'    => $x,
                    'last_editor'    => $x,
                    'last_edit_date' => date("Y-m-d")
                ));
            }catch (Exception $e){
                die($e->getMessage());
            }

            Session::flash('success');
            Redirect::to('supply_update.php?inserted');
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
            Update
            <small>Optional description</small>
         </h1>
         <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Update</li>
         </ol>
      </section>
      <!-- Main content -->
      <div id="content" class="content">
         <!-- Your Page Content Here -->


         <!-- Small boxes (Stat box) -->
         <div class="row">
            <div class="col-md-12">
               <!-- Custom Tabs (Pulled to the right) -->
               <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                     <li class="active"><a href="#tab_1-1" data-toggle="tab">Daily Supply</a></li>
                     <li><a href="#tab_2-2" data-toggle="tab">Service update</a></li>
                     <li><a href="#tab_3-2" data-toggle="tab">Edit data</a></li>
                  </ul>
                  <div class="tab-content">
                     <div class="tab-pane active" id="tab_1-1">
                        <section class="content">
                           <div class="row">
                              <!-- left column -->
                              <div class="col-md-12">
                                 <!-- general form elements -->
                                 <div class="box box-primary">
                                    <!-- form start -->
                                    <div class="row">
                                       <div class="form-group">
                                        <?php
                                         if(isset($_GET['inserted']))
                                         {
                                           ?>
                                      <div class="col-md-offset-2 col-xs-7">
                                          <div class="alert alert-success">
                                          Supplier Update Successefully added to the Factory database!
                                          </div>
                                      </div>
                                      <?php
                                         }else{
                                          ?>
                                          <div class="callout">
                                             <?php $d=strtotime("10:30pm April 15 2014");?>
                                             <p>Date is: <?php echo date("Y-m-d h:i:sa", $d);?></p>
                                          </div>
                                          <?php
                                         }
                                         ?>
                                       </div>
                                       <div class="form-group col-sm-4">
                                          <label>Date: </label>
                                          <div class="input-group ui-datepicker">
                                             <input type="date" name="date" class="form-control">
                                          </div>
                                       </div>
                                    </div>
                                    <!-- HERE IS UPDATE ALERT IN HERE -->
                                    <div class="row">
                                       <form action="" method="post">
                                          <div class="form-group">
                                             <div class="col-xs-2">
                                                <label>Supplier Code: </label>
                                                <input class="form-control" name="sup_code" placeholder="Sup-code" type="search" value="<?php echo $sup_code; ?>">
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="col-xs-2">
                                                <label>Supplier name: </label>
                                                <input class="form-control" placeholder="sup_name" type="text" value="<?php echo $sup_name; ?>" readonly="">
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="col-xs-2">
                                                <label>Quantity: </label>
                                                <input class="form-control" name="units" placeholder="units" type="text">
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="col-xs-2">
                                                <label>Approved kgs: </label>
                                                <input class="form-control" name="app_kgs" placeholder="kgs" type="text">
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="col-xs-2">
                                                <label>supplied kgs: </label>
                                                <input class="form-control" name="sup_kgs" placeholder="sup-kgs" type="text">
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="col-xs-2">
                                                <br>
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                             </div>
                                          </div>
                                       </form>
                                       <br><br><br>
                                    </div>
                                    <!-- /.box -->
                                    <?php
                                       // $supplier = DB::getInstance()->getall("suppliers");
                                       //  echo '<h1>'.$supplier->first()->f_name.'</h1>';
                                       $view = DB::getInstance()->getall("daily_supply");

                                    ?>
                                    <!-- Main content -->
                                    <section class="content">
                                       <div class="row">
                                          <div class="col-xs-12">
                                             <!--  <div class="box"> -->
                                             <div class="box-body">
                                                <table id="example1" class="table table-bordered table-striped">
                                                   <thead>
                                                      <tr>
                                                         <th>Supplier Code</th>
                                                         <th>Name</th>
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
                                                                 echo "<td><a href='supply_update.php?sup_name=$k&sup_code=$code'>".$vri.' '.$vrii."</a></td>";
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
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2-2">
                          
                        <!-- Supplier details for search result -->
                          <div class="row">
                            <div class="col-md-6">
                              <div class="box box-solid">
                                <div class="box-header with-border">
                                  <i class="fa fa-text-width"></i>
                                  <h3 class="box-title">Supplier Description</h3>
                                  <div class="input-group col-sm-5 pull-right">
                                    <input type="search" class="form-control" placeholder="Search...">
                                    <span type="submit" class="input-group-addon btn"><i class="fa fa-search"></i></span>
                                  </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                  <dl class="dl-horizontal">
                                    <dt>Code: </dt>
                                    <dd><?php echo $sup_code;?></dd>
                                    <dt>Name: </dt>
                                    <dd><?php echo $sup_name;?></dd>
                                    <dt>NIC NO: </dt>
                                    <dd><?php echo $supplier->search('supplier_code', $sup_code, 'nic_no')?></dd>
                                    <dt>Approximate tea Rate: </dt>
                                    <dd>23%</dd>
                                    <dt>Supply kgs: </dt>
                                    <dd>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</dd>
                                    <dt>Total income: </dt>
                                    <dd>2523</dd>
                                    <dt>Paid: </dt>
                                    <dd>34545</dd>
                                    <dt>remain balance: </dt>
                                    <dd>2452</dd>
                                  </dl>
                                </div><!-- /.box-body -->
                              </div><!-- /.box -->
                            </div><!-- ./col -->

                          <!-- END TYPOGRAPHY -->

                        <!-- end results -->

                          <!-- Advans amout start -->

                          <div class="col-md-6">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-credit-card"></i>  Advance</a></li>
                              <li><a href="#tab_2" data-toggle="tab"><i class="glyphicon glyphicon-grain"></i>  Products</a></li>
                              <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-tags"></i>  Loan</a></li>
                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane active" id="tab_1">
                                
                                <div class="panel-body ng-scope">
                                  <form name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required" data-ng-submit="submitForm()">
                                     <fieldset>
                                        <div class="form-group">
                                           <div class="col-sm-2">
                                              <label for="">Amount</label>
                                           </div>
                                           <div class="input-group col-sm-6">
                                              <span class="input-group-addon">Rs.</span>
                                              <input class="form-control" required="" data-ng-model="" onkeyup="sum();" type="text">
                                              <span class="input-group-addon">.00</span>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <div class="col-sm-2">
                                              <label for="">Des</label>
                                           </div>
                                           <div class="input-group">
                                              <input class="form-control" type="text">
                                           </div>
                                        </div>
                                        <button type="submit" class="btn btn-success" data-ng-disabled="!canSubmit()">Submit</button>
                                     </fieldset>
                                  </form>
                               </div>

                              </div><!-- /.tab-pane -->
                              <div class="tab-pane" id="tab_2">
                                
                                <div class="panel-body ng-scope">
                                  <form name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required" data-ng-submit="submitForm()">
                                     <fieldset>
                                        <div class="form-group">
                                           <div class="col-sm-2">
                                              <label for="">Product</label>
                                           </div>
                                           <span class="ui-select col-sm-4">
                                              <select class="form-control">
                                                 <option>Mustard</option>
                                                 <option>Ketchup</option>
                                                 <option>Barbecue</option>
                                              </select>
                                           </span>
                                        </div>
                                        <div class="form-group">
                                           <div class="col-sm-2">
                                              <label for="">Amount of 1 qty</label>
                                           </div>
                                           <div class="input-group col-sm-4">
                                              <span class="input-group-addon">Rs.</span>
                                              <input type="text" name="amountofaqty" class="form-control" required="" data-ng-model="">
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <div class="col-sm-2">
                                              <label for="">
                                                 Qty</labl>
                                           </div>
                                           <div class="input-group">
                                           <input type="text" name="qty" class="form-control" onkeyup="ProductTotal(this.form)">
                                           </div>
                                        </div>
                                        <div class="form-group ">
                                        <div class="col-sm-2">
                                        <label for="">Total</label>
                                        </div>
                                        <div class="input-group col-sm-6">
                                        <span class="input-group-addon">Rs.</span>
                                        <input type="text" name="producttotal" class="form-control" required="" data-ng-model="" readonly="">
                                        <span class="input-group-addon">.00</span>
                                        </div>
                                        </div>  
                                        <div class="form-group">
                                           <div class="col-sm-2">
                                              <label for="">payment months</label>
                                           </div>
                                           <div class="input-group">
                                              <input name="productpaymentmonths" class="form-control" type="text" onkeyup="InstallmentCalculate(this.form)">
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <div class="col-sm-2">
                                              <label for="">Interest</label>
                                           </div>
                                           <div class="input-group col-sm-6">
                                              <input name="productinterest" class="form-control" required="" data-ng-model="" type="text">
                                              <span class="input-group-addon">% per month</span>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <div class="col-sm-2">
                                              <label for="">Payment for month</label>
                                           </div>
                                           <div class="input-group col-sm-6">
                                              <span class="input-group-addon">Rs.</span>
                                              <input name="productinstallment" class="form-control" required="" data-ng-model="" type="text" readonly="">
                                              <span class="input-group-addon">.00</span>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <div class="col-sm-2">
                                              <label for="">Des</label>
                                           </div>
                                           <div class="input-group">
                                              <input class="form-control" type="text">
                                           </div>
                                        </div>
                                        <button type="submit" class="btn btn-success" data-ng-disabled="!canSubmit()">Submit</button>
                                     </fieldset>
                                  </form>
                               </div>


                              </div><!-- /.tab-pane -->
                              <div class="tab-pane" id="tab_3">

                                <div class="panel-body ng-scope">
                                  <form name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required" data-ng-submit="submitForm()">
                                     <fieldset>
                                        <div class="form-group">
                                           <div class="col-sm-2">
                                              <label for="">Amount</label>
                                           </div>
                                           <div class="input-group col-sm-6">
                                              <span class="input-group-addon">Rs.</span>
                                              <input class="form-control" required="" data-ng-model="" type="text">
                                              <span class="input-group-addon">.00</span>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <div class="col-sm-2">
                                              <label for="">Payment Months</label>
                                           </div>
                                           <div class="input-group">
                                              <input class="form-control" type="text">
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <div class="col-sm-2">
                                              <label for="">Interest</label>
                                           </div>
                                           <div class="input-group">
                                              <input class="form-control" type="text">
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <div class="col-sm-2">
                                              <label for="">Total for Pay</label>
                                           </div>
                                           <div class="input-group col-sm-6">
                                              <span class="input-group-addon">Rs.</span>
                                              <input class="form-control" required="" data-ng-model="" type="text" readonly="">
                                              <span class="input-group-addon">.00</span>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <div class="col-sm-2">
                                              <label for="">Installment</label>
                                           </div>
                                           <div class="input-group col-sm-6">
                                              <span class="input-group-addon">Rs.</span>
                                              <input class="form-control" required="" data-ng-model="" type="text" readonly="">
                                              <span class="input-group-addon">.00</span>
                                           </div>
                                        </div>
                                        <button type="submit" class="btn btn-success" data-ng-disabled="!canSubmit()">Submit</button>
                                     </fieldset>
                                  </form>
                               </div>

                              </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                            </div>
                        </div>

<!-- Advans amout end -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3-2">
                           Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                           Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                           when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                           It has survived not only five centuries, but also the leap into electronic typesetting,
                           remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                           sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                           like Aldus PageMaker including versions of Lorem Ipsum.
                        </div>
                        <!-- /.tab-pane -->
                     </div>
                     <!-- /.tab-content -->
                  </div>
                  <!-- nav-tabs-custom -->
               </div>
               <!-- /.col -->
            </div>
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
   <?php
      }else{
        Redirect::to('content/404.php');
      }
      ?>
   <script src="plugins/datatables/jquery.dataTables.min.js"></script>
   <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
   <!-- update disipier alert script -->

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

   <!-- page script tabale-->
   <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
   </script>


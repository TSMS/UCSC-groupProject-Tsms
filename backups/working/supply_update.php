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
                         $("#loaderIcon").show();
                         $.post('update.php', { 
                          supplier_code: update_form.supplier_code.value,
                          approved_kgs: update_form.approved_kgs.value,
                          supplied_kgs: update_form.supplied_kgs.value,
                          units: update_form.units.value
                           } , 
                            function(output){
                              $("#loaderIcon").hide();
                               $('#update').html(output).show();
                               update_form.reset();
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
                                           <span id="loaderIcon"></span>
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
                                              <input class="form-control" required="required" autocomplete="off" type="text" maxlength="4" name="suppleir_code" id="supplier_code" placeholder="Supplier Code" onBlur="checkAvailability()">  
                                              </div>
                                              <div class="col-xs-2">
                                                  <label>Quantity: </label>
                                                  <input class="form-control" name="units" placeholder="units" type="text">
                                              </div>
                                              <div class="col-xs-2">
                                                  <label>Approved kgs: </label>
                                                  <input class="form-control" name="approved_kgs" placeholder="kgs" type="text" required>
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
                             </div><!-- /.row -->
                        </section>
                    <!-- tab-1-1 END -->


                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2-2">
                                        <!-- http://www.johnmorrisonline.com/a-php-script-to-search-a-mysql-database/    http://www.vaaah.com/php/view/Search/29/How-to-search-and-retrieve-data-from-MySQL-database-using-PHP -->                    
                    <?php
                    $msg_id       = Input::get('id');
                    $supplier_code = $update->search('message_temp', 'message_id', $msg_id, 'supplier_code');
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
                        <!-- ./col -->
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
                                       <form action="" method="POST" name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required">
                                          <fieldset>
                                             <div class="form-group">
                                                <div class="col-sm-2">
                                                   <label for="">Amount</label>
                                                </div>
                                                <div class="input-group col-sm-6">
                                                   <span class="input-group-addon">Rs.</span>
                                                   <input class="form-control" required="" name="total_amount" data-ng-model="" onkeyup="sum();" type="text" value="<?php echo $reqval;?>">
                                                   <span class="input-group-addon">.00</span>
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <div class="col-sm-2">
                                                   <label for="">Des</label>
                                                </div>
                                                <div class="input-group">
                                                   <textarea class="form-control" type="text" rows="4" name="des" placeholder="Supplier Comment">
                                                   </textarea>
                                                </div>
                                             </div>
                                             <button type="submit" name="submit_1" class="btn bg-navy btn-flat">Submit</button>
                                          </fieldset>
                                       </form>
                                    </div>
                                 </div>
                                 <!-- /.tab-pane    product add-->
                                 <div class="tab-pane" id="tab_2">
                                    <div class="panel-body ng-scope">
                                       <form name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required">
                                          <fieldset>
                                             <div class="form-group">
                                                <div class="col-sm-2">
                                                   <label for="">Product</label>
                                                </div>
                                                <span class="ui-select col-sm-4">
                                                   <select class="form-control">
                                                      <option>Chemical</option>
                                                      <option>Tea Packet</option>
                                                      <option>Manure</option>
                                                   </select>
                                                </span>
                                             </div>
                                             <div class="form-group">
                                                <div class="col-sm-2">
                                                   <label for="">Amount of 1 qty</label>
                                                </div>
                                                <div class="input-group col-sm-4">
                                                   <span class="input-group-addon">Rs.</span>
                                                   <input type="text" name="unit_price" class="form-control" required="" data-ng-model="">
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <div class="col-sm-2">
                                                   <label for="">
                                                      Qty</labl>
                                                </div>
                                                <div class="input-group">
                                                <input type="text" name="units" class="form-control" onkeyup="ProductTotal(this.form)" value="<?php echo $reqqnt;?>">
                                                </div>
                                             </div>
                                             <div class="form-group ">
                                             <div class="col-sm-2">
                                             <label for="">Total</label>
                                             </div>
                                             <div class="input-group col-sm-6">
                                             <span class="input-group-addon">Rs.</span>
                                             <input type="text" name="total_product_amount" class="form-control" required="" data-ng-model="" readonly="">
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
                                                   <input name="des2" class="form-control" type="text">
                                                </div>
                                             </div>
                                             <button type="submit" class="btn bg-navy btn-flat">Submit</button>
                                          </fieldset>
                                       </form>
                                    </div>
                                 </div>
                                 <!-- /.tab-pane add a loan-->
                                 <div class="tab-pane" id="tab_3">
                                    <div class="panel-body ng-scope">
                                       <form name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required">
                                          <fieldset>
                                             <div class="form-group">
                                                <div class="col-sm-2">
                                                   <label for="">Amount</label>
                                                </div>
                                                <div class="input-group col-sm-6">
                                                   <span class="input-group-addon">Rs.</span>
                                                   <input name="loan_amount" class="form-control" required="" data-ng-model="" type="text">
                                                   <span class="input-group-addon">.00</span>
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <div class="col-sm-2">
                                                   <label for="">Payment Months</label>
                                                </div>
                                                <div class="input-group">
                                                   <input name="loanpaymentmonths" class="form-control" type="text">
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <div class="col-sm-2">
                                                   <label for="">Interest</label>
                                                </div>
                                                <div class="input-group col-sm-4">
                                                   <input class="form-control" type="text">
                                                   <span class="input-group-addon">%</span>
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <div class="col-sm-2">
                                                   <label for="">Total for Pay</label>
                                                </div>
                                                <div class="input-group col-sm-6">
                                                   <span class="input-group-addon">Rs.</span>
                                                   <input name="loantotalforpay" class="form-control" required="" data-ng-model="" type="text" readonly="">
                                                   <span class="input-group-addon">.00</span>
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <div class="col-sm-2">
                                                   <label for="">Installment</label>
                                                </div>
                                                <div class="input-group col-sm-6">
                                                   <span class="input-group-addon">Rs.</span>
                                                   <input name="loaninstallforpay" class="form-control" required="" data-ng-model="" type="text" readonly="">
                                                   <span class="input-group-addon">.00</span>
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <div class="col-sm-2">
                                                   <label for="">Description</label>
                                                </div>
                                                <div class="input-group">
                                                   <input name="des3" class="form-control" type="text">
                                                </div>
                                             </div>
                                             <button type="submit" class="btn bg-navy btn-flat">Submit</button>
                                          </fieldset>
                                       </form>
                                    </div>
                                 </div>
                                 <!-- /.tab-pane -->
                              </div>
                              <!-- /.tab-content -->
                           </div>
                        </div>
                        <!-- Advans amout end -->
                        <div class="row">
                          <section class="content">
        
          <div class="row">
            <div class="col-md-6">
              <!-- AREA CHART -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Supplies of last 6 months</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="revenue-chart" style="height: 300px;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (LEFT) -->
            <div class="col-md-6">
              <!-- LINE CHART -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Income and Payments of last 6 months</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="line-chart" style="height: 300px;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              

            </div><!-- /.col (RIGHT) -->
          </div><!-- /.row -->

        </section><!-- /.content -->
                          

                        </div>

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
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
   <!-- update disipier alert script -->

   <!-- dinamic calculation of siervice add from -->
   <script>
 /*
jQuery(function($) {

$(".qty, .price").change(function() {
    var total = 0;
    $(".qty").each(function() {
        var self = $(this),
            price = self.next(".price"),
            subtotal = parseInt(self.val(), 10) * parseFloat(price.val(), 10);
        total += (subtotal || 0);
    });
    $("#total").text(total);
});

});*/
function ProductTotal(f) {
    f.producttotal.value = (f.amountofaqty.value)*(f.qty.value);
}


 function SummeryView(f) {
  
}

 function InstallmentCalculate(f) {
   var monthinstall=(f.producttotal.value/f.productpaymentmonths.value);
    f.productinstallment.value=(monthinstall*f.productinterest.value) + monthinstall;
}

 /*
function getItems()
{
 var items = new Array();
 var itemCount = document.getElementsByClassName("items");
 var total = 0;
 var id= '';
 for(var i = 0; i < itemCount.length; i++)
 {
   id = "p"+(i+1);
   total = total +  parseInt(document.getElementById(id).value);
 }
document.getElementById('tot').value = total;
return total;
}
getItems();*/
 </script>  
   <!-- end -->

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

<script>
      $(function () {
        "use strict";

        // AREA CHART
        var area = new Morris.Area({
          element: 'revenue-chart',
          resize: true,
          data: [
            {y: '2010 Q1', item1: <?php echo $arr[5];?>},
            {y: '2011 Q1', item1: <?php echo $arr[4];?>},
            {y: '2012 Q1', item1: <?php echo $arr[3];?>},
            {y: '2013 Q1', item1: <?php echo $arr[2];?>},
            {y: '2014 Q3', item1: <?php echo $arr[1];?>},
            {y: '2015 Q3', item1: <?php echo $arr[0];?>}
          ],
          xkey: 'y',
          ykeys: ['item1'],
          labels: ['Item 1'],
          lineColors: ['#3c8dbc'],
          hideHover: 'auto'
        });

        // LINE CHART
        var line = new Morris.Line({
          element: 'line-chart',
          resize: true,
          data: [
            {y: '2011 Q1', item1: 2666, item2: 2666},
            {y: '2011 Q2', item1: 2778, item2: 2294},
            {y: '2013 Q3', item1: 4912, item2: 1969},
            {y: '2013 Q4', item1: 3767, item2: 3597},
            {y: '2014 Q1', item1: 6810, item2: 1914},
            {y: '2014 Q2', item1: 5670, item2: 4293},
            {y: '2014 Q3', item1: 4820, item2: 3795},
            {y: '2014 Q4', item1: 15073, item2: 5967},
            {y: '2015 Q1', item1: 10687, item2: 4460},
            {y: '2015 Q2', item1: 8432, item2: 5713}
          ],
          xkey: 'y',
          ykeys: ['item1', 'item2'],
          labels: ['Item 1', 'Item 2'],
          lineColors: ['#a0d0e0', '#3c8dbc'],
          hideHover: 'auto'
          
        });
      });
    </script>

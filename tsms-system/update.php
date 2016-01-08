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
<title>Daily Update</title>
  <?php include "include/head.php" ?>
  
    <div class="wrapper">

      <?php include "include/header.php" ?>
      
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <form name="form" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="name" class="form-control" placeholder="Supplier...">
              <span class="input-group-btn">
               <button type="button" name="search" onClick="get();" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
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
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="active">
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
            <li class="treeview">
              <a href="report.php">
                <i class="fa fa-print"></i> <span>Report</span>
              </a>
            </li>
            <li class="treeview">
              <a href="settings.php">
                <i class="fa fa-download"></i> <span>Settings</span>
              </a>
            </li>
          </ul><!-- /.sidebar-menu -->



        </section>
        <!-- /.sidebar -->
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <h1>
               Update Area
               <small>Optional description</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
               <li class="active">Dashboad</li>
            </ol>
         </section>
         <!-- Main content -->
         <div id="content" class="content">
         
          <div class="row">
            <div class="col-md-12">
              <!-- Update Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Daily Update</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Service update</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Edit Section</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div class="box-body">
                      <div class="row">
                         <div class="form-group">
                              <label for="Date" class="control-label">Date</label>
                              <div class="col-sm-4">
                                <input type="Date" class="form-control" id="date" placeholder="Date">
                              </div>
                            <div id="update"></div>
                            <span id="loaderIcon"></span>
                         </div>
                      </div>
                        <form role="form">
                         <div class="row">
                            <div class="col-md-2">
                                <label>Supplier Code: </label>
                                <input class="form-control" name="supcode" placeholder="Suplier Code" type="text">
                            </div>
                            <div class="col-md-2">
                                <label>Quantity: </label>
                                <input class="form-control" name="units" placeholder="units" type="text">
                            </div>
                            <div class="col-md-2">
                                <label>Approved kgs: </label>
                                <input class="form-control" name="approved_kgs" placeholder="kgs" type="text" required>
                            </div>
                            <div class="col-md-2">
                                <label>supplied kgs: </label>
                                <input class="form-control" name="supplied_kgs" placeholder="sup-kgs" type="text">
                            </div>
                            <div class="col-xs-2">
                                <br>
                                <button onClick="get();" type="button" name="submit" class="btn bg-navy btn-flat">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    <section class="content">
                        <div class="box-body">
                          <table id="supplier-updates" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th>Engine version</th>
                                <th>CSS grade</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Trident</td>
                                <td>Internet
                                  Explorer 4.0</td>
                                <td>Win 95+</td>
                                <td> 4</td>
                                <td>X</td>
                              </tr>
                              <tr>
                                <td>Trident</td>
                                <td>Internet
                                  Explorer 5.0</td>
                                <td>Win 95+</td>
                                <td>5</td>
                                <td>C</td>
                              </tr>
                              <tr>
                                <td>Trident</td>
                                <td>Internet
                                  Explorer 5.5</td>
                                <td>Win 95+</td>
                                <td>5.5</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Trident</td>
                                <td>Internet
                                  Explorer 6</td>
                                <td>Win 98+</td>
                                <td>6</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Trident</td>
                                <td>Internet Explorer 7</td>
                                <td>Win XP SP2+</td>
                                <td>7</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Trident</td>
                                <td>AOL browser (AOL desktop)</td>
                                <td>Win XP</td>
                                <td>6</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Firefox 1.0</td>
                                <td>Win 98+ / OSX.2+</td>
                                <td>1.7</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Firefox 1.5</td>
                                <td>Win 98+ / OSX.2+</td>
                                <td>1.8</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Firefox 2.0</td>
                                <td>Win 98+ / OSX.2+</td>
                                <td>1.8</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Firefox 3.0</td>
                                <td>Win 2k+ / OSX.3+</td>
                                <td>1.9</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Camino 1.0</td>
                                <td>OSX.2+</td>
                                <td>1.8</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Camino 1.5</td>
                                <td>OSX.3+</td>
                                <td>1.8</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Netscape 7.2</td>
                                <td>Win 95+ / Mac OS 8.6-9.2</td>
                                <td>1.7</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Netscape Browser 8</td>
                                <td>Win 98SE+</td>
                                <td>1.7</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Netscape Navigator 9</td>
                                <td>Win 98+ / OSX.2+</td>
                                <td>1.8</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Mozilla 1.0</td>
                                <td>Win 95+ / OSX.1+</td>
                                <td>1</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Mozilla 1.1</td>
                                <td>Win 95+ / OSX.1+</td>
                                <td>1.1</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Mozilla 1.2</td>
                                <td>Win 95+ / OSX.1+</td>
                                <td>1.2</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Mozilla 1.3</td>
                                <td>Win 95+ / OSX.1+</td>
                                <td>1.3</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Mozilla 1.4</td>
                                <td>Win 95+ / OSX.1+</td>
                                <td>1.4</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Mozilla 1.5</td>
                                <td>Win 95+ / OSX.1+</td>
                                <td>1.5</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Mozilla 1.6</td>
                                <td>Win 95+ / OSX.1+</td>
                                <td>1.6</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Mozilla 1.7</td>
                                <td>Win 98+ / OSX.1+</td>
                                <td>1.7</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Mozilla 1.8</td>
                                <td>Win 98+ / OSX.1+</td>
                                <td>1.8</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Seamonkey 1.1</td>
                                <td>Win 98+ / OSX.2+</td>
                                <td>1.8</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Gecko</td>
                                <td>Epiphany 2.20</td>
                                <td>Gnome</td>
                                <td>1.8</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Webkit</td>
                                <td>Safari 1.2</td>
                                <td>OSX.3</td>
                                <td>125.5</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Webkit</td>
                                <td>Safari 1.3</td>
                                <td>OSX.3</td>
                                <td>312.8</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Webkit</td>
                                <td>Safari 2.0</td>
                                <td>OSX.4+</td>
                                <td>419.3</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Webkit</td>
                                <td>Safari 3.0</td>
                                <td>OSX.4+</td>
                                <td>522.1</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Webkit</td>
                                <td>OmniWeb 5.5</td>
                                <td>OSX.4+</td>
                                <td>420</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Webkit</td>
                                <td>iPod Touch / iPhone</td>
                                <td>iPod</td>
                                <td>420.1</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Webkit</td>
                                <td>S60</td>
                                <td>S60</td>
                                <td>413</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Presto</td>
                                <td>Opera 7.0</td>
                                <td>Win 95+ / OSX.1+</td>
                                <td>-</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Presto</td>
                                <td>Opera 7.5</td>
                                <td>Win 95+ / OSX.2+</td>
                                <td>-</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Presto</td>
                                <td>Opera 8.0</td>
                                <td>Win 95+ / OSX.2+</td>
                                <td>-</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Presto</td>
                                <td>Opera 8.5</td>
                                <td>Win 95+ / OSX.2+</td>
                                <td>-</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Presto</td>
                                <td>Opera 9.0</td>
                                <td>Win 95+ / OSX.3+</td>
                                <td>-</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Presto</td>
                                <td>Opera 9.2</td>
                                <td>Win 88+ / OSX.3+</td>
                                <td>-</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Presto</td>
                                <td>Opera 9.5</td>
                                <td>Win 88+ / OSX.3+</td>
                                <td>-</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Presto</td>
                                <td>Opera for Wii</td>
                                <td>Wii</td>
                                <td>-</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Presto</td>
                                <td>Nokia N800</td>
                                <td>N800</td>
                                <td>-</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Presto</td>
                                <td>Nintendo DS browser</td>
                                <td>Nintendo DS</td>
                                <td>8.5</td>
                                <td>C/A<sup>1</sup></td>
                              </tr>
                              <tr>
                                <td>KHTML</td>
                                <td>Konqureror 3.1</td>
                                <td>KDE 3.1</td>
                                <td>3.1</td>
                                <td>C</td>
                              </tr>
                              <tr>
                                <td>KHTML</td>
                                <td>Konqureror 3.3</td>
                                <td>KDE 3.3</td>
                                <td>3.3</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>KHTML</td>
                                <td>Konqureror 3.5</td>
                                <td>KDE 3.5</td>
                                <td>3.5</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Tasman</td>
                                <td>Internet Explorer 4.5</td>
                                <td>Mac OS 8-9</td>
                                <td>-</td>
                                <td>X</td>
                              </tr>
                              <tr>
                                <td>Tasman</td>
                                <td>Internet Explorer 5.1</td>
                                <td>Mac OS 7.6-9</td>
                                <td>1</td>
                                <td>C</td>
                              </tr>
                              <tr>
                                <td>Tasman</td>
                                <td>Internet Explorer 5.2</td>
                                <td>Mac OS 8-X</td>
                                <td>1</td>
                                <td>C</td>
                              </tr>
                              <tr>
                                <td>Misc</td>
                                <td>NetFront 3.1</td>
                                <td>Embedded devices</td>
                                <td>-</td>
                                <td>C</td>
                              </tr>
                              <tr>
                                <td>Misc</td>
                                <td>NetFront 3.4</td>
                                <td>Embedded devices</td>
                                <td>-</td>
                                <td>A</td>
                              </tr>
                              <tr>
                                <td>Misc</td>
                                <td>Dillo 0.8</td>
                                <td>Embedded devices</td>
                                <td>-</td>
                                <td>X</td>
                              </tr>
                              <tr>
                                <td>Misc</td>
                                <td>Links</td>
                                <td>Text only</td>
                                <td>-</td>
                                <td>X</td>
                              </tr>
                              <tr>
                                <td>Misc</td>
                                <td>Lynx</td>
                                <td>Text only</td>
                                <td>-</td>
                                <td>X</td>
                              </tr>
                              <tr>
                                <td>Misc</td>
                                <td>IE Mobile</td>
                                <td>Windows Mobile 6</td>
                                <td>-</td>
                                <td>C</td>
                              </tr>
                              <tr>
                                <td>Misc</td>
                                <td>PSP browser</td>
                                <td>PSP</td>
                                <td>-</td>
                                <td>C</td>
                              </tr>
                              <tr>
                                <td>Other browsers</td>
                                <td>All others</td>
                                <td>-</td>
                                <td>-</td>
                                <td>U</td>
                              </tr>
                            </tbody>
                          </table>
                        </div><!-- /.box-body -->
                      </section>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    
                  <!-- Pass loan -->
                  <div class="row">
                    <!-- supplier descriptions -->
                    <div class="col-md-6">
                      <div class="box box-solid">
                         <div class="box-header with-border">
                            <i class="fa fa-text-width"></i>
                            <h3 class="box-title">Supplier Description</h3>
                            <form name="search" method="post">
                               <div class="input-group col-sm-5 pull-right">
                                  <input maxlength="4" type="search" name="code" class="form-control" placeholder="Search...">
                                  <span class="input-group-btn">
                                  <button type="submit" name="search" class="btn btn-flat"><i class="fa fa-search"></i></button>
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
                               <dd></dd>
                               <dt>ammount: </dt>
                               <dd></dd>
                               <dt>Quantity: </dt>
                               <dd></dd>
                               <dt>category: </dt>
                               <dd></dd>
                               <p>Supplier details
                               <p>
                               <dt>Code: </dt>
                               <dd><?php echo$scode;?></dd>
                               <dt>Name: </dt>
                               <dd></dd>
                               <dt>NIC NO: </dt>
                               <dd></dd>
                               <dt>Approximate tea Rate: </dt>
                               <dd>Rs </dd>
                               <dt>Supply kgs: </dt>
                               <dd> Kg</dd>
                               <dt>Total income: </dt>
                               <dd>Rs </dd>
                               <dt>Paid: </dt>
                               <dd>---</dd>
                               <dt>remain balance: </dt>
                               <dd>---</dd>
                            </dl>
                         </div>
                         <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div><!-- ./col -->
                    <!-- supplier descriptions END-->
                    <!-- loan advance -->
                    <div class="col-md-6">
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#advance" data-toggle="tab">Advance</a></li>
                          <li><a href="#products" data-toggle="tab">Products</a></li>
                          <li><a href="#loan" data-toggle="tab">Loan</a></li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane active" id="advance">
                            <!-- Advance Start -->
                              <div class="panel-body ng-scope">
                                   <form action="" method="POST" name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required">
                                      <fieldset>
                                         <div class="form-group">
                                            <div class="col-sm-2">
                                               <label for="">Amount</label>
                                            </div>
                                            <div class="input-group col-sm-6">
                                               <span class="input-group-addon">Rs.</span>
                                               <input class="form-control" required="" name="total_amount" data-ng-model="" onkeyup="sum();" type="text" value="">
                                               <span class="input-group-addon">.00</span>
                                            </div>
                                         </div>
                                         <div class="form-group">
                                            <div class="col-sm-2">
                                               <label for="">Des</label>
                                            </div>
                                            <div class="input-group">
                                              <textarea class="form-control" rows="5" id="comment" rows="4" cols="35" name="des" placeholder="Comment"></textarea>
                                            </div>
                                         </div>
                                         <button type="submit" name="submit_1" class="btn bg-navy btn-flat">Submit</button>
                                      </fieldset>
                                   </form>
                                </div>
                            <!-- Advance End -->
                          </div><!-- /.tab-pane -->
                          <div class="tab-pane" id="products">
                            <!-- products start -->
                            <div class="panel-body ng-scope">
                               <form name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required">
                                  <fieldset>
                                     <div class="form-group">
                                        <div class="col-sm-4">
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
                                        <div class="col-sm-4">
                                           <label for="">Amount of 1 qty</label>
                                        </div>
                                        <div class="input-group col-sm-4">
                                           <span class="input-group-addon">Rs.</span>
                                           <input type="text" name="unit_price" class="form-control" required="" data-ng-model="">
                                        </div>
                                     </div>
                                     <div class="form-group">
                                        <div class="col-sm-4">
                                           <label for="">
                                              Qty</labl>
                                        </div>
                                        <div class="input-group">
                                        <input type="text" name="units" class="form-control" onkeyup="ProductTotal(this.form)" value="">
                                        </div>
                                     </div>
                                     <div class="form-group ">
                                     <div class="col-sm-4">
                                     <label for="">Total</label>
                                     </div>
                                     <div class="input-group col-sm-6">
                                     <span class="input-group-addon">Rs.</span>
                                     <input type="text" name="total_product_amount" class="form-control" required="" data-ng-model="" readonly="">
                                     <span class="input-group-addon">.00</span>
                                     </div>
                                     </div>  
                                     <div class="form-group">
                                        <div class="col-sm-4">
                                           <label for="">payment months</label>
                                        </div>
                                        <div class="input-group">
                                           <input name="productpaymentmonths" class="form-control" type="text" onkeyup="InstallmentCalculate(this.form)">
                                        </div>
                                     </div>
                                     <div class="form-group">
                                        <div class="col-sm-4">
                                           <label for="">Interest</label>
                                        </div>
                                        <div class="input-group col-sm-6">
                                           <input name="productinterest" class="form-control" required="" data-ng-model="" type="text">
                                           <span class="input-group-addon">% per month</span>
                                        </div>
                                     </div>
                                     <div class="form-group">
                                        <div class="col-sm-4">
                                           <label for="">Payment for month</label>
                                        </div>
                                        <div class="input-group col-sm-6">
                                           <span class="input-group-addon">Rs.</span>
                                           <input name="productinstallment" class="form-control" required="" data-ng-model="" type="text" readonly="">
                                           <span class="input-group-addon">.00</span>
                                        </div>
                                     </div>
                                     <div class="form-group">
                                        <div class="col-sm-4">
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
                            <!-- products End -->
                          </div><!-- /.tab-pane -->
                          <div class="tab-pane" id="loan">
                            <!-- Loan Start -->
                              <div class="panel-body ng-scope">
                                 <form name="form_signin" class="form-horizontal form-validation ng-dirty ng-valid ng-valid-required">
                                    <fieldset>
                                       <div class="form-group">
                                          <div class="col-sm-4">
                                             <label for="">Amount</label>
                                          </div>
                                          <div class="input-group col-sm-6">
                                             <span class="input-group-addon">Rs.</span>
                                             <input name="loan_amount" class="form-control" required="" data-ng-model="" type="text">
                                             <span class="input-group-addon">.00</span>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <div class="col-sm-4">
                                             <label for="">Payment Months</label>
                                          </div>
                                          <div class="input-group">
                                             <input name="loanpaymentmonths" class="form-control" type="text">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <div class="col-sm-4">
                                             <label for="">Interest</label>
                                          </div>
                                          <div class="input-group col-sm-4">
                                             <input class="form-control" type="text">
                                             <span class="input-group-addon">%</span>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <div class="col-sm-4">
                                             <label for="">Total for Pay</label>
                                          </div>
                                          <div class="input-group col-sm-6">
                                             <span class="input-group-addon">Rs.</span>
                                             <input name="loantotalforpay" class="form-control" required="" data-ng-model="" type="text" readonly="">
                                             <span class="input-group-addon">.00</span>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <div class="col-sm-4">
                                             <label for="">Installment</label>
                                          </div>
                                          <div class="input-group col-sm-6">
                                             <span class="input-group-addon">Rs.</span>
                                             <input name="loaninstallforpay" class="form-control" required="" data-ng-model="" type="text" readonly="">
                                             <span class="input-group-addon">.00</span>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <div class="col-sm-4">
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
                            <!-- Loan End -->
                          </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                      </div>
                    </div>
                    <!-- loan advance End -->
                  </div>
                  <!-- Pass loan END -->
                  <div class="row">
                    <div class="col-md-6">
                      <p>in here should past</p>
                    </div>
                  </div>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                    
                    <h1>EDIT SETINGS</h1>

                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
          <!-- END Update TABS -->

         </div> <!-- /.content -->
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
    </div><!-- ./wrapper -->

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
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Data tabale JavaScript -->
    <script>
      $(function () {
        $('#supplier-updates').DataTable();
        // $('#supplier-updates2').DataTable({
        //   "paging": true,
        //   "lengthChange": false,
        //   "searching": false,
        //   "ordering": true,
        //   "info": true,
        //   "autoWidth": false
        // });
      });
    </script>

    <script>
      $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
          var clicks = $(this).data('clicks');
          if (clicks) {
            //Uncheck all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
          } else {
            //Check all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
          }
          $(this).data("clicks", !clicks);
        });

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {
          e.preventDefault();
          //detect type
          var $this = $(this).find("a > i");
          var glyph = $this.hasClass("glyphicon");
          var fa = $this.hasClass("fa");

          //Switch states
          if (glyph) {
            $this.toggleClass("glyphicon-star");
            $this.toggleClass("glyphicon-star-empty");
          }

          if (fa) {
            $this.toggleClass("fa-star");
            $this.toggleClass("fa-star-o");
          }
        });
      });
    </script>
  </body>
</html>

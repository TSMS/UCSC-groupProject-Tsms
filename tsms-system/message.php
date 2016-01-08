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

if(!empty($_GET["id"])){
  $id = $_GET["id"];
} 

?>
<!DOCTYPE html>
<html>
<title>Message</title>
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
            <li class="active">
              <a href="message.php">
                <i class="fa fa-envelope"></i> <span>Message</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
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
                <li><a href="#"><i class="fa fa-circle-o"></i> Edit</a></li>
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
               Message
               <small>Request Accepting</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
               <li class="active">Dashboad</li>
            </ol>
         </section>
         <!-- Main content -->
         <div id="content" class="content">
         
          <section class="content">
            <style>
             .login-dialog .modal-dialog {
                  width: 400px;
              }
          </style>
            <!-- Modal For Send message -->
            <div id="myModal" class="login-dialog modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Send message</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                              <!-- text input -->
                              <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" placeholder="Enter Mobile number like 0772376512.">
                              </div>
                              <!-- textarea -->
                              <div class="form-group">
                                <label>Textarea</label>
                                <textarea class="form-control" rows="3" placeholder="Enter your message in here"></textarea>
                              </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
                            <button type="button" class="btn bg-navy btn-flat">Send</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal For Reply message -->
            <div id="reply" class="login-dialog modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Reply message</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                              <!-- text input -->
                              <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" placeholder="Enter Mobile number like 0772376512.">
                              </div>
                              <!-- textarea -->
                              <div class="form-group">
                                <label>Textarea</label>
                                <textarea class="form-control" rows="3" placeholder="Enter your message in here"></textarea>
                              </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
                            <button type="button" class="btn bg-navy btn-flat">Send</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="box-body">
                  <p>Send Message to Suppliers</p>
                  <!-- Button HTML (to Trigger Modal) -->
            <a href="#myModal" role="button" class="btn bg-navy btn-flat" data-toggle="modal"><i class="fa fa-envelope"></i>  Compose</a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="box box-navy">
                  <div class="box-header with-border">
                    <h3 class="box-title">Inbox</h3>
                    <div class="box-tools pull-right">
                      <div class="has-feedback">
                        <input type="text" class="form-control input-sm" placeholder="Search Mail">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                      </div>
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    <div class="mailbox-controls">
                      <!-- Check all button -->
                      <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        <a href="#reply" role="button" class="btn btn-default btn-sm" data-toggle="modal"><i class="fa fa-reply"></i></a>
                      </div><!-- /.btn-group -->
                      <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                      <div class="pull-right"><i class="fa fa-reply"></i>
                        1-50/200
                        <div class="btn-group">
                          <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                          <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                        </div><!-- /.btn-group -->
                      </div><!-- /.pull-right -->
                    </div>
                    <div class="table-responsive mailbox-messages">
                      <?php
                      $getdata = $user_home->runQuery("SELECT t.message_id, s.f_name,s.l_name,t.message_code, t.value, t.quantity, t.category, t.date, t.time, t.approve FROM message_temp t,suppliers s WHERE t.supplier_code= s.supplier_code ORDER BY date DESC");
                      $getdata->execute();
                      ?>
                      <table class="table table-hover table-striped">
                        <tbody>
                        <?php 
                        if($getdata->rowCount() > 0)
                          {
                           while($row=$getdata->FETCH(PDO::FETCH_ASSOC)){
                            $type = $row['message_code'];
                            switch ($type) {
                                 case 'fer':
                                   $lable = 'btn-info';
                                   $mcode = 'fertilizer';
                                   break;
                                 case 'adv':
                                   $lable = 'btn-warning';
                                   $mcode = 'advance';
                                   break;
                                 case 'bil':
                                   $lable = 'btn-default';
                                   $mcode = 'bills';
                                   break;
                                 case 'lon':
                                   $lable = 'btn-primary';
                                   $mcode = 'loan';
                                   break;
                                 default:
                                   $lable = 'btn-success';
                                   $mcode = 'chemical';
                                   break;
                               }
                         ?>
                          <tr>
                            <td><input type="checkbox"></td>
                            <td class="mailbox-star">[<?php print($row['message_id']); ?>]</td>
                            <td class="mailbox-name"><a href="message.php?id=<?php echo $row['message_id'];?>"><?php print($row['f_name']." ".$row['l_name']); ?></a></td>
                            <td class="mailbox-subject"><p class="btn <?php echo $lable?> btn-flat btn-xs"><?php echo $mcode; ?></td>
                            <td class="mailbox-date"><?php print($row['time']); ?></td>
                          </tr>
                             <?php
                               }
                              }
                              else
                              {
                               ?>
                                  <tr>
                                  <td><?php print("nothing here...");  ?></td>
                                  </tr>
                                  <?php
                              }
                              ?>
                        </tbody>
                      </table><!-- /.table -->
                    </div><!-- /.mail-box-messages -->
                  </div><!-- /.box-body -->
                  <div class="box-footer no-padding">
                    <div class="mailbox-controls">
                      <!-- Check all button -->
                      <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        <a href="#reply" role="button" class="btn btn-default btn-sm" data-toggle="modal"><i class="fa fa-reply"></i></a>
                      </div><!-- /.btn-group -->
                      <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                      <div class="pull-right">
                        1-50/200
                        <div class="btn-group">
                          <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                          <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                        </div><!-- /.btn-group -->
                      </div><!-- /.pull-right -->
                    </div>
                  </div>
                </div><!-- /. box -->
              </div><!-- /.col -->
              <?php  
              if(!empty($id)){
                ?>
              <div class="col-md-6">
                <div class="box box-navy">
                  <div class="box-header with-border">
                    <h3 class="box-title"> View Message</h3>
                    <div class="box-body">
                      <dl class="dl-horizontal example1">
                         <p>Request message
                         <p>
                         <dt>Supplier Code: </dt>
                         <dd>as</dd>
                         <dt>Supplier Name: </dt>
                         <dd>txt</dd>
                         <dt>ammount: </dt>
                         <dd>value</dd>
                         <dt>Quantity: </dt>
                         <dd>quantity;</dd>
                         <dt>category: </dt>
                         <dd>reqtype</dd>

                         <div class="supplier-ditails">
                            <!-- Bar Chart Start -->
                              <div class="box box-success">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Supply of last 6 month</h3>
                                  <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="box-body">
                                  <div class="chart">
                                    <canvas id="income" width="500" height="230"></canvas>
                                  </div>
                                </div><!-- /.box-body -->
                              </div><!-- /.box -->
                              <!-- Bar Chart End -->
                             <!-- line Chart Start -->
                              <div class="box box-success">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Income vs payment</h3>
                                  <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="box-body">
                                  <div class="chart">
                                    <canvas id="c" width="500" height="230"></canvas>
                                  </div>
                                </div><!-- /.box-body -->
                              </div><!-- /.box -->
                              <!-- Line Chart End -->
                         </div>
                         <div class="is-accept">
                          <!-- here you can get idea about are you going to give this or not -->
                          <div class="col-md-6">
                            <div class="info-box bg-green">
                              <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">41,410</span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: 70%"></div>
                                </div>
                                <span class="progress-description">
                                  70% Increase in 30 Days
                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div><!-- /.col -->
                          <!-- if this mark apear then that means you can not offer anything to the supplier -->
                          <div class="col-md-6">
                            <div class="info-box bg-red">
                              <span class="info-box-icon"><i class="fa fa-thumbs-o-down"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">41,410</span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: 30%"></div>
                                </div>
                                <span class="progress-description">
                                  70% Increase in 30 Days
                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div><!-- /.col -->
                       </div>
                       <div class="input-group">
                         <span class="input-group-btn">
                            <button type="button" name="accept" class="btn bg-navy btn-flat pull-right">Accept</button>                
                            <button type="reset" name="Reject" class="btn bg-denger btn-flat ">Reject</button>
                         </span>
                       </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
              } ?>
            </div>
          </section>
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
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
     <!-- chartjs Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <!-- Page Script -->
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
    <!-- Charts javaScript -->
      <script>
      var ctx = document.getElementById("c").getContext("2d");
      var data = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
          label: "My First dataset",
          fillColor: "rgba(220,220,220,0.2)",
          strokeColor: "rgba(220,220,220,1)",
          pointColor: "rgba(220,220,220,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [65, 59, 80, 81, 56, 55, 40]
        }, {
          label: "My Second dataset",
          fillColor: "rgba(151,187,205,0.2)",
          strokeColor: "rgba(151,187,205,1)",
          pointColor: "rgba(151,187,205,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(151,187,205,1)",
          data: [28, 48, 40, 19, 86, 27, 90]
        }]
      };
      var MyNewChart = new Chart(ctx).Line(data);
    </script>
    <!-- Line Chart JavaScript End -->
    <!-- Bar Chart JavaScript Start -->
    <script type="text/javascript">
      var barData = {
                labels : ["January","February","March","April","May","June"],
                datasets : [
                    {
                        fillColor : "#48A497",
                        strokeColor : "#48A4D1",
                        data : [456,479,324,569,702,600]
                    }
                ]
            }
            // get bar chart canvas
            var income = document.getElementById("income").getContext("2d");
            // draw bar chart
            new Chart(income).Bar(barData);
    </script>
    <!-- Charts Ends -->
  </body>
</html>

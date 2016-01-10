<?php
session_start();
require_once 'classes/class.user.php';
$user = new USER();
$code = '0001';
$sql = "SELECT * FROM `suppliers` WHERE supplier_code = $code";
$getdata = $user->runQuery($sql);
$getdata->execute();
if(!empty($code)){
  if($getdata->rowCount() > 0)
  {
    while($row=$getdata->FETCH(PDO::FETCH_ASSOC))
    {
      $name = $row['f_name']." ".$row['l_name'];;
      $addr = $row['address_1'];
      $mobile = $row['mobile_no'];
      $email = $row['e_mail'];
    }
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tsms | Details view</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/TsmsUI.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <!-- select option -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
  </head>
  <body>
  <body class="lockscreen">
    <div class="wrapper">
        <section class="content">
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="info-box">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="dist/tsms.jpg" alt="User profile picture">
                  <h3 class="profile-username text-center"><?php echo $name?></h3>
                  <p class="text-muted text-center">-<?php echo $email?></p>
                  <hr>
                  <a class="btn bg-navy btn-flat pull-right" href="logout.php">Log Out</a>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- About Me Box -->
              <div class="info-box">
                <div class="box-header with-border">
                  <h3 class="box-title">About Me</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <strong><i class="fa fa-user margin-r-5"></i> Supplier Code</strong>
                  <p class="text-muted">
                    <?php echo $code?>
                  </p>

                  <hr>
                  <strong><i class="fa fa-mobile margin-r-5"></i> Mobile</strong>
                  <p class="text-muted">
                    <?php echo $mobile?>
                  </p>

                  <hr>

                  <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                  <p class="text-muted"><?php echo $addr?></p>

                  <hr>

                  <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              
              <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url('dist/img/image1.png') center center;">
                  <h3 class="widget-user-username"><b>THALAPALAKANADA</b></h3>
                  <h5 class="widget-user-desc">Tea Factory</h5>
                </div>
                <div class="box-footer">
                  

                  <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#activity" data-toggle="tab">Activity Summary</a></li>
                  <li><a href="#timeline" data-toggle="tab">My Supply Data</a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                   <div class="row">
                     <div class="col-md-6">
                      <div class="info-box">
                        <div class="box-header with-border">
                          <h4 class="box-title">Tea Rates of Last 6 Months (Rs)</h4>
                        </div>
                        <div class="box-body">
                          <div class="chart">
                            <canvas id="c" width="500" height="230"></canvas>
                          </div>
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div>
                  <div class="col-md-6">
                    <div class="info-box">
                      <div class="box-header with-border">
                        <h4 class="box-title">Supply of Last 6 Months (kg)</h4>
                      </div>
                      <div class="box-body">
                        <div class="chart">
                          <canvas id="income" width="500" height="230"></canvas>
                        </div>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </div>
                   </div>

                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline"> 
                   <?php 
                   $s = "SELECT * FROM `daily_supply` WHERE supplier_code = $code";
                    $smgt = $user->runQuery($s);
                    $smgt->execute();
                    ?>

                    <div class="table-responsive">          
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Units</th>
                            <th>Supplied (Kgs)</th>
                            <th>Approved (Kgs)</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if($smgt->rowCount() > 0)
                            {
                              while($roww=$smgt->FETCH(PDO::FETCH_ASSOC))
                              {?>
                          <tr>
                            <td><?php echo $roww['date'];?></td>
                            <td><?php echo $roww['units'];?></td>
                            <td><?php echo $roww['supplied_kgs'];?></td>
                            <td><?php echo $roww['approved_kgs'];?></td>
                          </tr>
                          <?php
                          }
                            } 
                           ?>
                        </tbody>
                      </table>
                      </div>

                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->

                </div>
              </div><!-- /.widget-user -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="info-box">
                <div class="box-body">
                  <blockquote>
                    <div class="row">
                      <div class="col-md-2">
                        <a href="#request" role="button" data-toggle="modal" class="btn btn-app"><i class="fa fa-envelope"></i> Request</a>
                      </div>
                      <div class="col-md-6">
                        <p class="text-green"><b>Click This button to send service Request..</b></p>
                        <small>More Details <cite title="Source Title">Contact Us</cite></small>
                      </div>
                    </div>
                  </blockquote>
                </div>
              </div>
            </div>
          </div><!-- /.row -->
        </section>

        <div id="request" class="login-dialog modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Send Service Request</h4>
                    </div>
                    <div class="modal-body">

                        <form role="form">
                          <div class="box-body">
                            <div class="form-group">
                              <div class="form-group">
                                <label>Minimal</label>
                                <select class="form-control select2" style="width: 100%;">
                                  <option selected="selected">Advance</option>
                                  <option>Fertilizer</option>
                                  <option>Tea Product</option>
                                  <option>Chemical</option>
                                </select>
                              </div>
                            </div>
                            <div class="input-group">
                              <span class="input-group-addon">Rs</span>
                              <input type="text" class="form-control" placeholder="Amount">
                            </div>
                            <div class="form-group">
                              <label for="qnt">Enter quntity for Tea product, chemical or firtilizer</label>
                              <input type="text" class="form-control" id="qnt" placeholder="Quntity">
                            </div>
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
      <footer class="footer box col-md-12">
        <div class="pull-right hidden-xs">
          <b>THALAPALAKANADA</b>Tea Factory
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="http:4it.lk">TSMS</a>.</strong> All rights reserved.
      </footer>
    </div>
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- select -->
    <script src="plugins/select2/select2.full.min.js"></script>

    <script type="text/javascript">
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
    </script>
     <!-- chartjs Scripts -->
    <script src="plugins/Chart.min.js"></script>
      <script>
      var ctx = document.getElementById("c").getContext("2d");
      var data = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
          label: "My First dataset",
          fillColor: "rgba(220,220,220,0.2)",
          strokeColor: "rgba(127, 140, 141,1.0)",
          pointColor: "rgba(127, 140, 141,1.0)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [65, 59, 80, 81, 56, 55, 40]
        }, {
          label: "My Second dataset",
          fillColor: "rgba(151,187,205,0.2)",
          strokeColor: "rgba(41, 128, 185,1.0)",
          pointColor: "rgba(41, 128, 185,1.0)",
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
                        fillColor : "rgba(52, 152, 219,1.0)",
                        strokeColor : "rgba(41, 128, 185,1.0)",
                        data : [456,479,324,569,702,600]
                    },
                    {
                        fillColor : "rgba(230, 126, 34,1.0)",
                        strokeColor : "rgba(211, 84, 0,1.0)",
                        data : [364,504,605,400,345,320]
                    }
                ]
            }
            // get bar chart canvas
            var income = document.getElementById("income").getContext("2d");
            // draw bar chart
            new Chart(income).Bar(barData);
    </script>
  </body>
</html>

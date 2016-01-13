<?php
include_once 'dbconfig.php';
if(!$user->is_loggedin())
{
  $user->redirect('index.php');
}
$supplier_code = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM suppliers WHERE supplier_code=:supplier_code");
$stmt->execute(array(":supplier_code"=>$supplier_code));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

include_once 'class.suppliers.php';
$supplier = new Supplier();
$code = $userRow['supplier_code'];



$sql = "SELECT * FROM `suppliers` WHERE supplier_code = $code";
$getdata = $supplier->runQuery($sql);
$getdata->execute();
if(!empty($code)){
  if($getdata->rowCount() > 0)
  {
    while($row=$getdata->FETCH(PDO::FETCH_ASSOC))
    {
      $name = $row['f_name']." ".$row['l_name'];
      $addr = $row['address_1'];
      $mobile = $row['mobile_no'];
      $email = $row['e_mail'];
    }
  }
}
if(isset($_POST['sendmsg'])){
	$selectservice=$_POST['selectservice'];
	$amount=$_POST['amount'];
	$qty=$_POST['qty'];
	$category=$_POST['category'];
	//echo($selectservice.$amount.$qty.$category);
	$supplier->sendmessagetosys($code,$selectservice,$amount,$qty,$category);
  echo '<script> alert("Success!") </script>';
}

$todaysupply=0;
$todaysupply=$supplier->getmytodaysupply($code);



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
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/TsmsUI.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
    <!-- select option -->
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  </head>
  <body>
  <body class="lockscreen">
    <div class="wrapper">
        <section class="content">
          <div class="row">
            <div class="col-md-3">

<?php 

if(isset($_POST['pass'])){

  $userr = $userRow['supplier_code'];
  $upass = $_POST['cpass'];
  $npass = $_POST['npass'];

  $s = $stmt = $DB_con->prepare("SELECT * FROM suppliers WHERE supplier_code=:uname LIMIT 1");
      $s->execute(array(':uname'=>$userr));
      $userRow=$s->fetch(PDO::FETCH_ASSOC);
      if($s->rowCount() > 0)
      {
        if($userRow['user_pass']==MD5($upass))
        {

          $new_password = MD5($npass);

          $s1 = $DB_con->prepare("UPDATE `suppliers` SET `user_pass`= :npass WHERE supplier_code = :uname");

          $s1->bindparam(":npass", $new_password);

          $s1->bindparam(":uname", $userr);                       
            
          $s1->execute();

           echo '<script> alert("Success!") </script>';
        }
        else
        {
           echo '<script> alert("Error!") </script>';
        }
      }
  //echo '<script>$(function(){ swal("Success!", "Successfully inserted","success")}); </script>';
}
 ?>
              <!-- Profile Image -->
              <div class="info-box">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="../dist/tsms.jpg" alt="User profile picture">
                  <h3 class="profile-username text-center"><?php echo $name?></h3>
                  <p class="text-muted text-center">-<?php echo $email?>-</p>
                  <hr>
                  <a href="#pass" role="button"  data-toggle="modal">Reset my password</a>
                  <a class="btn bg-navy btn-flat pull-right" href="logout.php?logout=true">Log Out</a>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           <!-- Modal For Send message -->
            <div id="pass" class="login-dialog modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Change password</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post">
                              <!-- text input -->
                              <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" class="form-control" name="cpass" placeholder="Enter Current password.">
                              </div>
                              <!-- textarea -->
                              <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="npass" placeholder="Enter New password.">
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn bg-olive btn-flat" data-dismiss="modal">Close</button>
                                  <button type="submit" name="pass" class="btn bg-navy btn-flat" value="send message">Submit</button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

                         <!-- Modal For Send message -->
            <div id="myModal" class="login-dialog modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Send message</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post">
                              <!-- text input -->
                              <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" maxlength="10" class="form-control" name="number" placeholder="Enter Mobile number like 0772376512.">
                              </div>
                              <!-- textarea -->
                              <div class="form-group">
                                <label>Textarea</label>
                                <textarea class="form-control" rows="3" name="send_message" placeholder="Enter your message in here"></textarea>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn bg-olive btn-flat" data-dismiss="modal">Close</button>
                                  <button type="submit" name="send" class="btn bg-navy btn-flat" value="send message">Send message</button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


              <div class="info-box color">
                <div class="box-body box-profile">
                  <h3 >Today My Supply</h3>
                  <hr>
                  <h4><?php echo($todaysupply);?> kg</h4>
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
                <div class="widget-user-header bg-black" style="background: url('../dist/img/image1.png') center center;">
                  <h3 class="widget-user-username"><b>THALAPALAKANADA</b></h3>
                  <h5 class="widget-user-desc">Tea Factory</h5>
                </div>
                <div class="box-footer">
                  

                  <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#activity" data-toggle="tab">Activity Summary</a></li>
                  <li><a href="#timeline" data-toggle="tab">My Supply Data</a></li>
				            <li><a href="#timeline" data-toggle="tab">My Service Data</a></li>
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
                    $smgt = $supplier->runQuery($s);
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

                        <form action="" method="POST" role="form">
                          <div class="box-body">
                            <div class="form-group">
                              <div class="form-group">
                                <label>Minimal</label>
                                <select name="selectservice" class="form-control select2" style="width: 100%;">
                                  <option selected="selected" value="adv">Advance</option>
                                  <option  value="fer">Fertilizer</option>
                                  <option  value="tea">Tea Product</option>
                                  <option  value="che">Chemical</option>
                                </select>
                              </div>
                              <label for="qnt">Enter Amount for Advance or loan</label>
                            </div>
                            <div class="input-group">
                              <span class="input-group-addon">Rs</span>
                              <input type="text" name="amount" class="form-control" placeholder="Amount" onkeypress="return isNumberKey(event)" maxlength="10">
                            </div>
                            <div class="form-group">
                              <label for="qnt">Enter quantity for Tea product, chemical or fertilizer</label>
                              <input type="text" name="qty" class="form-control" id="qnt" placeholder="Quntity" onkeypress="return isNumberKey(event)"  maxlength="3">
                            </div>
							<div class="form-group">
                              <label for="qnt">Enter category for chemical or fertilizer</label>
                              <input type="text" name="category" class="form-control" id="qnt" placeholder="Category"  maxlength="20">
                            </div>
							
                          </div>
						  <div class="modal-footer">
								<button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
								<button type="submit" name="sendmsg" class="btn bg-navy btn-flat">Send</button>
						   </div>
                        </form>
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
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <!-- select -->
    <script src="../plugins/select2/select2.full.min.js"></script>

    <script type="text/javascript">
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
    </script>
     <!-- chartjs Scripts -->
    <script src="../plugins/Chart.min.js"></script>
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
	<script>
	    function isNumberKey(evt){
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
				return false;
			return true;
		}
	</script>
  </body>
</html>

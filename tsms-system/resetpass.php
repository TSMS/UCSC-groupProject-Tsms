<?php
require_once 'classes/class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
  $user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
  $id = base64_decode($_GET['id']);
  $code = $_GET['code'];
  
  $stmt = $user->runQuery("SELECT * FROM users WHERE id=:uid AND token_Code=:token");
  $stmt->execute(array(":uid"=>$id,":token"=>$code));
  $rows = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if($stmt->rowCount() == 1)
  {
    if(isset($_POST['btn-reset-pass']))
    {
      $pass = $_POST['pass'];
      $cpass = $_POST['confirm-pass'];
      
      if($cpass!==$pass)
      {
        $msg = '<p class="text-red">
            <strong>Sorry!</strong>  Password Does not match. 
            </p>';
      }
      else
      {
        $password = md5($cpass);
        $stmt = $user->runQuery("UPDATE users SET password=:upass WHERE id=:uid");
        $stmt->execute(array(":upass"=>$password,":uid"=>$rows['id']));
        
        $msg = "<div class='alert alert-success'>
            <button class='close' data-dismiss='alert'>&times;</button>
            Password Changed.
            </div>";
        header("refresh:5;index.php");
      }
    } 
  }
  else
  {
    $msg = "<p>No Account Found, Try again!</p>";
        
  }
  
  
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TsmsUI 2 | Starter</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Datatable -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/TsmsUI.css">

    <link rel="stylesheet" href="dist/css/skins/skin.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  </head>
    <body class="hold-transition lockscreen">
    <div class="rbox">
        <div class="row">
          <br><br>
          <div class="col-md-offset-3 col-md-6">
              <div class="box box-solid">
                <div class="box-body">
                  <blockquote>
                    <p><strong>Hello !</strong>  <?php echo $rows['username'] ?> you are here to reset your forgetton password.</p>
                    <small>Change your password. <cite title="Source Title">Thalapalakanada tea factory</cite></small>
                  </blockquote>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- ./col -->
            <div class="col-md-offset-3 col-md-6">
              <div class="sbox"></div>
              <div class="box box-success">
                <div class="box-header with-border">
                   <h2 class="form-signin-heading">Password Reset</h2>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal form-signin" method="post">
                  <div class="box-body">
                    <label class="control-label"><?php
                      if(isset($msg))
                  {
                    echo $msg;
                  }
                  ?></label>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Password</label>
                      <div class="col-sm-6">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="New Password" name="pass" required />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword4" class="col-sm-4 control-label">Password Again</label>
                      <div class="col-sm-6">
                        <input type="password" class="form-control" id="inputPassword4" placeholder="Confirm New Password" name="confirm-pass" required />
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="index.php" type="submit" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success pull-right" name="btn-reset-pass">Reset Your Password</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->
          </div>
            </div>
        </div>
        <div class="lockscreen-footer text-center">
        Copyright &copy; 2015-2016 <b><a href="http://4it.lk" class="text-black">TSMS-ystem</a></b><br>
        All rights reserved
      </div>
    <script src="bootstrap/js/bootstrap.min.js"></script>
     <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>
</html>
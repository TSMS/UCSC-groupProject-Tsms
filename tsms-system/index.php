<?php
session_start();
require_once 'classes/class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
  $user_login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
  $email = trim($_POST['txtemail']);
  $upass = trim($_POST['txtupass']);
  
  if($user_login->login($email,$upass))
  {
    $user_login->redirect('home.php');
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tsms | Log in</title>
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
  </head>
  <body class="hold-transition login-page">
      <br>
    <div class="row">
      <div class="col-xs-10">
        <h4 class="pull-right"><a href="webpage.php"><b>Vist Us</b></a></h4>
      </div>
    </div>
    <!-- alert display in here! -->
    <div class="col-md-offset-3 col-md-6">
          <?php 
    if(isset($_GET['inactive']))
    {
      ?>
       <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-ban"></i> Sorry!</h4>
           This Account is not Activated Go to your Inbox and Activate it. 
      </div>
      <!-- <div class='alert alert-error'>
        <button class='close' data-dismiss='alert'>&times;</button>
        <strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. 
      </div> -->
      <?php
    }
        if(isset($_GET['error']))
    {
      ?>
      <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4>  <i class="icon fa fa-check"></i> Wrong Details!</h4>
        Please enter the correct details.
      </div>
      <!-- <div class='alert alert-success'>
        <button class='close' data-dismiss='alert'>&times;</button>
        <strong>Wrong Details!</strong> 
      </div> -->
    <?php
    }
    ?>
    </div>  
    <div class="row">
      <div class="col-md-5">
        <div class="login-box">
          <div class="login-logo">
            <br>
            <a href="login.html"><img src="dist/Llogo.png"></a>
          </div><!-- /.login-logo -->
          <div class="login-box-body">
            <p class="login-box-msg">Sign in to the system in here</p>
            <form class="form-signin" method="post">
              <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email address" name="txtemail" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="txtupass" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-8">
                  <div class="checkbox icheck">
                    <label>
                      <input type="checkbox"> Remember Me
                    </label>
                  </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                  <button type="submit" class="btn bg-olive btn-flat" name="btn-login">Sign In</button>
                </div><!-- /.col -->
              </div>
            </form>

           <!--  <div class="social-auth-links text-center">
              <p>- OR -</p>
              <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
              <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
            </div>
 -->
            <a href="fpass.php">I forgot my password</a><br>
            <a href="signup.php" class="text-center">Register a new membership</a>

          </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
      </div>
      <div class="row">
        <div class="">
          <div class="col-md-6">
                <br>
                <div class="box-body">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                      <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="dist/img/image1.png" alt="First slide">
                        <div class="carousel-caption">
                          Thalapalakanada
                        </div>
                      </div>
                      <div class="item">
                        <img src="dist/img/image2.png" alt="Second slide">
                        <div class="carousel-caption">
                          Tea
                        </div>
                      </div>
                      <div class="item">
                        <img src="dist/img/image3.png" alt="Third slide">
                        <div class="carousel-caption">
                          Factory
                        </div>
                      </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
                  </div>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          <div class="col-md-6 textcenter">
            <h1><span class="thalapalakanada"><b>THALAPALAKANADA</b></span></h1>
            <h3>Tea Factory</h3>
            <h5>This is Thalapalakanada tea factory official web site if you have no account Please <a class="link" href="signup.php">Register!</a> in here</h5>
          </div>
        </div>
      </div>
    </div>
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>

<?php
session_start();
require_once 'classes/class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
  $reg_user->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
  $uname = trim($_POST['txtuname']);
  $email = trim($_POST['txtemail']);
  $upass = trim($_POST['txtpass']);
  $code = md5(uniqid(rand()));
  $name_f=trim($_POST['fname']);
  $name_l=trim($_POST['lname']);
  $name=$name_f." ".$name_l;
  
  $stmt = $reg_user->runQuery("SELECT * FROM users WHERE email=:email_id");
  $stmt->execute(array(":email_id"=>$email));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if($stmt->rowCount() > 0)
  {
    $msg = ' <div class="col-md-offset-3 col-md-6"><div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Sorry!</h4>
                    email allready exists , Please Try another one
                  </div></div>';
    // $msg = "
    //       <div class='alert alert-error'>
    //     <button class='close' data-dismiss='alert'>&times;</button>
    //       <strong>Sorry !</strong>  email allready exists , Please Try another one
    //     </div>
    //     ";
  }
  else
  {
    if($reg_user->register($uname,$email,$upass,$code,$name))
    {     
      $id = $reg_user->lasdID();    
      $key = base64_encode($id);
      $id = $key;
      
      $message = "          
            Hello $uname,
            <br /><br />
            Welcome to THALAPALAKANADA TEA factory!<br/>
            To complete your registration  please , just click following link.<br/>you can login to the system after admin approved you.<br/>
            <br /><br />
            <a href='http://localhost/tsms/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
            <br /><br />
            Thanks,";
            
      $subject = "Confirm Registration";
            
      $reg_user->send_mail($email,$message,$subject);
      $msg ='<div class="col-md-offset-3 col-md-6"><div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>  <i class="icon fa fa-check"></i> Success!</h4>
                    We have sent an email to '.$email.' Please click on the confirmation link in the email to create your account.
                  </div></div>'; 
      // $msg = "
      //     <div class='alert alert-success'>
      //       <button class='close' data-dismiss='alert'>&times;</button>
      //       <strong>Success!</strong>  We've sent an email to $email.
      //               Please click on the confirmation link in the email to create your account. 
      //       </div>
      //     ";
    }
    else
    {
      echo "sorry , Query could no execute...";
    }   
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tsms | Registation</title>
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
        <h4 class="pull-right"><a href="thalapalakanada.lk"><b>Vist Us</b></a></h4>
      </div>
    </div>
    <?php if(isset($msg)) echo $msg;  ?>  
    <div class="row">
      <div class="col-md-5">
        <div class="login-box">
          <div class="login-logo">
            <br>
            <a href="login.html"><img src="dist/Llogo.png"></a>
          </div><!-- /.login-logo -->
          <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>
        <form class="form-signin" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="First Name" name="fname" required />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Last Name" name="lname" />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="txtuname" required />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email address" name="txtemail" required />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="txtpass" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input required type="checkbox"> I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-signup">Register</button>
            </div><!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
        </div>

        <a href="index.php" class="text-center">I already have a membership</a>
      </div><!-- /.form-box -->
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
                          First Slide
                        </div>
                      </div>
                      <div class="item">
                        <img src="dist/img/image2.png" alt="Second slide">
                        <div class="carousel-caption">
                          Second Slide
                        </div>
                      </div>
                      <div class="item">
                        <img src="dist/img/image3.png" alt="Third slide">
                        <div class="carousel-caption">
                          Third Slide
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
            <h5>This is Thalapalakanada tea factory official web site if you have no account Please <a class="link" href="register.html">Register!</a> in here</h5>
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

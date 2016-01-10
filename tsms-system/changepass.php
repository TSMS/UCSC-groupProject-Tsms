<?php
session_start();
require_once 'classes/class.user.php';
$user = new USER();

if(!$user->is_logged_in()!="")
{
  $user->redirect('index.php');
}

if(isset($_POST['btn-submit']))
{
  $email = $_POST['txtemail'];
  
  $stmt = $user->runQuery("SELECT id FROM users WHERE email=:email LIMIT 1");
  $stmt->execute(array(":email"=>$email));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);  
  if($stmt->rowCount() == 1)
  {
    $id = base64_encode($row['id']);
    $code = md5(uniqid(rand()));
    
    $stmt = $user->runQuery("UPDATE users SET token_Code=:token WHERE email=:email");
    $stmt->execute(array(":token"=>$code,"email"=>$email));
    
    $message= "
           Hello , $email
           <br /><br />
           We received a request to change your password on Tsms System.<br>
           click the following link to reset your password, if not just ignore
           <br /><br />
           Click Following Link To Reset Your Password 
           <br /><br />
           <a href='http://localhost/tsms/resetpass.php?id=$id&code=$code'>click here to reset your password</a>
           <br /><br />
           thank you :)
          Thalapalakanada tea factory, Deniyaya.
           ";
    $subject = "Password Reset";
    
    $user->send_mail($email,$message,$subject);
    
    $msg = '<div class="col-md-offset-3 col-md-6">
          <div class="box box-solid">
            <div class="box-body">
              <blockquote>
                <p class="text-green"><b>We have sent an email to '.$email.'.</b> <br>Please click on the password reset link in the email to generate new password!</p>
                <small>there will be reset password link on you email. <cite title="Source Title">Thalapalakanada tea factory</cite></small>
              </blockquote>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- ./col --> ';
        header("refresh:5;index.php");
  }
  else
  {
    $msg = '<div class="col-md-offset-3 col-md-6">
          <div class="box box-solid">
            <div class="box-body">
              <blockquote>
                <p class="alert alert-danger"><b>Sorry!</b> <br>this email not found.</p>
                <small>please enter your correct email address. <cite title="Source Title">Thalapalakanada tea factory</cite></small>
              </blockquote>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- ./col --> ';
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Forgot Password</title>
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
              <?php
      if(isset($msg))
      {
        echo $msg;
      }
      else
      {
        ?>
        <div class="col-md-offset-3 col-md-6">
          <div class="box box-solid">
            <div class="box-body">
              <blockquote>
                <p class="text-blue"><b>You Have To enter your email address, To Change Your current Password.</b> <br>You will receive a link to create a new password via email!</p>
                <small>Change your password. <cite title="Source Title">Thalapalakanada tea factory</cite></small>
              </blockquote>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- ./col --> 
                <?php
      }
      ?>
            <div class="col-md-offset-3 col-md-6">
              
              <!-- Horizontal Form -->
              <div class="sbox"></div>
              <div class="box box-success">
                <div class="box-header with-border">
                   <h2 class="form-signin-heading">Change Password</h2>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal form-signin" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email address" name="txtemail" required>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="profile.php" type="submit" class="btn bg-navy btn-flat">Back to profile</a>
                    <button type="submit" class="btn bg-olive btn-flat pull-right" name="btn-submit">Generate new Password</button>
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
<?php
session_start();
require_once 'classes/class.user.php';
$user = new USER();

if($user->is_logged_in()!="")
{
  $user->redirect('home.php');
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
           We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore                   this email,
           <br /><br />
           Click Following Link To Reset Your Password 
           <br /><br />
           <a href='http://localhost/tsms/resetpass.php?id=$id&code=$code'>click here to reset your password</a>
           <br /><br />
           thank you :)
           ";
    $subject = "Password Reset";
    
    $user->send_mail($email,$message,$subject);
    
    $msg = "<div class='alert alert-success'>
          <button class='close' data-dismiss='alert'>&times;</button>
          We've sent an email to $email.
                    Please click on the password reset link in the email to generate new password. 
          </div>";
  }
  else
  {
    $msg = "<div class='alert alert-danger'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Sorry!</strong>  this email not found. 
          </div>";
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
            <div class="col-md-offset-3 col-md-6">
              <br><br>
              <?php
      if(isset($msg))
      {
        echo $msg;
      }
      else
      {
        ?>
                <div class='alert alert-warning'>
        Please enter your email address. You will receive a link to create a new password via email.!
        </div>  
                <?php
      }
      ?>
              <!-- Horizontal Form -->
              <div class="sbox"></div>
              <div class="box box-success">
                <div class="box-header with-border">
                   <h2 class="form-signin-heading">Forgot Password</h2>
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
                    <a href="index.php" type="submit" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success pull-right" name="btn-submit">Generate new Password</button>
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
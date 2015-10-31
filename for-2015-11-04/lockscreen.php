<?php
require_once 'core/init.php';
if(Session::exists('success')){
    echo Session::flash('success');
}

$user = new User();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tsms-panel Lock</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition lockscreen" style="background-image:url(dist/img/4.jpg)">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="lockscreen.php"><b>TSMS</b>panel</a>
      </div>
      <!-- ERROR DISPLAY -->
      <?php
        if(isset($_POST['btn-login']))
        {
          if(Input::exists()){
            if(Token::check(Input::get('token'))){

              $login = $user->login(Input::get('username'), Input::get('password'));

              if($login){
                  if($user->apprved_user('approved')){
                  Redirect::to('home.php');
                  }else{
                      echo '<font color="brown"><strong>Warning!</strong>You need admin permission to log-in to this system</font>';
                  }
              }else{
                  echo '<center><font color="red"><b>Sorry, Failed to login to the System,<br>try with Correct<br> password and username!</b></font></center>';
              }   echo '<br>';

            }
          }
        }
        ?>

      <!-- User name -->
      <div class="lockscreen-name"><?php echo escape($user->data()->username);?></div>

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
          <img src="<?php echo escape($user->data()->image);?>" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" action="" method='post'>
          <div class="input-group">
            <input type="hidden" class="form-control" name="username" id="username" value="<?php echo escape($user->data()->username);?>" required autocomplete=""/>
            <input type="password" class="form-control" name="password" id="password" placeholder="Your Password" required autocomplete=""/>
            <input type="hidden" name="token" value="<?php echo Token::generate();?>"/>
            <div class="input-group-btn">
              <button type='submit' name="btn-login" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
            </div>
          </div>
        </form><!-- /.lockscreen credentials -->

      </div><!-- /.lockscreen-item -->
      <div class="help-block text-center">
        Enter your password to retrieve your session
      </div>
      <div class="text-center">
        <a href="logout.php">Or sign in as a different user</a>
      </div>
      <div class="lockscreen-footer text-center">
        Copyright &copy; 2015 <b><a href="http://4it.lk" class="text-black">4it</a>All rights reserved
      </div>
    </div><!-- /.center -->
    <center><img src="image/xv.png"></center>
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
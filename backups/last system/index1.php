<?php
require_once 'core/init.php';

if(isset($_POST['btn-login']))
{
  if(Input::exists()){
      if(Token::check(Input::get('token'))){
          $validation = new Validation();
          $validation->check($_POST, array(
              'username'  => array('required' => 'true'),
              'password'  => array('required' => 'true')
          ));

          if($validation->passed()){
              $user = new User();

              $remember = (Input::get('remember') === 'on')? true : false;
              $login = $user->login(Input::get('username'), Input::get('password'), $remember);

              if($login){
                  Redirect::to('index.php');
              }else{
                  echo '<p>Sorry, Logged in failed</p>';
              }
          }else{
              pre($validation->errors());
          }

      }
  }
}

if(isset($_POST['btn-signup']))
{
echo "you clicked sign up btn";
}
?>
<?php
$user = new User();

if($user->isLoggedIn()){
    ?>

    <p>Hello, <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username);?></a></p>

    <ul>
        <li><a href="logout.php">Log Out</a></li>
        <li><a href="update.php">Update Detail</a></li>
        <li><a href="changePassword.php">Change Password</a></li>
    </ul>

    <?php

    if($user->hasPermission('admin')){
        echo '<p>You are an administratior.</p>';
    }

}else{

?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
      <title>TSMS login page</title>
      <link rel="stylesheet" href="style/css/reset.css">
      <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
      <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
      <link rel="stylesheet" href="style/css/style.css">
</head>
<body>
      <div class="pen-title" id="box">
        <div class="box-top">
          <h1>TSMS Login page</h1>
        </br>
          <h2>Tea supply management system for THALAPALAKANADA Tea Factory - made by Uscs 11batch Group 5</h2>
        </div>
      </div>
      <!-- Form Module-->
      <div class="module form-module">
        <div class="toggle"><i class="fa fa-times fa-pencil"></i>
          <div class="tooltip">Sign Up</div>
        </div>
        <div class="form">
          <h2>Login to your account</h2>
          <form action="" method='post'>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username or E mail ID" required autocomplete=""/>
            <input type="password" class="form-control" name="password" id="password" placeholder="Your Password" required autocomplete=""/>
            <input type="hidden" name="token" value="<?php echo Token::generate();?>"/>
            <button type='submit' name="btn-login" value="Login">
              <i class="glyphicon glyphicon-log-in"></i>&nbsp;SIGN IN
            </button>
          </form>
        </div>
        <div class="form">
          <h2>Create an account</h2>
          <form action="" method="POST">
            <input type="text" name="firstname" placeholder="First Name"/>
            <input type="text" class="form-control" name="reg_username" placeholder="Enter Username"/>
            <input type="password" class="form-control" name="reg_password" placeholder="Enter Password"/>
            <input type="text" class="form-control" name="reg_email" placeholder="Enter E-Mail ID"/>
            <select name="gender" placeholder="Gender">
                <option> -- -- </option>
                <option value="Male"> Male</option>
                <option value="Female">Female</option>
            </select>
            <input type="tel" name="txt_mobno" placeholder="Phone Number"/>
            <input type="address" placeholder="Home Address"/>
            <button type="submit" class="btn btn-block btn-primary" name="btn-signup">
              <i class="glyphicon glyphicon-open-file"></i>&nbsp;Register
            </button>
          </form>
        </div>
      </div>
</div>

<script src='style/js/jquery.min.js'></script> 
<script src="style/js/index.js"></script>
</body>
</html>

<?php
}
?>
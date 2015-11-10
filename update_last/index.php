<?php
require_once 'core/init.php';
?>
<!DOCTYPE html>
<html >
   <head>
      <meta charset="UTF-8">
      <title>Tsms-login</title>
      <link rel="stylesheet" href="styles/css/reset.css">
      <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
      <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
      <link rel="stylesheet" href="styles/css/style.css">
   </head>
   <body>
      <!-- Form Mixin-->
      <!-- Input Mixin-->
      <!-- Button Mixin-->
      <!-- Pen Title-->
      <div class="pen-title">
         <img src="image/xv.png" alt="Mountain View" style="width:200px;height:80px;">
      </div>
      <!-- Form Module-->
      <div class="module form-module">
         <div class="toggle">
            <i class="fa fa-times fa-pencil"></i>
            <div class="tooltip">Click Me</div>
         </div>
         <div class="form">
            <h2>Login to your account</h2>
<?php
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
                if($user->apprved_user('approved')){
                Redirect::to('home.php');
                }else{
                    echo '<font color="brown"><strong>Warning!</strong>You need admin permission to log-in to this system</font>';
                }
            }else{
                echo '<center><font color="red"><b>Sorry, Failed to login to the System,<br>try with Correct<br> password and username!</b></font></center>';
            }   echo '<br>';
        }else{
            pre($validation->errors());
        }

    }
  }
}
?>
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
<?php
if(isset($_POST['btn-signup']))
{
            $user = new User();
            $salt = Hash::salt(32);

            try{
                $user->create(array(
                    //left side into database    right side get input field name="username"
                    'username'  => Input::get('username1'),
                    'password'  =>  Hash::make(Input::get('password1'), $salt),
                    'salt'      => $salt,
                    'email'     => Input::get('reg_email'),
                    'name'      => Input::get('name'),
                    'nic'       => Input::get('nic'),
                    'joined'    => date("Y-m-d H:i:s"),
                    'gender'    => Input::get('gender'),
                    'phone'     => Input::get('phone'),
                    'groups'    => 1,
                    'user_approved'  => 1
                ));
            }catch (Exception $e){
                die($e->getMessage());
            }
            echo '<script language="javascript">';
            echo 'alert("Success! You have successfully registered.")';
            echo '</script>';
}
?>
          <form action="" method="POST">
            <input maxlength="100" required="required" type="text" class="form-control" name="username1" placeholder="Enter Username" value="<?php echo escape(Input::get('username1')); ?>" autocomplete="off"/>
            <input type="password" class="form-control" name="password1" placeholder="Enter Password" value="" required autocomplete="off"/>
            <input type="password" class="form-control" name="password_again" id="password_again" placeholder="Enter Password again" value="" required autocomplete="off"/>
            <input type="email" class="form-control" name="reg_email" placeholder="Enter E-Mail ID" value="<?php echo escape(Input::get('reg_email')); ?>" required autocomplete="off"/>
            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?php echo escape(Input::get('name')); ?>" required autocomplete="off"/>
            <select type="text" name="gender" class="form-control k" placeholder="Gender" value="<?php echo escape(Input::get('gender')); ?>" autocomplete="off">
                <option> -- -- </option>
                <option value="Male"> Male</option>
                <option value="Female">Female</option>
            </select>
            <input maxlength="10" type="tel" name="phone" placeholder="Phone Number" required value="<?php echo escape(Input::get('phone')); ?>" autocomplete="off"/>
            <input type="address" placeholder="Home Address" name="address" value="<?php echo escape(Input::get('address')); ?>" autocomplete="off"/>
            <button type="submit" class="btn btn-block btn-primary" name="btn-signup">
              <i class="glyphicon glyphicon-open-file"></i>&nbsp;Register
            </button>
          </form>
         </div>
         <div class="cta"><a href="http://tsms.lk">Forgot your password?</a></div>
      </div>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src='styles/js/da0415260bc83974687e3f9ae.js'></script>
      <script src="styles/js/index.js"></script>
   </body>
</html>
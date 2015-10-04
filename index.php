<!DOCTYPE html>
<html>
<meta charset="UTF-8">
</head>
<body>
<div class="pen-title" id="box">
        <div class="box-top">
          <h1>TSMS Login page</h1>
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
            <input type="text" name="txt_fname" placeholder="First Name"/>
            <input type="text" class="form-control" name="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>"/>
            <input type="password" class="form-control" name="txt_upass" placeholder="Enter Password"/>
            <input type="text" class="form-control" name="txt_umail" placeholder="Enter E-Mail ID" value="<?php if(isset($error)){echo $umail;}?>"/>
            <select name="gender">
                <option> ---- </option>
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
</body>
</html>
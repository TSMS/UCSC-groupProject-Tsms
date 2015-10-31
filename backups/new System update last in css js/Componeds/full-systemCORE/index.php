<?php

require_once 'core/init.php';

if(Session::exists('success')){
    echo Session::flash('success');
}

$user = new User();

if($user->isLoggedIn()){
?>
<html>
	<head>
		<title>Our website</title>
		<link rel="stylesheet" href="css/styles.css"/>
	</head>
		<body>
			<h5>Php database asmnt</h5>
			<?php include ("header.php");?>

			<h3>Hello, <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username);?></a></h3>
<?php
    if(Input::exists()){
        $user->update(array(
                        'username'  => Input::get('username'),
                        'email'     => Input::get('email'),
                        'name'      => Input::get('name'),
                        'nic'       => Input::get('nic'),
                        'gender'    => Input::get('gender'),
                        'phone'     => Input::get('phone'),

                    ));
                    Session::flash('success', 'Information Updated Successfully');
                    Redirect::to('index.php');
    }
?>
    <p><a href="search.php">Search users</a></p><br>
<?php
    if($user->apprved_user('approved')){
        echo 'hii approved user</br>';
    }

    if($user->hasPermission('admin')){
        echo '<p>You are an administratior.</p> </br>'
?>
              
<?php
          
        }else{
            echo 'standard user';
        }
    }else{
?>
        <p>You need to log in. this is tsms system withot interface</p>
        <p><a href="register.php">Register</a></p>
        <p><a href="login.php">Login</a></p>
<?php
    }
?>
		</body>
</html>
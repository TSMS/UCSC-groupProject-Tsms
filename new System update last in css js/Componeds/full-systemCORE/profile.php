<?php
require_once 'core/init.php';

$user = new User();

if($user->isLoggedIn()){

if(!$username = Input::get('user')){
    Redirect::to('index.php');
}else{
    $user = new User($username);
    if(!$user->exists()){
        Redirect::to(404);
    }else{
        $data = $user->data();
    }
    ?>
<h1>My Profile</h1>
    <h3><?php echo 'hey: '.escape($data->username);?></h3>
    <p>Full name: <?php echo escape($data->name);?></p>
    <p>username: <?php echo escape($data->username);?></p>
    <p>Email Address: <?php echo escape($data->email);?></p>
    <p>Joined date: <?php echo escape($data->joined);?></p>
    <p>Phone Number: <?php echo escape($data->phone);?></p>
   <?php 
   if($user->hasPermission('admin')){
        echo '<p>You are an administratior.</p> </br>';
    }else{
        echo 'you are an standed user';
    }
    ?>
    <?php

}
}
?>
<br>
<a href="index.php">Back</a>

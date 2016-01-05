<?php
require_once 'core/init.php';

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
                Redirect::to('index.php');
                }else{
                    echo '<p>You need admin permission to log-in to this system</p></br>';
                }
            }else{
                echo '<p>Sorry, Logged in failed</p>';
            }
        }else{
            pre($validation->errors());
        }

    }
}

?>

<form action="" method="post">
    <table>
        <tr>
            <td><label for="username">Username</label></td>
            <td><input type="text" name="username" id="username" autocomplete=""/></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="password" name="password" id="password" autocomplete=""/></td>
        </tr>
        <tr>
            <td><label for="remember"><input type="checkbox" name="remember" id="remember"/> Remember me</label></td>
            <td><input type="hidden" name="token" value="<?php echo Token::generate();?>"/></td>
        </tr>
        <tr>
            <td><input type="submit" value="Login"/></td>
            <td><a href="index.php">Back</a></td>
        </tr>
    </table>
</form>

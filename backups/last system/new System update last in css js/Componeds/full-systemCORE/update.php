<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validation = new Validation();

        $validation = $validation->check($_POST, array(
            'name'  => array(
                'required' => true,
                'min'      => 2,
                'max'      => 50
            )
        ));

        if($validation->passed()){
            try{
                $user->update(array(
                    'username'  => Input::get('username'),
                    'email'     => Input::get('email'),
                    'name'      => Input::get('name'),
                    'nic'       => Input::get('nic'),
                    'phone'     => Input::get('phone')
                ));

                Session::flash('success', 'Information Updated Successfully');
                Redirect::to('index.php');

            }catch (Exception $e){
                die($e->getMessage());
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
            <td><label for="name">Name</label></td>
            <td><input type="text" name="name" id="name" value="<?php echo $user->data()->name;?>"/></td>
        </tr>
        <tr>
            <td><label for="username">Username</label></td>
            <td><input type="text" name="username" id="username" value="<?php echo $user->data()->username;?>" /></td>
        </tr>
        <tr>
            <td><label for="email">Enter your email</label></td>
            <td><input type="text" name="email" id="email" value="<?php echo $user->data()->email;?>"/></td>
        </tr>
        <tr>
            <td><label for="nic">NIC</label></td>
            <td><input type="text" name="nic" id="nic" value="<?php echo $user->data()->nic;?>"/></td>
        </tr>
        <tr>
            <td><label for="phone">Phone Number</label></td>
            <td><input type="text" name="phone" id="phone" value="<?php echo $user->data()->phone;?>"/></td>
        </tr>
        <tr>
            <td><input type="submit" value="Update"/></td>
            <td><input type="hidden" name="token" value="<?php echo Token::generate();?>"/></td>
        </tr>
    </table>

</form>



<br>
<a href="index.php">Back</a>
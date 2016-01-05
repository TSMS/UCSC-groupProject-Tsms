<?php
require_once 'core/init.php';

if(Input::exists()){
    //if(Token::check(Input::get('token'))) {
    if(true){
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'users'
            ),
            'password' => array(
                'required' => true,
                'min' => 6
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            ),
            'name' => array(
                'required' => true,
                'min' => 3,
                'max' => 50
            ),
            'phone' => array(
                'min' => 10,
                'max' => 12
            )
        ));

        if ($validation->passed()) {

            $user = new User();
            $salt = Hash::salt(32);

            try{
                $user->create(array(
                    //left side into database    right side get input field name="username"
                    'username'  => Input::get('username'),
                    'password'  =>  Hash::make(Input::get('password'), $salt),
                    'salt'      => $salt,
                    'email'     => Input::get('email'),
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

            Session::flash('success', 'You have successfully registered.');
            Redirect::to('index.php');
        } else {
            pre($validation->errors());
        }
    }
}

?>

<form action="" method="post">
    <table>
        <tr>
            <td><label for="name">Name</label></td>
            <td><input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>" autocomplete="off"/></td>
        </tr>
        <tr>
            <td><label for="username">Username</label></td>
            <td><input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off"/></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="password" name="password" id="password" value="" autocomplete="off"/></td>
        </tr>
        <tr>
            <td><label for="password_again">Retype Password</label></td>
            <td><input type="password" name="password_again" id="password_again" value="" autocomplete="off"/></td>
        </tr>
        <tr>
            <td><label for="email">Enter your email</label></td>
            <td><input type="email" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off"/></td>
        </tr>
        <tr>
            <td><label for="nic">NIC</label></td>
            <td><input type="text" name="nic" id="nic" value="<?php echo escape(Input::get('nic')); ?>" autocomplete="off"/></td>
        </tr>
        <tr>
            <td><label for="gender">Gender</label></td>
            <td>
                <select name="gender" placeholder="Gender">
                    <option> -- -- </option>
                    <option value="Male"> Male</option>
                    <option value="Female">Female</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="phone">Phone Number</label></td>
            <td><input type="text" name="phone" id="phone" value="<?php echo escape(Input::get('phone')); ?>" autocomplete="off"/></td>
        </tr>
        <tr>
            <td><input type="submit" value="Register"/></td>
            <td><input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/></td>
        </tr>
    </table>
</form>

<br>
<a href="index.php">Back</a>

<style>
table {
    border-spacing: 5px;
}

th {
    text-align: left;
} 

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 15px;
}

</style>
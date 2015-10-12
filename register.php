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
    <div class="field">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off"/>
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="" autocomplete="off"/>
    </div>

    <div class="field">
        <label for="password_again">Retype Password</label>
        <input type="password" name="password_again" id="password_again" value="" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="email">Enter your email</label>
        <input type="text" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="nic">NIC</label>
        <input type="text" name="nic" id="nic" value="<?php echo escape(Input::get('nic')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="gender">Gender</label>
        <select name="gender" placeholder="Gender">
                <option> -- -- </option>
                <option value="Male"> Male</option>
                <option value="Female">Female</option>
        </select>
    </div>
    <div class="field">
        <label for="phone">Phone Number</label>
        <input type="text" name="phone" id="phone" value="<?php echo escape(Input::get('phone')); ?>" autocomplete="off"/>
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>

    <input type="submit" value="Register"/>
</form>
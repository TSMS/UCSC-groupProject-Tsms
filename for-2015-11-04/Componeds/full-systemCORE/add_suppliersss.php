<?php
require_once 'core/init.php';

if(Session::exists('success')){
    echo Session::flash('success');
}

$user = new User();

if($user->isLoggedIn()){

if(Input::exists()){
    //if(Token::check(Input::get('token'))) {
    if(true){
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'sup_code' => array(
                'required' => true,
                'min' => 3,
                'max' => 4
            ),
            'fname' => array(
                'required' => true,
                'min' => 3,
                'max' => 50
            )
        ));

        if ($validation->passed()) {

            $supplier = new Supplier();

            try{
                $supplier->create(array(
                    'supplier_code'  => Input::get('sup_code'),
                    'f_name'         => Input::get('fname'),
                    'l_name'         => Input::get('lname'),
                    'address_1'      => Input::get('address1'),
                    'address_2'      => Input::get('address2'),
                    'mobile_no'      => Input::get('mobile'),
                    'e_mail'         => Input::get('email'),
                    'Gender'         => Input::get('gender'),
                    'last_edit_date' => date("Y-m-d H:i:s"),
                    'editor'         => "no-editor-yet"
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
}
?>

<form action="" method="post">
    <table>
        <tr>
            <td><label for="sup_code">Customer Code</label></td>
            <td><input type="text" name="sup_code" id="name" value="<?php echo escape(Input::get('sup_code')); ?>" autocomplete="off"/></td>
        </tr>
        <tr>
            <td><label for="fname">First Name</label></td>
            <td><input type="text" name="fname" id="name" value="<?php echo escape(Input::get('fname')); ?>" autocomplete="off"/>
    </div></td>
        </tr>
        <tr>
            <td><label for="lname">Last Name</label></td>
            <td><input type="text" name="lname" id="name" value="<?php echo escape(Input::get('lname')); ?>" autocomplete="off"/></td>
        </tr>
        <tr>
            <td><label for="address1">Enter Address 1</label></td>
            <td><input type="text" name="address1" id="address" value="<?php echo escape(Input::get('address2')); ?>" autocomplete="off"/></td>
        </tr>
        <tr>
            <td><label for="address2">Address 2</label></td>
            <td><input type="text" name="address2" id="address" value="<?php echo escape(Input::get('address2')); ?>" autocomplete="off"/></td>
        </tr>
        <tr>
            <td><label for="mobile">Mobile Number</label></td>
            <td><input type="text" name="mobile" id="mobile" value="<?php echo escape(Input::get('mobile')); ?>" autocomplete="off"/></td>
        </tr>
        <tr>
            <td><label for="email">Enter email</label></td>
            <td><input type="text" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off"/></td>
        </tr>
        <tr>
            <td><label for="gender">Gender</label></td>
            <td><select name="gender" placeholder="Gender">
                <option> -- -- </option>
                <option value="Male"> Male</option>
                <option value="Female">Female</option>
        </select></td>
        </tr>
        <tr>
            <td><input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/></td>
            <td><input type="submit" value="Register"/></td>
        </tr>
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
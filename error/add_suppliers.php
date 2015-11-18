<?php
require_once 'core/init.php';

if(Input::exists()){
    //if(Token::check(Input::get('token'))) {
    if(true){
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'nic' => array(
                'required' => true,
                'min' => 10,
                'max' => 10
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
                    'nic_no'         => Input::get('nic'),
                    'mobile_no'      => Input::get('mobile'),
                    'phone_no'       => Input::get('phone'),
                    'e_mail'         => Input::get('email'),
                    'birth_day'      => Input::get('birthday'),
                    'Gender'         => Input::get('gender'),
                    'estate_name'    => Input::get('estate_name'),
                    'reg_no'         => Input::get('reg_no'),
                    'account_name'   => Input::get('acc_name'),
                    'account_no'      => Input::get('acc_no'),
                    'bank'           => Input::get('bank'),
                    'branch'         => Input::get('branch'),
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

?>
<form action="" method="post">
    <div class="field">
        <label for="sup_code">Supplier Code</label>
        <input type="text" name="sup_code" id="name" value="<?php echo escape(Input::get('sup_code')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="fname">First Name</label>
        <input type="text" name="fname" id="name" value="<?php echo escape(Input::get('fname')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="lname">Last Name</label>
        <input type="text" name="lname" id="name" value="<?php echo escape(Input::get('lname')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="address1">Enter Address 1</label>
        <input type="text" name="address1" id="address" value="<?php echo escape(Input::get('address2')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="address2">Address 2</label>
        <input type="text" name="address2" id="address" value="<?php echo escape(Input::get('address2')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="nic">NIC</label>
        <input type="text" name="nic" id="nic" value="<?php echo escape(Input::get('nic')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="mobile">Mobile Number</label>
        <input type="text" name="mobile" id="mobile" value="<?php echo escape(Input::get('mobile')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="phone">Phone Number</label>
        <input type="text" name="phone" id="phone" value="<?php echo escape(Input::get('phone')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="email">Enter email</label>
        <input type="text" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="date">Birth day</label>
        <input type="text" name="birthday" id="date" value="<?php echo escape(Input::get('birthday')); ?>" autocomplete="off"/>
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
        <label for="estate_name">Estate name</label>
        <input type="text" name="estate_name" id="name" value="<?php echo escape(Input::get('estate_name')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="reg_no">Registation Number</label>
        <input type="text" name="reg_no" id="reg" value="<?php echo escape(Input::get('reg_no')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="acc">Account Name</label>
        <input type="text" name="acc_name" id="acc_name" value="<?php echo escape(Input::get('acc_name')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="acc">Account No</label>
        <input type="text" name="acc_no" id="acc_no" value="<?php echo escape(Input::get('acc_no')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="bank">Account No</label>
        <input type="text" name="bank" id="bank" value="<?php echo escape(Input::get('bank')); ?>" autocomplete="off"/>
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>

    <input type="submit" value="Register"/>
</form>
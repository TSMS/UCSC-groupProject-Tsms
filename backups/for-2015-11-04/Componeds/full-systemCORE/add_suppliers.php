<?php
require_once 'core/init.php';

if(Session::exists('success')){
    echo Session::flash('success');
}

$user = new User();

$x = escape($user->data()->name);

if(Input::exists()){
    //if(Token::check(Input::get('token'))) {
      $supplier = new Supplier();
      try{
          $supplier->create(array(
              'supplier_code'  => Input::get('sup_code'),
              'f_name'         => Input::get('fname'),
              'l_name'         => Input::get('lname'),
              'address_1'      => Input::get('address1'),
              'nic_no'         => Input::get('nic'),
              'mobile_no'      => Input::get('mobile'),
              'e_mail'         => Input::get('email'),
            //'birth_day'      => Input::get('birthday'),
              'Gender'         => Input::get('gender'),
              'estate_name'    => 'NULL',
              'reg_no'         => 'NULL',
              'size_of_estate' => 'NULL',
              'address_of_estate' => 'NULL',
              'account_name'   => Input::get('fname'),
              'account_no'     => 'NULL',
              'bank'           => 'HSBC',
              'branch'         => 'Deniyaya',
              'last_edit_date' => date("Y-m-d H:i:s"),
              'e_mail_send'    => '0',
              'sms_send'       => '1',
              'editor'         => $x
          ));
      }catch (Exception $e){
          die($e->getMessage());
      }
      Redirect::to('add_suppliers.php');
}      
?>

<form role="form" action="" method="post">
  <div class="row setup-content" id="step-1">
    <div class="col-xs-6 col-md-offset-2">
      <div class="col-md-12">
        <h3> Person</h3>
        <div class="form-group">
          <label class="control-label">Suuplier Code</label>
          <input maxlength="100" type="text" name="sup_code" value="<?php echo escape(Input::get('sup_code')); ?>" autocomplete="off" required="required" class="form-control" placeholder="Supplier Code">
        </div>
        <div class="form-group">
          <label class="control-label">First Name</label>
          <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" name="fname" value="<?php echo escape(Input::get('fname')); ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label class="control-label">Last Name</label>
          <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Last Name" name="lname" value="<?php echo escape(Input::get('lname')); ?>" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="nic-id" class="control-label">NIC</label>              
          <input class="form-control" name="nic" id="nic" required="required" placeholder="NIC" type="text" value="<?php echo escape(Input::get('nic')); ?>">
        </div>
        <div class="form-group">
          <label for="gender" class="col-sm-2">Gender</label>
              <label class="radio-inline">
                  <input name="gender" id="male" value="male" type="radio"> Male
              </label>
              <label class="radio-inline">
                  <input name="gender" id="female" value="female" type="radio"> Female
              </label>
        </div>
        <!-- <div class="form_group">
          <label for="dob" class="control-label">Date of Birth</label>                             
          <input class="form-control" name="birthday" id="dob" value="Y-m-d" placeholder="Y-m-d" required="" type="text">
        </div> -->
        <br><br>
        <button class="btn btn-primary nextBtn btn pull-right" type="button">Next</button>
      </div>
    </div>
  </div>

    <div class="row setup-content" id="step-2">
      <div class="col-xs-6 col-md-offset-2">
        <div class="col-md-12">
          <h3> Address</h3>
          <div class="form-group">
            <label class="control-label">Address</label>
            <input required="required" name="address1" value="<?php echo escape(Input::get('address2')); ?>" autocomplete="off" class="form-control" placeholder="Enter your address"\>
          </div>
          <div class="form-group">
            <label class="control-label">Phone number</label>
            <input maxlength="10" type="text" required="required" name="mobile" value="<?php echo escape(Input::get('mobile')); ?>" autocomplete="off" class="form-control"placeholder="Enter Phone Number" />
          </div>
          <div class="form-group">
            <label class="control-label">Email Address</label>
            <input maxlength="20" type="email" required="required" name="email" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off" class="form-control"placeholder="Email Adress"  />
          </div>
          <button class="btn btn-primary nextBtn btn pull-right" type="button">Next</button>
        </div>
      </div>
    </div>
    <div class="row setup-content" id="step-3">
      <div class="col-xs-6 col-md-offset-2">
        <div class="col-md-12">
          <h3> Step 3</h3>
          <br><br><br>
          <center>Are You Sure? If you add wrong details to System<br>
            it could be problem.<br>
          </center><br><br>
          <center>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>
            <button class="btn btn-success btn" type="submit">Submit</button>
          </center>
        </div>
      </div>
    </div>
  </form>
</div>

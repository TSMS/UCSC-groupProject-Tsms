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
                'required' => true
            ),
            'quantity' => array(
                'required' => true
            )
        ));

        if ($validation->passed()) {

            $update = new Update();

            try{
                $update->create(array(
                    'supplier_code'       => Input::get('sup_code'),
                    'approved_kgs'   => Input::get('app_kgs'),
                    'supplied_kgs'   => Input::get('sup_kgs'),
                    'units'       => Input::get('quantity'),
                    'editor'         => "no-editor-yet"
                ));
            }catch (Exception $e){
                die($e->getMessage());
            }

            Session::flash('success');
            Redirect::to('index.php');
        } else {
            pre($validation->errors());
        }
    }
}
}
?>
<form action="" method="post">
    <div class="field">
        <label for="sup_code">Supplier Code: </label>
        <input type="text" name="sup_code" id="name" value="<?php echo escape(Input::get('sup_code')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="sup_name">Supplier name: </label>
        <input type="text" name="sup_name" id="name" value="<?php echo escape(Input::get('sup_name')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="date">Date: </label>
        <input type="date" name="date" id="date" value="<?php echo escape(Input::get('date')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="quantity">Quantity: </label>
        <input type="text" name="quantity" id="quantity" value="<?php echo escape(Input::get('quantity')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="app_kgs">Approved kgs: </label>
        <input type="numbers" name="app_kgs" id="app_kgs" value="<?php echo escape(Input::get('app_kgs')); ?>" autocomplete="off"/>
    </div>
    <div class="field">
        <label for="sup_kgs">Supplied kgs: </label>
        <input type="numbers" name="sup_kgs" id="sup_kgs" value="<?php echo escape(Input::get('sup_kgs')); ?>" autocomplete="off"/>
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>

    <input type="submit" value="Register"/>
</form>
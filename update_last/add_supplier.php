<?php
require_once 'core/init.php';
   
if(Session::exists('success')){
   echo Session::flash('success');
}

$user = new User();

$x = escape($user->data()->name);
if(Input::exists()){
    if(true){
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'supplier_code' => array(
                'required' => true,
                'min' => 3,
                'max' => 4,
                'unique' => 'suppliers'
            )
            // ,
            // 'mobile_no' => array(
            //     'min' => 10,
            //     'max' => 10,
            //     'num' => $_POST
            // ),
            // 'nic_no' => array(
            //     'min' => 10,
            //     'max' => 10
            // ),
            // 'f_name' => array(
            //     'min' => 3,
            //     'max' => 20
            // ),
            // 'l_name' => array(
            //     'min' => 3,
            //     'max' => 20
            // )
        ));

    if ($validation->passed()) {
     $supplier = new Supplier();
     try{
         $supplier->create(array(
             'supplier_code'  => Input::get('supplier_code'),
             'f_name'         => Input::get('f_name'),
           //   'l_name'         => Input::get('l_name'),
           //   'address_1'      => Input::get('address_1'),
           //   'nic_no'         => Input::get('nic_no'),
           //   'mobile_no'      => Input::get('mobile_no'),
           //   'e_mail'         => Input::get('e_mail'),
           // //'birth_day'      => Input::get('birthday'),
           //   'Gender'         => Input::get('Gender'),
             'estate_name'    => 'NULL',
             'reg_no'         => 'NULL',
             'size_of_estate' => 'NULL',
             'address_of_estate' => 'NULL',
             'account_name'   => 'NULL',
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

           //  Session::flash('success');
           // Redirect::to('supplier_view.php');
         echo '<div class="col-md-offset-2 col-xs-7">
                <div class="alert alert-success">
                Supplier Successefully added!
                </div>
            </div>';
        
        }else{
          foreach ($validation->errors() as $key) {

            //$msg=$msg.$key."\n";
            echo '<div class="col-md-offset-2 col-xs-7">
                <div class="alert alert-danger">
                '.$key.'!
                </div>
            </div>';
          }
          
    }
}
}   
?>


<script type="text/javascript">
<!--
 
$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(1500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);
 
});
//-->
</script>
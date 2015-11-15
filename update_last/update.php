<?php
require_once 'core/init.php';
if(Session::exists('success')){
    echo Session::flash('success');
}

$user = new User();
$supplier  = new Supplier();
$update    = new Update();


//$sup_name  = $supplier->search('supplier_code', $supplier_code, 'f_name')." ".$supplier->search('supplier_code', $supplier_code, 'l_name') ;
$x = escape($user->data()->name);

if($user->isLoggedIn())
{
	if(Input::exists())
	{
			if(true)
			{
    		$validate = new Validation();
    		$validation = $validate->check($_POST, array(
	            'supplier_code' => array(
	                'required' => true,
	                'min'      => 3,
	                'max'      => 4,
	                'num'      => $_POST,
	                'unique'   => 'today_supply',
	                'notmatch' => 'suppliers'
	            ),
	            'approved_kgs' => array(
	                'min' => 1,
	                'max' => 8,
	                'num' => $_POST
	            ),

	            'supplied_kgs' => array(
	                'max' => 8,
	                'num' => $_POST
	            ),
	            'units' => array(
	                'min' => 1,
	                'max' => 8,
	                'num' => $_POST
	            )

	        ));

	        if ($validation->passed()) 
	        {
	            try{
	                $update->create(array(
	                    'date'           => date("Y-m-d"),
	                    'supplier_code'  => Input::get('supplier_code'),
	                    'approved_kgs'   => Input::get('approved_kgs'),
	                    'supplied_kgs'   => Input::get('supplied_kgs'),
	                    'units'          => Input::get('units'),
	                    'editor'         => $x
	                ));
	                }catch (Exception $e){
	                   die($e->getMessage());
	                }

            		// Session::flash('success');
           			// Redirect::to('supply_update.php);
						echo '<div class="pull-left">
                <a href="supply_update.php" class="btn btn-app">
                    <i class="fa fa-refresh"></i> Refresh
                  </a>
                  </div>
						<div class="col-md-offset-2 col-xs-7">
                              <div class="alert alert-success">
                                Supplier Update Successefully added to the Factory database!
                              </div>
                          </div>';
            }else{
            	$msg = '';
              	foreach ($validation->errors() as $key){
	                //$msg=$msg.$key."\n";
	                $msg .='error! '.$key.'!<br>';
              	}
              	echo '<div class="col-md-offset-2 col-xs-7">
				                <div class="alert alert-warning">'.$msg.'
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
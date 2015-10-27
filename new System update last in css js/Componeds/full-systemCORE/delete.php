<?php
require_once 'core/init.php';

$u_id = $_GET['u_id'];

$delete = DB::getInstance()->delete('users', array('id','=', $u_id));

if(!$delete->count()){
        echo 'Not DELETTED';
    }else{
    	Redirect::to('search.php');
    	echo "Succsessfuly DELETED";
    }

?>
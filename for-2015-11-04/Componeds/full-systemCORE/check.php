<?php
require_once 'core/init.php';

if(isSet($_POST['username']))
{
$username = $_POST['username'];

$x = Input::get('username');
$name = DB::getInstance()->get('users', array('username', '=', $x));

if($name->count())
{
    echo '<font color="red"><STRONG>'.$x.'</STRONG> is already in use.</font>';
}else{
    echo 'OK';

}

}

?>
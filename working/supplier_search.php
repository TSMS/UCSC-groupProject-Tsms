<?php
require_once 'core/init.php';


if(Input::exists()){
    
    $code = Input::get('getname');
    $name = DB::getInstance()->get('suppliers', array('supplier_code', '=', $code)); //use getall('users') to get all data into table

?>
<form>
    
<?php

    if(!$name->count()){
        echo 'There is no Supplier acoding to <br>'.$code.' supplier_code...';
    }else{
        ?>
<table>
    <tr>
        <th>Supplier Code</th>
        <th>Name</th>
        <th>Address</th>
        <th>Nic</th>
        <th>Mobile</th>
        <th>Gender</th>
        <th>Joined</th>
        <th>Bank</th>
    </tr>
        <?php
        foreach ($name->results() as $name){
        ?>
            <tr>
                <td><?php echo $name->supplier_code?></td>
                <td><?php echo $name->f_name." ".$name->l_name?></td>
                <td><?php echo $name->address_1?></td>
                <td><?php echo $name->nic_no?></td>
                <td><?php echo $name->mobile_no?></td>
                <td><?php echo $name->gender?></td>
                <td><?php echo $name->joined?></td>
                <td><?php echo $name->bank." ".$name->account_no?></td>
            </tr>
        <?php
        }
    }
    echo "</table>";


}
?>


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



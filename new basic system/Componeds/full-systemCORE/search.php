<?php
require_once 'core/init.php';

$user = new User();

if($user->isLoggedIn()){

// Search user by givin user id
//$view = new View();
$x = Input::get('name');
$name = DB::getInstance()->get('users', array('name', '=', $x)); //use getall('users') to get all data into table

?>
<form action="" method="post">
    <table>
        <tr>
            <td><label>Enter User id in here:</label></td>
            <td><input type="text" name="name"><br></td>
            <td><input type="submit" value="Search"></td>
        </tr>
    </table>
</form>
<?php if(Input::exists()){?>
<form>
    <table>
    <tr>
        <th>id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Namel</th>
        <th>Nic</th>
        <th>Joind Date</th>
        <th>Gender</th>
        <th>Phone number</th>
        <th>Action</th>
    </tr>
<?php

    if(!$name->count()){
        echo 'canot find that user';
    }else{
        foreach ($name->results() as $name){
        ?>
            <tr>
                <td><?php echo $name->id?></td>
                <td><?php echo $name->username?></td>
                <td><?php echo $name->email?></td>
                <td><?php echo $name->name?></td>
                <td><?php echo $name->nic?></td>
                <td><?php echo $name->joined?></td>
                <td><?php echo $name->gender?></td>
                <td><?php echo $name->phone?></td>
                <td><?php echo "<a href='delete.php?u_id=$name->id'>Delete</a>";?></td>
            </tr>
        <?php
        }
    }
    echo "</table>";
}else{

$view = DB::getInstance()->getall("users");

echo "<table>";
echo "<tr>
        <th>id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Namel</th>
        <th>Nic</th>
        <th>Joind Date</th>
        <th>Gender</th>
        <th>Phone number</th>
    </tr>";

if(!$name->count()){
    echo 'No user';
}else{
    foreach ($name->results() as $name){
        echo "<tr>";
        echo "<td>".$name->id."</td>";
        echo "<td>".$name->username."</td>";
        echo "<td>".$name->email."</td>";
        echo "<td>".$name->name."</td>";
        echo "<td>".$name->nic."</td>";
        echo "<td>".$name->joined."</td>";
        echo "<td>".$name->gender."</td>";
        echo "<td>".$name->phone."</td>";
        echo "</tr>";
    }
}
}


}

?>
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
<?php
require_once 'core/init.php';

// Search user by givin user id
//$view = new View();
    $x = Input::get('name');
    $name = DB::getInstance()->get('users', array('id', '=', $x)); //use getall('users') to get all data into table
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>test search print table</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
</head>

<form action="" method="post">
Enter User id in here: <input type="text" name="name"><br>
Search: <input type="submit">
</form>
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
    </tr>
<?php
if(Input::exists()){
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
            </tr>
        <?php
        }
    }
}

echo "</table>";


/*
//get all data from table

$bgItems = DB::getInstance()->getall("users");
 $bgItems->simple();

foreach($bgItems as $bgItem) {
    echo $bgItem;
}



$user = DB::getInstance()->getall("users");

echo "<table>";
echo "<tr><th>Name</th><th>Games Played</th><th>Tries</th></tr>";

if(!$user->count()){
    echo 'No user';
}else{
    foreach($user as $user) {
        echo "<tr>";
        echo "<td>".$user->id."</td>";
        echo "<td>".$user->username."</td>";
        echo "<td>".$user->password."</td>";
        echo "</tr>";
    }
}

echo "</table>";

*/

?>
</body>
</html> 
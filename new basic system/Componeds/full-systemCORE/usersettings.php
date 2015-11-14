<?php
require_once 'core/init.php';

$user = new User();

if($user->hasPermission('admin')){
        echo '<p><li><a href="update.php">Update Detail</a></p></li>'
?>
              <p>
                <a href="usersettings.php?type=user">User Settings</a>
                <a href="#">Level Settings</a>
              </p>
<?php
        if(isset($_GET['type']) && !empty($_GET['type'])){
?>
            <table>
                <tr>
                    <td width='150px'>Users</td>
                    <td>Options</td>
                    <td>Delete users</td>
                 </tr>
<?php 
            $list = DB::getInstance()->query("SELECT id, username, user_approved FROM users");
            if(!$list->count()){
                echo 'There is no user to Activate or diactivate';
            }else{
                foreach ($list->results() as $name){
                    $u_id = $name->id;
                    $u_type = $name->user_approved;
    ?>
                    <tr>
                        <td><?php echo $name->username ?></td>
                        <td>   
                    <?php
                    if($u_type == '1'){        
                        echo "<a href='activated_or_die.php?u_id=$u_id&type=$u_type'>activate</a>";
                    }else{
                        echo "<a href='activated_or_die.php?u_id=$u_id&type=$u_type'>Deactivate</a>";
                    } 
?>
                    </td>
                    <td><?php echo "<a href='delete.php?u_id=$u_id'>Delete</a>";?></td>
<?php
                } 
            }

?>
       </table>
<?php
        }else{
            echo "Select Option above ! ";
        }  
    } 
    ?>
    <br>
    <br>
<a href="index.php">Back</a>
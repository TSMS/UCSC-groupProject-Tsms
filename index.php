<?php

require_once 'core/init.php';

if(Session::exists('success')){
    echo Session::flash('success');
}

$user = new User();

if($user->isLoggedIn()){
?>

    <p>Hello, <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username);?></a></p>

    <ul>
        <li><a href="logout.php">Log Out</a></li>
        <li><a href="changePassword.php">Change Password</a></li>
        <li><a href="Supplierregister.php">Add Supplier</a></li>
    </ul>

<?php
    if(Input::exists()){
        $user->update(array(
                        'name'  => Input::get('name')
                    ));
                    Session::flash('success', 'Information Updated Successfully');
                    Redirect::to('index.php');
    }
?>
    <p><a href="search.php">Search users</a></p><br>
    <p><a href="daily_update.php">Daily Update</a></p></br>
    <p><a href="add_suppliers.php">Add Supplier</a></p>
<?php
    if($user->apprved_user('approved')){
        echo 'hii approved user</br>';
    }

    if($user->hasPermission('admin')){
        echo '<p>You are an administratior.</p> </br> 
              <li><a href="update.php">Update Detail</a></li>'
?>
              <p>
                <a href="index.php?type=user">User Settings</a>
                <a href="#">Level Settings</a>
              </p>
<?php
        if(isset($_GET['type']) && !empty($_GET['type'])){
?>
            <table>
                <tr>
                    <td width='150px'>Users</td>
                    <td>Options</td>
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
                    <tr><td><?php echo $name->username ?></td><td>   
                    <?php
                    if($u_type == '1'){        
                        echo "<a href='activated_or_die.php?u_id=$u_id&type=$u_type'>Deactivate</a>";
                    }else{
                        echo "<a href='activated_or_die.php?u_id=$u_id&type=$u_type'>Activate</a>";
                    }
                }
            }

?>
        </table>
<?php
        }else{
            echo "Select Option above ! ";
        }   
        }else{
            echo 'standard user';
        }
    }else{
?>
        <p>You need to log in. this is tsms system withot interface</p>
        <p><a href="register.php">Register</a></p>
        <p><a href="login.php">Login</a></p>
<?php
    }
?>

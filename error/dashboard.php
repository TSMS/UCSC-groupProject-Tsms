<?php

require_once 'core/init.php';
if(Session::exists('success')){
    echo Session::flash('success');
}

$user = new User();

if($user->isLoggedIn()){
?>
<div class="page page-dashboard" data-ng-controller="DashboardCtrl">
    <div class="row">
        <div class="col-lg-3 col-xsm-6">
            <div class="panel mini-box">
                <span class="box-icon bg-success">
                    <i class="fa fa-rocket"></i>
                </span>
                <div class="box-info">
                    <p class="size-h2">25 <span class="size-h4">%</span></p>
                    <p class="text-muted"><span data-i18n="Growth"></span></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xsm-6">
            <div class="panel mini-box">
                <span class="box-icon bg-info">
                    <i class="fa fa-users"></i>
                </span>
                <div class="box-info">
                    <p class="size-h2">112</p>
                    <p class="text-muted"><span data-i18n="New users"></span></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xsm-6">
            <div class="panel mini-box">
                <span class="box-icon bg-warning">
                    <i class="fa fa-dollar"></i>
                </span>
                <div class="box-info">
                    <p class="size-h2">4,550</p>
                    <p class="text-muted"><span data-i18n="Profit"></span></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xsm-6">
            <div class="panel mini-box">
                <span class="box-icon bg-danger">
                    <i class="fa fa-shopping-cart"></i>
                </span>
                <div class="box-info">
                    <p class="size-h2">262</p>
                    <p class="text-muted"><span data-i18n="Store"></span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <section class="panel panel-default">
                <div class="panel-body" data-ng-controller="CollapseDemoCtrl">
                    <p>Hello, <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username);?></a></p>

                    <ul>
                        <li><a href="../logout.php">Log Out</a></li>
                        <li><a href="changePassword.php">Change Password</a></li>
                        <li><a href="../add_suppliers.php">Add Supplier</a></li>
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
                <?php
                    if($user->apprved_user('approved')){
                        echo 'hii approved user</br>';
                    }

                    if($user->hasPermission('admin')){
                        echo '<p>You are an administratior.</p> </br> 
                              <li><a href="update.php">Update Detail</a></li>'
                ?>
                </div> 
            </section> 
        </div>
        <div class="col-md-6">
            <section class="panel panel-default">
                <div class="panel-body" data-ng-controller="CollapseDemoCtrl">
                    <button class="btn btn-success" ng-click="isCollapsed = !isCollapsed">User Settings</button>
                    <hr>
                    <div collapse="isCollapsed">
                        <p> here it is</p>

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
                        echo "<a href='../activated_or_die.php?u_id=$u_id&type=$name->user_approved'>Deactivate</a>";
                    }else{
                        echo "<a href='../activated_or_die.php?u_id=$u_id&type=$name->user_approved'>Activate</a>";
                    }
                }
            }

?>
        </table>
                    </div>            
                </div>
            </section>

        </div>
    </div>
    <?php
           
        }else{
            echo 'standard user';
        }
    }
?>
</div>



 
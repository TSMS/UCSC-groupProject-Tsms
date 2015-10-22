<?php
require_once 'core/init.php';

$user = new User();

if($user->isLoggedIn()){

        $data = $user->data();
?>
<div class="page page-profile">

    <div class="row">
        <div class="col-md-6">

            <div class="panel panel-profile">
                <div class="panel-heading bg-primary clearfix">
                    <a href="" class="pull-left profile">
                        <img alt="" src="images/g1.jpg" class="img-circle img80_80">
                    </a>
                    <h3><?php echo escape($data->name);?></h3>
                    <?php 
   if($user->hasPermission('admin')){
        echo '<p>You are an administratior.</p> </br>';
    }else{
        echo 'you are an standed user';
    }
    ?>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge badge-danger">6</span>
                        <i class="fa fa-envelope-o"></i>
                        Inbox Messages
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-warning">2</span>
                        <i class="fa fa-credit-card"></i>
                        Supplier Loan request 
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-info">1</span>
                        <i class="fa fa-spinner fa-spin"></i>
                        New Users
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-success">3</span>
                        <i class="fa fa-folder-open-o"></i>
                        Daily BackUps
                    </li>
                </ul>
            </div>
          
        </div>
        <div class="col-md-6">

            <div class="panel panel-default">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Profile Info</strong></div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-body">
                            <ul class="list-unstyled list-info">
                                <li>
                                    <span class="icon glyphicon glyphicon-user"></span>
                                    <label>User name</label>
                                    <?php echo escape($user->data()->username);?>
                                </li>
                                <li>
                                    <span class="icon glyphicon glyphicon-envelope"></span>
                                    <label>Email</label>
                                    <?php echo escape($data->email);?>
                                </li>
                                <li>
                                    <span class="icon glyphicon glyphicon-pencil"></span>
                                    <label>Joind Date</label>
                                    <?php echo escape($data->joined);?>
                                </li>
                                <li>
                                    <span class="icon glyphicon glyphicon-home"></span>
                                    <label>Address</label>
                                    No 60, River side, Gampola
                                </li>
                                <li>
                                    <span class="icon glyphicon glyphicon-earphone"></span>
                                    <label>Contact</label>
                                    <?php echo escape($data->phone);?>
                                </li>
                                <li>
                                    <span class="icon glyphicon glyphicon-flag"></span>
                                    <label>Nationality</label>
                                    Srilanaka
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
   if($user->hasPermission('admin')){
        ?>
    <div class="panel panel-default">
        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Table - General</strong></div>
 <?php $view = DB::getInstance()->getall("users");?>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>USER-CODE</th>
                    <th>Manager</th>
                    <th>Status</th>
                    <th>Progress</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!$view->count()){
                    echo 'No user';
                }else{
                    foreach ($view->results() as $name){
                ?>
                <tr>
                    <td>1</td>
                    <td><span class="color-success"><i class="fa fa-level-up"></i></span> <?php echo $name->id;?></td>
                    <td><?php echo $name->name;?></td>
                    <td><span class="label label-info">Pending</span></td>
                    <td><progressbar class="progressbar-xs no-margin" value="<?php echo $name->progressbar;?>"></progressbar>
                </tr>
                <?php 
            }
            }
        }
        ?>
                <!-- <tr>
                    <td>2</td>
                    <td><span class="color-success"><i class="fa fa-level-up"></i></span> A16Z</td>
                    <td>Romayne Carlyn</td>
                    <td><span class="label label-primary">Due</span></td>
                    <td><progressbar class="progressbar-xs no-margin" value="34" type="success"></progressbar></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><span class="color-warning"><i class="fa fa-level-down"></i></span> DARK</td>
                    <td>Marybeth Joanna</td>
                    <td><span class="label label-success">Due</span></td>
                    <td><progressbar class="progressbar-xs no-margin" value="68" type="info"></progressbar></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><span class="color-info"><i class="fa fa-level-up"></i></span> Q300</td>
                    <td>Jonah Benny</td>
                    <td><span class="label label-danger">Blocked</span></td>
                    <td><progressbar class="progressbar-xs no-margin" value="52" type="warning"></progressbar></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><span class="color-danger"><i class="fa fa-level-down"></i></span> RVNG</td>
                    <td>Daly Royle</td>
                    <td><span class="label label-warning">Suspended</span></td>
                    <td><progressbar class="progressbar-xs no-margin" value="77" type="danger"></progressbar></td></td>
                </tr> -->

            </tbody>
        </table>
    </div>


</div>

   
    <?php

}
?>
<?php
require_once 'core/init.php';

$user = new User();

if($user->isLoggedIn()){

        $data = $user->data();
?>

<?php include 'includes/head.php';?>

 <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <?php include 'top_nav.php';?>

	<!-- Left side column. contains the logo and sidebar -->
      <?php include 'includes/left_nav.php';?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Profile
            <small>Optional description</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Profile</li>
          </ol>
        </section>

        <!-- Main content -->
        <div id="content" class="content">

          <!-- Your Page Content Here -->
<div class="page page-profile">

    <div class="row">
        <div class="col-md-6">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url('dist/img/photo1.png') center center;">
                  <h3 class="widget-user-username"><b><?php echo escape($data->name);?></b></h3>
                  <h5 class="widget-user-desc">Brought leaf clack</h5>
                  <?php 
   if($user->hasPermission('admin')){
        echo '<p>You are an administratior.</p> </br>';
    }else{
        echo 'you are an standed user';
    }
    ?>
                </div>
                <div class="widget-user-image">
                  <img class="img-circle" src="<?php echo escape($user->data()->image);?>" alt="User Avatar">
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">32</h5>
                        <span class="description-text">Supplier Registation</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">13,00</h5>
                        <span class="description-text">Update</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">35</h5>
                        <span class="description-text">PRODUCTS</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div>
              </div><!-- /.widget-user -->
            </div><!-- /.col -->
          




        <div class="col-md-6">

            <div class="box box-primary">
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
        </div><!-- /.row -->
    
<?php 
   if($user->hasPermission('admin')){
        ?>
    <div class="box box-primary">
        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> User - Progress & status</strong></div>
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
                    <td>

                      <div class="progress">
                        <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $name->progressbar;?>%">
                        </div>
                      </div>

                    </td>
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

          <!-- Small boxes (Stat box) -->
          
        </div><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include 'includes/main_footer.php';?>

      <!-- Control Sidebar -->
      <?php include 'includes/right_bar.php';?>
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->


      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
<?php include 'includes/footer.php';?>
<?php
   require_once 'core/init.php';
   if(Session::exists('success')){
       echo Session::flash('success');
   }
   
   $user = new User();
   
   if($user->isLoggedIn()){
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
               Dashboad
               <small>Optional description</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
               <li class="active">Dashboad</li>
            </ol>
         </section>
         <!-- Main content -->
         <div id="content" class="content">
            <!-- Your Page Content Here -->
            <!-- Brief status  -->
            <div class="row">
               <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                     <div class="inner">
                        <h3>150</h3>
                        <p>New Orders</p>
                     </div>
                     <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                     </div>
                     <a href="#" class="small-box-footer">
                     More info <i class="fa fa-arrow-circle-right"></i>
                     </a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                     <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>Bounce Rate</p>
                     </div>
                     <div class="icon">
                        <i class="fa fa-leaf"></i>
                     </div>
                     <a href="#" class="small-box-footer">
                     More info <i class="fa fa-arrow-circle-right"></i>
                     </a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                     <div class="inner">
                        <h3>44</h3>
                        <p>User Registrations</p>
                     </div>
                     <div class="icon">
                        <i class="fa fa-envelope"></i>
                     </div>
                     <a href="#" class="small-box-footer">
                     More info <i class="fa fa-arrow-circle-right"></i>
                     </a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                     <div class="inner">
                        <h3>65</h3>
                        <p>Unique Visitors</p>
                     </div>
                     <div class="icon">
                        <i class="fa fa-circle-o-notch"></i>
                     </div>
                     <a href="#" class="small-box-footer">
                     More info <i class="fa fa-arrow-circle-right"></i>
                     </a>
                  </div>
               </div>
               <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- End status -->
            <!-- User details -->
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
                        <p><a href="search.php">Search users</a></p>
                        <br>
                        <p><a href="daily_update.php">Daily Update</a></p>
                        </br>
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
                  <!-- Box Comment -->
                  <div class="box box-widget">
                     <div class='box-header with-border'>
                        <p class="text-red">ACTIVATE DEACTIVATE USERS FROM FACTORY SYSTEM</p>
                        <div class='box-tools'>
                           <button class='btn btn-box-tool' data-toggle='tooltip' title='Mark as read'><i class='fa fa-circle-o'></i></button>
                           <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                           <button class='btn btn-box-tool' data-widget='remove'><i class='fa fa-times'></i></button>
                        </div>
                        <!-- /.box-tools -->
                     </div>
                     <!-- /.box-header -->
                     <div class='box-body'>
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
                           <tr>
                              <td><?php echo $name->username ?></td>
                              <td>   
                                 <?php
                                    if($u_type == '1'){        
                                        echo "<a href='activated_or_die.php?u_id=$u_id&type=$name->user_approved'>Activate</a>";
                                    }else{
                                        echo "<a href='activated_or_die.php?u_id=$u_id&type=$name->user_approved'>Deactivate</a>";
                                    }
                                    }
                                    }
                                    
                                    ?>
                        </table>
                        <?php
                           }else{
                               echo 'standard user';
                           }
                           }
                           ?>
                     </div>
                     <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
               </div>
               <!-- /.col -->
               <div class="col-md-6">
               </div>
            </div><!-- end row 2 -->
            <!-- end details -->
            <!-- Small boxes (Stat box) -->
         </div> <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <!-- Main Footer -->
      <?php include 'includes/main_footer.php';?>
      <!-- Control Sidebar -->
      <?php include 'includes/right_bar.php';?>
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
   </div>
   <!-- ./wrapper -->
   <!-- REQUIRED JS SCRIPTS -->
   <?php include 'includes/footer.php';?>


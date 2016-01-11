<!-- Main Header -->
<header class="main-header">
<?php 
require_once 'classes/class.user.php';
$user_home = new USER();

$list ="SELECT message_id FROM message_temp WHERE date=CURDATE() AND approve=0";
$getdata = $user_home->runQuery($list);
$getdata->execute();
$res1=0;
if($getdata->rowCount() > 0){
	while($data=$getdata->FETCH(PDO::FETCH_ASSOC)){
		$res1=$res1+1;
	}
}

$list ="SELECT supplier_code FROM today_supply WHERE date=CURDATE()";
$getdata = $user_home->runQuery($list);
$getdata->execute();
$res2=0;
if($getdata->rowCount() > 0){
	while($data=$getdata->FETCH(PDO::FETCH_ASSOC)){
		$res2=$res2+1;
	}
}
 ?>
  <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>T</b>SMS</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="dist/logo.png"></span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
          <!-- Menu toggle button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success"><?php echo $res1; ?></span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have <?php echo $res1; ?> new messages</li>
            <li>
              <!-- inner menu: contains the messages -->
              <ul class="menu">
                <li><!-- start message -->
					<?php 
						$query ="SELECT * FROM message_temp WHERE date=CURDATE() AND approve=0 ORDER BY time DESC";
						$getdata = $user_home->runQuery($query);
						$getdata->execute();
						$noOfmsgs=0;
						if($getdata->rowCount() > 0){
							while($data=$getdata->FETCH(PDO::FETCH_ASSOC)){
								if($noOfmsgs<10){
									$noOfmsgs=$noOfmsgs+1;
					?>
                  <a href="#">
                    <!-- Message title and timestamp -->					
                    <h4>
                      <?php echo("By supplier ".$data['supplier_code']);?>
                      <small><i class="fa fa-clock-o"></i><?php echo("By ".$data['time']);?></small>
                    </h4>
					<div class="pull-left">
						<p class="img-circle"><i class="fa fa-envelope fa-2x"></i></p>
					</div>
                    <!-- The message -->
                    <?php echo("<p>".$data['message_code']." ".$data['value']." want</p>");
					echo("</a>");
								}
					}
						} 
				  ?>
                </li><!-- end message -->
              </ul><!-- /.menu -->
            </li>
            <li class="footer"><a href="message.php">See All Messages</a></li>
          </ul>
        </li><!-- /.messages-menu -->

        <!-- Notifications Menu -->
        <li class="dropdown notifications-menu">
          <!-- Menu toggle button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning"><?php echo $res2; ?></span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have <?php echo $res2; ?> notifications</li>
            <li>
              <!-- Inner Menu: contains the notifications -->
              <ul class="menu">
                <li><!-- start notification -->
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> <?php echo $res2; ?> new supply added to system today
                  </a>
                </li><!-- end notification -->
              </ul>
            </li>
            <li class="footer"><a href="update.php">View all</a></li>
          </ul>
        </li>
        <!-- Tasks Menu -->
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="dist/img/avatar.png" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs"><?php echo $row['email']; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="dist/img/avatar.png" class="img-circle" alt="User Image">
              <p>
                <?php echo $row['username']; ?>
                <small>Thalapalakanada tea factory</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#"><i class=""></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>
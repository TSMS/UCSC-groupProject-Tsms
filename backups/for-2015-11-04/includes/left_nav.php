<aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->

          <!-- search form (Optional) -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul id="nav" class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
              <a href="home.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
              <a href="message">
                <i class="fa fa-envelope"></i> <span>Message</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="supply_update.php">
                <i class="fa fa-edit"></i> <span>Update</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="supply_update.php"><i class="fa fa-circle-o"></i> Supply</a></li>
                <li><a href="service_update"><i class="fa fa-circle-o"></i> Service</a></li>
                <li><a href="up_edit"><i class="fa fa-circle-o"></i> Edit</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-group"></i> <span>Suppliers</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="supplier_view.php"><i class="fa fa-circle-o"></i> View</a></li>
                <li><a href="supplier_registation.php"><i class="fa fa-circle-o"></i> Registation</a></li>
                <li><a href="sup_edit"><i class="fa fa-circle-o"></i> Edit</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="report">
                <i class="fa fa-print"></i> <span>Report</span>
              </a>
              <ul class="treeview-menu">
<!-- I have to make it for success id dont know how to slove this problem, if i remove this it isnt work, but this ul doing nothin in page -->
              </ul>
            </li>
            <li class="treeview">
              <a href="refreshform">
                <i class="fa fa-download"></i> <span>Back-Ups</span>
              </a>
            </li>

          </ul><!-- /.sidebar-menu -->



        </section>
        <!-- /.sidebar -->
      </aside>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TsmsUI 2 | Starter</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/TsmsUI.css">

    <link rel="stylesheet" href="dist/css/skins/skin.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

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
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the messages -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <!-- User Image -->
                            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                          </div>
                          <!-- Message title and timestamp -->
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <!-- The message -->
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                    </ul><!-- /.menu -->
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li><!-- /.messages-menu -->

              <!-- Notifications Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li><!-- end notification -->
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
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
                  <span class="hidden-xs">System Admin</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                      System Admin - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
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
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <form name="form" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="name" class="form-control" placeholder="Supplier...">
              <span class="input-group-btn">
               <button type="button" name="search" onClick="get();" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul id="nav" class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
              <a href="dashboard.html">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="active">
              <a href="message.html">
                <i class="fa fa-envelope"></i> <span>Message</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="supplyup.html">
                <i class="fa fa-edit"></i> <span>Update</span>
              </a>
            </li>
            <li class="treeview">
              <a href="Supreg.html">
                <i class="fa fa-group"></i> <span>Suppliers</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="sup_reg.php"><i class="fa fa-circle-o"></i> Registation</a></li>
                <li><a href="supplier_view.php"><i class="fa fa-circle-o"></i> View</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Edit</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="report.php">
                <i class="fa fa-print"></i> <span>Report</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-download"></i> <span>Back-Ups</span>
              </a>
            </li>
          </ul><!-- /.sidebar-menu -->



        </section>
        <!-- /.sidebar -->
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <h1>
               Message
               <small>Request Accepting</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
               <li class="active">Dashboad</li>
            </ol>
         </section>
         <!-- Main content -->
         <div id="content" class="content">
         
          <section class="content">
            <style>
             .login-dialog .modal-dialog {
                  width: 400px;
              }
          </style>
            <!-- Modal For Send message -->
            <div id="myModal" class="login-dialog modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Send message</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                              <!-- text input -->
                              <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" placeholder="Enter Mobile number like 0772376512.">
                              </div>
                              <!-- textarea -->
                              <div class="form-group">
                                <label>Textarea</label>
                                <textarea class="form-control" rows="3" placeholder="Enter your message in here"></textarea>
                              </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
                            <button type="button" class="btn bg-navy btn-flat">Send</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal For Reply message -->
            <div id="reply" class="login-dialog modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Reply message</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                              <!-- text input -->
                              <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" placeholder="Enter Mobile number like 0772376512.">
                              </div>
                              <!-- textarea -->
                              <div class="form-group">
                                <label>Textarea</label>
                                <textarea class="form-control" rows="3" placeholder="Enter your message in here"></textarea>
                              </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
                            <button type="button" class="btn bg-navy btn-flat">Send</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="box-body">
                  <p>Send Message to Suppliers</p>
                  <!-- Button HTML (to Trigger Modal) -->
            <a href="#myModal" role="button" class="btn bg-navy btn-flat" data-toggle="modal"><i class="fa fa-envelope"></i>  Compose</a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="box box-navy">
                  <div class="box-header with-border">
                    <h3 class="box-title">Inbox</h3>
                    <div class="box-tools pull-right">
                      <div class="has-feedback">
                        <input type="text" class="form-control input-sm" placeholder="Search Mail">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                      </div>
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    <div class="mailbox-controls">
                      <!-- Check all button -->
                      <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        <a href="#reply" role="button" class="btn btn-default btn-sm" data-toggle="modal"><i class="fa fa-reply"></i></a>
                      </div><!-- /.btn-group -->
                      <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                      <div class="pull-right"><i class="fa fa-reply"></i>
                        1-50/200
                        <div class="btn-group">
                          <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                          <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                        </div><!-- /.btn-group -->
                      </div><!-- /.pull-right -->
                    </div>
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-hover table-striped">
                        <tbody>
                          <tr>
                            <td><input type="checkbox"></td>
                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                            <td class="mailbox-subject"><b>tsms</b> - supplier requiest</td>
                            <td class="mailbox-attachment"></td>
                            <td class="mailbox-date">5 mins ago</td>
                          </tr>
                          <tr>
                            <td><input type="checkbox"></td>
                            <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                            <td class="mailbox-subject"><b>tsms</b> - supplier requiest</td>
                            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                            <td class="mailbox-date">28 mins ago</td>
                          </tr>
                          <tr>
                            <td><input type="checkbox"></td>
                            <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                            <td class="mailbox-subject"><b>tsms</b> - supplier requiest</td>
                            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                            <td class="mailbox-date">11 hours ago</td>
                          </tr>
                          <tr>
                            <td><input type="checkbox"></td>
                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                            <td class="mailbox-subject"><b>tsms</b> - supplier requiest</td>
                            <td class="mailbox-attachment"></td>
                            <td class="mailbox-date">15 hours ago</td>
                          </tr>
                          <tr>
                            <td><input type="checkbox"></td>
                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                            <td class="mailbox-subject"><b>tsms</b> - supplier requiest</td>
                            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                            <td class="mailbox-date">Yesterday</td>
                          </tr>
                        </tbody>
                      </table><!-- /.table -->
                    </div><!-- /.mail-box-messages -->
                  </div><!-- /.box-body -->
                  <div class="box-footer no-padding">
                    <div class="mailbox-controls">
                      <!-- Check all button -->
                      <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        <a href="#reply" role="button" class="btn btn-default btn-sm" data-toggle="modal"><i class="fa fa-reply"></i></a>
                      </div><!-- /.btn-group -->
                      <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                      <div class="pull-right">
                        1-50/200
                        <div class="btn-group">
                          <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                          <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                        </div><!-- /.btn-group -->
                      </div><!-- /.pull-right -->
                    </div>
                  </div>
                </div><!-- /. box -->
              </div><!-- /.col -->
              <div class="col-md-6">
                <div class="box box-navy">
                  <div class="box-header with-border">
                    <h3 class="box-title"> View Message</h3>
                    <div class="box-body">
                      <dl class="dl-horizontal example1">
                         <p>Request message
                         <p>
                         <dt>Supplier Code: </dt>
                         <dd>supplier_code</dd>
                         <dt>Supplier Name: </dt>
                         <dd>txt</dd>
                         <dt>ammount: </dt>
                         <dd>value</dd>
                         <dt>Quantity: </dt>
                         <dd>quantity;</dd>
                         <dt>category: </dt>
                         <dd>reqtype</dd>

                         <div class="supplier-ditails">
                            <!-- Bar Chart Start -->
                              <div class="box box-success">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Supply of last 6 month</h3>
                                  <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="box-body">
                                  <div class="chart">
                                    <canvas id="income" width="500" height="230"></canvas>
                                  </div>
                                </div><!-- /.box-body -->
                              </div><!-- /.box -->
                              <!-- Bar Chart End -->
                             <!-- line Chart Start -->
                              <div class="box box-success">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Income vs payment</h3>
                                  <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>
                                </div>
                                <div class="box-body">
                                  <div class="chart">
                                    <canvas id="c" width="500" height="230"></canvas>
                                  </div>
                                </div><!-- /.box-body -->
                              </div><!-- /.box -->
                              <!-- Line Chart End -->
                         </div>
                         <div class="is-accept">
                          <!-- here you can get idea about are you going to give this or not -->
                          <div class="col-md-6">
                            <div class="info-box bg-green">
                              <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">41,410</span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: 70%"></div>
                                </div>
                                <span class="progress-description">
                                  70% Increase in 30 Days
                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div><!-- /.col -->
                          <!-- if this mark apear then that means you can not offer anything to the supplier -->
                          <div class="col-md-6">
                            <div class="info-box bg-red">
                              <span class="info-box-icon"><i class="fa fa-thumbs-o-down"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">41,410</span>
                                <div class="progress">
                                  <div class="progress-bar" style="width: 30%"></div>
                                </div>
                                <span class="progress-description">
                                  70% Increase in 30 Days
                                </span>
                              </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                          </div><!-- /.col -->
                       </div>
                       <div class="input-group">
                         <span class="input-group-btn">
                            <button type="button" name="accept" class="btn bg-navy btn-flat pull-right">Accept</button>                
                            <button type="reset" name="Reject" class="btn bg-denger btn-flat ">Reject</button>
                         </span>
                       </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
         </div> <!-- /.content -->
      </div>

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">Company</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
     <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
     <!-- chartjs Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <!-- Page Script -->
    <script>
      $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
          var clicks = $(this).data('clicks');
          if (clicks) {
            //Uncheck all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
          } else {
            //Check all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
          }
          $(this).data("clicks", !clicks);
        });

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {
          e.preventDefault();
          //detect type
          var $this = $(this).find("a > i");
          var glyph = $this.hasClass("glyphicon");
          var fa = $this.hasClass("fa");

          //Switch states
          if (glyph) {
            $this.toggleClass("glyphicon-star");
            $this.toggleClass("glyphicon-star-empty");
          }

          if (fa) {
            $this.toggleClass("fa-star");
            $this.toggleClass("fa-star-o");
          }
        });
      });
    </script>
    <!-- Charts javaScript -->
      <script>
      var ctx = document.getElementById("c").getContext("2d");
      var data = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
          label: "My First dataset",
          fillColor: "rgba(220,220,220,0.2)",
          strokeColor: "rgba(220,220,220,1)",
          pointColor: "rgba(220,220,220,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [65, 59, 80, 81, 56, 55, 40]
        }, {
          label: "My Second dataset",
          fillColor: "rgba(151,187,205,0.2)",
          strokeColor: "rgba(151,187,205,1)",
          pointColor: "rgba(151,187,205,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(151,187,205,1)",
          data: [28, 48, 40, 19, 86, 27, 90]
        }]
      };
      var MyNewChart = new Chart(ctx).Line(data);
    </script>
    <!-- Line Chart JavaScript End -->
    <!-- Bar Chart JavaScript Start -->
    <script type="text/javascript">
      var barData = {
                labels : ["January","February","March","April","May","June"],
                datasets : [
                    {
                        fillColor : "#48A497",
                        strokeColor : "#48A4D1",
                        data : [456,479,324,569,702,600]
                    }
                ]
            }
            // get bar chart canvas
            var income = document.getElementById("income").getContext("2d");
            // draw bar chart
            new Chart(income).Bar(barData);
    </script>
    <!-- Charts Ends -->
  </body>
</html>

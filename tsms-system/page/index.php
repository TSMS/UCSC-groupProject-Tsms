<?php
   require_once 'dbconfig.php';
   
   if($user->is_loggedin()!="")
   {
    $user->redirect('webpage.php');
   }
   
   if(isset($_POST['btn-login']))
   {
    $uname = $_POST['txt_uname_email'];
    $umail = $_POST['txt_uname_email'];
    $upass = $_POST['txt_password'];
      
    if($user->login($uname,$umail,$upass))
    {
      $user->redirect('webpage.php');
    }
    else
    {
      $error = "Wrong Details !";
    } 
   }
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Tsms | Details view</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.5 -->
      <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="../dist/css/TsmsUI.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
      <!-- select option -->
      <link rel="stylesheet" href="../plugins/select2/select2.min.css">
   </head>
   <body>
      <body class="supplier">
         <div class="container">
         <div class="form-container">
          <br>
          <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url('../dist/img/image1.png') center center;">
                  <!-- <h3 class="widget-user-username">Elizabeth Pierce</h3> -->
                  <h1><span class="thalapalakanada"><b>THALAPALAKANADA</b></span></h1>
                  <h4 class="widget-user-desc">Tea Factory-deniyaya</h4>
                </div>
              </div><!-- /.widget-user -->
              <div class="box-footer">
          <div class="row">
               <div class="col-md-5">
                  <div class="login-box">
                     <div class="login-logo">
                        <br>
                        <a href="login.html"><img src="../dist/Llogo.png"></a>
                     </div>
                     <!-- /.login-logo -->
                     <div class="login-box-body">
                        <form method="post">
                           <h2>Sign in.</h2>
                           <hr />
                           <?php
                              if(isset($error))
                              {
                                       ?>
                           <div class="alert alert-danger">
                              <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                           </div>
                           <?php
                              }
                              ?>
                           <div class="form-group">
                              <input type="text" class="form-control" name="txt_uname_email" placeholder="Supplier Code" required />
                           </div>
                           <div class="form-group">
                              <input type="password" class="form-control" name="txt_password" placeholder="Your Password" required />
                           </div>
                           <div class="clearfix"></div>
                           <div class="form-group">
                              <button type="submit" name="btn-login" class="pull-right btn bg-olive btn-flat">
                              <i class="glyphicon glyphicon-log-in"></i>&nbsp;SIGN IN
                              </button>
                           </div>
                        </form>
                        <!--  <div class="social-auth-links text-center">
                           <p>- OR -</p>
                           <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
                           <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
                           </div>
                           -->
                        <a href="#inform" role="button" data-toggle="modal">I forgot my password</a><br>
                     </div>
                     <!-- /.login-box-body -->
                  </div>
               </div>
                   <div class="row">
        <div class="">
          <div class="col-md-6">
                <br>
                <div class="box-body">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                      <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="../dist/img/image1.png" alt="First slide">
                        <div class="carousel-caption">
                          Thalapalakanada
                        </div>
                      </div>
                      <div class="item">
                        <img src="../dist/img/image2.png" alt="Second slide">
                        <div class="carousel-caption">
                          Tea
                        </div>
                      </div>
                      <div class="item">
                        <img src="../dist/img/image3.png" alt="Third slide">
                        <div class="carousel-caption">
                          Factory
                        </div>
                      </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
                  </div>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          <div class="col-md-6 textcenter">
            <h4>This is Thalapalakanada tea factory official web site if you have no account Please <a class="link" data-toggle="modal" href="#inform">inform Us!</a> in here</h4>
          </div>
        </div>
      </div>
           </div> 
         </div>
         </div>

         <!-- Modal For Send message -->
            <div id="inform" class="login-dialog modal fade">
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
                                <label>Your Supplier Code</label>
                                <input type="text" class="form-control" placeholder="Supplier Code.">
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

         <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
         <!-- Bootstrap 3.3.5 -->
         <script src="../bootstrap/js/bootstrap.min.js"></script>
         <!-- iCheck -->
         <script src="../plugins/iCheck/icheck.min.js"></script>
         <!-- select -->
         <script src="../plugins/select2/select2.full.min.js"></script>
   </body>
</html>
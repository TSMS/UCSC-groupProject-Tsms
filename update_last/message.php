<?php
   require_once 'core/init.php';
   if(Session::exists('success')){
       echo Session::flash('success');
   }
   
   $user     = new User();
   $supplier = new Supplier();
   
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
               Alert Board
               <small>in and out messages</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Dashboad</a></li>
               <li class="active">Message</li>
            </ol>
         </section>
         <!-- Main content -->
         <div id="content" class="content">
            <!-- Your Page Content Here -->
            <!-- Brief status  -->
            <div class="row">
               <!-- Read area -->
               <div class="col-md-5">
                  <div class="box box-primary">
                      <div class="box-header with-border">
                        <div class="form-group">
                           <div class="box-tools pull-right">
                           <a href="message.php"><button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button></a>
                         </div>
                           <label>Message Area</label>
                           <?php
                           if(isset($_GET['id']))
                           { 
                               $code = $_GET['id'];
                               $msginfo = DB::getInstance()->get('message_temp', array('message_id', '=', $code));
                               if(!$msginfo->count()){
                                   echo 'There is no message...!';
                               }else{
                                 foreach ($msginfo->results() as $info){
                                    $vri   = $supplier->search('supplier_code', $info->supplier_code, 'f_name');
                                    $vrii  = $supplier->search('supplier_code', $info->supplier_code, 'l_name');
                                    $txt   = $vrii." ".$vri;
                                    $type  = $info->message_code;
                                    $reqtype  = $supplier->msgtype('message_code', $type, 'request');
                                    ?>
                                    <div class="box-body">
                                    <dl class="dl-horizontal example1">
                                       <p>Request message
                                       <p>
                                       <dt>Supplier Code: </dt>
                                       <dd><?php echo $info->supplier_code;?></dd>
                                       <dt>Supplier Name: </dt>
                                       <dd><?php echo $txt;?></dd>
                                       <dt>ammount: </dt>
                                       <dd><?php echo $info->value;?></dd>
                                       <dt>Quantity: </dt>
                                       <dd><?php echo $info->quantity;?></dd>
                                       <dt>category: </dt>
                                       <dd><?php echo $reqtype?></dd>
                                    </div>
                                    <?php
                                 }
                              }
                           
                        ?>
                         </div>
                         <div class="input-group">
                           <span class="input-group-btn">
                              <a href="supply_update.php?id=<?php echo $code;?>"><button type="button" name="accept" class="btn bg-navy btn-flat pull-right">Accept</button></a>                            
                             <button type="reset" name="Reject" class="btn bg-denger btn-flat">Reject</button>
                             <?php }?>
                           </span>
                         </div>
                      </div>
                  </div>
                  <div class="box-footer">
                      <div class="input-group">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-btn">
                          <button type="button" class="btn bg-navy btn-flat">Send</button>
                        </span>
                      </div>
                    </div><!-- /.box-footer-->
               </div>
               <!-- End Read area -->

               <div class="col-md-7">
                  <div class="box box-primary direct-chat direct-chat-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Request Messages</h3>
                      <div class="box-tools pull-right">
                        <span data-toggle="tooltip" title="3 New Messages" class="badge bg-blue">3</span>
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <!-- In box-tools add this button if you intend to use the contacts pane -->
                        <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <!-- Conversations are loaded here -->
                      <div class="direct-chat-messages">

                        <?php
                           // $supplier = DB::getInstance()->getall("suppliers");
                           //  echo '<h1>'.$supplier->first()->f_name.'</h1>';
                           $view = DB::getInstance()->getall("message_temp");
                            if(!$view->count()){
                               echo 'no message';
                           }else{
                               foreach ($view->results() as $tag){
                                $code = $tag->supplier_code;
                                $vri  = $supplier->search('supplier_code', $code, 'f_name');
                                $vrii  = $supplier->search('supplier_code', $code, 'l_name');
                                $txt = $vrii." ".$vri;
                                $msg = $tag->value." ".$tag->quantity." ".$tag->category;
                               $type = $tag->message_code;
                               $reqtype  = $supplier->msgtype('message_code', $type, 'request');
                        ?>

                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg">
                          </div><!-- /.direct-chat-info -->
                          <h4 class="direct-chat-img"><?php echo $tag->id;?></h4><!-- /.direct-chat-img -->
                          <a href="message.php?<?php echo "id=".$tag->message_id;?>">
                           <div class="direct-chat-text">
                            <?php echo $tag->supplier_code." - ".$txt." requesting <b>".$reqtype."</b>";?>
                              <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                           </div><!-- /.direct-chat-msg -->
                          </a>
                        <?php
                           }
                        }
                        ?>
                        <div class="direct-chat-msg right">
                          <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-right">supplier</span>
                            <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                          </div><!-- /.direct-chat-info -->
                          <h4 class="direct-chat-img">(00)</h4>
                          <div class="direct-chat-text">
                            You better believe it!
                          </div><!-- /.direct-chat-text -->
                        </div><!-- /.direct-chat-msg -->
                      </div><!--/.direct-chat-messages-->

                      <!-- Contacts are loaded here -->
                      <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                          <li>
                            <a href="#">
                              <h4 class="contacts-list-img"></h4>
                              <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Count Dracula
                                  <small class="contacts-list-date pull-right">2/28/2015</small>
                                </span>
                                <span class="contacts-list-msg">How have you been? I was...</span>
                              </div><!-- /.contacts-list-info -->
                            </a>
                          </li><!-- End Contact Item -->
                        </ul><!-- /.contatcts-list -->
                      </div><!-- /.direct-chat-pane -->
                    </div><!-- /.box-body -->
                  </div><!--/.direct-chat -->
               </div>
            </div


            <!-- Brief status End-->
          
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

   <script src="plugins/datatables/jquery.dataTables.min.js"></script>
   <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
   <script type="text/javascript">
     $(document).ready(function () {
      
     window.setTimeout(function() {
         $(".alert").fadeTo(1500, 0).slideUp(500, function(){
             $(this).remove(); 
         });
     }, 5000);
      
     });
  </script>

   <!-- page script tabale-->
   <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
   </script>
<?php
}else{
    Redirect::to('404.php');
}
?>
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
          <div id="search_r"></div>
          <br>
            <!-- Your Page Content Here -->
            <!-- Brief status  -->
            <div class="row">
              <div id="update"></div>
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
                    <script type="text/javascript">
                      function gett(){
                         $.post('test.php', { 
                          number: xxxx.number.value,
                          send_message: xxxx.message.value
                           } , 
                            function(output){
                               $('#update').html(output).show();
                            });
                      }
                   </script>
                   <form action="" name="xxxx" method="post">
                    <div class="row">
                      <div class="col-md-6">
                        <input  class="form-control" name="number" placeholder="ex: 0777 213 321" type="text"><span>Mobile Number</span>
                      </div>
                    </div>
                      <div class="box-footer">
                      <div class="input-group">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-btn">
                          <button onClick="gett();" type="button" name="submit" class="btn bg-navy btn-flat">Send</button>
                        </span>
                      </div>
                    </div><!-- /.box-footer-->
                  </form>

               </div>
               <!-- End Read area -->
               <div class="col-md-7">
               <!-- TO DO List -->
                <div class="box box-primary">
                  <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Request Messages</h3>
                    <div class="box-tools pull-right">
                      <ul class="pagination pagination-sm inline">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">&raquo;</a></li>
                      </ul>
                    </div>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <ul class="todo-list">
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

                               switch ($type) {
                                 case 'fer':
                                   $lable = 'info';
                                   break;
                                 case 'adv':
                                   $lable = 'warning';
                                   break;
                                 case 'bil':
                                   $lable = 'default';
                                   break;
                                 case 'lon':
                                   $lable = 'primary';
                                   break;
                                 default:
                                   $lable = 'success';
                                   break;
                               }



                        ?>
                      <li>
                        <!-- drag handle -->
                        <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <?php echo $tag->message_id;?>
                          <i class="fa fa-ellipsis-v"></i>
                        </span>
                        <!-- checkbox -->
                        <input type="checkbox" value="" name="chacked">
                        <!-- todo text -->
                        <span class="text"><a href="message.php?<?php echo "id=".$tag->message_id;?>">
                            <?php echo $tag->supplier_code." - ".$txt." requesting <b></b>";?>
                          </a></span><h6 class="direct-chat-timestamp pull-right">23 Nov 2:00 am</h6>
                        <!-- Emphasis label -->
                        <small class="label label-<?php echo $lable;?>"><?php echo $reqtype;?></small> 
                        <!-- /info/warning/success/primary/default -->
                        <!-- General tools such as edit or delete-->
                        <div class="tools">
                          <i class="fa fa-edit"></i>
                          <i class="fa fa-trash-o"></i>
                        </div>
                      </li>
                      <?php
                           }
                        }
                        ?>
                    </ul>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
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
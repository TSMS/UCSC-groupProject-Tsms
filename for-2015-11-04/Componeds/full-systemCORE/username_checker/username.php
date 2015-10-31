

      <META NAME="Keywords" CONTENT="form, username, checker">
      <META NAME="Description" CONTENT="An AJAX Username Verification Script">
      <script type="text/javascript" src="jquery-1.2.6.min.js"></script>
      <link rel="stylesheet" type="text/css" href="style.css" />
     
      <SCRIPT type="text/javascript">
         <!--
            /*
            Credits: Bit Repository
            Source: http://www.bitrepository.com/web-programming/ajax/username-checker.html 
            */
            
            pic1 = new Image(16, 16); 
            pic1.src = "loader.gif";
            
            $(document).ready(function(){
            
            $("#username").change(function() { 
            
            var usr = $("#username").val();
            
            if(usr.length >= 4)
            {
            $("#status").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking availability...');
            
                $.ajax({  
                type: "POST",  
                url: "check.php",  
                data: "username="+ usr,  
                success: function(msg){  
               
               $("#status").ajaxComplete(function(event, request, settings){ 
            
              if(msg == 'OK')
              { 
                    $("#username").removeClass('object_error'); // if necessary
                $("#username").addClass("object_ok");
                $(this).html('&nbsp;<img src="tick.gif" align="absmiddle">');
              }  
              else  
              {  
                $("#username").removeClass('object_ok'); // if necessary
                $("#username").addClass("object_error");
                $(this).html(msg);
              }  
               
               });
            
             } 
               
              }); 
            
            }
            else
              {
              $("#status").html('<font color="red">The username should have at least <strong>4</strong> characters.</font>');
              $("#username").removeClass('object_ok'); // if necessary
              $("#username").addClass("object_error");
              }
            
            });
            
            });
            
            //-->
      </SCRIPT>



      <center>
         <div align="center">
            <form>
               <table width="700" border="0">
                  <tr>
                     <td width="200">
                        <div align="right">Username:&nbsp;</div>
                     </td>
                     <td width="100"><input id="username" size="20" type="text" name="username"></td>
                     <td width="400" align="left">
                        <div id="status"></div>
                     </td>
                  </tr>
               </table>
            </form>
         </div>
      </center>




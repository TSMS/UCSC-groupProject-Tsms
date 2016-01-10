<?php 
include("DB/dbsms.php");



 ?>




<!DOCTYPE html>
<html lang="en">
<head>
<title>Example of Bootstrap 3 Modals</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
		function chk()
		{
			var fname=document.getElementById('fname').value;
			var lname=document.getElementById('lname').value;
			var dataString='fname='+ fname + '&lname=' + lname;
			$.ajax({
				type:"post",
				url: "check.php",
				data:dataString,
				cache:false,
				success: function(html){
					$('#msg').html(html);
				}
			});
			return false;
		}
	</script>
<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>
</head>
<body>
<form>
		<input type="text" id="fname">
		<br><br>
		<input type="text" id="lname">
		<br><br>
		<input type="submit" value="submit" onclick="return chk()">
	</form>
	<p id="msg"></p>



















<div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
    <a href="#myModal" class="btn btn-md btn-primary" data-toggle="modal">Launch Demo Modal</a>
    
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>Do you want to save changes you made to document before closing?</p>
                    <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>     
</body>
</html>                                		                                		
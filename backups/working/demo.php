<html>
<?php include 'includes/head.php';?>
<head>
	<title>Tsms</title>
</head>
<body>
<script type="text/javascript">
  function checkAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
    url: "check_availability.php",
    data:'code='+$("#supplier_code").val(),
    type: "POST",
    success:function(data){
      $("#user-availability-status").html(data);
      $("#loaderIcon").hide();
    },
    error:function (){}
    });
  }
</script>
<br><br><br>
<form>
	<span>Name</span>
	<input type="text" name="name">
	<input type="text" name="id">
	<button type="button" name="submit" >Okay</button>
</form>
 <?php include 'includes/footer.php';?>
</body>
</html>

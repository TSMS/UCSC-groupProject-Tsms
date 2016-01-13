<html>
<head>
	<title>convert pdf</title>
</head>
<body>
	<form action="" method="post">
		<input type="text" name="supcodeOne"/>-
		<input type="text" name="supcodeTwo"/>
		<input type="submit" value="convert pdf" name="pdf"/>
		<br/>
		year:
		<input type="text" name="year"/>
		month:
		<input type="text" name="month"/>
	</form>
</body>
</html>

<?php
	include_once("bill.php");
	include_once("pdfDB.php");

	if(!empty($_POST['supcodeOne']) && !empty($_POST['supcodeTwo']) && $_POST['pdf'] == "convert pdf"){
		$d1=$_POST['year'];
		$d2=$_POST['month'];
		$unformateddate=$d1."-".$d2;
		echo($unformateddate);
		PDF::createPDF((int)$_POST['supcodeOne'], (int)$_POST['supcodeTwo'], $unformateddate );
	}
?>
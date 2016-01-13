<?php 
include_once('backup.php');
if ($_GET['true']) {
	Backup::backup_tables("localhost","root","","tsms",$tables = '*');
}

?>


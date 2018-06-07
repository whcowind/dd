<?php
	session_start();
?>

<?php
	require 'connectdb.php';
?>

<?php
	$A_id = $_POST['A_id'];
	$A_password = $_POST['A_password'];

	//update login column
	$sql = "UPDATE admin_data SET login = 0 WHERE Aid = '$A_id' and Apassword = '$A_password'";
	mysql_query($sql) or die('error');
	session_destroy();
	echo "../index.html";
?>
<?php
	session_start();
?>

<?php
	require 'connectdb.php';
?>

<?php
	$S_id = $_POST['S_id'];
	$S_password = $_POST['S_password'];

	//update login column
	$sql = "UPDATE student_data SET login = 0 WHERE id = '$S_id' and password = '$S_password'";
	mysql_query($sql) or die('error');
	session_destroy();
	echo "index.html";
?>
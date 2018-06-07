<?php
	require 'connectdb.php';
?>

<?php

	$paperID = $_POST['paperID'];

	$sql = "SELECT IF(EXISTS (SELECT paperID FROM allocate WHERE paperID = '$paperID'), 1 , 0)";
	$result_exist = mysql_query($sql) or die('error');
	$exist_paper = mysql_result($result_exist, 0);

	if ($exist_paper) {
		echo $exist_paper;
	}else{
		$sqlD = "DELETE FROM paperbase WHERE paperID = '$paperID'";
		mysql_query($sqlD) or die('delete paper error');
	}

?>
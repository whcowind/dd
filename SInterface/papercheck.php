<?php 
	require 'connectdb.php';
?>

<?php

	$Sid = $_POST['S_id'];

	$sql = "SELECT paperID FROM allocate WHERE studentID = '$Sid' and progressing = '1'";
	$result = mysql_query($sql) or die('serr1');


	if(mysql_num_rows($result) > 0){
		echo "true";
	}
	else{
		echo "false";
	}

?>
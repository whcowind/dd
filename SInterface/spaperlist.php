<?php 
	require 'connectdb.php';
?>

<?php
	
	$Sid = $_POST['S_id'];

	$sql = "SELECT paperID , PTitle ,allocateID FROM allocate WHERE studentID = '$Sid' and progressing = '1'";
	$result = mysql_query($sql) or die('spaperlist.php , select paperID error');
	$num_row = mysql_num_rows($result);

	$res = array();

	for ($i=0; $i < $num_row; $i++) { 
		
		$res[$i]['paperID'] = mysql_result($result, $i , 'paperID');
		$res[$i]['PTitle'] = mysql_result($result, $i , 'PTitle');
		$res[$i]['allocateID'] = mysql_result($result, $i , 'allocateID');
	}

	echo json_encode($res);

?>
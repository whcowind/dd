<?php
	require 'connectdb.php'
?>

<?php
	$Aid = $_POST['Aid'];
	$PID = $_POST['PID'];
	$PArray = $_POST['PArray'];

	$sqlD = "DELETE FROM questionpermission WHERE owner = '$Aid' AND paperID = '$PID'";
	mysql_query($sqlD) or die('delete permission error');

	if (count($PArray) > 0) {

		for ($i=0; $i < count($PArray); $i++) { 
			$PTemp = '';
			$PTemp = $PArray[$i];

			$sql = "INSERT INTO questionpermission (owner , user , paperID)
			VALUES ('$Aid' , '$PTemp' , '$PID')";
			mysql_query($sql) or die('insert permission error');
		}

	}

?>
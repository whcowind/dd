<?php
	require 'connectdb.php';
?>

<?php
	$A_id = $_POST['A_id'];
	$A_password = $_POST['A_password'];
	$Aname = $_POST['Aname'];
	$Aphone = $_POST['Aphone'];
	$Amail = $_POST['Amail'];
	$type = $_POST['type'];

	// echo $Aname . " " . $Amail . " " . $Aphone ;

	switch ($type) {
		case 'update':
			// echo $type;
			//update admin data

			if($Aname != ""){
				$sql = "UPDATE admin_data SET Aname = '$Aname' WHERE Aid = '$A_id' AND Apassword = '$A_password'";
				mysql_query($sql) or die('error1');
			}

			if($Aphone != ""){
				$sql = "UPDATE admin_data SET Aphone = '$Aphone' WHERE Aid = '$A_id' AND Apassword = '$A_password'";
				mysql_query($sql) or die('error2');	
			}

			if($Amail != ""){
				$sql = "UPDATE admin_data SET Amail = '$Amail' WHERE Aid = '$A_id' AND Apassword = '$A_password'";
				mysql_query($sql) or die('error3');
			}

			echo "Amain.php";
		break;
	}

	
?>
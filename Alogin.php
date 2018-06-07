<?php
	session_start();
?>

<?php
	require 'connectdb2.php';
?>


<?php
	
	//receisave 
	$A_id = $_POST['A_id'];
	$A_password = $_POST['A_password'];

	// echo $A_id . '  ' . $A_password;

	//check id & password
	$sql = "SELECT IF(EXISTS (SELECT * FROM admin_data WHERE Aid = '$A_id' and Apassword = '$A_password'), 1 , 0)";
	$result = mysql_query($sql) or die('error');
	$exist_account = mysql_result($result, 0);

	if($exist_account){
		echo "Login Success";
		$_SESSION['A_id'] = $A_id;
		$_SESSION['A_password'] = $A_password;
		$sql  = "UPDATE admin_data SET login = 1 WHERE Aid = '$A_id'";
		mysql_query($sql) or die('error 1');
	}
	else{
		$sql = "SELECT IF (EXISTS (SELECT * FROM admin_data WHERE Aid = '$A_id') , 1 , 0)";
		$result = mysql_query($sql) or die('error 2');
		$exist_id = mysql_result($result, 0);

		$sql = "SELECT IF (EXISTS (SELECT * FROM admin_data WHERE Apassword = '$A_password') , 1 , 0)";
		$result = mysql_query($sql) or die('error 2');
		$exist_password = mysql_result($result, 0);


		if(!$exists_id){
			echo "no id";
		}
		
		else if (!$exists_password) {
			echo "no password";
		}
	}
?>
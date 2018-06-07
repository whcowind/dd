<?php
	session_start();
?>

<?php
	require 'connectdb.php';
?>


<?php
	
	//receive 
	$id = $_POST['id'];
	$password = $_POST['password'];

	// echo $id . '  ' . $password;

	//check id & password
	$sql = "SELECT IF(EXISTS (SELECT * FROM general_manager WHERE ID = '$id' and password = '$password'), 1 , 0)";
	$result = mysql_query($sql) or die('error');
	$exist_account = mysql_result($result, 0);

	if($exist_account){
		echo "Login Success";
		$_SESSION['ID'] = $id;
		$_SESSION['password'] = $password;
	}
	else{
		$sql = "SELECT IF (EXISTS (SELECT * FROM general_manager WHERE ID = '$id') , 1 , 0)";
		$result = mysql_query($sql) or die('error 2');
		$exist_id = mysql_result($result, 0);

		$sql = "SELECT IF (EXISTS (SELECT * FROM general_manager WHERE password = '$password') , 1 , 0)";
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
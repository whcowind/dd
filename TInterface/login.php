<?php
	session_start();
?>

<?php
	require 'connectdb.php';
?>


<?php
	
	//receive 
	$S_id = $_POST['S_id'];
	$S_password = $_POST['S_password'];

	echo $S_id . '  ' . $S_password;

	//check id & password
	$sql = "SELECT IF(EXISTS (SELECT * FROM student_data WHERE id = '$S_id' and password = '$S_password'), 1 , 0)";
	$result = mysql_query($sql) or die('error');
	$exist_account = mysql_result($result, 0);

	if($exist_account){
		echo "Login Success";
		$_SESSION['S_id'] = $S_id;
		$_SESSION['S_password'] = $S_password;
		$sql  = "UPDATE student_data SET login = 1 WHERE id = '$S_id'";
		mysql_query($sql) or die('error 1');
	}
	else{
		$sql = "SELECT IF (EXISTS (SELECT * FROM student_data WHERE id = '$S_id') , 1 , 0)";
		$result = mysql_query($sql) or die('error 2');
		$exist_id = mysql_result($result, 0);

		$sql = "SELECT IF (EXISTS (SELECT * FROM student_data WHERE password = '$S_password') , 1 , 0)";
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
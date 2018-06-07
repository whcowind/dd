<?php
	require 'connectdb.php';
?>

<?php
	$type = $_GET['type'];

	switch ($type) {
		case 'teacher_exist':
			teacher_exist();
			break;
		
		default:
			# code...
			break;
	}

	function teacher_exist(){
		$sql = "SELECT * FROM admin_data ORDER BY addTime ASC";
		$result = mysql_query($sql) or die('teacher message load error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				$res[$i][$field_name] = mysql_result($result, $i , $field_name);

			}
		}
		echo json_encode($res);
	}
?>
<?php
	require 'connectdb.php'
?>

<?php
	$Type = $_GET['Type'];


	switch ($Type) {
		case 'allocateList':
			$Aid = $_GET['Aid'];
			allocateList($Aid);
			break;
		
		case 'List':
			allocatePaper();		
			break;

		case 'Delete':
			$ID = $_GET['ID'];

			$sql = "DELETE FROM allocate WHERE allocateID = '$ID'";
			mysql_query($sql) or die('delete allocate error');

			break;

		case 'End':
			$ID = $_GET['ID'];

			$sql = "UPDATE allocate SET progressing = '0' WHERE allocateID = '$ID'";
			mysql_query($sql) or die('update allocate error');

			

			break;

		default:
			# code...
			break;
	}



	function allocateList($Aid) {
		// 可刪除
		// $sql = "SELECT DISTINCT allocateID, PTitle, progressing FROM allocate WHERE progressing = '1' AND Steacher = '$Aid' ORDER BY allocateID ASC";
		// $result = mysql_query($sql) or die('allocateList');
		// $row_num = mysql_num_rows($result);
		// if($row_num < 1){
		// 	$sql = "SELECT DISTINCT allocateID, PTitle, progressing FROM allocate WHERE Steacher = '$Aid' ORDER BY allocateID ASC";
		// 	$result = mysql_query($sql) or die('allocateList');
		// 	$row_num = mysql_num_rows($result);
		// }

		$sql = "SELECT DISTINCT allocateID, PTitle, progressing FROM allocate WHERE Steacher = '$Aid' ORDER BY allocateID ASC";
			$result = mysql_query($sql) or die('allocateList');
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



	function allocatePaper(){
		$sql = "SELECT * FROM allocate ORDER BY allocateID ASC";
		$result = mysql_query($sql) or die('err1');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				if ($field_name == 'studentID') {
					$res[$i][$field_name] = mysql_result($result, $i , $field_name);

					$Sid = mysql_result($result, $i , $field_name);

					$sql_sname = "SELECT Sname FROM student_data WHERE Sid = '$Sid'";

					$res[$i]['Sname'] = mysql_result(mysql_query($sql_sname), 0);
				}else{
					$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				}
			}
		}
		echo json_encode($res);

	}
?>
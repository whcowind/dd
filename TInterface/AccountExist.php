<?php
	require 'connectdb.php';
?>

<?php 
	$Type = $_GET['Type'];

	switch ($Type) {
		case 'classlist':
			$Aid = $_GET['Aid'];
			classlist($Aid);
			break;

		case 'studentList':
			$Aid = $_GET['Aid'];
			$className = $_GET['className'];
			studentList($Aid , $className);
			break;
		
		default:
			# code...
			break;
	}

	function classlist($Aid){
		$sql = "SELECT * FROM teacher_class WHERE Aid = '$Aid'";
		$result = mysql_query($sql) or die('class list message load error');
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

	function studentList($Aid , $className) {
		$sql = "SELECT * FROM student_data WHERE Steacher = '$Aid' AND Sclass = '$className'";
		$result = mysql_query($sql) or die('get student message error');
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

	function getStudentDetail($teacherID , $className , $studentID){
		$sql = "SELECT * FROM student_data WHERE Steacher = '$teacherID' AND Sclass = '$className' AND Sid = '$studentID'";
		$result = mysql_query($sql) or die('get student message error');
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
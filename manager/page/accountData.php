<?php
	require 'connectdb.php';
?>

<?php
	$type = $_POST['type'];

	switch ($type) {
		case 'getTeacherData':
			$ID = $_POST['ID'];
			getTeacherData($ID);

			break;

		case 'getClassData':
			$teacherID = $_POST['teacherID'];
			getClassData($teacherID);
			break;

		case 'getClassDetail':
			$teacherID = $_POST['teacherID'];
			$className = $_POST['className'];
			getClassDetail($teacherID , $className);
			break;

		case 'getStudentData':
			$teacherID = $_POST['teacherID'];
			$className = $_POST['className'];
			getStudentData($teacherID , $className);
			break;

		case 'getStudentDetail':
			$teacherID = $_POST['teacherID'];
			$className = $_POST['className'];
			$studentID = $_POST['studentID'];
			getStudentDetail($teacherID , $className , $studentID);
			break;

		case 'getGradeData':
			$studentID = $_POST['studentID'];
			getGradeData($studentID);
			break;
		
		default:
			# code...
			break;
	}

	function getTeacherData($ID){
		$sql = "SELECT * FROM admin_data WHERE Aid = '$ID'";
		$result = mysql_query($sql) or die('get teacher message error');
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

	function getClassData($teacherID){
		$sql = "SELECT * FROM teacher_class WHERE Aid = '$teacherID'";
		$result = mysql_query($sql) or die('get class message error');
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

	function getClassDetail($teacherID , $className){
		$sql = "SELECT * FROM teacher_class WHERE Aid = '$teacherID' AND Aclass = '$className'";
		$result = mysql_query($sql) or die('get class message error');
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

	function getStudentData($teacherID , $className){
		$sql = "SELECT * FROM student_data WHERE Steacher = '$teacherID' AND Sclass = '$className'";
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

	function getGradeData($studentID){
		$sql = "SELECT * FROM student_grade WHERE studentID = '$studentID'";
		$result = mysql_query($sql) or die('get student message error');
		
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				$res[$i][$field_name] = mysql_result($result, $i , $field_name);

			}

			$paperID = mysql_result($result, $i , 'paperID');
			$PTitle = mysql_result(mysql_query("SELECT PTitle FROM paperbase WHERE paperID = '$paperID'"), 0 , 'PTitle');
			$res[$i]['PTitle'] = $PTitle;
		}
		echo json_encode($res);
	}
?>
<?php
	require 'connectdb.php';
?>

<?php
	$type = $_GET['type'];

	switch ($type) {
		case 'grade_exist':
			grade_exist();
			break;

		case 'grade_detail':
			$paperID = $_GET['paperID'];
			$aid = $_GET['aid'];

			grade_detail($paperID , $aid);
			break;

		case 'del':
			$aid = $_GET['aid'];

			$sql = "DELETE FROM allocate WHERE allocateID = '$aid'";
			mysql_query($sql) or die('delete allocate error');
			break;
		
		default:
			# code...
			break;
	}

	function grade_exist(){
		$sql = "SELECT * FROM allocate WHERE progressing = '0' GROUP BY allocateID";
		$result = mysql_query($sql) or die('ger paper list error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		unset($res);
		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			for ($j=0; $j < $field_num; $j++) { 
				$field_name = mysql_field_name($result, $j);

				if ($field_name == 'Steacher') {
					$teacherID = mysql_result($result, $i , $field_name);

					$Aname = mysql_result(mysql_query("SELECT Aname FROM admin_data WHERE Aid = '$teacherID'"), 0);

					$res[$i]['Aname'] = $Aname;
				}

				$res[$i][$field_name] = mysql_result($result, $i , $field_name);
			}
		}

		echo json_encode($res);
	}

	function grade_detail($paperID , $aid) {

		$sql = "SELECT * FROM student_grade WHERE paperID = '$paperID' AND allocateID = '$aid'";
		$result = mysql_query($sql) or die('ger paper grade detail error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		unset($res);
		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			for ($j=0; $j < $field_num; $j++) { 
				$field_name = mysql_field_name($result, $j);

				$res[$i][$field_name] = mysql_result($result, $i , $field_name);
			}

			$studentID = mysql_result($result, $i , 'studentID');

			$sql = "SELECT Sname FROM student_data WHERE Sid = '$studentID'";
			$SnameResult = mysql_query($sql) or die('get Sname error');
			$Sname =mysql_result($SnameResult, 0);

			$res[$i]['Sname'] = $Sname;
		}

		echo json_encode($res);

	}
?>
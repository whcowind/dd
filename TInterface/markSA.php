<?php 
	require 'connectdb.php';
?>

<?php
	$Type = $_POST['Type'];
	date_default_timezone_set('Asia/Taipei');

	switch ($Type) {
		case 'getpaper':
			
			$teacherID = $_POST['Aid'];
			$index = 0;

			$sql_count = "SELECT count(*) FROM gpsa_store WHERE Steacher = '$teacherID' AND mark = '0'";
			$result_count = mysql_query($sql_count);
			$c = mysql_result($result_count, 0);

			if ($c > 0) {
				$sql = "SELECT DISTINCT PID , AID FROM gpsa_store WHERE Steacher = '$teacherID' AND mark = '0'";
				$result = mysql_query($sql) or die('markSA.php , select paperID error');
				$num_row = mysql_num_rows($result);

				$res = array();

				for ($i=0; $i < $num_row; $i++) { 
					$PID = mysql_result($result, $i , 'PID');
					$AID = mysql_result($result, $i , 'AID');
					$sql_getPTile = "SELECT PTitle FROM paperbase WHERE paperID = '$PID'";
					$PTitle = mysql_result(mysql_query($sql_getPTile), 0);

					$res[$i]['paperID'] = $PID;
					$res[$i]['PTitle'] = $PTitle;
					$res[$i]['allocateID'] = $AID;

					$index += 1;
				}


				$sql_sa = "SELECT DISTINCT PID , AID FROM sa_store WHERE Steacher = '$teacherID' AND mark = '0'";
				$result_sa = mysql_query($sql_sa) or die('markSA.php , select paperID error');
				$num_row_sa = mysql_num_rows($result_sa);

				for ($x=0; $x < $num_row_sa; $x++) { 
					$PID = mysql_result($result_sa, $x , 'PID');
					$AID = mysql_result($result_sa, $x , 'AID');

					for ($j=0; $j < $num_row; $j++) { 
						$PIDTemp = mysql_result($result, $j , 'PID');
						$AIDTemp = mysql_result($result, $j , 'AID');

						if ($PID != $PIDTemp && $AID != $AIDTemp) {
							$sql_sa_getPTile = "SELECT PTitle FROM paperbase WHERE paperID = '$PID'";
							$PTitle = mysql_result(mysql_query($sql_sa_getPTile), 0);
							
							$res[$index]['paperID'] = $PID;
							$res[$index]['PTitle'] = $PTitle;
							$res[$index]['allocateID'] = $AID;
							$index += 1;
						}
					}

				}
			}else{
				$sql_sa = "SELECT DISTINCT PID , AID FROM sa_store WHERE Steacher = '$teacherID' AND mark = '0'";
				$result_sa = mysql_query($sql_sa) or die('markSA.php , select paperID error');
				$num_row_sa = mysql_num_rows($result_sa);

				$res = array();

				for ($x=0; $x < $num_row_sa; $x++) { 
					$PID = mysql_result($result_sa, $x , 'PID');
					$AID = mysql_result($result_sa, $x , 'AID');

					

					$sql_sa_getPTile = "SELECT PTitle FROM paperbase WHERE paperID = '$PID'";
					$PTitle = mysql_result(mysql_query($sql_sa_getPTile), 0);
					
					$res[$index]['paperID'] = $PID;
					$res[$index]['PTitle'] = $PTitle;
					$res[$index]['allocateID'] = $AID;
				

					$index += 1;
				}
			}

			

			echo json_encode($res);
			break;

		case 'getDetail':
			
			$teacherID = $_POST['teacherID'];
			$PID = $_POST['PID'];
			$AID = $_POST['AID'];

			$sql = "SELECT count(*) FROM gpsa_store WHERE PID = '$PID' AND AID = '$AID' AND Steacher = '$teacherID'";
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);
			
			if ($c > 0) {
				GPSA($PID , $AID , $teacherID);
			}else{
				SA_DATA($PID , $AID , $teacherID);
			}

			break;

		case 'finish':
			$sa_obj = json_decode(stripslashes($_POST['SAJSON']));

			foreach ($sa_obj as $key => $value) {
				$SID = $value->SID;
				$QID = $value->QID;
				$PID  = $value->PID;
				$AID  = $value->AID;
				$GID  = $value->GID;
				$Score  = $value->Score;
				$Type  = $value->Type;
				$time = date('Y-m-d');


				if ($Score != "" && is_numeric($Score)) {

					if ($Type == 'GPSA') {
						$sql_grade = "SELECT grade FROM student_grade WHERE studentID = '$SID' AND paperID = '$PID' AND gradeID = '$GID' AND allocateID = '$AID'";
						$grade = mysql_result(mysql_query($sql_grade), 0);
						$grade += $Score;

						$sql_grade_update = "UPDATE student_grade SET grade = '$grade' , Time = '$time' WHERE studentID = '$SID' AND paperID = '$PID' AND gradeID = '$GID' AND allocateID = '$AID'";
						mysql_query($sql_grade_update) or die('update grade error');

						$sql_update_detail = "UPDATE grade_detail SET Qgrade = '$Score' WHERE studentID = '$SID' AND paperID = '$PID' AND gradeID = '$GID' AND QID = '$QID' AND QType = 'GPSA'";
						mysql_query($sql_update_detail) or die('insert into grade_detail(GPSA)');

						$sql_sa_update = "UPDATE gpsa_store SET grade = '$Score' , mark = '1' WHERE GPSID = '$QID' AND SID = '$SID' AND PID = '$PID' AND AID = '$AID' AND GID = '$GID'";
						mysql_query($sql_sa_update) or die('update gpsa_store error');

					}else if ($Type == 'SA') {
						$sql_grade = "SELECT grade FROM student_grade WHERE studentID = '$SID' AND paperID = '$PID' AND gradeID = '$GID' AND allocateID = '$AID'";
						$grade = mysql_result(mysql_query($sql_grade), 0);
						$grade += $Score;

						$sql_grade_update = "UPDATE student_grade SET grade = '$grade' , Time = '$time' WHERE studentID = '$SID' AND paperID = '$PID' AND gradeID = '$GID' AND allocateID = '$AID'";
						mysql_query($sql_grade_update) or die('update grade error');

						$sql_update_detail = "UPDATE grade_detail SET Qgrade = '$Score' WHERE studentID = '$SID' AND paperID = '$PID' AND gradeID = '$GID' AND QID = '$QID' AND QType = 'SA'";
						mysql_query($sql_update_detail) or die('insert into grade_detail(SA)');

						$sql_sa_update = "UPDATE sa_store SET grade = '$Score' , mark = '1' WHERE SAId = '$QID' AND SID = '$SID' AND PID = '$PID' AND AID = '$AID' AND GID = '$GID'";
						mysql_query($sql_sa_update) or die('update sa_store error');
					}else{

					}
				}

				
			}
			break;
		
		default:
			# code...
			break;
	}
	
	function SA_DATA($PID , $AID , $teacherID) {
		$sql = "SELECT * FROM sa_store WHERE PID = '$PID' AND AID = '$AID' AND Steacher = '$teacherID' AND mark = '0'";
		$result = mysql_query($sql) or die('getDetail error');
		$num_row = mysql_num_rows($result);
		$num_field = mysql_num_fields($result);

		$res = array();

		for ($i=0; $i < $num_row; $i++) { 
			$SAID = mysql_result($result, $i , 'SAId');
			$sql_getSATitle = "SELECT SADetail FROM short WHERE SAId = '$SAID'";
			$SATitle = mysql_result(mysql_query($sql_getSATitle), 0);

			$SID = mysql_result($result, $i , 'SID');
			$sql_getSname = "SELECT Sname FROM student_data WHERE Sid = '$SID' AND Steacher = '$teacherID'";
			$Sname = mysql_result(mysql_query($sql_getSname), 0);
			
			$res[$i]['Title'] = $SATitle;
			$res[$i]['Sname'] = $Sname;
			$res[$i]['Type'] = 'SA';
			
			for ($j=0; $j < $num_field; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				if ($field_name == 'SAId') {
					$res[$i]['QID'] = mysql_result($result, $i , $field_name);
				}else if($field_name == 'SAAns') {
					$res[$i]['Ans'] = mysql_result($result, $i , $field_name);
				}else{
					$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				}
			}

		}

		echo json_encode($res);
	}

	function GPSA($PID , $AID , $teacherID) {
		$sql = "SELECT * FROM gpsa_store WHERE PID = '$PID' AND AID = '$AID' AND Steacher = '$teacherID' AND mark = '0'";
		$result = mysql_query($sql) or die('getDetail error');
		$num_row = mysql_num_rows($result);
		$num_field = mysql_num_fields($result);

		$index = 0;

		$res = array();

		for ($i=0; $i < $num_row; $i++) { 
			$GPSAID = mysql_result($result, $i , 'GPSID');
			$sql_getGPSATitle = "SELECT GroupQContent FROM groupsubquestionbase WHERE GroupQID = '$GPSAID'";
			$GPSATitle = mysql_result(mysql_query($sql_getGPSATitle), 0);

			$SID = mysql_result($result, $i , 'SID');
			$sql_getSname = "SELECT Sname FROM student_data WHERE Sid = '$SID' AND Steacher = '$teacherID'";
			$Sname = mysql_result(mysql_query($sql_getSname), 0);

			$res[$i]['Title'] = $GPSATitle;
			$res[$i]['Sname'] = $Sname;
			$res[$i]['Type'] = 'GPSA';
			
			for ($j=0; $j < $num_field; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				if ($field_name == 'GPSID') {
					$res[$i]['QID'] = mysql_result($result, $i , $field_name);
				}else if($field_name == 'GPSAAns') {
					$res[$i]['Ans'] = mysql_result($result, $i , $field_name);
				}else{
					$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				}
			}
			$index += 1;
		}


		$sql = "SELECT count(*) FROM sa_store WHERE PID = '$PID' AND AID = '$AID' AND Steacher = '$teacherID'";
		$result = mysql_query($sql);
		$c = mysql_result($result, 0);

		if ($c > 0) {
			$sql_sa = "SELECT * FROM sa_store WHERE PID = '$PID' AND AID = '$AID' AND Steacher = '$teacherID' AND mark = '0'";
			$result_sa = mysql_query($sql_sa) or die('getDetail error');
			$num_row_sa = mysql_num_rows($result_sa);
			$num_field_sa = mysql_num_fields($result_sa);

			for ($i=0; $i < $num_row_sa; $i++) { 
				$SAID = mysql_result($result_sa, $i , 'SAId');
				$sql_getSATitle = "SELECT SADetail FROM short WHERE SAId = '$SAID'";
				$SATitle = mysql_result(mysql_query($sql_getSATitle), 0);

				$SID = mysql_result($result_sa, $i , 'SID');
				$sql_getSname = "SELECT Sname FROM student_data WHERE Sid = '$SID' AND Steacher = '$teacherID'";
				$Sname = mysql_result(mysql_query($sql_getSname), 0);
				
				$res[$index]['Title'] = $SATitle;
				$res[$index]['Sname'] = $Sname;
				$res[$index]['Type'] = 'SA';
				
				for ($j=0; $j < $num_field_sa; $j++) { 
					
					$field_name = mysql_field_name($result_sa, $j);

					if ($field_name == 'SAId') {
						$res[$index]['QID'] = mysql_result($result_sa, $i , $field_name);
					}else if($field_name == 'SAAns') {
						$res[$index]['Ans'] = mysql_result($result_sa, $i , $field_name);
					}else{
						$res[$index][$field_name] = mysql_result($result_sa, $i , $field_name);
					}
				}
				$index += 1;
			}
		}

		echo json_encode($res);
	}

?>
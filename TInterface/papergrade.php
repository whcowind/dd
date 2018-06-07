<?php
	require 'connectdb.php';
?>

<?php
	$Type = $_GET['Type'];

	switch ($Type) {
		case 'paperlist':
			$Aid = $_GET['Aid'];
			$sql = "SELECT * FROM allocate WHERE progressing = '0' AND Steacher = '$Aid' GROUP BY allocateID";
			$result = mysql_query($sql) or die('ger paper list error');
			$row_num = mysql_num_rows($result);
			$field_num = mysql_num_fields($result);

			unset($res);
			$res = array();

			for ($i=0; $i < $row_num; $i++) { 
				for ($j=0; $j < $field_num; $j++) { 
					$field_name = mysql_field_name($result, $j);

					$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				}
			}

			echo json_encode($res);

			break;

		case 'paperDetail':
			$paperID = $_GET['paperID'];
			$aid = $_GET['aid'];

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

			break;

		case 'excel':
			$paperID = $_GET['paperID'];
			$aid = $_GET['aid'];

			$sql = "SELECT * FROM student_grade WHERE paperID = '$paperID' AND allocateID = '$aid'";
			$result = mysql_query($sql) or die('paper excel error');
			$row_num = mysql_num_rows($result);
			$field_num = mysql_num_fields($result);

			for ($i=0; $i < $row_num; $i++) { 
				for ($j=0; $j < $field_num; $j++) { 
					$field_name = mysql_field_name($result, $j);

					$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				}
				$studentID = mysql_result($result, $i , 'studentID');

				$sql = "SELECT Sname FROM student_data WHERE Sid = '$studentID'";
				$SnameTemp = mysql_query($sql) or die('excel select sname error');
				$Sname = mysql_result($SnameTemp, 0);

				$res[$i]['Sname'] = $Sname;
			}

			echo json_encode($res);


			break;

		case 'excel_detailed':
			$paperID = $_GET['paperID'];
			$aid = $_GET['aid'];

			$sql = "SELECT gradeID FROM student_grade WHERE paperID = '$paperID' AND allocateID = '$aid'";
			$result = mysql_query($sql) or die('excel2 get grade id error');
			$gradeID = mysql_result($result, 0);

			$sql = "SELECT IF(EXISTS (SELECT * FROM grade_detail WHERE paperID = '$paperID' and gradeID = '$gradeID'), 1 , 0)";
			$result = mysql_query($sql) or die('error');
			$exist_grade = mysql_result($result, 0);

			if ($exist_grade) {
				$sql = "SELECT * FROM paperlink WHERE paperID = '$paperID'";
				$result = mysql_query($sql) or die('get paper link error');
				$row_num = mysql_num_rows($result);
				$gpcount = 0;
				$gpstart = 0;
				$title = array();

				for ($j=0; $j < $row_num; $j++) { 
					$type = mysql_result($result, $j , 'QType');
					$QID = mysql_result($result, $j , 'QID');
					switch ($type) {
						case 'TF':
							$sql_text = "SELECT TFDetail FROM tfquestionbase WHERE TFId = '$QID'";
							$text = mysql_query($sql_text);
							$title[$j]['title'] = mysql_result($text, 0);
							break;

						case 'CH':
							$sql_text = "SELECT ChDetail FROM choicequestionbase WHERE ChId = '$QID'";
							$text = mysql_query($sql_text);
							$title[$j]['title'] = mysql_result($text, 0);
							break;

						case 'GP':
							if ($gpcount == 0) {
								$gpstart = $j;
							}
							$gpcount ++;
							$subcount = 0;
							$sql_gp = "SELECT * FROM groupqtable WHERE GroupID = '$QID'";
							$gps = mysql_query($sql_gp);
							$field_num = mysql_num_fields($gps);
							for ($x=1; $x < $field_num; $x++) { 
								$field_name = mysql_field_name($gps, $x);
								$temp = mysql_result($gps, 0 , $field_name);

								if ($temp != 0) {
									$subcount++;
									$sql_sub = "SELECT GroupQContent FROM groupsubquestionbase WHERE GroupQID = '$temp'";
									$gpsub = mysql_query($sql_sub);

									$sub[$x]['content'] = mysql_result($gpsub, 0);
								}
							}
							$title[$j]['sub'] = $sub;
							$title[$j]['subcount'] = $subcount;
							break;

						case 'SA':
							$sql_text = "SELECT SADetail FROM short WHERE SAId = '$QID'";
							$text = mysql_query($sql_text);
							$title[$j]['title'] = mysql_result($text, 0);
							break;
						
						default:
							# code...
							break;
					}
				}
				$title['gpcount'] = $gpcount;
				$title['gpstart'] = $gpstart;
				$res['title'] = $title;

				$sql = "SELECT DISTINCT studentID FROM grade_detail WHERE paperID = '$paperID' AND gradeID = '$gradeID'";
				$result = mysql_query($sql) or die('get grade detail error');	
				$row_num = mysql_num_rows($result);
				for ($i=0; $i < $row_num; $i++) { 
					$gradecount = 0;
					$studentID = mysql_result($result, $i);
					$sql_grade = "SELECT Qgrade FROM grade_detail WHERE paperID = '$paperID' AND gradeID = '$gradeID' AND studentID = '$studentID'";
					$result_grade = mysql_query($sql_grade);
					$grade_row = mysql_num_rows($result_grade);

					$grade[$i]['ID'] = $studentID;

					for ($z=0; $z < $grade_row; $z++) { 
						$typeCheck = mysql_result(mysql_query("SELECT QType FROM grade_detail WHERE paperID = '$paperID' AND gradeID = '$gradeID' AND studentID = '$studentID'"), $z);
						if($typeCheck == 'GPSA'){
							$GPSAIDTemp = mysql_result(mysql_query("SELECT QID FROM grade_detail WHERE paperID = '$paperID' AND gradeID = '$gradeID' AND studentID = '$studentID'"), $z);
							$GPSAContent = mysql_result(mysql_query("SELECT GPSAAns FROM gpsa_store WHERE PID = '$paperID' AND GID = '$gradeID' AND SID = '$studentID' AND GPSID = '$GPSAIDTemp'"), 0);
							$p[$z] = mysql_result($result_grade, $z) . '分 - ' . $GPSAContent;
						}else if($typeCheck == 'SA') {
							$SAIDTemp = mysql_result(mysql_query("SELECT QID FROM grade_detail WHERE paperID = '$paperID' AND gradeID = '$gradeID' AND studentID = '$studentID'"), $z);
							$SAContent = mysql_result(mysql_query("SELECT SAAns FROM sa_store WHERE PID = '$paperID' AND GID = '$gradeID' AND SID = '$studentID' AND SAId = '$SAIDTemp'"), 0);
							$p[$z] = mysql_result($result_grade, $z) . '分 - ' . $SAContent;
						}else{
							$p[$z] = mysql_result($result_grade, $z);
						}
						$gradecount++;
					}

					$grade[$i]['grade'] = $p;
					$grade[$i]['count'] = $gradecount;

					$sql_name = "SELECT Sname FROM student_data WHERE Sid = '$studentID'";
					$result_temp = mysql_query($sql_name);
					$studentName = mysql_result($result_temp, 0);

					$grade[$i]['name'] = $studentName;

					$sql_time = "SELECT Time FROM student_grade WHERE studentID = '$studentID' AND paperID = '$paperID' AND allocateID = '$aid'";
					$result_temp = mysql_query($sql_time);
					$grade_Time = mysql_result($result_temp, 0);

					$grade[$i]['Time'] = $grade_Time;

					$sql_totalGrade = "SELECT grade FROM student_grade WHERE studentID = '$studentID' AND paperID = '$paperID' AND allocateID = '$aid'";
					$result_temp = mysql_query($sql_totalGrade);
					$totalGrade = mysql_result($result_temp, 0);

					$grade[$i]['totalGrade'] = $totalGrade;

				}

				$res['content'] = $grade;

				echo json_encode($res);

			}else{
				break;
			}

			break;
		
		default:
			# code...
			break;
	}
?>
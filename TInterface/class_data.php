<?php
	require 'connectdb.php';
?>

<?php

	$Type = $_GET['Type'];

	switch ($Type) {
		case 'classList':
			$Aid = $_GET['Aid'];
			$sql = "SELECT * FROM teacher_class WHERE Aid = '$Aid'";
			$result = mysql_query($sql) or die('error in classList');
			$row_num = mysql_num_rows($result);
			$field_num = mysql_num_fields($result);

			unset($res);
			$res = array();

			for ($i=0; $i < $row_num; $i++) { 
				for ($j=0; $j < $field_num; $j++) { 
					$field_name = mysql_field_name($result, $j);

					$res[$i][$field_name] = mysql_result($result, $i, $field_name);
				}
			}

			echo json_encode($res);

			break;

		case 'studentList':
			$className = $_GET['className'];
			$Aid = $_GET['Aid'];

			$sql = "SELECT * FROM student_data WHERE Sclass = '$className' AND Steacher = '$Aid'";
			$result = mysql_query($sql) or die('error1');
			$row_num = mysql_num_rows($result);
			$field_num = mysql_num_fields($result);

			unset($res);
			$res = array();

			for ($i=0; $i < $row_num; $i++) { 
				for ($j=0; $j < $field_num; $j++) { 
					$field_name = mysql_field_name($result, $j);

					$res[$i][$field_name] = mysql_result($result, $i, $field_name);
				}

				$studentID = mysql_result($result, $i , 'Sid');

				$sql = "SELECT * FROM student_grade WHERE studentID = '$studentID'";
				$result2 = mysql_query($sql) or die('error2');
				$row_num2 = mysql_num_rows($result2);
				$field_num2 = mysql_num_fields($result2);
				
				unset($grade);
				$grade = array();

				for ($x=0; $x < $row_num2; $x++) { 
					
					for ($y=0; $y <$field_num2 ; $y++) { 
						$field_name = mysql_field_name($result2, $y);

						$grade[$x][$field_name] = mysql_result($result2, $x, $field_name);
					}

					$paperID = mysql_result($result2, $x , 'paperID');

					$sql = "SELECT PTitle FROM paperbase WHERE paperID = '$paperID'";
					$PTitleResult = mysql_query($sql) or die('PTitle error');
					$PTitle = mysql_result($PTitleResult, 0);

					$grade[$x]['PTitle'] = $PTitle;

					$gradeID = mysql_result($result2, $x , 'gradeID');

					$sql = "SELECT * FROM grade_detail WHERE studentID = '$studentID' and gradeID = '$gradeID'";
					$result3 = mysql_query($sql) or die('get grade detail error');
					$row_num3 = mysql_num_rows($result3);
					$field_num3 = mysql_num_fields($result3);

					unset($gradeDetail);
					$gradeDetail = array();

					for ($a=0; $a < $row_num3; $a++) { 
						for ($b=0; $b < $field_num3; $b++) { 
							$field_name = mysql_field_name($result3, $b);

							$gradeDetail[$a][$field_name] = mysql_result($result3, $a, $field_name);
						}
					}

					$grade[$x]['Detail'] = $gradeDetail;

				}

				$res[$i]['grade'] = $grade;

			}

			echo json_encode($res);

			break;

		case 'student':

			$studentID = $_GET['studentID'];

			$sql = "SELECT * FROM student_grade WHERE studentID = '$studentID'";
			$result = mysql_query($sql) or die('get student grade error');
			$row_num = mysql_num_rows($result);
			$field_num = mysql_num_fields($result);

			unset($res);
			$res = array();

			for ($i=0; $i < $row_num; $i++) { 
				for ($j=0; $j < $field_num; $j++) { 
					$field_name = mysql_field_name($result, $j);

					$res[$i][$field_name] = mysql_result($result, $i, $field_name);
				}

				$paperID = mysql_result($result, $i , 'paperID');

				$sql = "SELECT PTitle FROM paperbase WHERE paperID = '$paperID'";
				$PTitleResult = mysql_query($sql) or die('PTitle error');
				$PTitle = mysql_result($PTitleResult, 0);

				$res[$i]['PTitle'] = $PTitle;
			}

			echo json_encode($res);

			break;

		case 'excel':
			
			$studentID = $_GET['studentID'];
			$studentName = $_GET['studentName'];

			$sql = "SELECT * FROM student_grade WHERE studentID = '$studentID'";
			$result = mysql_query($sql) or die('get student grade error');
			$row_num = mysql_num_rows($result);
			$field_num = mysql_num_fields($result);

			unset($res);
			$res = array();

			for ($i=0; $i < $row_num; $i++) { 
				for ($j=0; $j < $field_num; $j++) { 
					$field_name = mysql_field_name($result, $j);

					$res[$i][$field_name] = mysql_result($result, $i, $field_name);
				}
				$paperID = mysql_result($result, $i , 'paperID');

				$sql = "SELECT PTitle FROM paperbase WHERE paperID = '$paperID'";
				$result2 = mysql_query($sql) or die('excel ptitle error');
				$PTitle = mysql_result($result2, 0);

				$res[$i]['PTitle'] = $PTitle;
			}

			echo json_encode($res);

			// $filename = 'Student_Grade_Table';


			// header("Content-Disposition: attachment; filename=\"$filename\"");
			// header("Content-type: application/vnd.ms-excel");

			// for ($i=0; $i < $row_num; $i++) { 
			// 	$paperID = mysql_result($result, $i , 'paperID');
			// 	$grade = mysql_result($result, $i , 'grade');
			// 	$Time = mysql_result($result, $i , 'Time');

			// 	$sql = "SELECT PTitle FROM paperbase WHERE paperID = '$paperID'";
			// 	$result2 = mysql_query($sql) or die('excel ptitle error');
			// 	$PTitle = mysql_result($result2, 0);

			// 	$content = "$studentID\t$studentName\t$paperID\t$PTitle\t$grade\t$Time\n";

			// 	$content =  mb_convert_encoding($content , "big5" , "UTF8");
			// }

			// echo $content;
			exit;

			break;

		case 'excel_detailed':
			$studentID = $_GET['studentID'];
			$studentName = $_GET['studentName'];

			$sql = "SELECT * FROM student_grade WHERE studentID = '$studentID'";
			$result = mysql_query($sql) or die('get student grade error');
			$row_num = mysql_num_rows($result);

			for ($i=0; $i < $row_num; $i++) { 
				$paperID = mysql_result($result, $i , 'paperID');
				$aid = mysql_result($result, $i , 'allocateID');
				$gradeID = mysql_result($result, $i , 'gradeID');
				$Time = mysql_result($result, $i , 'Time');
				$totalGrade = mysql_result($result, $i , 'grade');

				$sql = "SELECT PTitle FROM paperbase WHERE paperID = '$paperID'";
				$result_paper = mysql_query($sql);
				$paperName = mysql_result($result_paper, 0);

				$paperName = $aid . '： ' . $paperName . '(試卷ID : ' . $paperID . ')';

				$res[$i]['paperName'] = $paperName;
				$res[$i]['Time'] = $Time;
				$res[$i]['totalGrade'] = $totalGrade;
				$res[$i]['aid'] = $aid;

				$sql = "SELECT IF(EXISTS (SELECT * FROM grade_detail WHERE paperID = '$paperID' and gradeID = '$gradeID'), 1 , 0)";
				$result_exist = mysql_query($sql) or die('error');
				$exist_grade = mysql_result($result_exist, 0);

				unset($paper);
				$paper = array();
				switch ($exist_grade) {
					case '1':
						
						$sql = "SELECT * FROM paperlink WHERE paperID = '$paperID'";
						$result_link = mysql_query($sql) or die('get paper link error');
						$row_num_link = mysql_num_rows($result_link);
						$gpcount = 0;
						$gpstart = 0;
						$title = array();

						for ($j=0; $j < $row_num_link; $j++) { 
							$type = mysql_result($result_link, $j , 'QType');
							$QID = mysql_result($result_link, $j , 'QID');
							// echo 'P' . $paperID . ' - ' . $type . ' / ';
							switch ($type) {
								case 'TF':
									$sql_text = "SELECT TFDetail FROM tfquestionbase WHERE TFId = '$QID'";
									$text = mysql_query($sql_text) or die('5');
									$title[$j]['title'] = mysql_result($text, 0);
									break;

								case 'CH':
									$sql_text = "SELECT ChDetail FROM choicequestionbase WHERE ChId = '$QID'";
									$text = mysql_query($sql_text) or die('4');
									$title[$j]['title'] = mysql_result($text, 0);
									break;

								case 'GP':
									if ($gpcount == 0) {
										$gpstart = $j;
									}
									$gpcount ++;
									$subcount = 0;
									$sql_gp = "SELECT * FROM groupqtable WHERE GroupID = '$QID'";
									$gps = mysql_query($sql_gp) or die('3');
									$field_num = mysql_num_fields($gps);
									for ($x=1; $x < $field_num; $x++) { 
										$field_name = mysql_field_name($gps, $x);
										$temp = mysql_result($gps, 0 , $field_name);

										if ($temp != 0) {
											$subcount++;
											$sql_sub = "SELECT GroupQContent FROM groupsubquestionbase WHERE GroupQID = '$temp'";
											$gpsub = mysql_query($sql_sub) or die('2');

											$sub[$x]['content'] = mysql_result($gpsub, 0);
										}
									}
									$title[$j]['sub'] = $sub;
									$title[$j]['subcount'] = $subcount;
									break;

								case 'SA':
									$sql_text = "SELECT SADetail FROM short WHERE SAId = '$QID'";
									$text = mysql_query($sql_text) or die('5');
									$title[$j]['title'] = mysql_result($text, 0);
									break;
								
								default:
									# code...
									break;
							}
						}
						$title['gpcount'] = $gpcount;
						$title['gpstart'] = $gpstart;
						$paper['title'] = $title;
						// echo json_encode($paper);
						
						$gradecount = 0;
						$sql_grade = "SELECT Qgrade FROM grade_detail WHERE paperID = '$paperID' AND gradeID = '$gradeID' AND studentID = '$studentID'";
						$result_grade = mysql_query($sql_grade) or die('1');
						$grade_row = mysql_num_rows($result_grade);


						for ($z=0; $z < $grade_row; $z++) {
							$typeCheck = mysql_result(mysql_query("SELECT QType FROM grade_detail WHERE paperID = '$paperID' AND gradeID = '$gradeID' AND studentID = '$studentID'"), $z);
							if ($typeCheck == 'GPSA') {
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
							// $p[$z] = mysql_result($result_grade, $z);
							// $gradecount++;
						}

						$grade['grade'] = $p;
						$grade['count'] = $gradecount;

						

						$paper['content'] = $grade;

						// $type = "T";
						break;

					case '0':
						// $paper[0]['hint'] = $studentID;
						// $type = "F";
						break;
					
					default:
						# code...
						break;
				}
				$res[$i]['paper'] = $paper;
				// $res[$i]['type'] = $type;

				// if ($exist_grade) {
				// 	$sql = "SELECT * FROM paperlink WHERE paperID = '$paperID'";
				// 	$result_link = mysql_query($sql) or die('get paper link error');
				// 	$row_num = mysql_num_rows($result_link);
				// 	$gpcount = 0;
				// 	$title = array();

				// 	for ($j=0; $j < $row_num; $j++) { 
				// 		$type = mysql_result($result_link, $j , 'QType');
				// 		$QID = mysql_result($result_link, $j , 'QID');
				// 		switch ($type) {
				// 			case 'TF':
				// 				$sql_text = "SELECT TFDetail FROM tfquestionbase WHERE TFId = '$QID'";
				// 				$text = mysql_query($sql_text) or die('5');
				// 				$title[$j]['title'] = mysql_result($text, 0);
				// 				break;

				// 			case 'CH':
				// 				$sql_text = "SELECT ChDetail FROM choicequestionbase WHERE ChId = '$QID'";
				// 				$text = mysql_query($sql_text) or die('4');
				// 				$title[$j]['title'] = mysql_result($text, 0);
				// 				break;

				// 			case 'GP':
				// 				$gpcount ++;
				// 				$subcount = 0;
				// 				$sql_gp = "SELECT * FROM groupqtable WHERE GroupID = '$QID'";
				// 				$gps = mysql_query($sql_gp) or die('3');
				// 				$field_num = mysql_num_fields($gps);
				// 				for ($x=1; $x < $field_num; $x++) { 
				// 					$field_name = mysql_field_name($gps, $x);
				// 					$temp = mysql_result($gps, 0 , $field_name);

				// 					if ($temp != 0) {
				// 						$subcount++;
				// 						$sql_sub = "SELECT GroupQContent FROM groupsubquestionbase WHERE GroupQID = '$temp'";
				// 						$gpsub = mysql_query($sql_sub) or die('2');

				// 						$sub[$x]['content'] = mysql_result($gpsub, 0);
				// 					}
				// 				}
				// 				$title[$j]['sub'] = $sub;
				// 				$title[$j]['subcount'] = $subcount;
				// 				break;
							
				// 			default:
				// 				# code...
				// 				break;
				// 		}
				// 	}
				// 	$title['gpcount'] = $gpcount;
				// 	$paper['title'] = $title;
					// echo json_encode($paper);

					
					
				// 	$gradecount = 0;
				// 	$sql_grade = "SELECT Qgrade FROM grade_detail WHERE paperID = '$paperID' AND gradeID = '$gradeID' AND studentID = '$studentID'";
				// 	$result_grade = mysql_query($sql_grade) or die('1');
				// 	$grade_row = mysql_num_rows($result_grade);

				// 	$grade[$k]['ID'] = $studentID;

				// 	for ($z=0; $z < $grade_row; $z++) { 
				// 		$p[$z] = mysql_result($result_grade, $z);
				// 		$gradecount++;
				// 	}

				// 	$grade['grade'] = $p;
				// 	$grade['count'] = $gradecount;

					

				// 	$paper['content'] = $grade;
				// }else{
				// 	// echo "e";
				// 	continue;
				// }

				// $res[$i] = $paper;

			}

			echo json_encode($res);

			break;
		
		default:
			# code...
			break;
	}


	

?>
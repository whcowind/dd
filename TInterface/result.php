<?php
	require 'connectdb.php';
?>

<?php
	$Type = $_GET['Type'];

	switch ($Type) {
		case 'getList':
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

		case 'calculate':
			$aid = $_GET['aid'];
			$id = $_GET['id'];
			$title = $_GET['title'];
			$selectLength = $_GET['selectLength'];

			// echo $aid . " - " . $id . " - " . $title . " - " . $selectLength;

			$sql_getPaper = "SELECT * FROM paperlink WHERE paperID = '$id'";
			$paperQNum = mysql_num_rows(mysql_query($sql_getPaper));

			$res = array();
			$sacount = 0;
			$start = 0;
			for ($i=0; $i < $paperQNum; $i++) { 
				$QType = mysql_result(mysql_query($sql_getPaper), $i , 'QType');
				if ($QType != 'SA') {
					$QID = mysql_result(mysql_query($sql_getPaper), $i , 'QID');

					switch ($QType) {
						case 'TF':
							unset($tf);
							$tf = array();
							
							$QTitle = mysql_result(mysql_query("SELECT TFDetail FROM tfquestionbase WHERE TFId = '$QID'"), 0);
							$TContent = mysql_result(mysql_query("SELECT TContent FROM tfquestionbase WHERE TFId = '$QID'"), 0);
							$FContent = mysql_result(mysql_query("SELECT FContent FROM tfquestionbase WHERE TFId = '$QID'"), 0);
							$TPercent = TFTPercent($QID , $aid , $id);
							$FPercent = 100 - $TPercent;

							$tf['QTitle'] = $QTitle;
							$tf['TContent'] = $TContent;
							$tf['FContent'] = $FContent;
							$tf['TPercent'] = $TPercent;
							$tf['FPercent'] = $FPercent;
							$tf['Type'] = 'TF';

							$res[$i] = $tf;
							$start++;
							break;

						case 'CH':
							unset($ch);
							$ch = array();

							$QTitle = mysql_result(mysql_query("SELECT ChDetail FROM choicequestionbase WHERE ChId = '$QID'"), 0);
							$C1Content = mysql_result(mysql_query("SELECT ChAns1Content FROM choicequestionbase WHERE ChId = '$QID'"), 0);
							$C2Content = mysql_result(mysql_query("SELECT ChAns2Content FROM choicequestionbase WHERE ChId = '$QID'"), 0);
							$C3Content = mysql_result(mysql_query("SELECT ChAns3Content FROM choicequestionbase WHERE ChId = '$QID'"), 0);
							$C4Content = mysql_result(mysql_query("SELECT ChAns4Content FROM choicequestionbase WHERE ChId = '$QID'"), 0);

							$C1Percent = CHPercent($QID , $aid , $id , '1');
							$C2Percent = CHPercent($QID , $aid , $id , '2');
							$C3Percent = CHPercent($QID , $aid , $id , '3');
							$C4Percent = CHPercent($QID , $aid , $id , '4');

							$ch['QTitle'] = $QTitle;
							$ch['C1Content'] = $C1Content;
							$ch['C2Content'] = $C2Content;
							$ch['C3Content'] = $C3Content;
							$ch['C4Content'] = $C4Content;
							$ch['C1Percent'] = $C1Percent;
							$ch['C2Percent'] = $C2Percent;
							$ch['C3Percent'] = $C3Percent;
							$ch['C4Percent'] = $C4Percent;
							$ch['Type'] = 'CH';

							$res[$i] = $ch;
							$start++;
							break;

						case 'GP':
							unset($gp);
							$gp = array();
							$index = 1;

							$MainTitle = mysql_result(mysql_query("SELECT GroupTitle FROM groupquestionbase WHERE GroupID = '$QID'"), 0);
							// $MainTitle = str_split($MainTitle , 240);
							// $gp['MainTitle'] = $MainTitle[0];
							$gp['MainTitle'] = $MainTitle;

							for ($a=1; $a < 11; $a++) { 
								// $object = mysql_fetch_field(mysql_query("SELECT * FROM groupqtable WHERE GroupID = '$QID'") , $a);
								$subID = mysql_result(mysql_query("SELECT * FROM groupqtable WHERE GroupID = '$QID'"), 0 , 'GroupQ' . $a . 'ID');
								if ($subID != 0) {
									unset($gps);
									$gps = array();

									$subTitle = mysql_result(mysql_query("SELECT GroupQContent FROM groupsubquestionbase WHERE GroupQID = '$subID'"), 0);
									$sort = mysql_result(mysql_query("SELECT sort FROM groupsubquestionbase WHERE GroupQID = '$subID'"), 0);
									$G1Content = mysql_result(mysql_query("SELECT GroupA1Content FROM groupsubquestionbase WHERE GroupQID = '$subID'"), 0);
									$G2Content = mysql_result(mysql_query("SELECT GroupA2Content FROM groupsubquestionbase WHERE GroupQID = '$subID'"), 0);
									$G3Content = mysql_result(mysql_query("SELECT GroupA3Content FROM groupsubquestionbase WHERE GroupQID = '$subID'"), 0);
									$G4Content = mysql_result(mysql_query("SELECT GroupA4Content FROM groupsubquestionbase WHERE GroupQID = '$subID'"), 0);

									if ($sort == 0) {
										$G1Percent = GPPercent($subID , $aid , $id , '1');
										$G2Percent = GPPercent($subID , $aid , $id , '2');
										$G3Percent = GPPercent($subID , $aid , $id , '3');
										$G4Percent = GPPercent($subID , $aid , $id , '4');

										$gps['subID'] = $subID;
										$gps['subTitle'] = $subTitle;
										$gps['G1Content'] = $G1Content;
										$gps['G2Content'] = $G2Content;
										$gps['G3Content'] = $G3Content;
										$gps['G4Content'] = $G4Content;
										$gps['G1Percent'] = $G1Percent;
										$gps['G2Percent'] = $G2Percent;
										$gps['G3Percent'] = $G3Percent;
										$gps['G4Percent'] = $G4Percent;
										$gps['sort'] = $sort;
									}else if ($sort == 1) {
										$G1Percent = GPPercent($subID , $aid , $id , '1');
										$G2Percent = GPPercent($subID , $aid , $id , '2');
										$gps['subID'] = $subID;
										$gps['subTitle'] = $subTitle;
										$gps['G1Content'] = $G1Content;
										$gps['G2Content'] = $G2Content;
										$gps['G1Percent'] = $G1Percent;
										$gps['G2Percent'] = $G2Percent;
										$gps['sort'] = $sort;
									}else if($sort == 2){
										$gps['subID'] = $subID;
										$gps['subTitle'] = $subTitle;
										$gps['sort'] = $sort;
									}else{

									}

									$gp[$index] = $gps;
									$index += 1;
								}
							}

							$res[$i]['GP'] = $gp;
							$res[$i]['Type'] = 'GP';
							break;
						
						default:
							# code...
							break;
					}
				}else{
					$sacount ++;
				}
			}
			$res['start'] = $start;
			$res['SA'] = $sacount;
			echo json_encode($res);

			break;
		
		default:
			# code...
			break;
	}

	function TFTPercent($QID , $aid , $PID) {
		$TScore = mysql_result(mysql_query("SELECT TScore FROM tfquestionbase WHERE TFId = '$QID'"), 0);
		$AllCount = 0;
		$TCount = 0;

		$sql_student = "SELECT * FROM student_grade WHERE paperID = '$PID' AND allocateID = '$aid'";
		$studentNum = mysql_num_rows(mysql_query($sql_student));
		// echo $studentNum . ' Q- ';

		for ($x=0; $x < $studentNum; $x++) { 
			$ansCheck = mysql_result(mysql_query($sql_student), $x , 'Time');
			// echo $ansCheck . ' W- ';
			if ($ansCheck != '') {
				$AllCount += 1;
				$SID = mysql_result(mysql_query($sql_student), $x , 'studentID');
				$GID = mysql_result(mysql_query($sql_student), $x , 'gradeID');

				$QGrade = mysql_result(mysql_query("SELECT Qgrade FROM grade_detail WHERE studentID = '$SID' AND paperID = '$PID' AND gradeID = '$GID' AND QID = '$QID' AND QType = 'TF'"), 0);

				if ($TScore == $QGrade) {
					$TContent += 1;
				}
			}
		}

		$percent = round(($TContent/$AllCount)*100);
		return $percent;
	}

	function CHPercent($QID , $aid , $PID , $item) {
		$AllCount = 0;
		$C1 = 0;
		$C2 = 0;
		$C3 = 0;
		$C4 = 0;

		$sql_student = "SELECT * FROM student_grade WHERE paperID = '$PID' AND allocateID = '$aid'";
		$studentNum = mysql_num_rows(mysql_query($sql_student));

		for ($x=0; $x < $studentNum; $x++) { 
			$ansCheck = mysql_result(mysql_query($sql_student), $x , 'Time');
			if ($ansCheck != '') {
				$AllCount += 1;
				$SID = mysql_result(mysql_query($sql_student), $x , 'studentID');
				$GID = mysql_result(mysql_query($sql_student), $x , 'gradeID');

				$SelectItem = mysql_result(mysql_query("SELECT item FROM grade_detail WHERE studentID = '$SID' AND paperID = '$PID' AND gradeID = '$GID' AND QID = '$QID' AND QType = 'CH'"), 0);

				switch ($SelectItem) {
					case '1':
						$C1 += 1;
						break;

					case '2':
						$C2 += 1;
						break;
					
					case '3':
						$C3 += 1;
						break;

					case '4':
						$C4 += 1;
						break;

					default:
						# code...
						break;
				}
			}
		}

		switch ($item) {
			case '1':
				$percent = round(($C1/$AllCount)*100);
				return $percent;

				break;

			case '2':
				$percent = round(($C2/$AllCount)*100);
				return $percent;
				
				break;

			case '3':
				$percent = round(($C3/$AllCount)*100);
				return $percent;
				
				break;

			case '4':
				$percent = round(($C4/$AllCount)*100);
				return $percent;
				
				break;
			
			default:
				# code...
				break;
		}
	}

	function GPPercent($subID , $aid , $PID , $item) {
		$AllCount = 0;
		$G1 = 0;
		$G2 = 0;
		$G3 = 0;
		$G4 = 0;

		$sql_student = "SELECT * FROM student_grade WHERE paperID = '$PID' AND allocateID = '$aid'";
		$studentNum = mysql_num_rows(mysql_query($sql_student));

		for ($x=0; $x < $studentNum; $x++) { 
			$ansCheck = mysql_result(mysql_query($sql_student), $x , 'Time');
			if ($ansCheck != '') {
				$AllCount += 1;
				$SID = mysql_result(mysql_query($sql_student), $x , 'studentID');
				$GID = mysql_result(mysql_query($sql_student), $x , 'gradeID');

				$SelectItem = mysql_result(mysql_query("SELECT item FROM grade_detail WHERE studentID = '$SID' AND paperID = '$PID' AND gradeID = '$GID' AND QID = '$subID' AND QType = 'GP'"), 0);

				switch ($SelectItem) {
					case '1':
						$G1 += 1;
						break;

					case '2':
						$G2 += 1;
						break;
					
					case '3':
						$G3 += 1;
						break;

					case '4':
						$G4 += 1;
						break;

					default:
						# code...
						break;
				}
			}
		}

		switch ($item) {
			case '1':
				$percent = round(($G1/$AllCount)*100);
				return $percent;

				break;

			case '2':
				$percent = round(($G2/$AllCount)*100);
				return $percent;
				
				break;

			case '3':
				$percent = round(($G3/$AllCount)*100);
				return $percent;
				
				break;

			case '4':
				$percent = round(($G4/$AllCount)*100);
				return $percent;
				
				break;
			
			default:
				# code...
				break;
		}
	}
?>
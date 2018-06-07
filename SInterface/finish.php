<?php 
	require 'connectdb.php';
?>

<?php 
	$SID = $_POST['S_id'];
	$PID = $_POST['PID'];
	$allocateID = $_POST['allocateID'];
	// $TFJSON = Array();
	// $TFJSON['TFJSON'] = json_decode($_POST['TFJSON']);
	// $TFJSON = json_decode(stripslashes($_POST['TFJSON']));
	$tf_obj = json_decode(stripslashes($_POST['TFJSON']));
	$ch_obj = json_decode(stripslashes($_POST['CHJSON']));
	$gp_obj = json_decode(stripslashes($_POST['GPJSON']));
	$sa_obj = json_decode(stripslashes($_POST['SAJSON']));
	// $TFJSON = $_POST['TFJSON'];
	// $CHJSON = $_POST['CHJSON'];
	// $GPJSON = $_POST['GPJSON'];

	date_default_timezone_set('Asia/Taipei');


	$sql_getclass = "SELECT Steacher FROM student_data WHERE Sid = '$SID'";
	$Steacher = mysql_result(mysql_query($sql_getclass), 0);

	$grade_counter = 0;

	$sql = "SELECT gradeID FROM student_grade WHERE studentID = '$SID' and allocateID = '$allocateID'";
	$grade = mysql_query($sql) or die('select gradeid error');
	$gradeID = mysql_result($grade, 0);

	$time = date('Y-m-d');
	$sql = "UPDATE student_grade SET Time = '$time' WHERE gradeID = '$gradeID' AND studentID = '$SID' AND allocateID = '$allocateID'";
	mysql_query($sql) or die('finish update time error');

	// $gradeID = getgradeId($SID);
	// $sql = "INSERT INTO student_grade(studentID , paperID , gradeID , allocateID)
	// VALUES ('$SID' , '$PID' , '$gradeID' , '$allocateID')";
	// mysql_query($sql) or die('insert into student_grade');



	foreach ($tf_obj as $key => $value) {
		$TFID = $value->TFID;
		$Ans  = $value->Ans;

		$sql = "SELECT TContent , FContent , TScore , FScore FROM tfquestionbase WHERE TFID = '$TFID'";
		$result = mysql_query($sql) or die('finish error1');
		$TAns = mysql_result($result, 0 ,'TContent');
		$FAns = mysql_result($result, 0 ,'FContent');

		if ($Ans == $TAns) {
			$Score = mysql_result($result, 0 , 'TScore');
			$grade_counter += (int)$Score;
			echo $Score;

			$sql = "INSERT INTO grade_detail(studentID , paperID , gradeID , QID , Qgrade , item , QType)
			VALUES ('$SID' , '$PID' , '$gradeID' , '$TFID' , '$Score' , '' , 'TF')";
			mysql_query($sql) or die('insert into grade_detail(TF)');
		}
		else if($Ans == $FAns){
			$Score = mysql_result($result, 0 , 'FScore');
			$grade_counter += (int)$Score;
			echo $Score;

			$sql = "INSERT INTO grade_detail(studentID , paperID , gradeID , QID , Qgrade , item , QType)
			VALUES ('$SID' , '$PID' , '$gradeID' , '$TFID' , '$Score' , '' , 'TF')";
			mysql_query($sql) or die('insert into grade_detail(TF)');
		}

	}

	foreach ($ch_obj as $key => $value) {
		$CHID = $value->CHID;
		$Ans  = $value->Ans;

		$sql = "SELECT * FROM choicequestionbase WHERE ChID = '$CHID'";
		$result = mysql_query($sql) or die('finish error2');
		$C1Ans = mysql_result($result, 0 , 'ChAns1Content');
		$C2Ans = mysql_result($result, 0 , 'ChAns2Content');
		$C3Ans = mysql_result($result, 0 , 'ChAns3Content');
		$C4Ans = mysql_result($result, 0 , 'ChAns4Content');

		if($Ans == $C1Ans){
			$Score = mysql_result($result, 0 , 'ChAns1Score');
			$grade_counter += (int)$Score;

			$sql = "INSERT INTO grade_detail(studentID , paperID , gradeID , QID , Qgrade , item , QType)
			VALUES ('$SID' , '$PID' , '$gradeID' , '$CHID' , '$Score' , '1' , 'CH')";
			mysql_query($sql) or die('insert into grade_detail(CH)');
		}
		else if($Ans == $C2Ans){
			$Score = mysql_result($result, 0 , 'ChAns2Score');
			$grade_counter += (int)$Score;

			$sql = "INSERT INTO grade_detail(studentID , paperID , gradeID , QID , Qgrade , item , QType)
			VALUES ('$SID' , '$PID' , '$gradeID' , '$CHID' , '$Score' , '2' , 'CH')";
			mysql_query($sql) or die('insert into grade_detail(CH)');
		}
		else if($Ans == $C3Ans){
			$Score = mysql_result($result, 0 , 'ChAns3Score');
			$grade_counter += (int)$Score;

			$sql = "INSERT INTO grade_detail(studentID , paperID , gradeID , QID , Qgrade , item , QType)
			VALUES ('$SID' , '$PID' , '$gradeID' , '$CHID' , '$Score' , '3' , 'CH')";
			mysql_query($sql) or die('insert into grade_detail(CH)');
		}
		else if($Ans == $C4Ans){
			$Score = mysql_result($result, 0 , 'ChAns4Score');
			$grade_counter += (int)$Score;

			$sql = "INSERT INTO grade_detail(studentID , paperID , gradeID , QID , Qgrade , item , QType)
			VALUES ('$SID' , '$PID' , '$gradeID' , '$CHID' , '$Score' , '4' , 'CH')";
			mysql_query($sql) or die('insert into grade_detail(CH)');
		}
	}

	foreach ($gp_obj as $key => $value) {
		$GPSID = $value->GPSID;
		$Ans   = $value->Ans;
		$sort  = $value->sort;

		$sql = "SELECT * FROM groupsubquestionbase WHERE GroupQID = '$GPSID'";
		$result = mysql_query($sql) or die('finish error2');
		$G1Ans = mysql_result($result, 0 , 'GroupA1Content');
		$G2Ans = mysql_result($result, 0 , 'GroupA2Content');
		$G3Ans = mysql_result($result, 0 , 'GroupA3Content');
		$G4Ans = mysql_result($result, 0 , 'GroupA4Content');

		switch ($sort) {
			case '0':
				if($Ans == $G1Ans){
					$Score = mysql_result($result, 0 , 'GroupA1Score');
					$grade_counter += (int)$Score;

					$sql = "INSERT INTO grade_detail(studentID , paperID , gradeID , QID , Qgrade , item , QType)
					VALUES ('$SID' , '$PID' , '$gradeID' , '$GPSID' , '$Score' , '1' , 'GP')";
					mysql_query($sql) or die('insert into grade_detail(GP)');
				}
				else if($Ans == $G2Ans){
					$Score = mysql_result($result, 0 , 'GroupA2Score');
					$grade_counter += (int)$Score;

					$sql = "INSERT INTO grade_detail(studentID , paperID , gradeID , QID , Qgrade , item , QType)
					VALUES ('$SID' , '$PID' , '$gradeID' , '$GPSID' , '$Score' , '2' , 'GP')";
					mysql_query($sql) or die('insert into grade_detail(GP)');
				}
				else if($Ans == $G3Ans){
					$Score = mysql_result($result, 0 , 'GroupA3Score');
					$grade_counter += (int)$Score;

					$sql = "INSERT INTO grade_detail(studentID , paperID , gradeID , QID , Qgrade , item , QType)
					VALUES ('$SID' , '$PID' , '$gradeID' , '$GPSID' , '$Score' , '3' , 'GP')";
					mysql_query($sql) or die('insert into grade_detail(GP)');
				}
				else if($Ans == $G4Ans){
					$Score = mysql_result($result, 0 , 'GroupA4Score');
					$grade_counter += (int)$Score;

					$sql = "INSERT INTO grade_detail(studentID , paperID , gradeID , QID , Qgrade , item , QType)
					VALUES ('$SID' , '$PID' , '$gradeID' , '$GPSID' , '$Score' , '4' , 'GP')";
					mysql_query($sql) or die('insert into grade_detail(GP)');
				}
				break;

			case '1':
				if($Ans == $G1Ans){
					$Score = mysql_result($result, 0 , 'GroupA1Score');
					$grade_counter += (int)$Score;

					$sql = "INSERT INTO grade_detail(studentID , paperID , gradeID , QID , Qgrade , item , QType)
					VALUES ('$SID' , '$PID' , '$gradeID' , '$GPSID' , '$Score' , '1' , 'GP')";
					mysql_query($sql) or die('insert into grade_detail(GP)');
				}
				else if($Ans == $G2Ans){
					$Score = mysql_result($result, 0 , 'GroupA2Score');
					$grade_counter += (int)$Score;

					$sql = "INSERT INTO grade_detail(studentID , paperID , gradeID , QID , Qgrade , item , QType)
					VALUES ('$SID' , '$PID' , '$gradeID' , '$GPSID' , '$Score' , '2' , 'GP')";
					mysql_query($sql) or die('insert into grade_detail(GP)');
				}
				break;

			case '2':
				$sql = "INSERT INTO grade_detail(studentID , paperID , gradeID , QID , Qgrade , item , QType)
				VALUES ('$SID' , '$PID' , '$gradeID' , '$GPSID' , 'N' , '' , 'GPSA')";
				mysql_query($sql) or die('insert into grade_detail(GPSA)');

				$sql = "INSERT INTO gpsa_store(GPSID , GPSAAns , SID , PID , AID , GID , grade , mark , Steacher)
				VALUES ('$GPSID' , '$Ans' , '$SID' , '$PID' , '$allocateID' , '$gradeID' , 'N' , '0' , '$Steacher')";
				mysql_query($sql) or die('insert sa err');
				break;
			
			default:
				# code...
				break;
		}
	}

	foreach ($sa_obj as $key => $value) {
		$SAID = $value->SAID;
		$Ans  = $value->Ans;

		$sql = "INSERT INTO grade_detail(studentID , paperID , gradeID , QID , Qgrade , item , QType)
		VALUES ('$SID' , '$PID' , '$gradeID' , '$SAID' , 'N' , '' , 'SA')";
		mysql_query($sql) or die('insert into grade_detail(SA)');

		$sql = "INSERT INTO sa_store(SAId , SAAns , SID , PID , AID , GID , grade , mark , Steacher)
		VALUES ('$SAID' , '$Ans' , '$SID' , '$PID' , '$allocateID' , '$gradeID' , 'N' , '0' , '$Steacher')";
		mysql_query($sql) or die('insert sa err');
	}

	

	$sql = "UPDATE student_grade SET grade = '$grade_counter' WHERE gradeID = '$gradeID' AND studentID = '$SID'";
	mysql_query($sql) or die('count total grade');

	

	$sql = "UPDATE allocate SET progressing = '0' WHERE paperID = '$PID' and studentID = '$SID'";
	mysql_query($sql) or die('end the paper error');

	// $TFID = $tf_obj -> TFID;
	// var_dump($tf_obj);
	// var_dump($TFJSON);
	// echo $TFJSON;
 	// print_r(json_decode(substr($TFJSON,3)));
	// var_dump(json_decode($TFJSON));
	// $obj = json_decode($TFJSON);
	// echo $obj;

	// $TFID = $obj->TFID;

	// echo json_decode($_POST['TFJSON']);

	// echo $TFID;

	// echo $obj->TFID;
	// echo $obj->Ans;
	
	// echo $TFJSON;
	// echo $array;

	// function getgradeId($SID) {
	// 	$count = 1;
	// 	$sql = "SELECT * FROM student_grade WHERE studentID = '$SID' ORDER BY gradeID ASC";
	// 	$result = mysql_query($sql) or die('paperID error');
	// 	$row_num = mysql_num_rows($result);


	// 	if ($row_num == 0) {
	// 		return $count;
	// 	}else{

	// 		for ($i=0; $i < $row_num; $i++) { 
	// 			$Id = mysql_result($result, $i , 'gradeID');

	// 			if ($count == $Id) {
	// 				if ($row_num == $Id) {
	// 					$count++;
	// 					return $count;
	// 				}else{
	// 					$count ++;
	// 				}
	// 			}elseif ($count != $Id) {
	// 				return $count;
	// 			}
	// 		}

	// 	}

	// }
?>
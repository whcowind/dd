<?php
	require 'connectdb.php';
?>

<?php
	$type = $_POST['type'];

	switch ($type) {
		case 'getQuestionData':
			$Qtype = $_POST['Qtype'];

			switch ($Qtype) {
				case 'TF':
					TF_exist();
					break;

				case 'CH':
					CH_exist();
					break;

				case 'GP':
					GP_exist();
					break;

				case 'SA':
					SA_exist();
					break;
				
				default:
					# code...
					break;
			}
			break;

		case 'getQuestionDetail':
			$ID = $_POST['ID'];
			$Qtype = $_POST['Qtype'];
			$owner = $_POST['owner'];

			switch ($Qtype) {
				case 'TF':
					TF_detail($ID , $owner);
					break;

				case 'CH':
					CH_detail($ID , $owner);
					break;

				case 'GP':
					GP_detail($ID , $owner);
					break;

				case 'SA':
					SA_detail($ID);
					break;
				
				default:
					# code...
					break;
			}

			break;

		case 'update':
			$Qtype = $_POST['Qtype'];
			$owner = $_POST['owner'];
			$QID = $_POST['QID'];
			$imgArr = $_POST['imgArr'];

			switch ($Qtype) {
				case 'TF':
					$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'TF' AND QID = '$QID'"; 
					$result = mysql_query($sql);
					$c = mysql_result($result, 0);
					
					if ($c) {
						echo $c;
					}
					else{
						$title = $_POST['title'];
						$TContent = $_POST['TContent'];
						$FContent = $_POST['FContent'];
						$TScore = $_POST['TScore'];
						$FScore = $_POST['FScore'];

						$sql_update = "UPDATE tfquestionbase SET TFDetail = '$title' , TContent = '$TContent' , FContent = '$FContent' , TScore = '$TScore' , FScore = '$FScore' WHERE TFId = '$QID' AND owner = '$owner'";
						mysql_query($sql_update) or die(mysql_error());

						if(!empty($imgArr)){
							$sql = "DELETE FROM imagelink WHERE QID = '$QID' and QType = 'TFQuestion'";
							mysql_query($sql) or die('err001 , delete img');

							for ($i=0; $i < count($imgArr); $i++) { 
								$imageTemp = '';
								$imageTemp = $imgArr[$i];

								$sql = "INSERT INTO imagelink (imageID , QID , QType)
								VALUES ('$imageTemp' , '$QID' , 'TFQuestion')";
								mysql_query($sql) or die('err002 , update and insert imagelink table');
							}
						}
						else{
							$sql = "DELETE FROM imagelink WHERE QID = '$QID' and QType = 'TFQuestion'";
							mysql_query($sql) or die('err003 , delete img');
						}

					}
					break;

				case 'CH':
					$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'CH' AND QID = '$QID'"; 
					$result = mysql_query($sql);
					$c = mysql_result($result, 0);

					if ($c) {
						echo $c;
					}else{
						$title = $_POST['title'];
						$CH1Content = $_POST['CH1Content'];
						$CH2Content = $_POST['CH2Content'];
						$CH3Content = $_POST['CH3Content'];
						$CH4Content = $_POST['CH4Content'];
						$CH1Score = $_POST['CH1Score'];
						$CH2Score = $_POST['CH2Score'];
						$CH3Score = $_POST['CH3Score'];
						$CH4Score = $_POST['CH4Score'];

						$sql_update = "UPDATE choicequestionbase SET ChDetail = '$title' , ChAns1Content = '$CH1Content' , ChAns2Content = '$CH2Content' , ChAns3Content = '$CH3Content' , ChAns4Content = '$CH4Content' , ChAns1Score = '$CH1Score' , ChAns2Score = '$CH2Score' , ChAns3Score = '$CH3Score' , ChAns4Score = '$CH4Score' WHERE CHId = '$QID' AND owner = '$owner'";
						mysql_query($sql_update) or die(mysql_error());

						if(!empty($imgArr)){
							$sql = "DELETE FROM imagelink WHERE QID = '$QID' and QType = 'ChoiceQuestion'";
							mysql_query($sql) or die('err004 , delete img');

							for ($i=0; $i < count($imgArr); $i++) { 
								$imageTemp = '';
								$imageTemp = $imgArr[$i];

								$sql = "INSERT INTO imagelink (imageID , QID , QType)
								VALUES ('$imageTemp' , '$QID' , 'ChoiceQuestion')";
								mysql_query($sql) or die('err005 , update and insert imagelink table');
							}
						}
						else{
							$sql = "DELETE FROM imagelink WHERE QID = '$QID' and QType = 'ChoiceQuestion'";
							mysql_query($sql) or die('err006 , delete img');
						}
					}
					break;

				case 'GP':
					$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'GP' AND QID = '$QID'"; 
					$result = mysql_query($sql);
					$c = mysql_result($result, 0);

					if ($c > 0) {
						echo $c;
					}else{
						$MainTitle = $_POST['MainTitle'];
						$sql_maintitle = "UPDATE groupquestionbase SET GroupTitle = '$MainTitle' WHERE GroupID = '$QID'";
						mysql_query($sql_maintitle) or die('err3 , groupquestionbase update error');

						$gp_obj = json_decode(stripslashes($_POST['GPJSON']));
						$gpscount = 0;

						if(!empty($imgArr)){
							$sql = "DELETE FROM imagelink WHERE QID = '$QID' and QType = 'Group'";
							mysql_query($sql) or die('err007 , delete img');

							for ($i=0; $i < count($imgArr); $i++) { 
								$imageTemp = '';
								$imageTemp = $imgArr[$i];

								$sql = "INSERT INTO imagelink (imageID , QID , QType)
								VALUES ('$imageTemp' , '$QID' , 'Group')";
								mysql_query($sql) or die('err008 , update and insert imagelink table');
							}
						}
						else{
							$sql = "DELETE FROM imagelink WHERE QID = '$QID' and QType = 'Group'";
							mysql_query($sql) or die('err009 , delete img');
						}

						foreach ($gp_obj as $key => $value) {
							$gpscount += 1;
							$title = $value->title;
							$sort = $value->sort;
							$Ans1 = $value->Ans1;
							$Ans2 = $value->Ans2;
							$Ans3 = $value->Ans3;
							$Ans4 = $value->Ans4;
							$score1 = $value->score1;
							$score2 = $value->score2;
							$score3 = $value->score3;
							$score4 = $value->score4;
							$GPSIdTemp = ($QID - 1) *10 + $gpscount;

							if ($title != "") {
								// echo $GPSIdTemp . ' - ' . $title . ' - ';
								$result = mysql_query("SELECT GroupQID FROM groupsubquestionbase WHERE GroupQID = '$GPSIdTemp' and GroupID = '$QID'");

								if(mysql_num_rows($result) == 0){
									echo 'insert' .  $GPSIdTemp . ' - ' . $title . ' - ';
									$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score , sort)
									VALUES ('$GPSIdTemp' , '$QID' , '$title' , '$Ans1' , '$score1' , '$Ans2' , '$score2' , '$Ans3' , '$score3' , '$Ans4' , '$score4' , '$sort')";
									mysql_query($sql) or die('err5-0');

									$sql = "UPDATE groupqtable SET GroupQ2ID = '$GpIdTemp2' WHERE GroupID = '$GroupID'";
									mysql_query($sql) or die('err5--0');
								}
								else{
									echo 'update' .  $GPSIdTemp . ' - ' . $title . ' - ';
									$sql = "UPDATE groupsubquestionbase SET sort = '$sort' , GroupQContent = '$title' , GroupA1Content = '$Ans1' , GroupA1Score = '$score1' , GroupA2Content = '$Ans2' , GroupA2Score = '$score2' , GroupA3Content = '$Ans3' , GroupA3Score = '$score3' , GroupA4Content = '$Ans4' , GroupA4Score = '$score4' WHERE GroupID = '$QID' and GroupQID = '$GPSIdTemp'";
									mysql_query($sql) or die('err5 , groupsubquestionbase error');
								}
							}else{
								$sql = "DELETE from groupsubquestionbase WHERE GroupQID = '$GPSIdTemp' and GroupID = '$QID'";
								mysql_query($sql) or die('err5-1');
								$temp = 'GroupQ' . $gpscount . 'ID';
								$sql = "UPDATE groupqtable SET $temp = '' WHERE GroupID = '$QID'";
								mysql_query($sql) or die('err5-2');
							}
						}
					}
					break;

				case 'SA':
					$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'SA' AND QID = '$QID'"; 
					$result = mysql_query($sql);
					$c = mysql_result($result, 0);

					if ($c) {
						echo $c;
					}else{
						$title = $_POST['title'];
						$sql = "UPDATE short SET SADetail = '$title' WHERE SAId = '$QID'";
						mysql_query($sql) or die('err1 , short Ans update error');
					}
					break;
				
				default:
					# code...
					break;
			}

			break;

		case 'delQuestion':
			$ID = $_POST['ID'];
			$Qtype = $_POST['Qtype'];

			switch ($Qtype) {
				case 'TF':
					TF_delete($ID);
					break;

				case 'CH':
					CH_delete($ID);
					break;

				case 'GP':
					GP_delete($ID);
					break;

				case 'SA':
					SA_delete($ID);
					break;
				
				default:
					# code...
					break;
			}

			break;
		
		default:
			# code...
			break;
	}

	function TF_exist(){
		$sql = "SELECT * FROM tfquestionbase ORDER BY TFId ASC";
		$result = mysql_query($sql) or die('TF message load error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				if ($field_name == 'TFId') {
					$res[$i]['ID'] = mysql_result($result, $i , $field_name);
				}elseif ($field_name == 'TFDetail') {
					$str = mysql_result($result, $i , $field_name);
					$ArrStr = str_split($str, 60);
					if (count($ArrStr) == 1) {
						$res[$i]['title'] = $ArrStr[0];
					}else{
						$res[$i]['title'] = $ArrStr[0] . '...';
					}
					
				}else{
					$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				}
			}
			$res[$i]['type'] = 'TF';
		}
		echo json_encode($res);
	}

	function CH_exist(){
		$sql = "SELECT * FROM choicequestionbase ORDER BY ChId ASC";
		$result = mysql_query($sql) or die('CH message load error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				if ($field_name == 'ChId') {
					$res[$i]['ID'] = mysql_result($result, $i , $field_name);
				}elseif ($field_name == 'ChDetail') {
					$str = mysql_result($result, $i , $field_name);
					$ArrStr = str_split($str, 60);
					if (count($ArrStr) == 1) {
						$res[$i]['title'] = $ArrStr[0];
					}else{
						$res[$i]['title'] = $ArrStr[0] . '...';
					}
				}else{
					$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				}
			}
			$res[$i]['type'] = 'CH';
		}
		echo json_encode($res);
	}

	function GP_exist(){
		$sql = "SELECT * FROM groupquestionbase ORDER BY GroupID ASC";
		$result = mysql_query($sql) or die('GP message load error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				if ($field_name == 'GroupID') {
					$res[$i]['ID'] = mysql_result($result, $i , $field_name);
				}elseif ($field_name == 'GroupTitle') {
					$str = mysql_result($result, $i , $field_name);
					// $ArrStr = str_split($str, 90);
					// $res[$i]['title'] = $ArrStr[0];
					$res[$i]['title'] = $str;
				}else{
					$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				}
			}
			$res[$i]['type'] = 'GP';
		}
		echo json_encode($res);
	}

	function SA_exist(){
		$sql = "SELECT * FROM short ORDER BY SAId ASC";
		$result = mysql_query($sql) or die('SA message load error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				if ($field_name == 'SAId') {
					$res[$i]['ID'] = mysql_result($result, $i , $field_name);
				}elseif ($field_name == 'SADetail') {
					$str = mysql_result($result, $i , $field_name);
					$ArrStr = str_split($str, 60);
					if (count($ArrStr) == 1) {
						$res[$i]['title'] = $ArrStr[0];
					}else{
						$res[$i]['title'] = $ArrStr[0] . '...';
					}
				}else{
					$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				}
			}
			$res[$i]['type'] = 'SA';
		}
		echo json_encode($res);
	}

	function TF_detail($ID , $owner){
		$sql = "SELECT * FROM tfquestionbase WHERE TFId = '$ID'";
		$result = mysql_query($sql) or die('TF detail message load error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$sql2 = "SELECT imageID FROM imagelink WHERE QType = 'TFQuestion' and QID = '$ID' ORDER BY imageID ASC";
		$result2 = mysql_query($sql2) or die('err3 , gettfimage err');
		$row_num2 = mysql_num_rows($result2);

		$res = array();
		$img = array();
		$img_exist = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				
			}

			for ($r=0; $r < $row_num2; $r++) { 
				$tempImgID = mysql_result($result2, $r);
				array_push($img, $tempImgID);
			}
			$img_exist = image($owner);

			$res[$i]['img_exist'] = $img_exist;
			$res[$i]['IMG'] = $img;
			$res[$i]['type'] = 'TF';
		}
		echo json_encode($res);
	}

	function CH_detail($ID , $owner){
		$sql = "SELECT * FROM choicequestionbase WHERE ChId = '$ID'";
		$result = mysql_query($sql) or die('CH detail message load error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$sql2 = "SELECT imageID FROM imagelink WHERE QType = 'ChoiceQuestion' and QID = '$ID' ORDER BY imageID ASC";
		$result2 = mysql_query($sql2) or die('err3 , getchimage err');
		$row_num2 = mysql_num_rows($result2);

		$res = array();
		$img = array();
		$img_exist = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);
				
				$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				
			}

			for ($r=0; $r < $row_num2; $r++) { 
				$tempImgID = mysql_result($result2, $r);
				array_push($img, $tempImgID);
			}
			$img_exist = image($owner);

			$res[$i]['img_exist'] = $img_exist;
			$res[$i]['IMG'] = $img;
			$res[$i]['type'] = 'CH';
		}
		echo json_encode($res);
	}

	function GP_detail($ID , $owner){
		$sql = "SELECT * FROM groupquestionbase  WHERE GroupID = '$ID' ORDER BY GroupID ASC";
		$result = mysql_query($sql) or die('err2 , getGpData Err');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$sql2 = "SELECT * FROM groupsubquestionbase WHERE GroupID = '$ID' ORDER BY GroupQID ASC";
		$result2 = mysql_query($sql2) or die('err3 , getGpsubData err');
		$row_num2 = mysql_num_rows($result2);
		$field_num2 = mysql_num_fields($result2);

		$sql3 = "SELECT imageID FROM imagelink WHERE QType = 'Group' and QID = '$ID' ORDER BY imageID ASC";
		$result3 = mysql_query($sql3) or die('err3 , getchimage err');
		$row_num3 = mysql_num_rows($result3);

		$gps = array();
		$gp = array();
		$img = array();
		$img_exist = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 

				$field_name = mysql_field_name($result , $j);

				$gp[$i][$field_name] = mysql_result($result, $i , $field_name);

			}


			for ($x=0; $x < $row_num2; $x++) { 
				
				for ($y=0; $y < $field_num2; $y++) { 
					
					$field_name2 = mysql_field_name($result2, $y);

					$gps[0][$field_name2] = mysql_result($result2, $x , $field_name2);

				}

				$temp = "Q" . $x;

				$gp[$i][$temp] = $gps;
			}

			for ($r=0; $r < $row_num3; $r++) { 
				$tempImgID = mysql_result($result3, $r);
				array_push($img, $tempImgID);
			}
			$img_exist = image($owner);

			$gp[$i]['img_exist'] = $img_exist;
			$gp[$i]['IMG'] = $img;
			$gp[$i]['type'] = 'GP';
		}

		echo json_encode($gp);
	}

	function SA_detail($ID){
		$sql = "SELECT * FROM short WHERE SAId = '$ID'";
		$result = mysql_query($sql) or die('SA detail message load error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);
				
				$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				
			}
			$res[$i]['type'] = 'SA';
		}
		echo json_encode($res);
	}

	function TF_delete($ID) {
		$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'TF' AND QID = '$ID'"; 
		$result = mysql_query($sql);
		$c = mysql_result($result, 0);
		
		if ($c) {
			echo $c;
		}
		else{
			$sql = "DELETE from tfquestionbase WHERE TFId = '$ID' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'TF' and QID = '$ID')";
			mysql_query($sql) or die('err1 , tfquestionbase delete error');

			$sql = "DELETE from imagelink WHERE QID = '$ID' and QType = 'TFQuestion' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'TF' and QID = '$ID')";
			mysql_query($sql) or die('TFQuestion delete imagelink error');

			$sql = "DELETE from paperlink WHERE QID = '$ID' and QType = 'TF' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'TF' and QID = '$ID')";
			mysql_query($sql) or die('TFQuestion delete paperlink error');
			
			echo $c;
		}
	}

	function CH_delete($ID) {
		$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'CH' AND QID = '$ID'"; 
		$result = mysql_query($sql);
		$c = mysql_result($result, 0);

		if ($c) {
			echo $c;
		}else{
			$sql = "DELETE from choicequestionbase WHERE ChId = '$ID' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'CH' and QID = '$ID')";
			mysql_query($sql) or die('err2 , choicequestionbase delete error');

			$sql = "DELETE from imagelink WHERE QID = '$ID' and QType = 'ChoiceQuestion' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'CH' and QID = '$ID')";
			mysql_query($sql) or die('TFQuestion delete imagelink error');

			$sql = "DELETE from paperlink WHERE QID = '$ID' and QType = 'CH' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'CH' and QID = '$ID')";
			mysql_query($sql) or die('TFQuestion delete paperlink error');

			echo $c;
		}
	}

	function GP_delete($ID) {
		$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'GP' AND QID = '$ID'"; 
		$result = mysql_query($sql);
		$c = mysql_result($result, 0);

		if ($c) {
			echo $c;
		}else{
			$sql = "DELETE from groupquestionbase WHERE GroupID = '$ID' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'GP' and QID = '$ID')";
			mysql_query($sql) or die('err3 , groupquestionbase delete error');

			$sql = "DELETE from imagelink WHERE QID = '$ID' and QType = 'Group' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'GP' and QID = '$ID')";
			mysql_query($sql) or die('TFQuestion delete imagelink error');

			$sql = "DELETE from paperlink WHERE QID = '$ID' and QType = 'GP' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'GP' and QID = '$ID')";
			mysql_query($sql) or die('TFQuestion delete paperlink error');

			echo $c;
		}
	}

	function SA_delete($ID) {
		$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'SA' AND QID = '$ID'"; 
		$result = mysql_query($sql);
		$c = mysql_result($result, 0);

		if ($c) {
			echo $c;
		}else{
			$sql = "DELETE from short WHERE SAId = '$ID' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'SA' and QID = '$ID')";
			mysql_query($sql) or die('err , SA delete error');

			$sql = "DELETE from paperlink WHERE QID = '$ID' and QType = 'SA' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'SA' and QID = '$ID')";
			mysql_query($sql) or die('SAQuestion delete paperlink error');

			echo $c;
		}
	}

	function image($Aid) {
		$sql = "SELECT * FROM imagetable WHERE owner = '$Aid' ORDER BY imageID ASC";
		$result = mysql_query($sql) or die('err1');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);
		$index = 0;

		$IDTemp = array();
		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				if ($field_name == 'imageID') {
					$imageID = mysql_result($result, $i , $field_name);
					array_push($IDTemp, $imageID);
				}

				$res[$i][$field_name] = mysql_result($result, $i , $field_name);

			}
			$index += 1;
		}

		$sql_count = "SELECT COUNT(*) FROM questionpermission WHERE user = '$Aid'"; 
		$count = mysql_query($sql_count);
		$c = mysql_result($count, 0);

		if ($c > 0) {
			$sql = "SELECT * FROM questionpermission WHERE user = '$Aid'"; 
			$result = mysql_query($sql);
			$permission_row = mysql_num_rows($result);

			for ($a=0; $a < $permission_row; $a++) { 
				$paperID = mysql_result($result, $a , 'paperID');

				$paperlink_sql = "SELECT * FROM paperlink WHERE paperID = '$paperID'";
				$paperlink = mysql_query($paperlink_sql) or die(mysql_error());
				$QID_row = mysql_num_rows($paperlink);

				for ($b=0; $b < $QID_row; $b++) { 
					$typeCheck = mysql_result($paperlink, $b , 'QType');
					$QID = mysql_result($paperlink, $b , 'QID');

					switch ($typeCheck) {
						case 'TF':

							$sql_TFcount = "SELECT COUNT(*) FROM imagelink WHERE QID = '$QID' AND QType = 'TFQuestion'"; 
							$TFcount = mysql_query($sql_TFcount);
							$tf = mysql_result($TFcount, 0);

							if ($tf > 0) {
								$sql_getIMGID = "SELECT imageID FROM imagelink WHERE QID = '$QID' AND QType = 'TFQuestion'";
								$getIMGID = mysql_query($sql_getIMGID) or die('get user tf - image id err');
								$imageID_row = mysql_num_rows($getIMGID);

								for ($q=0; $q < $imageID_row; $q++) { 
									$check = 0;
									$imageID = mysql_result($getIMGID, $q);
									foreach ($IDTemp as $value) {
										if ($imageID == $value) {
											$check += 1;
										}
									}

									if ($check > 0) {
										//重複ID，不放入陣列
									}elseif ($check == 0) {
										array_push($IDTemp, $imageID);
										$sql_tfimg = "SELECT * FROM imagetable WHERE imageID = '$imageID'";
										$result_tfimg = mysql_query($sql_tfimg) or die('err1');
										$field_num_tfimg = mysql_num_fields($result_tfimg);

										for ($temp=0; $temp < $field_num_tfimg; $temp++) { 
											$field_name = mysql_field_name($result_tfimg, $temp);

											$res[$index][$field_name] = mysql_result($result_tfimg, 0 , $field_name);
										}

										$index += 1;
									}else{
										//error
									}
								}
							}
							
							break;

						case 'CH':
							$sql_CHcount = "SELECT COUNT(*) FROM imagelink WHERE QID = '$QID' AND QType = 'ChoiceQuestion'"; 
							$CHcount = mysql_query($sql_CHcount);
							$ch = mysql_result($CHcount, 0);

							if ($ch > 0) {
								$sql_getIMGID = "SELECT imageID FROM imagelink WHERE QID = '$QID' AND QType = 'ChoiceQuestion'";
								$getIMGID = mysql_query($sql_getIMGID) or die('get user ch - image id err');
								$imageID_row = mysql_num_rows($getIMGID);

								for ($q=0; $q < $imageID_row; $q++) { 
									$check = 0;
									$imageID = mysql_result($getIMGID, $q);
									foreach ($IDTemp as $value) {
										if ($imageID == $value) {
											$check += 1;
										}
									}

									if ($check > 0) {
										//重複ID，不放入陣列
									}elseif ($check == 0) {
										array_push($IDTemp, $imageID);
										$sql_chimg = "SELECT * FROM imagetable WHERE imageID = '$imageID'";
										$result_chimg = mysql_query($sql_chimg) or die('err1');
										$field_num_chimg = mysql_num_fields($result_chimg);

										for ($temp=0; $temp < $field_num_chimg; $temp++) { 
											$field_name = mysql_field_name($result_chimg, $temp);

											$res[$index][$field_name] = mysql_result($result_chimg, 0 , $field_name);
										}

										$index += 1;
									}else{
										//error
									}
								}
							}
							break;

						case 'GP':
							$sql_GPcount = "SELECT COUNT(*) FROM imagelink WHERE QID = '$QID' AND QType = 'Group'"; 
							$GPcount = mysql_query($sql_GPcount);
							$gp = mysql_result($GPcount, 0);

							if ($gp > 0) {
								$sql_getIMGID = "SELECT imageID FROM imagelink WHERE QID = '$QID' AND QType = 'Group'";
								$getIMGID = mysql_query($sql_getIMGID) or die('get user gp - image id err');
								$imageID_row = mysql_num_rows($getIMGID);

								for ($q=0; $q < $imageID_row; $q++) { 
									$check = 0;
									$imageID = mysql_result($getIMGID, $q);
									foreach ($IDTemp as $value) {
										if ($imageID == $value) {
											$check += 1;
										}
									}

									if ($check > 0) {
										//重複ID，不放入陣列
									}elseif ($check == 0) {
										array_push($IDTemp, $imageID);
										$sql_gpimg = "SELECT * FROM imagetable WHERE imageID = '$imageID'";
										$result_gpimg = mysql_query($sql_gpimg) or die('err1');
										$field_num_gpimg = mysql_num_fields($result_gpimg);

										for ($temp=0; $temp < $field_num_gpimg; $temp++) { 
											$field_name = mysql_field_name($result_gpimg, $temp);

											$res[$index][$field_name] = mysql_result($result_gpimg, 0 , $field_name);
										}

										$index += 1;
									}else{
										//error
									}
								}
							}
							break;

						case 'SA':
							# code...
							break;
						
						default:
							# code...
							break;
					}
				}
			}
		}

		$sql_count = "SELECT COUNT(*) FROM questionpermission WHERE owner = '$Aid'"; 
		$count = mysql_query($sql_count);
		$c = mysql_result($count, 0);

		if ($c > 0) {
			$sql = "SELECT * FROM questionpermission WHERE owner = '$Aid'"; 
			$result = mysql_query($sql);
			$permission_row = mysql_num_rows($result);

			for ($a=0; $a < $permission_row; $a++) { 
				$paperID = mysql_result($result, $a , 'paperID');

				$paperlink_sql = "SELECT * FROM paperlink WHERE paperID = '$paperID'";
				$paperlink = mysql_query($paperlink_sql) or die(mysql_error());
				$QID_row = mysql_num_rows($paperlink);

				for ($b=0; $b < $QID_row; $b++) { 
					$typeCheck = mysql_result($paperlink, $b , 'QType');
					$QID = mysql_result($paperlink, $b , 'QID');

					switch ($typeCheck) {
						case 'TF':

							$sql_TFcount = "SELECT COUNT(*) FROM imagelink WHERE QID = '$QID' AND QType = 'TFQuestion'"; 
							$TFcount = mysql_query($sql_TFcount);
							$tf = mysql_result($TFcount, 0);

							if ($tf > 0) {
								$sql_getIMGID = "SELECT imageID FROM imagelink WHERE QID = '$QID' AND QType = 'TFQuestion'";
								$getIMGID = mysql_query($sql_getIMGID) or die('get owner tf - image id err');
								$imageID_row = mysql_num_rows($getIMGID);

								for ($q=0; $q < $imageID_row; $q++) { 
									$check = 0;
									$imageID = mysql_result($getIMGID, $q);
									foreach ($IDTemp as $value) {
										if ($imageID == $value) {
											$check += 1;
										}
									}

									if ($check > 0) {
										//重複ID，不放入陣列
									}elseif ($check == 0) {
										array_push($IDTemp, $imageID);
										$sql_tfimg = "SELECT * FROM imagetable WHERE imageID = '$imageID'";
										$result_tfimg = mysql_query($sql_tfimg) or die('err1');
										$field_num_tfimg = mysql_num_fields($result_tfimg);

										for ($temp=0; $temp < $field_num_tfimg; $temp++) { 
											$field_name = mysql_field_name($result_tfimg, $temp);

											$res[$index][$field_name] = mysql_result($result_tfimg, 0 , $field_name);
										}

										$index += 1;
									}else{
										//error
									}
								}
							}
							
							break;

						case 'CH':
							$sql_CHcount = "SELECT COUNT(*) FROM imagelink WHERE QID = '$QID' AND QType = 'ChoiceQuestion'"; 
							$CHcount = mysql_query($sql_CHcount);
							$ch = mysql_result($CHcount, 0);

							if ($ch > 0) {
								$sql_getIMGID = "SELECT imageID FROM imagelink WHERE QID = '$QID' AND QType = 'ChoiceQuestion'";
								$getIMGID = mysql_query($sql_getIMGID) or die('get owner ch - image id err');
								$imageID_row = mysql_num_rows($getIMGID);

								for ($q=0; $q < $imageID_row; $q++) { 
									$check = 0;
									$imageID = mysql_result($getIMGID, $q);
									foreach ($IDTemp as $value) {
										if ($imageID == $value) {
											$check += 1;
										}
									}

									if ($check > 0) {
										//重複ID，不放入陣列
									}elseif ($check == 0) {
										array_push($IDTemp, $imageID);
										$sql_chimg = "SELECT * FROM imagetable WHERE imageID = '$imageID'";
										$result_chimg = mysql_query($sql_chimg) or die('err1');
										$field_num_chimg = mysql_num_fields($result_chimg);

										for ($temp=0; $temp < $field_num_chimg; $temp++) { 
											$field_name = mysql_field_name($result_chimg, $temp);

											$res[$index][$field_name] = mysql_result($result_chimg, 0 , $field_name);
										}

										$index += 1;
									}else{
										//error
									}
								}
							}
							break;

						case 'GP':
							$sql_GPcount = "SELECT COUNT(*) FROM imagelink WHERE QID = '$QID' AND QType = 'Group'"; 
							$GPcount = mysql_query($sql_GPcount);
							$gp = mysql_result($GPcount, 0);

							if ($gp > 0) {
								$sql_getIMGID = "SELECT imageID FROM imagelink WHERE QID = '$QID' AND QType = 'Group'";
								$getIMGID = mysql_query($sql_getIMGID) or die('get owner gp - image id err');
								$imageID_row = mysql_num_rows($getIMGID);

								for ($q=0; $q < $imageID_row; $q++) { 
									$check = 0;
									$imageID = mysql_result($getIMGID, $q);
									foreach ($IDTemp as $value) {
										if ($imageID == $value) {
											$check += 1;
										}
									}

									if ($check > 0) {
										//重複ID，不放入陣列
									}elseif ($check == 0) {
										array_push($IDTemp, $imageID);
										$sql_gpimg = "SELECT * FROM imagetable WHERE imageID = '$imageID'";
										$result_gpimg = mysql_query($sql_gpimg) or die('err1');
										$field_num_gpimg = mysql_num_fields($result_gpimg);

										for ($temp=0; $temp < $field_num_gpimg; $temp++) { 
											$field_name = mysql_field_name($result_gpimg, $temp);

											$res[$index][$field_name] = mysql_result($result_gpimg, 0 , $field_name);
										}

										$index += 1;
									}else{
										//error
									}
								}
							}
							break;

						case 'SA':
							# code...
							break;
						
						default:
							# code...
							break;
					}
				}
			}
		}
		return $res;
	}
?>
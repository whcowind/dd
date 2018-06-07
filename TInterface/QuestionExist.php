<?php
	require 'connectdb.php';
?>

<?php

	$QExixt = $_GET['Type'];

	switch ($QExixt) {
		case 'TFQExixt':
			$Aid = $_GET['Aid'];
			TF($Aid);
			break;

		case 'TFQuestion':
			$id = $_GET['TFId'];
			getTFData($id);
			break;

		case 'CHQExist':
			$Aid = $_GET['Aid'];
			CH($Aid);
			break;

		case 'ChQuestion':
			$id = $_GET['ChId'];
			getChData($id);
			break;

		case 'GPExist':
			$Aid = $_GET['Aid'];
			GP($Aid);
			break;

		case 'GpQuestion':
			$id = $_GET['GpId'];
			getGpData($id);
			break;

		case 'SAExist':
			$Aid = $_GET['Aid'];
			SA($Aid);
			break;

		case 'SAQuestion':
			$id = $_GET['SAId'];
			getSAData($id);
			break;
		
		default:
			# code...
			break;
	}




	function TF($Aid){
		$sql = "SELECT * FROM tfquestionbase WHERE owner = '$Aid' ORDER BY TFId ASC";
		$result = mysql_query($sql) or die('err1');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);
		$temp = 0;

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				$res[$i][$field_name] = mysql_result($result, $i , $field_name);

			}
			$temp += 1;
		}

		$sql_count = "SELECT COUNT(*) FROM questionpermission WHERE user = '$Aid'"; 
		$count = mysql_query($sql_count);
		$c = mysql_result($count, 0);

		if ($c > 0) {
			$sql = "SELECT * FROM questionpermission WHERE user = '$Aid'"; 
			$result = mysql_query($sql);
			$permission_row = mysql_num_rows($result);

			for ($i=0; $i < $permission_row; $i++) { 
				$paperID = mysql_result($result, $i , 'paperID');

				$paperlink_sql = "SELECT * FROM paperlink WHERE paperID = '$paperID'";
				$paperlink = mysql_query($paperlink_sql) or die(mysql_error());
				$QID_row = mysql_num_rows($paperlink);
				
				for ($x=0; $x < $QID_row; $x++) { 
					$typeCheck = mysql_result($paperlink, $x , 'QType');
					
					if ($typeCheck == 'TF') {
						$TFId = mysql_result($paperlink, $x , 'QID');

						$getQ = "SELECT * FROM tfquestionbase WHERE TFId = '$TFId'";
						$getQResult = mysql_query($getQ) or die(mysql_error());
						$GetQFieldNum = mysql_num_fields($getQResult);

						for ($y=0; $y < $GetQFieldNum; $y++) { 
							$field_name = mysql_field_name($getQResult, $y);

							$res[$temp][$field_name] = mysql_result($getQResult, 0 , $field_name);
						}
						$temp += 1;
					}
				}
			}
		}


		echo json_encode($res);

	}

	function CH($Aid){
		$sql = "SELECT * FROM choicequestionbase WHERE owner = '$Aid' ORDER BY ChId ASC";
		$result = mysql_query($sql) or die('err1');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);
		$temp = 0;

		$res2 = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				$res2[$i][$field_name] = mysql_result($result, $i , $field_name);

			}
			$temp += 1;
		}

		$sql_count = "SELECT COUNT(*) FROM questionpermission WHERE user = '$Aid'"; 
		$count = mysql_query($sql_count);
		$c = mysql_result($count, 0);

		if ($c > 0) {
			$sql = "SELECT * FROM questionpermission WHERE user = '$Aid'"; 
			$result = mysql_query($sql);
			$permission_row = mysql_num_rows($result);

			for ($i=0; $i < $permission_row; $i++) { 
				$paperID = mysql_result($result, $i , 'paperID');

				$paperlink_sql = "SELECT * FROM paperlink WHERE paperID = '$paperID'";
				$paperlink = mysql_query($paperlink_sql) or die(mysql_error());
				$QID_row = mysql_num_rows($paperlink);
				
				for ($x=0; $x < $QID_row; $x++) { 
					$typeCheck = mysql_result($paperlink, $x , 'QType');
					
					if ($typeCheck == 'CH') {
						$CHId = mysql_result($paperlink, $x , 'QID');

						$getQ = "SELECT * FROM choicequestionbase WHERE ChId = '$CHId'";
						$getQResult = mysql_query($getQ) or die(mysql_error());
						$GetQFieldNum = mysql_num_fields($getQResult);

						for ($y=0; $y < $GetQFieldNum; $y++) { 
							$field_name = mysql_field_name($getQResult, $y);

							$res2[$temp][$field_name] = mysql_result($getQResult, 0 , $field_name);
						}
						$temp += 1;
					}
				}
			}
		}

		echo json_encode($res2);

	}

	function GP($Aid){
		$sql = "SELECT * FROM groupquestionbase WHERE owner = '$Aid' ORDER BY GroupID ASC";
		$result = mysql_query($sql) or die('err1');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);
		$temp = 0;

		$res3 = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				$res3[$i][$field_name] = mysql_result($result, $i , $field_name);

			}
			$temp += 1;
		}

		$sql_count = "SELECT COUNT(*) FROM questionpermission WHERE user = '$Aid'"; 
		$count = mysql_query($sql_count);
		$c = mysql_result($count, 0);

		if ($c > 0) {
			$sql = "SELECT * FROM questionpermission WHERE user = '$Aid'"; 
			$result = mysql_query($sql);
			$permission_row = mysql_num_rows($result);

			for ($i=0; $i < $permission_row; $i++) { 
				$paperID = mysql_result($result, $i , 'paperID');

				$paperlink_sql = "SELECT * FROM paperlink WHERE paperID = '$paperID'";
				$paperlink = mysql_query($paperlink_sql) or die(mysql_error());
				$QID_row = mysql_num_rows($paperlink);
				
				for ($x=0; $x < $QID_row; $x++) { 
					$typeCheck = mysql_result($paperlink, $x , 'QType');
					
					if ($typeCheck == 'GP') {
						$GroupID = mysql_result($paperlink, $x , 'QID');

						$getQ = "SELECT * FROM groupquestionbase WHERE GroupID = '$GroupID'";
						$getQResult = mysql_query($getQ) or die(mysql_error());
						$GetQFieldNum = mysql_num_fields($getQResult);

						for ($y=0; $y < $GetQFieldNum; $y++) { 
							$field_name = mysql_field_name($getQResult, $y);

							$res3[$temp][$field_name] = mysql_result($getQResult, 0 , $field_name);
						}
						$temp += 1;
					}
				}
			}
		}

		echo json_encode($res3);

	}

	function SA($Aid){
		$sql = "SELECT * FROM short WHERE owner = '$Aid' ORDER BY SAId ASC";
		$result = mysql_query($sql) or die('err-sa');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);
		$temp = 0;

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				$res[$i][$field_name] = mysql_result($result, $i , $field_name);

			}
			$temp += 1;
		}

		$sql_count = "SELECT COUNT(*) FROM questionpermission WHERE user = '$Aid'"; 
		$count = mysql_query($sql_count);
		$c = mysql_result($count, 0);

		if ($c > 0) {
			$sql = "SELECT * FROM questionpermission WHERE user = '$Aid'"; 
			$result = mysql_query($sql);
			$permission_row = mysql_num_rows($result);

			for ($i=0; $i < $permission_row; $i++) { 
				$paperID = mysql_result($result, $i , 'paperID');

				$paperlink_sql = "SELECT * FROM paperlink WHERE paperID = '$paperID'";
				$paperlink = mysql_query($paperlink_sql) or die(mysql_error());
				$QID_row = mysql_num_rows($paperlink);
				
				for ($x=0; $x < $QID_row; $x++) { 
					$typeCheck = mysql_result($paperlink, $x , 'QType');
					
					if ($typeCheck == 'SA') {
						$SAId = mysql_result($paperlink, $x , 'QID');

						$getQ = "SELECT * FROM short WHERE SAId = '$SAId'";
						$getQResult = mysql_query($getQ) or die(mysql_error());
						$GetQFieldNum = mysql_num_fields($getQResult);

						for ($y=0; $y < $GetQFieldNum; $y++) { 
							$field_name = mysql_field_name($getQResult, $y);

							$res[$temp][$field_name] = mysql_result($getQResult, 0 , $field_name);
						}
						$temp += 1;
					}
				}
			}
		}

		echo json_encode($res);

	}


	function getTFData($tfid) {
		$sql = "SELECT * FROM tfquestionbase WHERE TFId = '$tfid' ORDER BY TFId ASC";
		$result = mysql_query($sql) or die('err2 , getTFData Err');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$sql2 = "SELECT imageID FROM imagelink WHERE QType = 'TFQuestion' and QID = '$tfid' ORDER BY imageID ASC";
		$result2 = mysql_query($sql2) or die('err3 , gettfimage err');
		$row_num2 = mysql_num_rows($result2);
		
		

		$tf = array();
		$tfimg = array();

		for ($i=0; $i<$row_num; $i++) {

			for ($j=0; $j<$field_num; $j++) {

				$field_name = mysql_field_name($result , $j);

				$tf[$i][$field_name] = mysql_result($result, $i , $field_name);

			}

			for ($r=0; $r < $row_num2; $r++) { 
				$tfimg = array();
				$tempImgID = mysql_result($result2, $r);
				// $sql3 = "SELECT imageURL FROM imagetable WHERE imageID = '$tempImgID' ORDER BY imageID ASC";
				// $result3 = mysql_query($sql3) or die('err33');
				// $imgURLresult = mysql_result($result3, 0);
				// array_push($tfimg, $imgURLresult);
				array_push($tfimg, $tempImgID);

				$temp = "IMG" . $r;

				$tf[$i][$temp] = $tfimg;

			}

		}
		echo json_encode($tf);

	}

	function getChData($chid) {
		$sql = "SELECT * FROM choicequestionbase WHERE ChId = '$chid' ORDER BY ChId ASC";
		$result = mysql_query($sql) or die('err2 , getChData Err');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$sql2 = "SELECT imageID FROM imagelink WHERE QType = 'ChoiceQuestion' and QID = '$chid' ORDER BY imageID ASC";
		$result2 = mysql_query($sql2) or die('err3 , getchimage err');
		$row_num2 = mysql_num_rows($result2);

		$ch = array();
		$chimg = array();

		for ($i=0; $i<$row_num; $i++) {

			for ($j=0; $j<$field_num; $j++) {

				$field_name = mysql_field_name($result , $j);

				$ch[$i][$field_name] = mysql_result($result, $i , $field_name);

			}

			for ($r=0; $r < $row_num2; $r++) { 
				$chimg = array();
				$tempImgID = mysql_result($result2, $r);
				// $sql3 = "SELECT imageURL FROM imagetable WHERE imageID = '$tempImgID' ORDER BY imageID ASC";
				// $result3 = mysql_query($sql3) or die('err33');
				// $imgURLresult = mysql_result($result3, 0);
				// array_push($chimg, $imgURLresult);
				array_push($chimg, $tempImgID);

				$temp = "IMG" . $r;

				$ch[$i][$temp] = $chimg;

			}

		}
		echo json_encode($ch);

	}

	function getGpData($gpid){
		$sql = "SELECT * FROM groupquestionbase  WHERE GroupID = '$gpid' ORDER BY GroupID ASC";
		$result = mysql_query($sql) or die('err2 , getGpData Err');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$sql2 = "SELECT * FROM groupsubquestionbase WHERE GroupID = '$gpid' ORDER BY GroupQID ASC";
		$result2 = mysql_query($sql2) or die('err3 , getGpsubData err');
		$row_num2 = mysql_num_rows($result2);
		$field_num2 = mysql_num_fields($result2);

		$sql3 = "SELECT imageID FROM imagelink WHERE QType = 'Group' and QID = '$gpid' ORDER BY imageID ASC";
		$result3 = mysql_query($sql3) or die('err3 , getchimage err');
		$row_num3 = mysql_num_rows($result3);

		$gpimgtemp = array();
		$gpimg = array();
		$gps = array();
		$gp = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 

				$field_name = mysql_field_name($result , $j);

				$gp[$i][$field_name] = mysql_result($result, $i , $field_name);

			}


			for ($x=0; $x < $row_num2; $x++) { 
				// $gps = array();
				
				for ($y=0; $y < $field_num2; $y++) { 
					
					$field_name2 = mysql_field_name($result2, $y);

					$gps[$field_name2] = mysql_result($result2, $x , $field_name2);

				}

				// $temp = "Q" . $x;

				$gp[$i][$x] = $gps;

				// unset($gps);


			}

			for ($r=0; $r < $row_num3; $r++) { 
				$gpimg = array();
				$tempImgID = mysql_result($result3, $r);
				// $sql3 = "SELECT imageURL FROM imagetable WHERE imageID = '$tempImgID' ORDER BY imageID ASC";
				// $result3 = mysql_query($sql3) or die('err33');
				// $imgURLresult = mysql_result($result3, 0);
				// array_push($gpimg, $imgURLresult);
				array_push($gpimg, $tempImgID);

				$temp = "IMG" . $r;

				$gpimgtemp[$i][$temp] = $gpimg;

			}
			$gp[$i]['IMGID'] = $gpimgtemp;

		}

		echo json_encode($gp);

	}

	function getSAData($SAId) {
		$sql = "SELECT * FROM short WHERE SAId = '$SAId' ORDER BY SAId ASC";
		$result = mysql_query($sql) or die('err2 , getSAData Err');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);
		

		$sql2 = "SELECT imageID FROM imagelink WHERE QType = 'SAQuestion' and QID = '$SAId' ORDER BY imageID ASC";
		$result2 = mysql_query($sql2) or die('err3 , getSAimage err');
		$row_num2 = mysql_num_rows($result2);
		
		

		$sa = array();
		$saimg = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				$sa[$i][$field_name] = mysql_result($result, $i , $field_name);

			}
			
			for ($r=0; $r < $row_num2; $r++) { 
				$saimg = array();
				$tempImgID = mysql_result($result2, $r);

				array_push($saimg, $tempImgID);

				$temp = "IMG" . $r;

				$sa[$i][$temp] = $saimg;

			}
		}
		echo json_encode($sa);

		

	}
?>
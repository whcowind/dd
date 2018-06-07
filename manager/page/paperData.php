<?php
	require 'connectdb.php';
?>

<?php

	$type = $_POST['type'];

	switch ($type) {
		case 'getPaperData':
			$ID = $_POST['ID'];
			$owner = $_POST['owner'];

			getPaperData($ID , $owner);
			break;

		case 'paperTF':
			$owner = $_POST['owner'];
			paperTF($owner);
			break;

		case 'paperCH':
			$owner = $_POST['owner'];
			paperCH($owner);
			break;

		case 'paperGP':
			$owner = $_POST['owner'];
			paperGP($owner);
			break;

		case 'paperSA':
			$owner = $_POST['owner'];
			paperSA($owner);
			break;

		case 'paperP':
			$owner = $_POST['owner'];
			paperP($owner);
			break;

		case 'paperUpdate':
			$id = $_POST['id'];
			$owner = $_POST['owner'];
			$PTitle = $_POST['PTitle'];
			$PExplan = $_POST['PExplan'];
			$TFArr = $_POST['TFArr'];
			$CHArr = $_POST['CHArr'];
			$GPArr = $_POST['GPArr'];
			$SAArr = $_POST['SAArr'];
			$PArr = $_POST['PArr'];

			$sql_count = "SELECT COUNT(*) FROM allocate WHERE paperID = '$id'"; 
			$count = mysql_query($sql_count);
			$c = mysql_result($count, 0);

			if ($c > 0) {
				echo $c;
			}else{
				$sql = "UPDATE paperbase SET PTitle = '$PTitle' , PExplan = '$PExplan' WHERE paperID = '$id'";
				mysql_query($sql) or die('update error');


				$sql = "DELETE FROM paperlink WHERE paperID = '$id'";
				mysql_query($sql) or die('err');

				paperlinkTF($TFArr , $id);
				paperlinkCH($CHArr , $id);
				paperlinkGP($GPArr , $id , $SAArr);

				$sqlD = "DELETE FROM questionpermission WHERE owner = '$owner' AND paperID = '$id'";
				mysql_query($sqlD) or die('delete permission error');

				if (count($PArr) > 0) {

					for ($i=0; $i < count($PArr); $i++) { 
						$PTemp = '';
						$PTemp = $PArr[$i];

						$sql = "INSERT INTO questionpermission (owner , user , paperID)
						VALUES ('$owner' , '$PTemp' , '$id')";
						mysql_query($sql) or die('insert permission error');
					}

				}
			}
			break;

		case 'paperDelete':
			$ID = $_POST['ID'];

			$sqlD = "DELETE FROM paperbase WHERE paperID = '$ID'";
			mysql_query($sqlD) or die('delete paper error');
			break;
		
		default:
			# code...
			break;
	}

	function paperlinkTF($TF , $PID) {
		if(count($TF) > 0){
			for ($i=0; $i < count($TF); $i++) { 
				$PTFTemp = '';
				$PTFTemp = $TF[$i];

				$sql = "INSERT INTO paperlink (paperID , QID , QType)
				VALUES ('$PID' , '$PTFTemp' , 'TF')";
				mysql_query($sql) or die('insert paperlink with tf error');
			}
		}
	}

	function paperlinkCH($CH , $PID) {
		if (count($CH) > 0) {
			
			for ($j=0; $j < count($CH); $j++) { 
				$PCHTemp = '';
				$PCHTemp = $CH[$j];

				$sql = "INSERT INTO paperlink (paperID , QID , QType)
				VALUES ('$PID' , '$PCHTemp' , 'CH')";
				mysql_query($sql) or die('insert paperlink with ch error');
			}
			
		}
	}

	function paperlinkGP($GP , $PID , $SA) {
		if (count($GP) > 0) {
			
			for ($k=0; $k < count($GP); $k++) { 
				$PGPTemp = '';
				$PGPTemp = $GP[$k];

				$sql = "INSERT INTO paperlink (paperID , QID , QType)
				VALUES ('$PID' , '$PGPTemp' , 'GP')";
				mysql_query($sql) or die('insert paperlink with gp error');
			}
			paperlinkSA($SA , $PID);
		}else{
			paperlinkSA($SA , $PID);
		}
	}

	function paperlinkSA($SA , $PID) {
		if(count($SA) > 0){
			for ($i=0; $i < count($SA); $i++) { 
				$PSATemp = '';
				$PSATemp = $SA[$i];

				$sql = "INSERT INTO paperlink (paperID , QID , QType)
				VALUES ('$PID' , '$PSATemp' , 'SA')";
				mysql_query($sql) or die('insert paperlink with SA error');
			}
		}
	}


	function getPaperData($id , $Aid) {
		$sql = "SELECT * FROM paperbase WHERE paperID = '$id' ORDER BY paperID ASC";
		$result = mysql_query($sql) or die('err , getPaperData Err');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$sql2 = "SELECT QID FROM paperlink WHERE QType = 'TF' and paperID = '$id' ORDER BY paperID ASC";
		$result2 = mysql_query($sql2) or die('err3');
		$row_num2 = mysql_num_rows($result2);
		$field_num2 = mysql_num_fields($result2);

		$sql3 = "SELECT QID FROM paperlink WHERE QType = 'CH' and paperID = '$id' ORDER BY paperID ASC";
		$result3 = mysql_query($sql3) or die('err4');
		$row_num3 = mysql_num_rows($result3);
		$field_num3 = mysql_num_fields($result3);

		$sql4 = "SELECT QID FROM paperlink WHERE QType = 'GP' and paperID = '$id' ORDER BY paperID ASC";
		$result4 = mysql_query($sql4) or die('err5');
		$row_num4 = mysql_num_rows($result4);
		$field_num4 = mysql_num_fields($result4);

		$sql5 = "SELECT QID FROM paperlink WHERE QType = 'SA' and paperID = '$id' ORDER BY paperID ASC";
		$result5 = mysql_query($sql5) or die('err3');
		$row_num5 = mysql_num_rows($result5);
		$field_num5 = mysql_num_fields($result5);

		$sql6 = "SELECT user FROM questionpermission WHERE owner = '$Aid' AND paperID = '$id' ORDER BY user ASC";
		$result6 = mysql_query($sql6) or die('teacher data error');
		$row_num6 = mysql_num_rows($result6);
		$field_num6 = mysql_num_fields($result6);


		$paper = array();
		$paperTF = array();
		$paperCH = array();
		$paperGP = array();
		$paperSA = array();
		$paperP = array();
		$paperTFTemp = array();
		$paperCHTemp = array();
		$paperGPTemp = array();
		$paperSATemp = array();
		$paperPTemp = array();



		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 

				$field_name = mysql_field_name($result , $j);

				$paper[$i][$field_name] = mysql_result($result, $i , $field_name);

			}


			//paper tf
			for ($x=0; $x < $row_num2; $x++) { 
				
				for ($y=0; $y < $field_num2; $y++) { 
					
					$field_name2 = mysql_field_name($result2, $y);

					$paperTF[$field_name2] = mysql_result($result2, $x , $field_name2);

				}
				$temptf = "Q" . $x;

				$paperTFTemp[$i][$temptf] = $paperTF;
			}

			//paper ch
			for ($a=0; $a < $row_num3; $a++) { 
				
				for ($b=0; $b < $field_num3; $b++) { 
					
					$field_name3 = mysql_field_name($result3, $b);

					$paperCH[$field_name3] = mysql_result($result3, $a , $field_name3);
				}
				$tempch = "Q" . $a;

				$paperCHTemp[$i][$tempch] = $paperCH;
			}

			//paper gp
			for ($e=0; $e < $row_num4; $e++) { 
				
				for ($f=0; $f < $field_num4; $f++) { 
					
					$field_name4 = mysql_field_name($result4, $f);

					$paperGP[$field_name4] = mysql_result($result4, $e , $field_name4);
				}
				$tempgp = "Q" . $e;

				$paperGPTemp[$i][$tempgp] = $paperGP;
			}

			//paper sa
			for ($c=0; $c < $row_num5; $c++) { 
				
				for ($d=0; $d < $field_num5; $d++) { 
					
					$field_name5 = mysql_field_name($result5, $d);

					$paperSA[$field_name5] = mysql_result($result5, $c , $field_name5);

				}
				$tempsa = "Q" . $c;

				$paperSATemp[$i][$tempsa] = $paperSA;
			}

			//paper teacher list
			for ($g=0; $g < $row_num6; $g++) { 
				
				for ($h=0; $h < $field_num6; $h++) { 
					
					$field_name6 = mysql_field_name($result6, $h);

					$paperP[$field_name6] = mysql_result($result6, $g , $field_name6);
					
				}

				$tempsa = "Q" . $g;

				$paperPTemp[$i][$tempsa] = $paperP;
			}

			$paper[$i]['TF'] = $paperTFTemp;
			$paper[$i]['CH'] = $paperCHTemp;
			$paper[$i]['GP'] = $paperGPTemp;
			$paper[$i]['SA'] = $paperSATemp;
			$paper[$i]['P'] = $paperPTemp;

		}

		 echo json_encode($paper);
	}


	function paperTF($Aid) {
		
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

	function paperCH($Aid){
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

	function paperGP($Aid){
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

	function paperSA($Aid) {
		
		$sql = "SELECT * FROM short WHERE owner = '$Aid' ORDER BY SAId ASC";
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

	function paperP($Aid) {
		$sql = "SELECT * FROM admin_data ORDER BY addTime ASC";
		$result = mysql_query($sql) or die('teacher message load error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 

				$ID = mysql_result($result, $i , 'Aid');

				// if ($ID != $Aid) {
					$field_name = mysql_field_name($result, $j);

					$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				// }

			}
		}
		echo json_encode($res);
	}

?>
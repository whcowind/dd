<?php
	require 'connectdb.php';
?>

<?php
	$Type = $_GET['Type'];

	switch ($Type) {
		case 'paperTF':
			$Aid = $_GET['Aid'];
			paperTF($Aid);
			break;

		case 'paperCH':
			$Aid = $_GET['Aid'];
			paperCH($Aid);
			break;
		
		case 'paperGP':
			$Aid = $_GET['Aid'];
			paperGP($Aid);
			break;

		case 'paperExist':
			$Aid = $_GET['Aid'];
			paperExist($Aid);
			break;

		case 'paperSA':
			$Aid = $_GET['Aid'];
			paperSA($Aid);
			break;

		case 'paperP':
			$Aid = $_GET['Aid'];
			paperP($Aid);
			break;

		default:
			# code...
			break;
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

				if ($ID != $Aid) {
					$field_name = mysql_field_name($result, $j);

					$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				}

			}
		}
		echo json_encode($res);
	}

	function paperExist($Aid){
		$sql = "SELECT * FROM paperbase WHERE owner = '$Aid' ORDER BY paperID ASC";
		$result = mysql_query($sql) or die('err1');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);
		$temp = 0;

		$res4 = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				$res4[$i][$field_name] = mysql_result($result, $i , $field_name);

				$res4[$i]['own'] = 1;

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

				$paper_sql = "SELECT * FROM paperbase WHERE paperID = '$paperID'";
				$paper = mysql_query($paper_sql) or die(mysql_error());
				$paper_row = mysql_num_rows($paper);
				$paper_field = mysql_num_fields($paper);
				
				for ($x=0; $x < $paper_row; $x++) { 

					for ($y=0; $y < $paper_field; $y++) { 
						$field_name = mysql_field_name($paper, $y);

						$res4[$temp][$field_name] = mysql_result($paper, $x , $field_name);

						$res4[$temp]['own'] = 0;
					}
					$temp += 1;
				}
			}
		}

		echo json_encode($res4);

	}
?>
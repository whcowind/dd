	<?php
	require 'connectdb.php';
?>

<?php

	$Aid = $_GET['Aid'];
	
	image($Aid);

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


		echo json_encode($res);
	}
?>
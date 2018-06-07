<?php
	require 'connectdb.php'
?>

<?php
	$Type = $_POST['Type'];


	switch ($Type) {
		case 'createPreviewTF':
			$selectPaperTF = $_POST['selectPaperTF'];
			$res = array();

			for ($i=0; $i < count($selectPaperTF); $i++) { 
				$temp = '';
				$temp = $selectPaperTF[$i];
				$sql = "SELECT * FROM tfquestionbase WHERE TFId = '$temp' ORDER BY TFID ASC";
				$result = mysql_query($sql) or die('err');
				$field_num = mysql_num_fields($result);

				for ($b=0; $b < $field_num; $b++) { 
					
					$field_name = mysql_field_name($result, $b);

					$res[$i][$field_name] = mysql_result($result, 0 , $field_name);

				}

				unset($img);
				$img = array();

				$sql = "SELECT imageID FROM imagelink WHERE QType = 'TFQuestion' and QID = '$temp' ORDER BY imageID ASC";
				$result = mysql_query($sql) or die('err1');
				$row_num = mysql_num_rows($result);

				for ($x=0; $x < $row_num; $x++) { 
					
					$imgID = mysql_result($result, $x);

					$sql = "SELECT imageURL FROM imagetable WHERE imageID = '$imgID'";
					$imgURL = mysql_query($sql) or die('err2');
					$img[$x]['IMGURL'] = mysql_result($imgURL, 0);

				}
				$res[$i]['IMG'] = $img;
			}

			echo json_encode($res);
			break;

		case 'createPreviewCH':
			$selectPaperCH = $_POST['selectPaperCH'];
			$res = array();

			for ($i=0; $i < count($selectPaperCH); $i++) { 
				$temp = '';
				$temp = $selectPaperCH[$i];
				$sql = "SELECT * FROM choicequestionbase WHERE ChId = '$temp' ORDER BY ChId ASC";
				$result = mysql_query($sql) or die('err');
				$field_num = mysql_num_fields($result);

				for ($b=0; $b < $field_num; $b++) { 
					
					$field_name = mysql_field_name($result, $b);

					$res[$i][$field_name] = mysql_result($result, 0 , $field_name);

				}

				unset($img);
				$img = array();

				$sql = "SELECT imageID FROM imagelink WHERE QType = 'ChoiceQuestion' and QID = '$temp' ORDER BY imageID ASC";
				$result = mysql_query($sql) or die('err1');
				$row_num = mysql_num_rows($result);

				for ($x=0; $x < $row_num; $x++) { 
					
					$imgID = mysql_result($result, $x);

					$sql = "SELECT imageURL FROM imagetable WHERE imageID = '$imgID'";
					$imgURL = mysql_query($sql) or die('err2');
					$img[$x]['IMGURL'] = mysql_result($imgURL, 0);

				}
				$res[$i]['IMG'] = $img;
			}

			echo json_encode($res);
			break;

		case 'createPreviewGP':
			$selectPaperGP = $_POST['selectPaperGP'];
			$res = array();

			for ($i=0; $i < count($selectPaperGP); $i++) { 
				$temp = '';
				$temp = $selectPaperGP[$i];
				$sql = "SELECT * FROM groupquestionbase WHERE GroupID = '$temp' ORDER BY GroupID ASC";
				$result = mysql_query($sql) or die('err');
				$field_num = mysql_num_fields($result);

				for ($b=0; $b < $field_num; $b++) { 
					
					$field_name = mysql_field_name($result, $b);

					$res[$i][$field_name] = mysql_result($result, 0 , $field_name);

				}

				$sql = "SELECT * FROM groupsubquestionbase WHERE GroupID = '$temp' ORDER BY GroupQID ASC";
				$result = mysql_query($sql) or die('err4');
				$row_num = mysql_num_rows($result);
				$field_num = mysql_num_fields($result);

				unset($sub);
				$sub = array();

				for ($x=0; $x < $row_num; $x++) { 
					for ($y=0; $y < $field_num; $y++) { 
						
						$field_name = mysql_field_name($result, $y);

						$sub[$x][$field_name] = mysql_result($result, $x , $field_name);
					}
				}
				$res[$i]['sub'] = $sub;

				unset($img);
				$img = array();

				$sql = "SELECT imageID FROM imagelink WHERE QType = 'Group' and QID = '$temp' ORDER BY imageID ASC";
				$result = mysql_query($sql) or die('err1');
				$row_num = mysql_num_rows($result);

				for ($x=0; $x < $row_num; $x++) { 
					
					$imgID = mysql_result($result, $x);

					$sql = "SELECT imageURL FROM imagetable WHERE imageID = '$imgID'";
					$imgURL = mysql_query($sql) or die('err2');
					$img[$x]['IMGID'] = $imgID;
					$img[$x]['IMGURL'] = mysql_result($imgURL, 0);

				}
				$res[$i]['IMG'] = $img;
			}
			echo json_encode($res);

			break;

		case 'createPreviewSA':
			$selectPaperSA = $_POST['selectPaperSA'];
			$res = array();

			for ($i=0; $i < count($selectPaperSA); $i++) { 
				$temp = '';
				$temp = $selectPaperSA[$i];
				$sql = "SELECT * FROM short WHERE SAId = '$temp' ORDER BY SAId ASC";
				$result = mysql_query($sql) or die('err');
				$field_num = mysql_num_fields($result);

				for ($b=0; $b < $field_num; $b++) { 
					
					$field_name = mysql_field_name($result, $b);

					$res[$i][$field_name] = mysql_result($result, 0 , $field_name);

				}
				$res[$i]['IMG'] = getimg("SAQuestion",$temp);
			}

			echo json_encode($res);
			break;
		case 'getimgList':
			$imgID_list = $_POST['imgID_list'];
			$res = array();

			$sql = "SELECT * FROM imagetable WHERE imageID IN ( $imgID_list ) ";
			$result = mysql_query($sql) or die('err1');
			$row_num = mysql_num_rows($result);
	
			for ($b=0; $b < $row_num; $b++) { 
				$res[$b]['IMG'] = mysql_result($result, $b,'imageURL');
				$res[$b]['ID'] = mysql_result($result, $b,'imageID');
			}
				
			

			echo json_encode($res);
			break;
		default:
			# code...
			break;
	}


	function getimg($QType,$temp)
	{
		unset($img);
		$img = array();

		$sql = "SELECT imageID FROM imagelink WHERE QType = '$QType' and QID = '$temp' ORDER BY imageID ASC";
		$result = mysql_query($sql) or die('err1');
		$row_num = mysql_num_rows($result);

		for ($x=0; $x < $row_num; $x++) { 
			
			$imgID = mysql_result($result, $x);

			$sql = "SELECT imageURL FROM imagetable WHERE imageID = '$imgID'";
			$imgURL = mysql_query($sql) or die('err2');
			$img[$x]['IMGURL'] = mysql_result($imgURL, 0);

			// 是非 選擇 沒有此 其餘的全相同
			$img[$x]['IMGID'] = $imgID;
		}

		return $img;
		
		
	}

?>
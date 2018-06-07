<?php
	require 'connectdb.php'
?>

<?php
	
	$paperID = $_GET['paperID'];
	$Aid = $_GET['Aid'];


	getPaperData($paperID , $Aid);





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

					// $paperTF[0][$field_name2] = mysql_result($result2, $x , $field_name2);
					$paperTF[$field_name2] = mysql_result($result2, $x , $field_name2);

				}

				$temptf = "Q" . $x;

				$paperTFTemp[$i][$temptf] = $paperTF;

				// unset($paperTF);


			}

			//paper ch
			for ($a=0; $a < $row_num3; $a++) { 
				
				for ($b=0; $b < $field_num3; $b++) { 
					
					$field_name3 = mysql_field_name($result3, $b);

					// $paperCH[0][$field_name3] = mysql_result($result3, $a , $field_name3);
					$paperCH[$field_name3] = mysql_result($result3, $a , $field_name3);

				}

				$tempch = "Q" . $a;

				$paperCHTemp[$i][$tempch] = $paperCH;

				// unset($paperTF);


			}

			//paper gp
			for ($e=0; $e < $row_num4; $e++) { 
				
				for ($f=0; $f < $field_num4; $f++) { 
					
					$field_name4 = mysql_field_name($result4, $f);

					// $paperGP[0][$field_name4] = mysql_result($result4, $e , $field_name4);
					$paperGP[$field_name4] = mysql_result($result4, $e , $field_name4);

				}

				$tempgp = "Q" . $e;

				$paperGPTemp[$i][$tempgp] = $paperGP;

				// unset($paperTF);


			}

			//paper sa
			for ($c=0; $c < $row_num5; $c++) { 
				
				for ($d=0; $d < $field_num5; $d++) { 
					
					$field_name5 = mysql_field_name($result5, $d);

					// $paperSA[0][$field_name5] = mysql_result($result5, $c , $field_name5);
					$paperSA[$field_name5] = mysql_result($result5, $c , $field_name5);

				}

				$tempsa = "Q" . $c;

				$paperSATemp[$i][$tempsa] = $paperSA;

				// unset($paperSA);


			}

			//paper teacher list
			for ($g=0; $g < $row_num6; $g++) { 
				
				for ($h=0; $h < $field_num6; $h++) { 
					
					$field_name6 = mysql_field_name($result6, $h);

					$paperP[$field_name6] = mysql_result($result6, $g , $field_name6);
					
				}

				$tempsa = "Q" . $g;

				$paperPTemp[$i][$tempsa] = $paperP;

				// unset($paperSA);


			}

			// $paper['totalTF'] = $row_num2;
			// $paper['totalCH'] = $row_num3;
			// $paper['totalGP'] = $row_num4;

			$paper[$i]['TF'] = $paperTFTemp;
			$paper[$i]['CH'] = $paperCHTemp;
			$paper[$i]['GP'] = $paperGPTemp;
			$paper[$i]['SA'] = $paperSATemp;
			$paper[$i]['P'] = $paperPTemp;

		}

		 echo json_encode($paper);
		//echo $paperTF;

	}



?>
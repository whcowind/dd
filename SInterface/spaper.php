<?php 
	require 'connectdb.php';
?>

<?php
	
	$Sid = $_POST['S_id'];
	$paperID = $_POST['paperID'];

	$res = array();

	$sql = "SELECT PTitle FROM paperbase WHERE paperID = '$paperID'";
	$describeResult = mysql_query($sql) or die('error3');

	$res[0]['paperID'] = $paperID;
	$res[0]['PTitle'] = mysql_result($describeResult, 0 );


	$sql = "SELECT QID FROM paperlink WHERE paperID = '$paperID' and QType = 'TF'";
	$TFID_result = mysql_query($sql) or die('error4');

	if(empty($TFID_result)){
		echo "No TF";
	}
	else{
		unset($tf);
		$tf = array();
		
		$TFID_row_num = mysql_num_rows($TFID_result);
		for ($a=0; $a < $TFID_row_num; $a++) { 
			

			$TFID = mysql_result($TFID_result, $a);

			$sql = "SELECT TFDetail , TContent , FContent FROM tfquestionbase WHERE TFid = '$TFID'";
			$TFContent = mysql_query($sql) or die('error5');

			$tf[$a]['TFID'] = $TFID;
			$tf[$a]['TFDetail'] = mysql_result($TFContent, 0 , 'TFDetail');
			$tf[$a]['TContent'] = mysql_result($TFContent, 0 , 'TContent');
			$tf[$a]['FContent'] = mysql_result($TFContent, 0 , 'FContent');

			$sql = "SELECT imageID FROM imagelink WHERE QID = '$TFID' and QType = 'TFQuestion'";
			$imageID_result = mysql_query($sql) or die('error6');
			$imageID_row_num = mysql_num_rows($imageID_result);

			unset($img);
			$img = array();
			for ($image = 0; $image < $imageID_row_num; $image++) { 
				$imageID = mysql_result($imageID_result, $image);

				$sql = "SELECT imageURL FROM imagetable WHERE imageID = '$imageID'";
				$imgURL = mysql_query($sql) or die('error7');

				$img[$image]['IMGID'] = $imageID;
				$img[$image]['IMGURL'] = '../TInterface/' .  mysql_result($imgURL, 0);
			}
			$tf[$a]['IMG'] = $img;
		}

		$res[0]['TF'] = $tf;
	}

	$sql = "SELECT QID FROM paperlink WHERE paperID = '$paperID' and QType = 'CH'";
	$CHID_result = mysql_query($sql) or die('error8');

	if(empty($CHID_result)){
		echo "No CH";
	}
	else{
		unset($ch);
		$ch = array();
		
		$CHID_row_num = mysql_num_rows($CHID_result);

		for ($b=0; $b < $CHID_row_num; $b++) { 
			$CHID = mysql_result($CHID_result, $b);

			$sql = "SELECT ChDetail , ChAns1Content , ChAns2Content , ChAns3Content , ChAns4Content FROM choicequestionbase WHERE Chid = '$CHID'";
			$CHContent = mysql_query($sql) or die('error9');

			$ch[$b]['CHID'] = $CHID;
			$ch[$b]['CHDetail'] = mysql_result($CHContent, 0 , 'ChDetail');
			$ch[$b]['CHAns1'] = mysql_result($CHContent, 0 , 'ChAns1Content');
			$ch[$b]['CHAns2'] = mysql_result($CHContent, 0 , 'ChAns2Content');
			$ch[$b]['CHAns3'] = mysql_result($CHContent, 0 , 'ChAns3Content');
			$ch[$b]['CHAns4'] = mysql_result($CHContent, 0 , 'ChAns4Content');


			$sql = "SELECT imageID FROM imagelink WHERE QID = '$CHID' and QType = 'ChoiceQuestion' ORDER BY imageID ASC";
			$imageID_result = mysql_query($sql) or die('error10');
			$imageID_row_num = mysql_num_rows($imageID_result);

			unset($img);
			$img = array();
			for ($image = 0; $image < $imageID_row_num; $image++) { 
				$imageID = mysql_result($imageID_result, $image);

				$sql = "SELECT imageURL FROM imagetable WHERE imageID = '$imageID'";
				$imgURL = mysql_query($sql) or die('error11');

				$img[$image]['IMGID'] = $imageID;
				$img[$image]['IMGURL'] = '../TInterface/' .  mysql_result($imgURL, 0);
			}
			$ch[$b]['IMG'] = $img;
		}

		$res[0]['CH'] = $ch;
	}

	$sql = "SELECT QID FROM paperlink WHERE paperID = '$paperID' and QType = 'GP'";
	$GPID_result = mysql_query($sql) or die('error12');

	if(empty($GPID_result)){
		echo "No GP";
	}
	else{
		unset($gp);
		$gp = array();

		$GPID_row_num = mysql_num_rows($GPID_result);

		for ($c=0; $c < $GPID_row_num; $c++) { 
			$GPID = mysql_result($GPID_result, $c);

			$sql = "SELECT GroupTitle FROM groupquestionbase WHERE GroupID = '$GPID'";
			$GPDetail = mysql_query($sql) or die('error13');

			$gp[$c]['GPTitle'] = mysql_result($GPDetail, 0);

			$sql = "SELECT sort , GroupQID , GroupQContent , GroupA1Content , GroupA2Content , GroupA3Content , GroupA4Content FROM groupsubquestionbase WHERE GroupID = '$GPID' ORDER BY GroupQID ASC";
			$GPContent = mysql_query($sql) or die('error14');
			$GPQ_row_num = mysql_num_rows($GPContent);

			unset($gp_sub);
			$gp_sub = array();
			for ($d=0; $d < $GPQ_row_num; $d++) { 

				$gp_sub[$d]['GPSID'] = mysql_result($GPContent, $d , 'GroupQID');
				$gp_sub[$d]['sort'] = mysql_result($GPContent, $d , 'sort');
				$gp_sub[$d]['GroupQContent'] = mysql_result($GPContent, $d , 'GroupQContent');
				if (mysql_result($GPContent, $d , 'GroupA1Content') != "") {
					$gp_sub[$d]['GroupA1Content'] = mysql_result($GPContent, $d , 'GroupA1Content');
				}
				if (mysql_result($GPContent, $d , 'GroupA2Content') != "") {
					$gp_sub[$d]['GroupA2Content'] = mysql_result($GPContent, $d , 'GroupA2Content');
				}
				if (mysql_result($GPContent, $d , 'GroupA3Content') != "") {
					$gp_sub[$d]['GroupA3Content'] = mysql_result($GPContent, $d , 'GroupA3Content');
				}
				if (mysql_result($GPContent, $d , 'GroupA4Content') != "") {
					$gp_sub[$d]['GroupA4Content'] = mysql_result($GPContent, $d , 'GroupA4Content');
				}

			}
			$gp[$c]['sub'] = $gp_sub;

			$sql = "SELECT imageID FROM imagelink WHERE QID = '$GPID' and QType = 'Group'";
			$imageID_result = mysql_query($sql) or die('error15');
			$imageID_row_num = mysql_num_rows($imageID_result);

			unset($img);
			$img = array();
			for ($image = 0; $image < $imageID_row_num; $image++) { 
				$imageID = mysql_result($imageID_result, $image);

				$sql = "SELECT imageURL FROM imagetable WHERE imageID = '$imageID'";
				$imgURL = mysql_query($sql) or die('error16');

				$img[$image]['IMGID'] = $imageID;
				$img[$image]['IMGURL'] = '../TInterface/' .  mysql_result($imgURL, 0);
			}
			$gp[$c]['IMG'] = $img;
		}
		$res[0]['GP'] = $gp;
	}

	$sql = "SELECT QID FROM paperlink WHERE paperID = '$paperID' and QType = 'SA'";
	$SAID_result = mysql_query($sql) or die('error4');

	if(empty($SAID_result)){
		echo "No SA";
	}
	else{
		unset($sa);
		$sa = array();
		
		$SAID_row_num = mysql_num_rows($SAID_result);
		for ($e=0; $e < $SAID_row_num; $e++) { 
			

			$SAID = mysql_result($SAID_result, $e);

			$sql = "SELECT SADetail FROM short WHERE SAId = '$SAID'";
			$SAContent = mysql_query($sql) or die('error5');

			$sa[$e]['SAID'] = $SAID;
			$sa[$e]['SADetail'] = mysql_result($SAContent, 0 , 'SADetail');
			$sa[$e]['IMG'] = fetch_imgID($SAID,"SAQuestion");

		// 	$sql = "SELECT imageID FROM imagelink WHERE QID = '$SAID' and QType = 'SAQuestion'";
		// 	$imageID_result = mysql_query($sql) or die('error6');
		// 	$imageID_row_num = mysql_num_rows($imageID_result);

		// 	unset($img);
		// 	$img = array();
		// 	for ($image = 0; $image < $imageID_row_num; $image++) { 
		// 		$imageID = mysql_result($imageID_result, $image);

		// 		$sql = "SELECT imageURL FROM imagetable WHERE imageID = '$imageID'";
		// 		$imgURL = mysql_query($sql) or die('error7');

		// 		$img[$image]['IMGID'] = $imageID;
		// 		$img[$image]['IMGURL'] = mysql_result($imgURL, 0);
		// 	}
		// 	$SA[$e]['IMG'] = $img;
		}

		$res[0]['SA'] = $sa;
	}

	echo json_encode($res);


	function fetch_imgID($QID,$QType)
	{
		$sql = "SELECT imageID FROM imagelink WHERE QID = '$QID' and QType = '$QType'";
			$imageID_result = mysql_query($sql) or die('error6 fetch_imgID');
			$imageID_row_num = mysql_num_rows($imageID_result);

			unset($img);
			$img = array();
			for ($image = 0; $image < $imageID_row_num; $image++) { 
				$imageID = mysql_result($imageID_result, $image);

				$sql = "SELECT imageURL FROM imagetable WHERE imageID = '$imageID'";
				$imgURL = mysql_query($sql) or die('error7');

				$img[$image]['IMGID'] = $imageID;
				$img[$image]['IMGURL'] = '../TInterface/' .  mysql_result($imgURL, 0);
			}
		return $img;
	}

	

	// $sql = "SELECT paperID FROM allocate WHERE studentID = '$Sid' and progressing = '1'";
	// $result = mysql_query($sql) or die('error2');
	// $papernumber = mysql_num_rows($result);
	// $res = array();

	// for ($i=0; $i < $papernumber; $i++) { 
	// 	$paperID = mysql_result($result, $i);

	// 	$sql = "SELECT PTitle FROM paperbase WHERE paperID = '$paperID'";
	// 	$describeResult = mysql_query($sql) or die('error3');

	// 	$res[$i]['PTitle'] = mysql_result($describeResult, 0 );


	// 	$sql = "SELECT QID FROM paperlink WHERE paperID = '$paperID' and QType = 'TF'";
	// 	$TFID_result = mysql_query($sql) or die('error4');

	// 	if(empty($TFID_result)){
	// 		echo "No TF";
	// 	}
	// 	else{
	// 		unset($tf);
	// 		$tf = array();
			
	// 		$TFID_row_num = mysql_num_rows($TFID_result);
	// 		for ($a=0; $a < $TFID_row_num; $a++) { 
				

	// 			$TFID = mysql_result($TFID_result, $a);

	// 			$sql = "SELECT TFDetail , TContent , FContent FROM tfquestionbase WHERE TFid = '$TFID'";
	// 			$TFContent = mysql_query($sql) or die('error5');

	// 			$tf[$a]['TFID'] = $TFID;
	// 			$tf[$a]['TFDetail'] = mysql_result($TFContent, 0 , 'TFDetail');
	// 			$tf[$a]['TContent'] = mysql_result($TFContent, 0 , 'TContent');
	// 			$tf[$a]['FContent'] = mysql_result($TFContent, 0 , 'FContent');

	// 			$sql = "SELECT imageID FROM imagelink WHERE QID = '$TFID' and QType = 'TFQuestion'";
	// 			$imageID_result = mysql_query($sql) or die('error6');
	// 			$imageID_row_num = mysql_num_rows($imageID_result);

	// 			unset($img);
	// 			$img = array();
	// 			for ($image = 0; $image < $imageID_row_num; $image++) { 
	// 				$imageID = mysql_result($imageID_result, $image);

	// 				$sql = "SELECT imageURL FROM imagetable WHERE imageID = '$imageID'";
	// 				$imgURL = mysql_query($sql) or die('error7');

	// 				$img[$image]['IMGID'] = $imageID;
	// 				$img[$image]['IMGURL'] = mysql_result($imgURL, 0);
	// 			}
	// 			$tf[$a]['IMG'] = $img;
	// 		}

	// 		$res[$i]['TF'] = $tf;
	// 	}

	// 	$sql = "SELECT QID FROM paperlink WHERE paperID = '$paperID' and QType = 'CH'";
	// 	$CHID_result = mysql_query($sql) or die('error8');

	// 	if(empty($CHID_result)){
	// 		echo "No CH";
	// 	}
	// 	else{
	// 		unset($ch);
	// 		$ch = array();
			
	// 		$CHID_row_num = mysql_num_rows($CHID_result);

	// 		for ($b=0; $b < $CHID_row_num; $b++) { 
	// 			$CHID = mysql_result($CHID_result, $b);

	// 			$sql = "SELECT ChDetail , ChAns1Content , ChAns2Content , ChAns3Content , ChAns4Content FROM choicequestionbase WHERE Chid = '$CHID'";
	// 			$CHContent = mysql_query($sql) or die('error9');

	// 			$ch[$b]['CHID'] = $CHID;
	// 			$ch[$b]['CHDetail'] = mysql_result($CHContent, 0 , 'ChDetail');
	// 			$ch[$b]['CHAns1'] = mysql_result($CHContent, 0 , 'ChAns1Content');
	// 			$ch[$b]['CHAns2'] = mysql_result($CHContent, 0 , 'ChAns2Content');
	// 			$ch[$b]['CHAns3'] = mysql_result($CHContent, 0 , 'ChAns3Content');
	// 			$ch[$b]['CHAns4'] = mysql_result($CHContent, 0 , 'ChAns4Content');


	// 			$sql = "SELECT imageID FROM imagelink WHERE QID = '$TFID' and QType = 'ChoiceQuestion'";
	// 			$imageID_result = mysql_query($sql) or die('error10');
	// 			$imageID_row_num = mysql_num_rows($imageID_result);

	// 			unset($img);
	// 			$img = array();
	// 			for ($image = 0; $image < $imageID_row_num; $image++) { 
	// 				$imageID = mysql_result($imageID_result, $image);

	// 				$sql = "SELECT imageURL FROM imagetable WHERE imageID = '$imageID'";
	// 				$imgURL = mysql_query($sql) or die('error11');

	// 				$img[$image]['IMGID'] = $imageID;
	// 				$img[$image]['IMGURL'] = mysql_result($imgURL, 0);
	// 			}
	// 			$ch[$b]['IMG'] = $img;
	// 		}

	// 		$res[$i]['CH'] = $ch;
	// 	}

	// 	$sql = "SELECT QID FROM paperlink WHERE paperID = '$paperID' and QType = 'GP'";
	// 	$GPID_result = mysql_query($sql) or die('error12');

	// 	if(empty($GPID_result)){
	// 		echo "No GP";
	// 	}
	// 	else{
	// 		unset($gp);
	// 		$gp = array();

	// 		$GPID_row_num = mysql_num_rows($GPID_result);

	// 		for ($c=0; $c < $GPID_row_num; $c++) { 
	// 			$GPID = mysql_result($GPID_result, $c);

	// 			$sql = "SELECT GroupTitle FROM groupquestionbase WHERE GroupID = '$GPID'";
	// 			$GPDetail = mysql_query($sql) or die('error13');

	// 			$gp[$c]['GPTitle'] = mysql_result($GPDetail, 0);

	// 			$sql = "SELECT GroupQID , GroupQContent , GroupA1Content , GroupA2Content , GroupA3Content , GroupA4Content FROM groupsubquestionbase WHERE GroupID = '$GPID' ORDER BY GroupQID ASC";
	// 			$GPContent = mysql_query($sql) or die('error14');
	// 			$GPQ_row_num = mysql_num_rows($GPContent);

	// 			unset($gp_sub);
	// 			$gp_sub = array();
	// 			for ($d=0; $d < $GPQ_row_num; $d++) { 

	// 				$gp_sub[$d]['GPSID'] = mysql_result($GPContent, $d , 'GroupQID');
	// 				$gp_sub[$d]['GroupQContent'] = mysql_result($GPContent, $d , 'GroupQContent');
	// 				$gp_sub[$d]['GroupA1Content'] = mysql_result($GPContent, $d , 'GroupA1Content');
	// 				$gp_sub[$d]['GroupA2Content'] = mysql_result($GPContent, $d , 'GroupA2Content');
	// 				$gp_sub[$d]['GroupA3Content'] = mysql_result($GPContent, $d , 'GroupA3Content');
	// 				$gp_sub[$d]['GroupA4Content'] = mysql_result($GPContent, $d , 'GroupA4Content');

	// 			}
	// 			$gp[$c]['sub'] = $gp_sub;

	// 			$sql = "SELECT imageID FROM imagelink WHERE QID = '$TFID' and QType = 'Group'";
	// 			$imageID_result = mysql_query($sql) or die('error15');
	// 			$imageID_row_num = mysql_num_rows($imageID_result);

	// 			unset($img);
	// 			$img = array();
	// 			for ($image = 0; $image < $imageID_row_num; $image++) { 
	// 				$imageID = mysql_result($imageID_result, $image);

	// 				$sql = "SELECT imageURL FROM imagetable WHERE imageID = '$imageID'";
	// 				$imgURL = mysql_query($sql) or die('error16');

	// 				$img[$image]['IMGID'] = $imageID;
	// 				$img[$image]['IMGURL'] = mysql_result($imgURL, 0);
	// 			}
	// 			$gp[$c]['IMG'] = $img;
	// 		}
	// 		$res[$i]['GP'] = $gp;
	// 	}

	// }
?>
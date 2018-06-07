<?php
	require 'connectdb.php';
?>
<?php

	//True & False
	$TFDetail = $_POST['TFDetail'];
	$TContent = $_POST['TContent'];
	$TScore = $_POST['TScore'];
	$FContent = $_POST['FContent'];
	$FScore = $_POST['FScore'];
	

	//Choice
	$ChDetail = $_POST['ChoiceDetail'];
	$C1Ans = $_POST['C1Ans'];
	$C2Ans = $_POST['C2Ans'];
	$C3Ans = $_POST['C3Ans'];
	$C4Ans = $_POST['C4Ans'];
	$C1Score = $_POST['C1Score'];
	$C2Score = $_POST['C2Score'];
	$C3Score = $_POST['C3Score'];
	$C4Score = $_POST['C4Score'];

	//Group
	$GroupTitle = $_POST['GroupTitle'];
	$GroupSubQ1Title = $_POST['GroupSubQ1Title'];
	$GroupSubQ1A1Content = $_POST['GroupSubQ1A1Content'];
	$GQ1A1Score = $_POST['GQ1A1Score'];
	$GroupSubQ1A2Content = $_POST['GroupSubQ1A2Content'];
	$GQ1A2Score = $_POST['GQ1A2Score'];
	$GroupSubQ1A3Content = $_POST['GroupSubQ1A3Content'];
	$GQ1A3Score = $_POST['GQ1A3Score'];
	$GroupSubQ1A4Content = $_POST['GroupSubQ1A4Content'];
	$GQ1A4Score = $_POST['GQ1A4Score'];
	$GroupSubQ2Title = $_POST['GroupSubQ2Title'];
	$GroupSubQ2A1Content = $_POST['GroupSubQ2A1Content'];
	$GQ2A1Score = $_POST['GQ2A1Score'];
	$GroupSubQ2A2Content = $_POST['GroupSubQ2A2Content'];
	$GQ2A2Score = $_POST['GQ2A2Score'];
	$GroupSubQ2A3Content = $_POST['GroupSubQ2A3Content'];
	$GQ2A3Score = $_POST['GQ2A3Score'];
	$GroupSubQ2A4Content = $_POST['GroupSubQ2A4Content'];
	$GQ2A4Score = $_POST['GQ2A4Score'];
	$GroupSubQ3Title = $_POST['GroupSubQ3Title'];
	$GroupSubQ3A1Content = $_POST['GroupSubQ3A1Content'];
	$GQ3A1Score = $_POST['GQ3A1Score'];
	$GroupSubQ3A2Content = $_POST['GroupSubQ3A2Content'];
	$GQ3A2Score = $_POST['GQ3A2Score'];
	$GroupSubQ3A3Content = $_POST['GroupSubQ3A3Content'];
	$GQ3A3Score = $_POST['GQ3A3Score'];
	$GroupSubQ3A4Content = $_POST['GroupSubQ3A4Content'];
	$GQ3A4Score = $_POST['GQ3A4Score'];
	$GroupSubQ4Title = $_POST['GroupSubQ4Title'];
	$GroupSubQ4A1Content = $_POST['GroupSubQ4A1Content'];
	$GQ4A1Score = $_POST['GQ4A1Score'];
	$GroupSubQ4A2Content = $_POST['GroupSubQ4A2Content'];
	$GQ4A2Score = $_POST['GQ4A2Score'];
	$GroupSubQ4A3Content = $_POST['GroupSubQ4A3Content'];
	$GQ4A3Score = $_POST['GQ4A3Score'];
	$GroupSubQ4A4Content = $_POST['GroupSubQ4A4Content'];
	$GQ4A4Score = $_POST['GQ4A4Score'];
	$GroupSubQ5Title = $_POST['GroupSubQ5Title'];
	$GroupSubQ5A1Content = $_POST['GroupSubQ5A1Content'];
	$GQ5A1Score = $_POST['GQ5A1Score'];
	$GroupSubQ5A2Content = $_POST['GroupSubQ5A2Content'];
	$GQ5A2Score = $_POST['GQ5A2Score'];
	$GroupSubQ5A3Content = $_POST['GroupSubQ5A3Content'];
	$GQ5A3Score = $_POST['GQ5A3Score'];
	$GroupSubQ5A4Content = $_POST['GroupSubQ5A4Content'];
	$GQ5A4Score = $_POST['GQ5A4Score'];
	$GroupSubQ6Title = $_POST['GroupSubQ6Title'];
	$GroupSubQ6A1Content = $_POST['GroupSubQ6A1Content'];
	$GQ6A1Score = $_POST['GQ6A1Score'];
	$GroupSubQ6A2Content = $_POST['GroupSubQ6A2Content'];
	$GQ6A2Score = $_POST['GQ6A2Score'];
	$GroupSubQ6A3Content = $_POST['GroupSubQ6A3Content'];
	$GQ6A3Score = $_POST['GQ6A3Score'];
	$GroupSubQ6A4Content = $_POST['GroupSubQ6A4Content'];
	$GQ6A4Score = $_POST['GQ6A4Score'];
	$GroupSubQ7Title = $_POST['GroupSubQ7Title'];
	$GroupSubQ7A1Content = $_POST['GroupSubQ7A1Content'];
	$GQ7A1Score = $_POST['GQ7A1Score'];
	$GroupSubQ7A2Content = $_POST['GroupSubQ7A2Content'];
	$GQ7A2Score = $_POST['GQ7A2Score'];
	$GroupSubQ7A3Content = $_POST['GroupSubQ7A3Content'];
	$GQ7A3Score = $_POST['GQ7A3Score'];
	$GroupSubQ7A4Content = $_POST['GroupSubQ7A4Content'];
	$GQ7A4Score = $_POST['GQ7A4Score'];
	$GroupSubQ8Title = $_POST['GroupSubQ8Title'];
	$GroupSubQ8A1Content = $_POST['GroupSubQ8A1Content'];
	$GQ8A1Score = $_POST['GQ8A1Score'];
	$GroupSubQ8A2Content = $_POST['GroupSubQ8A2Content'];
	$GQ8A2Score = $_POST['GQ8A2Score'];
	$GroupSubQ8A3Content = $_POST['GroupSubQ8A3Content'];
	$GQ8A3Score = $_POST['GQ8A3Score'];
	$GroupSubQ8A4Content = $_POST['GroupSubQ8A4Content'];
	$GQ8A4Score = $_POST['GQ8A4Score'];
	$GroupSubQ9Title = $_POST['GroupSubQ9Title'];
	$GroupSubQ9A1Content = $_POST['GroupSubQ9A1Content'];
	$GQ9A1Score = $_POST['GQ9A1Score'];
	$GroupSubQ9A2Content = $_POST['GroupSubQ9A2Content'];
	$GQ9A2Score = $_POST['GQ9A2Score'];
	$GroupSubQ9A3Content = $_POST['GroupSubQ9A3Content'];
	$GQ9A3Score = $_POST['GQ9A3Score'];
	$GroupSubQ9A4Content = $_POST['GroupSubQ9A4Content'];
	$GQ9A4Score = $_POST['GQ9A4Score'];
	$GroupSubQ10Title = $_POST['GroupSubQ10Title'];
	$GroupSubQ10A1Content = $_POST['GroupSubQ10A1Content'];
	$GQ10A1Score = $_POST['GQ10A1Score'];
	$GroupSubQ10A2Content = $_POST['GroupSubQ10A2Content'];
	$GQ10A2Score = $_POST['GQ10A2Score'];
	$GroupSubQ10A3Content = $_POST['GroupSubQ10A3Content'];
	$GQ10A3Score = $_POST['GQ10A3Score'];
	$GroupSubQ10A4Content = $_POST['GroupSubQ10A4Content'];
	$GQ10A4Score = $_POST['GQ10A4Score'];
	$sort1 = $_POST['sort1'];
	$sort2 = $_POST['sort2'];
	$sort3 = $_POST['sort3'];
	$sort4 = $_POST['sort4'];
	$sort5 = $_POST['sort5'];
	$sort6 = $_POST['sort6'];
	$sort7 = $_POST['sort7'];
	$sort8 = $_POST['sort8'];
	$sort9 = $_POST['sort9'];
	$sort10 = $_POST['sort10'];

	//Short Ans
	$SADetail = $_POST['SADetail'];


	$QType = $_POST['QType'];
	$Aid = $_POST['Aid'];
	$TFId;
	$ChId;


	switch ($QType) {
		case 'TFQuestion':

			$imageArray = $_POST['imageArray'];
			$TFId = getTFId();
			$sql = "INSERT INTO tfquestionbase (TFId , TFDetail , TContent , FContent , TScore , FScore , QType , owner)
			VALUES ('$TFId' , '$TFDetail' , '$TContent' , '$FContent' , '$TScore' , '$FScore' , '$QType' , '$Aid')";
			mysql_query($sql) or die('TF insert error');

			for ($tfImageIndex = 0; $tfImageIndex < count($imageArray); $tfImageIndex++) { 
				$imageTemp = '';
				$imageTemp = $imageArray[$tfImageIndex];

				$sql = "INSERT INTO imagelink (imageID , QID , QType)
				VALUES ('$imageTemp' , '$TFId' , '$QType')";
				mysql_query($sql) or die('TF image error');
			}


			break;

		case 'ChoiceQuestion':

			$imageArray = $_POST['imageArray'];
			$ChId = getChId();
			$sql = "INSERT INTO choicequestionbase (ChId , ChDetail , ChAns1Content , ChAns2Content , ChAns3Content , ChAns4Content , ChAns1Score , ChAns2Score , ChAns3Score , ChAns4Score , QType , owner)
			VALUES ('$ChId' , '$ChDetail' , '$C1Ans' , '$C2Ans' , '$C3Ans' , '$C4Ans' , '$C1Score' , '$C2Score' , '$C3Score' , '$C4Score' , '$QType' , '$Aid')";
			mysql_query($sql) or die('Choice insert error');

			for ($chimgidx = 0; $chimgidx < count($imageArray); $chimgidx++) { 
				$imageTemp = '';
				$imageTemp = $imageArray[$chimgidx];

				$sql = "INSERT INTO imagelink (imageID , QID , QType)
				VALUES ('$imageTemp' , '$ChId' , '$QType')";
				mysql_query($sql) or die(mysql_error());
				/*'CH image error'*/
			}

			break;

		case 'Group':
			$imageArray = $_POST['imageArray'];
			$GroupID = getGroupID();
			$sql = "INSERT INTO groupquestionbase (GroupID , GroupTitle , QType , owner)
			VALUES ('$GroupID' , '$GroupTitle' , '$QType' , '$Aid')";
			mysql_query($sql) or die('group insert error');

			$sql = "INSERT INTO groupqtable (GroupID) VALUES ('$GroupID')";
			mysql_query($sql) or die('groupid insert error');

			for ($gpimgidx = 0; $gpimgidx < count($imageArray); $gpimgidx++) { 
				$imageTemp = '';
				$imageTemp = $imageArray[$gpimgidx];

				$sql = "INSERT INTO imagelink (imageID , QID , QType)
				VALUES ('$imageTemp' , '$GroupID' , '$QType')";
				mysql_query($sql) or die('CH image error');
			}


			if($GroupSubQ1Title == ''){
				# code...
			}
			else{
				$GroupQ1ID = ($GroupID - 1) * 10 + 1;
				$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , sort , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score)
				VALUES ('$GroupQ1ID' , '$GroupID' , '$sort1' , '$GroupSubQ1Title' , '$GroupSubQ1A1Content' , '$GQ1A1Score' , '$GroupSubQ1A2Content' , '$GQ1A2Score' , '$GroupSubQ1A3Content' , '$GQ1A3Score' , '$GroupSubQ1A4Content' , '$GQ1A4Score')";
				mysql_query($sql) or die('group sub q1 error');

				$sql = "UPDATE groupqtable SET GroupQ1ID = '$GroupQ1ID' WHERE GroupID = '$GroupID'";
				mysql_query($sql) or die('groupq1id insert error');
				
				if ($GroupSubQ2Title == '') {
					# code...
				}
				else{
					$GroupQ2ID = ($GroupID - 1) * 10 + 2;
					$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , sort , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score)
					VALUES ('$GroupQ2ID' , '$GroupID' , '$sort2' , '$GroupSubQ2Title' , '$GroupSubQ2A1Content' , '$GQ2A1Score' , '$GroupSubQ2A2Content' , '$GQ2A2Score' , '$GroupSubQ2A3Content' , '$GQ2A3Score' , '$GroupSubQ2A4Content' , '$GQ2A4Score')";
					mysql_query($sql) or die('group sub q1 error');

					$sql = "UPDATE groupqtable SET GroupQ2ID = '$GroupQ2ID' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('groupq1id insert error');
				}

				if ($GroupSubQ3Title == '') {
					# code...
				}
				else{
					$GroupQ3ID = ($GroupID - 1) * 10 + 3;
					$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , sort , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score)
					VALUES ('$GroupQ3ID' , '$GroupID' , '$sort3' , '$GroupSubQ3Title' , '$GroupSubQ3A1Content' , '$GQ3A1Score' , '$GroupSubQ3A2Content' , '$GQ3A2Score' , '$GroupSubQ3A3Content' , '$GQ3A3Score' , '$GroupSubQ3A4Content' , '$GQ3A4Score')";
					mysql_query($sql) or die('group sub q1 error');

					$sql = "UPDATE groupqtable SET GroupQ3ID = '$GroupQ3ID' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('groupq1id insert error');
				}

				if ($GroupSubQ4Title == '') {
					# code...
				}
				else{
					$GroupQ4ID = ($GroupID - 1) * 10 + 4;
					$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , sort , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score)
					VALUES ('$GroupQ4ID' , '$GroupID' , '$sort4' , '$GroupSubQ4Title' , '$GroupSubQ4A1Content' , '$GQ4A1Score' , '$GroupSubQ4A2Content' , '$GQ4A2Score' , '$GroupSubQ4A3Content' , '$GQ4A3Score' , '$GroupSubQ4A4Content' , '$GQ4A4Score')";
					mysql_query($sql) or die('group sub q1 error');

					$sql = "UPDATE groupqtable SET GroupQ4ID = '$GroupQ4ID' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('groupq1id insert error');
				}

				if ($GroupSubQ5Title == '') {
					# code...
				}
				else{
					$GroupQ5ID = ($GroupID - 1) * 10 + 5;
					$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , sort , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score)
					VALUES ('$GroupQ5ID' , '$GroupID' , '$sort5' , '$GroupSubQ5Title' , '$GroupSubQ5A1Content' , '$GQ5A1Score' , '$GroupSubQ5A2Content' , '$GQ5A2Score' , '$GroupSubQ5A3Content' , '$GQ5A3Score' , '$GroupSubQ5A4Content' , '$GQ5A4Score')";
					mysql_query($sql) or die('group sub q1 error');

					$sql = "UPDATE groupqtable SET GroupQ5ID = '$GroupQ5ID' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('groupq1id insert error');
				}

				if ($GroupSubQ6Title == '') {
					# code...
				}
				else{
					$GroupQ6ID = ($GroupID - 1) * 10 + 6;
					$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , sort , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score)
					VALUES ('$GroupQ6ID' , '$GroupID' , '$sort6' , '$GroupSubQ6Title' , '$GroupSubQ6A1Content' , '$GQ6A1Score' , '$GroupSubQ6A2Content' , '$GQ6A2Score' , '$GroupSubQ6A3Content' , '$GQ6A3Score' , '$GroupSubQ6A4Content' , '$GQ6A4Score')";
					mysql_query($sql) or die('group sub q1 error');

					$sql = "UPDATE groupqtable SET GroupQ6ID = '$GroupQ6ID' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('groupq1id insert error');
				}

				if ($GroupSubQ7Title == '') {
					# code...
				}
				else{
					$GroupQ7ID = ($GroupID - 1) * 10 + 7;
					$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , sort , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score)
					VALUES ('$GroupQ7ID' , '$GroupID' , '$sort7' , '$GroupSubQ7Title' , '$GroupSubQ7A1Content' , '$GQ7A1Score' , '$GroupSubQ7A2Content' , '$GQ7A2Score' , '$GroupSubQ7A3Content' , '$GQ7A3Score' , '$GroupSubQ7A4Content' , '$GQ7A4Score')";
					mysql_query($sql) or die('group sub q1 error');

					$sql = "UPDATE groupqtable SET GroupQ7ID = '$GroupQ7ID' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('groupq1id insert error');
				}

				if ($GroupSubQ8Title == '') {
					# code...
				}
				else{
					$GroupQ8ID = ($GroupID - 1) * 10 + 8;
					$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , sort , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score)
					VALUES ('$GroupQ8ID' , '$GroupID' , '$sort8' , '$GroupSubQ8Title' , '$GroupSubQ8A1Content' , '$GQ8A1Score' , '$GroupSubQ8A2Content' , '$GQ8A2Score' , '$GroupSubQ8A3Content' , '$GQ8A3Score' , '$GroupSubQ8A4Content' , '$GQ8A4Score')";
					mysql_query($sql) or die('group sub q1 error');

					$sql = "UPDATE groupqtable SET GroupQ8ID = '$GroupQ8ID' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('groupq1id insert error');
				}

				if ($GroupSubQ9Title == '') {
					# code...
				}
				else{
					$GroupQ9ID = ($GroupID - 1) * 10 + 9;
					$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , sort , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score)
					VALUES ('$GroupQ9ID' , '$GroupID' , '$sort9' , '$GroupSubQ9Title' , '$GroupSubQ9A1Content' , '$GQ9A1Score' , '$GroupSubQ9A2Content' , '$GQ9A2Score' , '$GroupSubQ9A3Content' , '$GQ9A3Score' , '$GroupSubQ9A4Content' , '$GQ9A4Score')";
					mysql_query($sql) or die('group sub q1 error');

					$sql = "UPDATE groupqtable SET GroupQ9ID = '$GroupQ9ID' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('groupq1id insert error');
				}

				if ($GroupSubQ10Title == '') {
					# code...
				}
				else{
					$GroupQ10ID = ($GroupID - 1) * 10 + 10;
					$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , sort , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score)
					VALUES ('$GroupQ10ID' , '$GroupID' , '$sort10' , '$GroupSubQ10Title' , '$GroupSubQ10A1Content' , '$GQ10A1Score' , '$GroupSubQ10A2Content' , '$GQ10A2Score' , '$GroupSubQ10A3Content' , '$GQ10A3Score' , '$GroupSubQ10A4Content' , '$GQ10A4Score')";
					mysql_query($sql) or die('group sub q1 error');

					$sql = "UPDATE groupqtable SET GroupQ10ID = '$GroupQ10ID' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('groupq1id insert error');
				}


			}

			break;

		case 'SAQuestion':
			$SAId = getSAId();
			$sql = "INSERT INTO short (SAId , SADetail , QType , owner)
			VALUES ('$SAId' , '$SADetail' , '$QType' , '$Aid')";
			mysql_query($sql) or die('SA insert error');

			$imageArray = $_POST['imageArray'];

			for ($tfImageIndex = 0; $tfImageIndex < count($imageArray); $tfImageIndex++) { 
				$imageTemp = '';
				$imageTemp = $imageArray[$tfImageIndex];

				$sql = "INSERT INTO imagelink (imageID , QID , QType)
				VALUES ('$imageTemp' , '$SAId' , '$QType')";
				mysql_query($sql) or die('SA image error');
			}

			break;
			

			

			
		default:
			# code...
			break;
	}








	function getTFId() {
		$count = 1;
		$sql = "SELECT * FROM tfquestionbase ORDER BY TFId ASC";
		$result = mysql_query($sql) or die('TFId error');
		$row_num = mysql_num_rows($result);


		if ($row_num == 0) {
			return $count;
		}else{

			for ($i=0; $i < $row_num; $i++) { 
				$Id = mysql_result($result, $i , 'TFId');

				if ($count == $Id) {
					if ($row_num == $Id) {
						$count++;
						return $count;
					}else{
						$count ++;
					}
				}elseif ($count != $Id) {
					return $count;
				}
			}

		}

	}

	function getChId() {
		$count = 1;
		$sql = "SELECT * FROM choicequestionbase ORDER BY ChId ASC";
		$result = mysql_query($sql) or die('ChId error');
		$row_num = mysql_num_rows($result);


		if ($row_num == 0) {
			return $count;
		}else{

			for ($i=0; $i < $row_num; $i++) { 
				$Id = mysql_result($result, $i , 'ChId');

				if ($count == $Id) {
					if ($row_num == $Id) {
						$count++;
						return $count;
					}else{
						$count ++;
					}
				}elseif ($count != $Id) {
					return $count;
				}
			}

		}
	}


	function getGroupQID() {
		$count = 1;
		$sql = "SELECT * FROM groupqtable ORDER BY GroupQ1ID ASC";
		$result = mysql_query($sql) or die('GroupQ1ID error');
		$row_num = mysql_num_rows($result);


		if ($row_num == 0) {
			return $count;
		}else{

			for ($i=0; $i < $row_num; $i++) { 
				$Id = mysql_result($result, $i , 'GroupQ1ID');

				if ($count == $Id) {
					if ($row_num == $Id) {
						$count++;
						return $count;
					}else{
						$count ++;
					}
				}elseif ($count != $Id) {
					return $count;
				}
			}

		}
	}

	function getGroupID() {
		$count = 1;
		$sql = "SELECT * FROM groupquestionbase ORDER BY GroupID ASC";
		$result = mysql_query($sql) or die('GroupID error');
		$row_num = mysql_num_rows($result);


		if ($row_num == 0) {
			return $count;
		}else{

			for ($i=0; $i < $row_num; $i++) { 
				$Id = mysql_result($result, $i , 'GroupID');

				if ($count == $Id) {
					if ($row_num == $Id) {
						$count++;
						return $count;
					}else{
						$count ++;
					}
				}elseif ($count != $Id) {
					return $count;
				}
			}

		}
	}

	function getSAId(){
		$count = 1;
		$sql = "SELECT * FROM short ORDER BY SAId ASC";
		$result = mysql_query($sql) or die('SAId error');
		$row_num = mysql_num_rows($result);


		if ($row_num == 0) {
			return $count;
		}else{

			for ($i=0; $i < $row_num; $i++) { 
				$Id = mysql_result($result, $i , 'SAId');

				if ($count == $Id) {
					if ($row_num == $Id) {
						$count++;
						return $count;
					}else{
						$count ++;
					}
				}elseif ($count != $Id) {
					return $count;
				}
			}

		}
	}


?>
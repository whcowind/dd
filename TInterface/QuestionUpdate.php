<?php
	require 'connectdb.php';
?>

<?php
	//True & False
	$TFId = $_POST['TFId'];
	$TFUDetail = $_POST['TFUDetail'];
	$TUContent = $_POST['TUContent'];
	$TUScore = $_POST['TUScore'];
	$FUContent = $_POST['FUContent'];
	$FUScore = $_POST['FUScore'];

	//Choice
	$CHId = $_POST['CHId'];
	$ChUDetail = $_POST['ChoiceUDetail'];
	$C1UAns = $_POST['C1UAns'];
	$C2UAns = $_POST['C2UAns'];
	$C3UAns = $_POST['C3UAns'];
	$C4UAns = $_POST['C4UAns'];
	$C1UScore = $_POST['C1UScore'];
	$C2UScore = $_POST['C2UScore'];
	$C3UScore = $_POST['C3UScore'];
	$C4UScore = $_POST['C4UScore'];

	//Group
	$GroupID = $_POST['GroupID'];
	$GroupQ1Id = $_POST['GroupQ1Id'];
	$GroupQ2Id = $_POST['GroupQ2Id'];
	$GroupQ3Id = $_POST['GroupQ3Id'];
	$GroupQ4Id = $_POST['GroupQ4Id'];
	$GroupQ5Id = $_POST['GroupQ5Id'];
	$GroupQ6Id = $_POST['GroupQ6Id'];
	$GroupQ7Id = $_POST['GroupQ7Id'];
	$GroupQ8Id = $_POST['GroupQ8Id'];
	$GroupQ9Id = $_POST['GroupQ9Id'];
	$GroupQ10Id = $_POST['GroupQ10Id'];
	$GroupTitle = $_POST['GroupTitle'];
	$GroupSubQ1Title = $_POST['GroupSubQ1Title'];
	$GroupSubQ1A1Content = $_POST['GroupSubQ1A1Content'];
	$GQ1A1UScore = $_POST['GQ1A1UScore'];
	$GroupSubQ1A2Content = $_POST['GroupSubQ1A2Content'];
	$GQ1A2UScore = $_POST['GQ1A2UScore'];
	$GroupSubQ1A3Content = $_POST['GroupSubQ1A3Content'];
	$GQ1A3UScore = $_POST['GQ1A3UScore'];
	$GroupSubQ1A4Content = $_POST['GroupSubQ1A4Content'];
	$GQ1A4UScore = $_POST['GQ1A4UScore'];
	$GroupSubQ2Title = $_POST['GroupSubQ2Title'];
	$GroupSubQ2A1Content = $_POST['GroupSubQ2A1Content'];
	$GQ2A1UScore = $_POST['GQ2A1UScore'];
	$GroupSubQ2A2Content = $_POST['GroupSubQ2A2Content'];
	$GQ2A2UScore = $_POST['GQ2A2UScore'];
	$GroupSubQ2A3Content = $_POST['GroupSubQ2A3Content'];
	$GQ2A3UScore = $_POST['GQ2A3UScore'];
	$GroupSubQ2A4Content = $_POST['GroupSubQ2A4Content'];
	$GQ2A4UScore = $_POST['GQ2A4UScore'];
	$GroupSubQ3Title = $_POST['GroupSubQ3Title'];
	$GroupSubQ3A1Content = $_POST['GroupSubQ3A1Content'];
	$GQ3A1UScore = $_POST['GQ3A1UScore'];
	$GroupSubQ3A2Content = $_POST['GroupSubQ3A2Content'];
	$GQ3A2UScore = $_POST['GQ3A2UScore'];
	$GroupSubQ3A3Content = $_POST['GroupSubQ3A3Content'];
	$GQ3A3UScore = $_POST['GQ3A3UScore'];
	$GroupSubQ3A4Content = $_POST['GroupSubQ3A4Content'];
	$GQ3A4UScore = $_POST['GQ3A4UScore'];
	$GroupSubQ4Title = $_POST['GroupSubQ4Title'];
	$GroupSubQ4A1Content = $_POST['GroupSubQ4A1Content'];
	$GQ4A1UScore = $_POST['GQ4A1UScore'];
	$GroupSubQ4A2Content = $_POST['GroupSubQ4A2Content'];
	$GQ4A2UScore = $_POST['GQ4A2UScore'];
	$GroupSubQ4A3Content = $_POST['GroupSubQ4A3Content'];
	$GQ4A3UScore = $_POST['GQ4A3UScore'];
	$GroupSubQ4A4Content = $_POST['GroupSubQ4A4Content'];
	$GQ4A4UScore = $_POST['GQ4A4UScore'];
	$GroupSubQ5Title = $_POST['GroupSubQ5Title'];
	$GroupSubQ5A1Content = $_POST['GroupSubQ5A1Content'];
	$GQ5A1UScore = $_POST['GQ5A1UScore'];
	$GroupSubQ5A2Content = $_POST['GroupSubQ5A2Content'];
	$GQ5A2UScore = $_POST['GQ5A2UScore'];
	$GroupSubQ5A3Content = $_POST['GroupSubQ5A3Content'];
	$GQ5A3UScore = $_POST['GQ5A3UScore'];
	$GroupSubQ5A4Content = $_POST['GroupSubQ5A4Content'];
	$GQ5A4UScore = $_POST['GQ5A4UScore'];
	$GroupSubQ6Title = $_POST['GroupSubQ6Title'];
	$GroupSubQ6A1Content = $_POST['GroupSubQ6A1Content'];
	$GQ6A1UScore = $_POST['GQ6A1UScore'];
	$GroupSubQ6A2Content = $_POST['GroupSubQ6A2Content'];
	$GQ6A2UScore = $_POST['GQ6A2UScore'];
	$GroupSubQ6A3Content = $_POST['GroupSubQ6A3Content'];
	$GQ6A3UScore = $_POST['GQ6A3UScore'];
	$GroupSubQ6A4Content = $_POST['GroupSubQ6A4Content'];
	$GQ6A4UScore = $_POST['GQ6A4UScore'];
	$GroupSubQ7Title = $_POST['GroupSubQ7Title'];
	$GroupSubQ7A1Content = $_POST['GroupSubQ7A1Content'];
	$GQ7A1UScore = $_POST['GQ7A1UScore'];
	$GroupSubQ7A2Content = $_POST['GroupSubQ7A2Content'];
	$GQ7A2UScore = $_POST['GQ7A2UScore'];
	$GroupSubQ7A3Content = $_POST['GroupSubQ7A3Content'];
	$GQ7A3UScore = $_POST['GQ7A3UScore'];
	$GroupSubQ7A4Content = $_POST['GroupSubQ7A4Content'];
	$GQ7A4UScore = $_POST['GQ7A4UScore'];
	$GroupSubQ8Title = $_POST['GroupSubQ8Title'];
	$GroupSubQ8A1Content = $_POST['GroupSubQ8A1Content'];
	$GQ8A1UScore = $_POST['GQ8A1UScore'];
	$GroupSubQ8A2Content = $_POST['GroupSubQ8A2Content'];
	$GQ8A2UScore = $_POST['GQ8A2UScore'];
	$GroupSubQ8A3Content = $_POST['GroupSubQ8A3Content'];
	$GQ8A3UScore = $_POST['GQ8A3UScore'];
	$GroupSubQ8A4Content = $_POST['GroupSubQ8A4Content'];
	$GQ8A4UScore = $_POST['GQ8A4UScore'];
	$GroupSubQ9Title = $_POST['GroupSubQ9Title'];
	$GroupSubQ9A1Content = $_POST['GroupSubQ9A1Content'];
	$GQ9A1UScore = $_POST['GQ9A1UScore'];
	$GroupSubQ9A2Content = $_POST['GroupSubQ9A2Content'];
	$GQ9A2UScore = $_POST['GQ9A2UScore'];
	$GroupSubQ9A3Content = $_POST['GroupSubQ9A3Content'];
	$GQ9A3UScore = $_POST['GQ9A3UScore'];
	$GroupSubQ9A4Content = $_POST['GroupSubQ9A4Content'];
	$GQ9A4UScore = $_POST['GQ9A4UScore'];
	$GroupSubQ10Title = $_POST['GroupSubQ10Title'];
	$GroupSubQ10A1Content = $_POST['GroupSubQ10A1Content'];
	$GQ10A1UScore = $_POST['GQ10A1UScore'];
	$GroupSubQ10A2Content = $_POST['GroupSubQ10A2Content'];
	$GQ10A2UScore = $_POST['GQ10A2UScore'];
	$GroupSubQ10A3Content = $_POST['GroupSubQ10A3Content'];
	$GQ10A3UScore = $_POST['GQ10A3UScore'];
	$GroupSubQ10A4Content = $_POST['GroupSubQ10A4Content'];
	$GQ10A4UScore = $_POST['GQ10A4UScore'];
	$Usort1 = $_POST['Usort1'];
	$Usort2 = $_POST['Usort2'];
	$Usort3 = $_POST['Usort3'];
	$Usort4 = $_POST['Usort4'];
	$Usort5 = $_POST['Usort5'];
	$Usort6 = $_POST['Usort6'];
	$Usort7 = $_POST['Usort7'];
	$Usort8 = $_POST['Usort8'];
	$Usort9 = $_POST['Usort9'];
	$Usort10 = $_POST['Usort10'];

	//Short Ans
	$SAId = $_POST['SAId'];
	$SAUDetail = $_POST['SAUDetail'];

	$QType = $_POST['QType'];

	switch ($QType) {
		case 'TFUQuestion':
			$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'TF' AND QID = '$TFId'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);

			if ($c) {
				echo $c;
			}else{
				$imageArray = $_POST['imageArray'];

				$sql = "UPDATE tfquestionbase SET TFDetail = '$TFUDetail' , TContent = '$TUContent' , FContent = '$FUContent' , TScore = '$TUScore' , FScore = '$FUScore' WHERE TFId = '$TFId'";
				mysql_query($sql) or die('err1 , tfquestionbase update error');

				// $check = array_filter($imageArray);
				if(!empty($imageArray)){
					$sql = "DELETE FROM imagelink WHERE QID = '$TFId' and QType = 'TFQuestion'";
					mysql_query($sql) or die('err001 , delete img');

					for ($i=0; $i < count($imageArray); $i++) { 
						$imageTemp = '';
						$imageTemp = $imageArray[$i];

						$sql = "INSERT INTO imagelink (imageID , QID , QType)
						VALUES ('$imageTemp' , '$TFId' , 'TFQuestion')";
						mysql_query($sql) or die('err002 , update and insert imagelink table');
					}
				}
				else{
					$sql = "DELETE FROM imagelink WHERE QID = '$TFId' and QType = 'TFQuestion'";
					mysql_query($sql) or die('err003 , delete img');
				}
			}

			
			break;

		case 'ChoiceUQuestion':
			$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'CH' AND QID = '$CHId'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);

			if ($c) {
				echo $c;
			}else{
				$imageArray = $_POST['imageArray'];

				$sql = "UPDATE choicequestionbase SET ChDetail = '$ChUDetail' , ChAns1Content = '$C1UAns' , ChAns2Content = '$C2UAns' , ChAns3Content = '$C3UAns' , ChAns4Content = '$C4UAns' , ChAns1Score = '$C1UScore' , ChAns2Score = '$C2UScore' , ChAns3Score = '$C3UScore' , ChAns4Score = '$C4UScore' WHERE ChId = '$CHId'";
				mysql_query($sql) or die('err2 , choicequestionbase update error');

				// $check2 = array_filter($imageArray);
				if(!empty($imageArray)){
					$sql = "DELETE FROM imagelink WHERE QID = '$CHId' and QType = 'ChoiceQuestion'";
					mysql_query($sql) or die('err004 , delete img');

					for ($i=0; $i < count($imageArray); $i++) { 
						$imageTemp = '';
						$imageTemp = $imageArray[$i];

						$sql = "INSERT INTO imagelink (imageID , QID , QType)
						VALUES ('$imageTemp' , '$CHId' , 'ChoiceQuestion')";
						mysql_query($sql) or die('err005 , update and insert imagelink table');
					}
				}
				else{
					$sql = "DELETE FROM imagelink WHERE QID = '$CHId' and QType = 'ChoiceQuestion'";
					mysql_query($sql) or die('err006 , delete img');
				}
			}

			break;

		case 'GroupUQuestion':
			// $paperCount = "SELECT DISTINCT paperID FROM grade_detail";
			// $paperCountResult = mysql_query($paperCount);
			// $paperCountRow = mysql_num_rows($paperCountResult);
			// $c = 0;

			// for ($t=0; $t < $paperCountRow; $t++) { 
			// 	$paperID = mysql_result($paperCountResult, $t , 0);
			// 	$sql = "SELECT COUNT(*) FROM paperlink WHERE QType = 'GP' AND QID = '$GroupID'"; 
			// 	$result = mysql_query($sql);
			// 	if(mysql_result($result, 0)) {
			// 		$c += 1;
			// 	}
			// }

			$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'GP' AND QID = '$GroupQ1Id'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);

			if ($c) {
				echo $c;
			}else{
				$imageArray = $_POST['imageArray'];

				$sql = "UPDATE groupquestionbase SET GroupTitle = '$GroupTitle' WHERE GroupID = '$GroupID' ";
				mysql_query($sql) or die('err3 , groupquestionbase update error');


				// $check3 = array_filter($imageArray);
				if(!empty($imageArray)){
					$sql = "DELETE FROM imagelink WHERE QID = '$GroupID' and QType = 'Group'";
					mysql_query($sql) or die('err007 , delete img');

					for ($i=0; $i < count($imageArray); $i++) { 
						$imageTemp = '';
						$imageTemp = $imageArray[$i];

						$sql = "INSERT INTO imagelink (imageID , QID , QType)
						VALUES ('$imageTemp' , '$GroupID' , 'Group')";
						mysql_query($sql) or die('err008 , update and insert imagelink table');
					}
				}
				else{
					$sql = "DELETE FROM imagelink WHERE QID = '$GroupID' and QType = 'Group'";
					mysql_query($sql) or die('err009 , delete img');
				}


				$GpIdTemp1 = ($GroupID - 1) *10 + 1;
				$GpIdTemp2 = ($GroupID - 1) *10 + 2;
				$GpIdTemp3 = ($GroupID - 1) *10 + 3;
				$GpIdTemp4 = ($GroupID - 1) *10 + 4;
				$GpIdTemp5 = ($GroupID - 1) *10 + 5;
				$GpIdTemp6 = ($GroupID - 1) *10 + 6;
				$GpIdTemp7 = ($GroupID - 1) *10 + 7;
				$GpIdTemp8 = ($GroupID - 1) *10 + 8;
				$GpIdTemp9 = ($GroupID - 1) *10 + 9;
				$GpIdTemp10 = ($GroupID - 1) *10 + 10;
				//sub1
				if($GroupSubQ1Title != ''){
					$result = mysql_query("SELECT GroupQID FROM groupsubquestionbase WHERE GroupQID = '$GpIdTemp1' and GroupID = '$GroupID'");

					if(mysql_num_rows($result) == 0){
						// $sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score)
						// VALUES ('$GpIdTemp1' , '$GroupID' , '$GroupSubQ1Title' , '$GroupSubQ1A1Content' , '$GQ1A1UScore' , '$GroupSubQ1A2Content' , '$GQ1A2UScore' , '$GroupSubQ1A3Content' , '$GQ1A3UScore' , '$GroupSubQ1A4Content' , '$GQ1A4UScore')";
						// mysql_query($sql) or die('err4-0');

						// $sql = "INSERT INTO groupqtable (GroupID , GroupQ1ID)
						// VALUES ('$GroupID' , '$GpIdTemp1')";
						// mysql_query($sql) or die('err4--0');
					}
					else{
						$sql = "UPDATE groupsubquestionbase SET sort = '$Usort1' , GroupQContent = '$GroupSubQ1Title' , GroupA1Content = '$GroupSubQ1A1Content' , GroupA1Score = '$GQ1A1UScore' , GroupA2Content = '$GroupSubQ1A2Content' , GroupA2Score = '$GQ1A2UScore' , GroupA3Content = '$GroupSubQ1A3Content' , GroupA3Score = '$GQ1A3UScore' , GroupA4Content = '$GroupSubQ1A4Content' , GroupA4Score = '$GQ1A4UScore' WHERE GroupID = '$GroupID' and GroupQID = '$GpIdTemp1'";
						mysql_query($sql) or die('err4 , groupsubquestionbase error');
					}
				}
				else{

				}

				//sub2
				if($GroupSubQ2Title != ''){

					$result = mysql_query("SELECT GroupQID FROM groupsubquestionbase WHERE GroupQID = '$GpIdTemp2' and GroupID = '$GroupID'");

					if(mysql_num_rows($result) == 0){
						$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score , sort)
						VALUES ('$GpIdTemp2' , '$GroupID' , '$GroupSubQ2Title' , '$GroupSubQ2A1Content' , '$GQ2A1UScore' , '$GroupSubQ2A2Content' , '$GQ2A2UScore' , '$GroupSubQ2A3Content' , '$GQ2A3UScore' , '$GroupSubQ2A4Content' , '$GQ2A4UScore' , '$Usort2')";
						mysql_query($sql) or die('err5-0');

						$sql = "UPDATE groupqtable SET GroupQ2ID = '$GpIdTemp2' WHERE GroupID = '$GroupID'";
						mysql_query($sql) or die('err5--0');
					}
					else{
						$sql = "UPDATE groupsubquestionbase SET sort = '$Usort2' , GroupQContent = '$GroupSubQ2Title' , GroupA1Content = '$GroupSubQ2A1Content' , GroupA1Score = '$GQ2A1UScore' , GroupA2Content = '$GroupSubQ2A2Content' , GroupA2Score = '$GQ2A2UScore' , GroupA3Content = '$GroupSubQ2A3Content' , GroupA3Score = '$GQ2A3UScore' , GroupA4Content = '$GroupSubQ2A4Content' , GroupA4Score = '$GQ2A4UScore' WHERE GroupID = '$GroupID' and GroupQID = '$GpIdTemp2'";
						mysql_query($sql) or die('err5 , groupsubquestionbase error');
					}
				}
				else{
					$sql = "DELETE from groupsubquestionbase WHERE GroupQID = '$GpIdTemp2' and GroupID = '$GroupID'";
					mysql_query($sql) or die('err5-1');

					$sql = "UPDATE groupqtable SET GroupQ2ID = '' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('err5-2');
				}

				//sub3
				if($GroupSubQ3Title != ''){
					// echo "1";
					$result = mysql_query("SELECT GroupQID FROM groupsubquestionbase WHERE GroupQID = '$GpIdTemp3' and GroupID = '$GroupID'");

					if(mysql_num_rows($result) == 0){
						$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score , sort)
						VALUES ('$GpIdTemp3' , '$GroupID' , '$GroupSubQ3Title' , '$GroupSubQ3A1Content' , '$GQ3A1UScore' , '$GroupSubQ3A2Content' , '$GQ3A2UScore' , '$GroupSubQ3A3Content' , '$GQ3A3UScore' , '$GroupSubQ3A4Content' , '$GQ3A4UScore' , '$Usort3')";
						mysql_query($sql) or die('err6-0');

						$sql = "UPDATE groupqtable SET GroupQ3ID = '$GpIdTemp3' WHERE GroupID = '$GroupID'";
						mysql_query($sql) or die('err6--0');
					}
					else{
						// echo "2";
						$sql = "UPDATE groupsubquestionbase SET sort = '$Usort3' , GroupQContent = '$GroupSubQ3Title' , GroupA1Content = '$GroupSubQ3A1Content' , GroupA1Score = '$GQ3A1UScore' , GroupA2Content = '$GroupSubQ3A2Content' , GroupA2Score = '$GQ3A2UScore' , GroupA3Content = '$GroupSubQ3A3Content' , GroupA3Score = '$GQ3A3UScore' , GroupA4Content = '$GroupSubQ3A4Content' , GroupA4Score = '$GQ3A4UScore' WHERE GroupID = '$GroupID' and GroupQID = '$GpIdTemp3'";
						mysql_query($sql) or die('err6 , groupsubquestionbase error');
					}
				}
				else{
					$sql = "DELETE from groupsubquestionbase WHERE GroupQID = '$GpIdTemp3' and GroupID = '$GroupID'";
					mysql_query($sql) or die('err6-1');

					$sql = "UPDATE groupqtable SET GroupQ3ID = '' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('err6-2');
				}

				//sub4
				if($GroupSubQ4Title != ''){

					$result = mysql_query("SELECT GroupQID FROM groupsubquestionbase WHERE GroupQID = '$GpIdTemp4' and GroupID = '$GroupID'");

					if(mysql_num_rows($result) == 0){
						$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score , sort)
						VALUES ('$GpIdTemp4' , '$GroupID' , '$GroupSubQ4Title' , '$GroupSubQ4A1Content' , '$GQ4A1UScore' , '$GroupSubQ4A2Content' , '$GQ4A2UScore' , '$GroupSubQ4A3Content' , '$GQ4A3UScore' , '$GroupSubQ4A4Content' , '$GQ4A4UScore' , '$Usort4')";
						mysql_query($sql) or die('err7-0');

						$sql = "UPDATE groupqtable SET GroupQ4ID = '$GpIdTemp4' WHERE GroupID = '$GroupID'";
						mysql_query($sql) or die('err7--0');
					}
					else{
						$sql = "UPDATE groupsubquestionbase SET sort = '$Usort4' , GroupQContent = '$GroupSubQ4Title' , GroupA1Content = '$GroupSubQ4A1Content' , GroupA1Score = '$GQ4A1UScore' , GroupA2Content = '$GroupSubQ4A2Content' , GroupA2Score = '$GQ4A2UScore' , GroupA3Content = '$GroupSubQ4A3Content' , GroupA3Score = '$GQ4A3UScore' , GroupA4Content = '$GroupSubQ4A4Content' , GroupA4Score = '$GQ4A4UScore' WHERE GroupID = '$GroupID' and GroupQID = '$GpIdTemp4'";
						mysql_query($sql) or die('err7 , groupsubquestionbase error');
					}
				}
				else{
					$sql = "DELETE from groupsubquestionbase WHERE GroupQID = '$GpIdTemp4' and GroupID = '$GroupID'";
					mysql_query($sql) or die('err7-1');

					$sql = "UPDATE groupqtable SET GroupQ4ID = '' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('err7-2');
				}

				//sub5
				if($GroupSubQ5Title != ''){

					$result = mysql_query("SELECT GroupQID FROM groupsubquestionbase WHERE GroupQID = '$GpIdTemp5' and GroupID = '$GroupID'");

					if(mysql_num_rows($result) == 0){
						$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score , sort)
						VALUES ('$GpIdTemp5' , '$GroupID' , '$GroupSubQ5Title' , '$GroupSubQ5A1Content' , '$GQ5A1UScore' , '$GroupSubQ5A2Content' , '$GQ5A2UScore' , '$GroupSubQ5A3Content' , '$GQ5A3UScore' , '$GroupSubQ5A4Content' , '$GQ5A4UScore' , '$Usort5')";
						mysql_query($sql) or die('err7-0');

						$sql = "UPDATE groupqtable SET GroupQ5ID = '$GpIdTemp5' WHERE GroupID = '$GroupID'";
						mysql_query($sql) or die('err7--0');
					}
					else{
						$sql = "UPDATE groupsubquestionbase SET sort = '$Usort5' , GroupQContent = '$GroupSubQ5Title' , GroupA1Content = '$GroupSubQ5A1Content' , GroupA1Score = '$GQ5A1UScore' , GroupA2Content = '$GroupSubQ5A2Content' , GroupA2Score = '$GQ5A2UScore' , GroupA3Content = '$GroupSubQ5A3Content' , GroupA3Score = '$GQ5A3UScore' , GroupA4Content = '$GroupSubQ5A4Content' , GroupA4Score = '$GQ5A4UScore' WHERE GroupID = '$GroupID' and GroupQID = '$GpIdTemp5'";
						mysql_query($sql) or die('err7 , groupsubquestionbase error');
					}
				}
				else{
					$sql = "DELETE from groupsubquestionbase WHERE GroupQID = '$GpIdTemp5' and GroupID = '$GroupID'";
					mysql_query($sql) or die('err7-1');

					$sql = "UPDATE groupqtable SET GroupQ5ID = '' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('err7-2');
				}

				//sub6
				if($GroupSubQ6Title != ''){

					$result = mysql_query("SELECT GroupQID FROM groupsubquestionbase WHERE GroupQID = '$GpIdTemp6' and GroupID = '$GroupID'");

					if(mysql_num_rows($result) == 0){
						$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score , sort)
						VALUES ('$GpIdTemp6' , '$GroupID' , '$GroupSubQ6Title' , '$GroupSubQ6A1Content' , '$GQ6A1UScore' , '$GroupSubQ6A2Content' , '$GQ6A2UScore' , '$GroupSubQ6A3Content' , '$GQ6A3UScore' , '$GroupSubQ6A4Content' , '$GQ6A4UScore' , '$Usort6')";
						mysql_query($sql) or die('err7-0');

						$sql = "UPDATE groupqtable SET GroupQ6ID = '$GpIdTemp6' WHERE GroupID = '$GroupID'";
						mysql_query($sql) or die('err7--0');
					}
					else{
						$sql = "UPDATE groupsubquestionbase SET sort = '$Usort6' , GroupQContent = '$GroupSubQ6Title' , GroupA1Content = '$GroupSubQ6A1Content' , GroupA1Score = '$GQ6A1UScore' , GroupA2Content = '$GroupSubQ6A2Content' , GroupA2Score = '$GQ6A2UScore' , GroupA3Content = '$GroupSubQ6A3Content' , GroupA3Score = '$GQ6A3UScore' , GroupA4Content = '$GroupSubQ6A4Content' , GroupA4Score = '$GQ6A4UScore' WHERE GroupID = '$GroupID' and GroupQID = '$GpIdTemp6'";
						mysql_query($sql) or die('err7 , groupsubquestionbase error');
					}
				}
				else{
					$sql = "DELETE from groupsubquestionbase WHERE GroupQID = '$GpIdTemp6' and GroupID = '$GroupID'";
					mysql_query($sql) or die('err7-1');

					$sql = "UPDATE groupqtable SET GroupQ6ID = '' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('err7-2');
				}

				//sub7
				if($GroupSubQ7Title != ''){

					$result = mysql_query("SELECT GroupQID FROM groupsubquestionbase WHERE GroupQID = '$GpIdTemp7' and GroupID = '$GroupID'");

					if(mysql_num_rows($result) == 0){
						$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score , sort)
						VALUES ('$GpIdTemp7' , '$GroupID' , '$GroupSubQ7Title' , '$GroupSubQ7A1Content' , '$GQ7A1UScore' , '$GroupSubQ7A2Content' , '$GQ7A2UScore' , '$GroupSubQ7A3Content' , '$GQ7A3UScore' , '$GroupSubQ7A4Content' , '$GQ7A4UScore' , '$Usort7')";
						mysql_query($sql) or die('err7-0');

						$sql = "UPDATE groupqtable SET GroupQ7ID = '$GpIdTemp7' WHERE GroupID = '$GroupID'";
						mysql_query($sql) or die('err7--0');
					}
					else{
						$sql = "UPDATE groupsubquestionbase SET sort = '$Usort7' , GroupQContent = '$GroupSubQ7Title' , GroupA1Content = '$GroupSubQ7A1Content' , GroupA1Score = '$GQ7A1UScore' , GroupA2Content = '$GroupSubQ7A2Content' , GroupA2Score = '$GQ7A2UScore' , GroupA3Content = '$GroupSubQ7A3Content' , GroupA3Score = '$GQ7A3UScore' , GroupA4Content = '$GroupSubQ7A4Content' , GroupA4Score = '$GQ7A4UScore' WHERE GroupID = '$GroupID' and GroupQID = '$GpIdTemp7'";
						mysql_query($sql) or die('err7 , groupsubquestionbase error');
					}
				}
				else{
					$sql = "DELETE from groupsubquestionbase WHERE GroupQID = '$GpIdTemp7' and GroupID = '$GroupID'";
					mysql_query($sql) or die('err7-1');

					$sql = "UPDATE groupqtable SET GroupQ7ID = '' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('err7-2');
				}

				//sub8
				if($GroupSubQ8Title != ''){

					$result = mysql_query("SELECT GroupQID FROM groupsubquestionbase WHERE GroupQID = '$GpIdTemp8' and GroupID = '$GroupID'");

					if(mysql_num_rows($result) == 0){
						$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score , sort)
						VALUES ('$GpIdTemp8' , '$GroupID' , '$GroupSubQ8Title' , '$GroupSubQ8A1Content' , '$GQ8A1UScore' , '$GroupSubQ8A2Content' , '$GQ8A2UScore' , '$GroupSubQ8A3Content' , '$GQ8A3UScore' , '$GroupSubQ8A4Content' , '$GQ8A4UScore' , '$Usort8')";
						mysql_query($sql) or die('err7-0');

						$sql = "UPDATE groupqtable SET GroupQ8ID = '$GpIdTemp8' WHERE GroupID = '$GroupID'";
						mysql_query($sql) or die('err7--0');
					}
					else{
						$sql = "UPDATE groupsubquestionbase SET sort = '$Usort8' , GroupQContent = '$GroupSubQ8Title' , GroupA1Content = '$GroupSubQ8A1Content' , GroupA1Score = '$GQ8A1UScore' , GroupA2Content = '$GroupSubQ8A2Content' , GroupA2Score = '$GQ8A2UScore' , GroupA3Content = '$GroupSubQ8A3Content' , GroupA3Score = '$GQ8A3UScore' , GroupA4Content = '$GroupSubQ8A4Content' , GroupA4Score = '$GQ8A4UScore' WHERE GroupID = '$GroupID' and GroupQID = '$GpIdTemp8'";
						mysql_query($sql) or die('err7 , groupsubquestionbase error');
					}
				}
				else{
					$sql = "DELETE from groupsubquestionbase WHERE GroupQID = '$GpIdTemp8' and GroupID = '$GroupID'";
					mysql_query($sql) or die('err7-1');

					$sql = "UPDATE groupqtable SET GroupQ8ID = '' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('err7-2');
				}

				//sub9
				if($GroupSubQ9Title != ''){

					$result = mysql_query("SELECT GroupQID FROM groupsubquestionbase WHERE GroupQID = '$GpIdTemp9' and GroupID = '$GroupID'");

					if(mysql_num_rows($result) == 0){
						$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score , sort)
						VALUES ('$GpIdTemp9' , '$GroupID' , '$GroupSubQ9Title' , '$GroupSubQ9A1Content' , '$GQ9A1UScore' , '$GroupSubQ9A2Content' , '$GQ9A2UScore' , '$GroupSubQ9A3Content' , '$GQ9A3UScore' , '$GroupSubQ9A4Content' , '$GQ9A4UScore' , '$Usort9')";
						mysql_query($sql) or die('err7-0');

						$sql = "UPDATE groupqtable SET GroupQ9ID = '$GpIdTemp9' WHERE GroupID = '$GroupID'";
						mysql_query($sql) or die('err7--0');
					}
					else{
						$sql = "UPDATE groupsubquestionbase SET sort = '$Usort9' , GroupQContent = '$GroupSubQ9Title' , GroupA1Content = '$GroupSubQ9A1Content' , GroupA1Score = '$GQ9A1UScore' , GroupA2Content = '$GroupSubQ9A2Content' , GroupA2Score = '$GQ9A2UScore' , GroupA3Content = '$GroupSubQ9A3Content' , GroupA3Score = '$GQ9A3UScore' , GroupA4Content = '$GroupSubQ9A4Content' , GroupA4Score = '$GQ9A4UScore' WHERE GroupID = '$GroupID' and GroupQID = '$GpIdTemp9'";
						mysql_query($sql) or die('err7 , groupsubquestionbase error');
					}
				}
				else{
					$sql = "DELETE from groupsubquestionbase WHERE GroupQID = '$GpIdTemp9' and GroupID = '$GroupID'";
					mysql_query($sql) or die('err7-1');

					$sql = "UPDATE groupqtable SET GroupQ9ID = '' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('err7-2');
				}

				//sub10
				if($GroupSubQ10Title != ''){

					$result = mysql_query("SELECT GroupQID FROM groupsubquestionbase WHERE GroupQID = '$GpIdTemp10' and GroupID = '$GroupID'");

					if(mysql_num_rows($result) == 0){
						$sql = "INSERT INTO groupsubquestionbase (GroupQID , GroupID , GroupQContent , GroupA1Content , GroupA1Score , GroupA2Content , GroupA2Score , GroupA3Content , GroupA3Score , GroupA4Content , GroupA4Score , sort)
						VALUES ('$GpIdTemp10' , '$GroupID' , '$GroupSubQ10Title' , '$GroupSubQ10A1Content' , '$GQ10A1UScore' , '$GroupSubQ10A2Content' , '$GQ10A2UScore' , '$GroupSubQ10A3Content' , '$GQ10A3UScore' , '$GroupSubQ10A4Content' , '$GQ10A4UScore' , '$Usort10')";
						mysql_query($sql) or die('err7-0');

						$sql = "UPDATE groupqtable SET GroupQ10ID = '$GpIdTemp10' WHERE GroupID = '$GroupID'";
						mysql_query($sql) or die('err7--0');
					}
					else{
						$sql = "UPDATE groupsubquestionbase SET sort = '$Usort10' , GroupQContent = '$GroupSubQ10Title' , GroupA1Content = '$GroupSubQ10A1Content' , GroupA1Score = '$GQ10A1UScore' , GroupA2Content = '$GroupSubQ10A2Content' , GroupA2Score = '$GQ10A2UScore' , GroupA3Content = '$GroupSubQ10A3Content' , GroupA3Score = '$GQ10A3UScore' , GroupA4Content = '$GroupSubQ10A4Content' , GroupA4Score = '$GQ10A4UScore' WHERE GroupID = '$GroupID' and GroupQID = '$GpIdTemp10'";
						mysql_query($sql) or die('err7 , groupsubquestionbase error');
					}
				}
				else{
					$sql = "DELETE from groupsubquestionbase WHERE GroupQID = '$GpIdTemp10' and GroupID = '$GroupID'";
					mysql_query($sql) or die('err7-1');

					$sql = "UPDATE groupqtable SET GroupQ10ID = '' WHERE GroupID = '$GroupID'";
					mysql_query($sql) or die('err7-2');
				}
			}

			break;

		case 'SAUQuestion':
			$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'SA' AND QID = '$SAId'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);

			if ($c) {
				echo $c;
			}else{
				$sql = "UPDATE short SET SADetail = '$SAUDetail' WHERE SAId = '$SAId'";
				mysql_query($sql) or die('err1 , short Ans update error');
			
				$imageArray = $_POST['imageArray'];

				if(!empty($imageArray)){
					$sql = "DELETE FROM imagelink WHERE QID = '$SAId' and QType = 'SAQuestion'";
					mysql_query($sql) or die('err001 , delete img');

					for ($i=0; $i < count($imageArray); $i++) { 
						$imageTemp = '';
						$imageTemp = $imageArray[$i];

						$sql = "INSERT INTO imagelink (imageID , QID , QType)
						VALUES ('$imageTemp' , '$SAId' , 'SAQuestion')";
						mysql_query($sql) or die('err002 , update and insert imagelink table');
					}
				}
				else{
					$sql = "DELETE FROM imagelink WHERE QID = '$SAId' and QType = 'SAQuestion'";
					mysql_query($sql) or die('err003 , delete img');
				}
			}
			
				


			break;
		
		default:
			# code...
			break;
	}

?>
<?php
	require 'connectdb.php';
?>

<?php
	//True & False
	$TFId = $_POST['TFId'];
	$TFUDetail = $_POST['TFUDetail'];

	//Choice
	$CHId = $_POST['CHId'];
	$ChoiceUDetail = $_POST['ChoiceUDetail'];

	//Group
	$GPID = $_POST['GroupID'];
	$GroupUDetail = $_POST['GroupUDetail'];

	//Short Ans
	$SAId = $_POST['SAId'];
	$SAUDetail = $_POST['SAUDetail'];

	$QType = $_POST['QType'];


	switch ($QType) {
		case 'TFDQuestion':
			$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'TF' AND QID = '$TFId'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);
			
			if ($c) {
				echo $c;
			}
			else{
				$sql = "DELETE from tfquestionbase WHERE TFId = '$TFId' and TFDetail = '$TFUDetail' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'TF' and QID = '$TFId')";
				mysql_query($sql) or die('err1 , tfquestionbase delete error');

				$sql = "DELETE from imagelink WHERE QID = '$TFId' and QType = 'TFQuestion' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'TF' and QID = '$TFId')";
				mysql_query($sql) or die('TFQuestion delete imagelink error');

				$sql = "DELETE from paperlink WHERE QID = '$TFId' and QType = 'TF' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'TF' and QID = '$TFId')";
				mysql_query($sql) or die('TFQuestion delete paperlink error');
				
				echo $c;
			}

			break;

		case 'ChoiceDQuestion':
			$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'CH' AND QID = '$CHId'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);

			if ($c) {
				echo $c;
			}else{
				$sql = "DELETE from choicequestionbase WHERE ChId = '$CHId' and ChDetail = '$ChoiceUDetail' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'CH' and QID = '$CHId')";
				mysql_query($sql) or die('err2 , choicequestionbase delete error');

				$sql = "DELETE from imagelink WHERE QID = '$CHId' and QType = 'ChoiceQuestion' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'CH' and QID = '$CHId')";
				mysql_query($sql) or die('TFQuestion delete imagelink error');

				$sql = "DELETE from paperlink WHERE QID = '$CHId' and QType = 'CH' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'CH' and QID = '$CHId')";
				mysql_query($sql) or die('TFQuestion delete paperlink error');

				echo $c;
			}

			break;

		case 'GroupDQuestion':
			$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'GP' AND QID = '$GPID'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);

			if ($c) {
				echo $c;
			}else{
				$sql = "DELETE from groupquestionbase WHERE GroupID = '$GPID' and GroupTitle = '$GroupUDetail' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'GP' and QID = '$GPID')";
				mysql_query($sql) or die('err3 , groupquestionbase delete error');

				$sql = "DELETE from imagelink WHERE QID = '$GPID' and QType = 'Group' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'GP' and QID = '$GPID')";
				mysql_query($sql) or die('TFQuestion delete imagelink error');

				$sql = "DELETE from paperlink WHERE QID = '$GPID' and QType = 'GP' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'GP' and QID = '$GPID')";
				mysql_query($sql) or die('TFQuestion delete paperlink error');

				echo $c;
			}

			break;
		
		case 'SADelQuestion':
			$sql = "SELECT COUNT(*) FROM grade_detail WHERE QType = 'SA' AND QID = '$SAId'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);

			if ($c) {
				echo $c;
			}else{
				$sql = "DELETE from short WHERE SAId = '$SAId' and SADetail = '$SAUDetail' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'SA' and QID = '$SAId')";
				mysql_query($sql) or die('err , SA delete error');

				$sql = "DELETE from paperlink WHERE QID = '$SAId' and QType = 'SA' and NOT EXISTS(SELECT * FROM grade_detail WHERE QType = 'SA' and QID = '$SAId')";
				mysql_query($sql) or die('SAQuestion delete paperlink error');

				echo $c;
			}
			
			break;

		default:
			# code...
			break;
	}

?>
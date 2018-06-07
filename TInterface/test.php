<?php
	require 'connectdb.php'
?>

<?php
	ob_start();
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-type: application/vnd.ms-excel");


	$studentID = $_GET['studentID'];
	$studentName = $_GET['studentName'];

	$sql = "SELECT * FROM student_grade WHERE studentID = '$studentID'";
	$result = mysql_query($sql) or die('get student grade error');
	$row_num = mysql_num_rows($result);
	$field_num = mysql_num_fields($result);

	$filename = 'Student_Grade_Table';


	


	for ($i=0; $i < $row_num; $i++) { 
		$paperID = mysql_result($result, $i , 'paperID');
		$grade = mysql_result($result, $i , 'grade');
		$Time = mysql_result($result, $i , 'Time');

		$sql = "SELECT PTitle FROM paperbase WHERE paperID = '$paperID'";
		$result2 = mysql_query($sql) or die('excel ptitle error');
		$PTitle = mysql_result($result2, 0);

		$content = "$studentID\t$studentName\t$paperID\t$PTitle\t$grade\t$Time\n";

		$content =  mb_convert_encoding($content , "big5" , "UTF8");
	}

	echo $content;
?>
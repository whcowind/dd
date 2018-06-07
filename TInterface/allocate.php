<?php 
	require 'connectdb.php'
?>

<?php
	$Aid = $_POST['Aid'];
	$paperID = $_POST['paperID'];
	$studentArray = $_POST['studentArray'];

	$allocateID = getAllocateID();
	
	for ($i=0; $i < count($studentArray); $i++) { 
		$studentID = $studentArray[$i];
		

		$sql = "SELECT PTitle FROM paperbase WHERE paperID = '$paperID'";
		$result = mysql_query($sql) or die('err2');
		$Title = mysql_result($result, 0);
	
		$sql = "INSERT INTO allocate(allocateID , paperID , PTitle , studentID , progressing , Steacher)
		VALUES ('$allocateID' , '$paperID' , '$Title' , '$studentID' , '1' , '$Aid')";
		mysql_query($sql) or die('allocate error');

		$gradeID = getgradeId($studentID);

		$sql = "INSERT INTO student_grade(studentID , paperID , gradeID , allocateID , grade)
		VALUES ('$studentID' , '$paperID' , '$gradeID' , '$allocateID' , '0')";
		mysql_query($sql) or die('grade init error');

	}


	function getAllocateID() {
		$count = 1;
		$sql = "SELECT DISTINCT allocateID FROM allocate ORDER BY allocateID ASC";
		$result = mysql_query($sql) or die('allocateID error');
		$row_num = mysql_num_rows($result);


		if ($row_num == 0) {
			return $count;
		}else{

			for ($i=0; $i < $row_num; $i++) { 
				$Id = mysql_result($result, $i , 'allocateID');

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


	function getgradeId($SID) {
		$count = 1;
		$sql = "SELECT * FROM student_grade WHERE studentID = '$SID' ORDER BY gradeID ASC";
		$result = mysql_query($sql) or die('paperID error');
		$row_num = mysql_num_rows($result);


		if ($row_num == 0) {
			return $count;
		}else{

			for ($i=0; $i < $row_num; $i++) { 
				$Id = mysql_result($result, $i , 'gradeID');

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
<?php
	require 'connectdb.php'
?>

<?php
	$Aid = $_GET['Aid'];


	$sql = "SELECT * FROM student_data WHERE Steacher = '$Aid'";
	$result = mysql_query($sql) or die('err1,get student data error');
	$rownum = mysql_num_rows($result);
	$fieldnum = mysql_num_fields($result);

	$student = array();
	$count = 0;

	for ($i=0; $i < $rownum; $i++) { 
		for ($j=0; $j < $fieldnum; $j++) { 

			$field_name = mysql_field_name($result , $j);

			$student[$i][$field_name] = mysql_result($result, $i , $field_name);

		}
		$student[$i]['length'] = $rownum;
	}

	echo json_encode($student);


?>
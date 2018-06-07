<?php
	require 'connectdb.php';
?>

<?php
	$type = $_GET['type'];

	switch ($type) {
		case 'paper_exist':
			paper_exist();
			break;
		
		default:
			# code...
			break;
	}

	function paper_exist(){
		$sql = "SELECT * FROM paperbase ORDER BY paperID ASC";
		$result = mysql_query($sql) or die('paper message load error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				if ($field_name == 'owner') {
					$owner = mysql_result($result, $i , $field_name);

					$sql_getAdmin = "SELECT * FROM admin_data WHERE Aid = '$owner'";

					$Aname = mysql_result(mysql_query($sql_getAdmin), 0 , 'Aname');

					$res[$i][$field_name] = mysql_result($result, $i , $field_name);

					$res[$i]['Aname'] = $Aname;
				}else{
					$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				}
			}
		}
		echo json_encode($res);
	}
?>
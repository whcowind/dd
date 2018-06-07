<?php
	require 'connectdb.php';
?>

<?php
	$type = $_GET['type'];

	switch ($type) {
		case 'picture_exist':
			picture_exist();
			break;

		case 'del':
			$imgArr = $_GET['imgArr'];

			del($imgArr);
			break;
		
		default:
			# code...
			break;
	}

	function picture_exist(){
		$sql = "SELECT * FROM imagetable ORDER BY imageID ASC";
		$result = mysql_query($sql) or die('teacher message load error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				if ($field_name == 'imageURL') {
					$urlTemp = mysql_result($result, $i , $field_name);

					$url = '../../TInterface/' . $urlTemp;

					$res[$i][$field_name] = $url;
				}else if($field_name == 'owner'){
					$owner = mysql_result($result, $i , $field_name);
					$name = mysql_result(mysql_query("SELECT Aname FROM admin_data WHERE Aid = '$owner'"), 0);

					$res[$i][$field_name] = $owner;
					$res[$i][$name] = $name;
				}else{
					$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				}
			}
		}
		echo json_encode($res);
	}

	function del($imgArr) {
		foreach ($imgArr as $value) {
			$imgID = $value;

			$sql_delfile = "SELECT imageURL FROM imagetable WHERE imageID = '$imgID'";
			$URL = mysql_result(mysql_query($sql_delfile), 0);
			$URL = "../../TInterface/" . $URL;
			@unlink($URL);

			$sql = "DELETE FROM imagetable WHERE imageID = '$imgID'";
			mysql_query($sql) or die('delete img error');
		}
	}
?>
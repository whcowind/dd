<?php
	require 'connectdb2.php';
?>

<?php
	$Type = $_GET['Type'];

	switch ($Type) {
		case 'getList':
			getList();
			break;

		case 'passCheck':
			$ID = $_GET['ID'];
			$pass = $_GET['pass'];

			$sql = "SELECT * FROM share WHERE ID = '$ID'";
			$result = mysql_query($sql) or die('error in check pass');
			$password = mysql_result($result, 0 , 'password');

			$res = array();

			if ($pass == $password) {
				$path = mysql_result($result, 0 , 'file_path');
				$title = mysql_result($result, 0 , 'title');

				$res[0]['path'] = $path;
				$res[0]['title'] = $title;
				$res[0]['check'] = '1';
			}else{
				$res[0]['check'] = '0';
			}

			echo json_encode($res);
			
			break;

		case 'new_share':
			$teacherID = $_GET['teacherID'];
			$sort = $_GET['sort'];
			$pass = $_GET['pass'];
			$upName = $_GET['upName'];
			$upTitle = $_GET['upTitle'];
			$ID = getShareID();

			$sql = "INSERT INTO share(ID , password , sort , Aid , name , title , file_path , upTime)
			VALUES('$ID' , '$pass' , '$sort' , '$teacherID' , '$upName' , '$upTitle' , 'none' , '')";
			mysql_query($sql) or die(mysql_error());

			echo $ID;
			break;

		case 'del':
			$teacherID = $_GET['teacherID'];
			$ID = $_GET['ID'];

			$sql_getpath = "SELECT file_path FROM share WHERE ID = '$ID' AND Aid = '$teacherID'";
			$result = mysql_query($sql_getpath) or die(mysql_error());
			$path = mysql_result($result, 0);
			if ($path != 'none') {
				@unlink($path);
			}

			$sql = "DELETE FROM share WHERE ID = '$ID'";
			mysql_query($sql) or die('delete share error');
			break;
		
		default:
			# code...
			break;
	}

	function getList() {
		$sql = "SELECT * FROM share ORDER BY upTime DESC";
		$result = mysql_query($sql) or die('share message load error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				$res[$i][$field_name] = mysql_result($result, $i , $field_name);

			}
		}
		echo json_encode($res);
	}

	function getShareID() {
		$count = 1;
		$sql = "SELECT * FROM share ORDER BY ID ASC";
		$result = mysql_query($sql) or die('shareID error');
		$row_num = mysql_num_rows($result);


		if ($row_num == 0) {
			return $count;
		}else{

			for ($i=0; $i < $row_num; $i++) { 
				$Id = mysql_result($result, $i , 'ID');

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
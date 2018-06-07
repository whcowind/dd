<?php 
	require 'connectdb.php';
?>

<?php
	$type = $_POST['type'];

	switch ($type) {
		case 'newShare':
			$name = $_POST['name'];
			$title = $_POST['title'];
			$pass = $_POST['pass'];
			$sort = $_POST['sort'];

			$ID = getShareID();

			$sql = "INSERT INTO share(ID , password , sort , Aid , name , title , file_path , upTime)
			VALUES('$ID' , '$pass' , '$sort' , 'Manager' , '$name' , '$title' , 'none' , '')";
			mysql_query($sql) or die(mysql_error());

			echo $ID;

			break;

		case 'editShare':
			$ID = $_POST['ID'];
			$name = $_POST['name'];
			$title = $_POST['title'];
			$pass = $_POST['pass'];
			$sort = $_POST['sort'];

			$sql = "UPDATE share SET password = '$pass' , name = '$name' , title = '$title' , sort = '$sort' WHERE ID = '$ID'";
			mysql_query($sql) or die('update share error');

			break;

		case 'deleteShare':
			$ID = $_POST['ID'];

			//unlink file
			$sql = "SELECT file_path FROM share WHERE ID = '$ID'";
			$file_path = mysql_result(mysql_query($sql), 0);
			if ($file_path != 'none') {
				$realPath = "../../TInterface/" . $file_path;
				@unlink($realPath);
			}
			

			$sql = "DELETE FROM share WHERE ID = '$ID'";
			mysql_query($sql) or die('delete share error');
			break;
		
		default:
			# code...
			break;
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
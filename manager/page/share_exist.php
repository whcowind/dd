<?php
	require 'connectdb.php';
?>

<?php
	$type = $_GET['type'];

	switch ($type) {
		case 'share_exist':
			share_exist();
			break;

		case 'getShareData':
			$ID = $_GET['ID'];
			getShareData($ID);
			break;
		
		default:
			# code...
			break;
	}

	function share_exist(){
		$sql = "SELECT * FROM share ORDER BY upTime ASC";
		$result = mysql_query($sql) or die('share message load error');
		$row_num = mysql_num_rows($result);
		$field_num = mysql_num_fields($result);

		$res = array();

		for ($i=0; $i < $row_num; $i++) { 
			
			for ($j=0; $j < $field_num; $j++) { 
				
				$field_name = mysql_field_name($result, $j);

				if ($field_name == 'sort') {
					$sort = mysql_result($result, $i , 'sort');

					switch ($sort) {
						case '1':
							$res[$i][$field_name] = '數學';
							break;
						
						case '2':
							$res[$i][$field_name] = '科學';
							break;

						case '3':
							$res[$i][$field_name] = '閱讀';
							break;

						case '4':
							$res[$i][$field_name] = '其他';
							break;

						default:
							# code...
							break;
					}
				}elseif ($field_name == 'file_path') {
					$file_path = mysql_result($result, $i , 'file_path');
					$title = mysql_result($result, $i , 'title');
					$explode_filename = explode (".", $file_path);
					$res[$i]['downloadName'] = $title . '.' . $explode_filename[1];
					$realPath = "../../TInterface/" . $file_path;
					$res[$i][$field_name] = $realPath;
				}
				else{
					$res[$i][$field_name] = mysql_result($result, $i , $field_name);
				}
			}
		}
		echo json_encode($res);
	}

	function getShareData($ID){
		$sql = "SELECT * FROM share WHERE ID = '$ID'";
		$result = mysql_query($sql) or die('get share message error');
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
?>
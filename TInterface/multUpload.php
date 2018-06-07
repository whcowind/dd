<?php
	require 'connectdb.php';
?>
<?php
	$id = $_POST['id'];
	date_default_timezone_set("Asia/Shanghai");
	$explode_filename = explode (".", $_FILES['files']['name']);
	$upload_filename = date("ymdHis"). floor(microtime() * 1000) . "." . $explode_filename[1];
	// $id = json_decode($_POST['id']);
	// $id = $_REQUEST['id'];
	// $temp = 'temp';

	// if (!is_dir("upload/result/" . $id)) {
	// 	mkdir("upload/result/" . $id , 0777);
	// }

	// mkdir("upload/result/123", 0777);
	// echo "<script>alert('123')</script>";
	// echo $id . " - " . $temp;

	// $Updir = "upload/result/" . $id;
	// $upload_path2 = "upload/1". $upload_filename;
	$upload_path = "upload/1". date("ymdHis") . floor(microtime() * 1000) . "." . $explode_filename[1];
	// echo $upload_path . '-';
	// echo $upload_path2;
	
	// insert the file path to sql
	if (is_file($upload_path)) {
		
	}else{
		if ($id != '') {
			$imageID = getImgId();
			$sql = "INSERT INTO imagetable (imageID , imageURL , owner)
			VALUES ('$imageID' , '$upload_path' , '$id')";
			mysql_query($sql) or die('upimgfile err');


			if( isset($_FILES['files']) && $_FILES['files']['error']==0){
				// $upload_folder = dirname(dirname(__FILE__))."/uploads";	
				// $upload_path = $upload_folder."/".$_FILES['files']['name'];
				// $upload_path = "upload/result/". $id . "/" . $_FILES['files']['name'];
				move_uploaded_file($_FILES['files']['tmp_name'], $upload_path);

				@unlink($_FILES['files']);

				// $unlink_path = "upload/1". $upload_filename;
				// @unlink($unlink_path);


				echo '{"status":"success"}';
				exit();
			}
		}
		
	}

	// if( isset($_FILES['files']) && $_FILES['files']['error']==0){
	// 	// $upload_folder = dirname(dirname(__FILE__))."/uploads";	
	// 	// $upload_path = $upload_folder."/".$_FILES['files']['name'];
	// 	// $upload_path = "upload/result/". $id . "/" . $_FILES['files']['name'];
	// 	move_uploaded_file($_FILES['files']['tmp_name'], $upload_path);

	// 	@unlink($_FILES['files']);

	// 	$unlink_path = "upload/". $upload_filename;
	// 	@unlink($unlink_path);


	// 	echo '{"status":"success"}';
	// 	exit();
	// }
	echo '{"status":"error"}';
	exit();

	function getImgId() {
		$count = 1;
		$sql = "SELECT * FROM imagetable ORDER BY imageID ASC";
		$result = mysql_query($sql) or die('imageID error');
		$row_num = mysql_num_rows($result);


		if ($row_num == 0) {
			return $count;
		}else{

			for ($i=0; $i < $row_num; $i++) { 
				$Id = mysql_result($result, $i , 'imageID');

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
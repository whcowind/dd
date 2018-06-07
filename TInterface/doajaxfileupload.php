
<?php
	require 'connectdb.php';
?>
 


<?php
	$teacherID = $_POST['teacherID'];
	date_default_timezone_set("Asia/Shanghai");
	$error = "";
	$msg = "";
	// $fileElementName = 'fileToUpload';
	$fileElementName = 'giveMeTruth';
	$imageID = getImgId();
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}else 
	{
		if(($_FILES[$fileElementName]["type"] == "image/gif") || ($_FILES[$fileElementName]["type"] == "image/jpeg") || ($_FILES[$fileElementName]["type"] == "image/pjpeg") || ($_FILES[$fileElementName]["type"] == "image/png")){

			if(file_exists("upload/" .$_FILES[$fileElementName]["name"])){

			}	
			else{
				$msg .= " File Name: " . $_FILES[$fileElementName]['name'] . ", ";
				$msg .= " File Size: " . @filesize($_FILES[$fileElementName]['tmp_name']);
				$explode_filename = explode (".", $_FILES[$fileElementName]['name']);
				$upload_filename = date("YmdHis") . "." . $explode_filename[1];

				$imageURL = "upload/".$upload_filename;

				// update the user photo file name
				$sql = "INSERT INTO imagetable (imageID , imageURL , owner)
				VALUES ('$imageID' , '$imageURL' , '$teacherID')";
				mysql_query($sql) or die('upimgfile err');

				//unlink old picture
				// if ($A_photo_init != 'init.jpg') {
				// 	@unlink($A_photo_url);
				// }

				move_uploaded_file($_FILES[$fileElementName]["tmp_name"],"upload/".$upload_filename);
				//for security reason, we force to remove all uploaded file
				@unlink($_FILES[$fileElementName]);
			}
		}
		else{
			
		}

	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";



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

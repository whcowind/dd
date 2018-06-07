
<?php
	require 'connectdb.php';
?>

<?php
	$id = $_POST['id'];

	date_default_timezone_set("Asia/Shanghai");
	$error = "";
	$msg = "";
	$fileElementName = 'fileToUpload';

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
	}elseif(empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}else 
	{
		if(1){
			//($_FILES["fileToUpload"]["type"] == "image/gif") || ($_FILES["fileToUpload"]["type"] == "image/jpeg") || ($_FILES["fileToUpload"]["type"] == "image/pjpeg") || ($_FILES["fileToUpload"]["type"] == "image/png")
			if(0){
				// file_exists("upload/" .$_FILES["fileToUpload"]["name"])
			}	
			else{
				// unlink old file
				$sql = "SELECT file_path FROM share WHERE ID = '$id'";
				$result = mysql_query($sql) or die('delete old file error');
				$old_file_url = mysql_result($result, 0);

				if ($old_file_url != 'none') {
					$realOldPath = "../../TInterface/" . $old_file_url;
					@unlink($realOldPath);
				}

				$msg .= " File Name: " . $_FILES['fileToUpload']['name'] . ", ";
				$msg .= " File Size: " . @filesize($_FILES['fileToUpload']['tmp_name']);
				$explode_filename = explode (".", $_FILES['fileToUpload']['name']);
				$upload_filename = $id . "." . $explode_filename[1];

				$file_path = "upload/share/" . $upload_filename;
				$release = date("Y / m / d");
				$realPath = "../../TInterface/" . $file_path;

				// update the file path to sql
				$sql = "UPDATE share SET file_path = '$file_path' , upTime = '$release' WHERE ID = '$id'";
				mysql_query($sql) or die(mysql_error());
				
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$realPath);
				//for security reason, we force to remove all uploaded file
				@unlink($_FILES['fileToUpload']);
			}
		}
		else{
			
		}

	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
?>

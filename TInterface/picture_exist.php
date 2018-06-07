<?php
	require 'connectdb.php';
?>

<?php
	$type = $_GET['type'];

	switch ($type) {
		case 'del':
			$imgArr = $_GET['imgArr'];

			del($imgArr);
			break;
		
		default:
			# code...
			break;
	}

	function del($imgArr) {
		foreach ($imgArr as $value) {
			$imgID = $value;

			$sql_delfile = "SELECT imageURL FROM imagetable WHERE imageID = '$imgID'";
			$URL = mysql_result(mysql_query($sql_delfile), 0);
			@unlink($URL);

			$sql = "DELETE FROM imagetable WHERE imageID = '$imgID'";
			mysql_query($sql) or die('delete img error');
		}
	}
?>
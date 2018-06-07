<?php
	require 'connectdb.php';
?>
<?php
	date_default_timezone_set('Asia/Taipei');
	// header("Content-Type:text/html;charset=UTF8");
	$type = $_POST['type'];
	$explode_filename = explode (".", $_FILES[$type]['name']);
	$check_file = $explode_filename[1];

	if ($check_file == 'csv') {
		switch ($type) {
			case 'teacher':

				$temp_SQL = "";
				$firstline = 0;
				$release = date(YmdHi);
				$CSVfile = $_FILES["teacher"]["tmp_name"];
				$undoID = "";
				$undoIndex = 0;

				// 解析 CSV 檔之內容，並組成 SQL 字串
				$fp = fopen($CSVfile, "r");
				while ( $ROW = fgetcsv($fp, 0 ) ) {   //(file , length (0 or 忽略表示無上限) , separator , enclosure)
					//CSV 匯出編碼為 BIG5 ，將其轉成 UTF-8
					for ($i=0; $i < count($ROW); $i++) { 
						//mb_conbert_encoding(str , 目標編碼 , 現在編碼)
						$ROW[$i] = mb_convert_encoding($ROW[$i], 'UTF-8' , 'big5');
					}
				  	// 在資料列有內容時（長度大於 0），才做以下動作
				  	if ( strlen($ROW[0]) ) {
				  		$temp_SQL = "";
				  		//跳過第一行
				  		if ($firstline) {
					  		// 如果 $temp_SQL 已經存有內容的話，與之後的內容間，用逗號隔開來
					   		if ( strlen($temp_SQL) ) $temp_SQL .= ", ";
					   		//檢查帳號
					   		$check = checkTeacherID($ROW[1]);

					   		if ($check > 0) {
					   			$undoID = $undoID . ' - ' . $ROW[1];
					   			$undoIndex += 1;
					   		}else{
						    	$temp_SQL .= "('" . $ROW[1] . "', '" . $ROW[2] . "', '" . $ROW[0] . "', '" . $ROW[3] . "', '" . $release . "') ";
						    	$sql = "INSERT INTO admin_data (Aid, Apassword, Aname, Amail, addTime) VALUES " . $temp_SQL;
						    	@mysql_query($sql);
					   		}

					  	}
					    else{
					    	$firstline += 1;
					    	continue;
				    	}
				  	}
				}
				fclose($fp);
				if ($undoIndex > 0) {
					echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
					echo "<script>alert('重複帳號為" . $undoID . " ，其餘已成功新增。');</script>";
					echo "<script>setTimeout(\"location.href = 'account.php';\",300);</script>";
				}else{
					header('Location: account.php');
				}
	   			exit;
				break;

			case 'class':
				$temp_SQL = "";
				$firstline = 0;
				$release = date(YmdHi);
				$CSVfile = $_FILES["class"]["tmp_name"];
				$teacherID = $_POST['teacherID'];
				$undoClass = "";
				$undoIndex = 0;

				// 解析 CSV 檔之內容，並組成 SQL 字串
				$fp = fopen($CSVfile, "r");
				while ( $ROW = fgetcsv($fp, 0 ) ) {   //(file , length (0 or 忽略表示無上限) , separator , enclosure)
					//CSV 匯出編碼為 BIG5 ，將其轉成 UTF-8
					for ($i=0; $i < count($ROW); $i++) { 
						//mb_conbert_encoding(str , 目標編碼 , 現在編碼)
						$ROW[$i] = mb_convert_encoding($ROW[$i], 'UTF-8' , 'big5');
					}
				  	// 在資料列有內容時（長度大於 0），才做以下動作
				  	if ( strlen($ROW[0]) ) {
				  		$temp_SQL = "";
				  		//跳過第一行
				  		if ($firstline) {
					  		// 如果 $temp_SQL 已經存有內容的話，與之後的內容間，用逗號隔開來
					   		if ( strlen($temp_SQL) ) $temp_SQL .= ", ";
					   		//檢查重複班級
					   		$check = checkClass($teacherID , $ROW[0]);

					   		if ($check > 0) {
					   			$undoClass = $undoClass . ' - ' . $ROW[0];
					   			$undoIndex += 1;
					   		}else{
					   			$temp_SQL .= "('" . $teacherID . "', '" . $ROW[0] . "') ";
						    	$sql = "INSERT INTO teacher_class (Aid, Aclass) VALUES " . $temp_SQL;
						    	@mysql_query($sql);
					   		}
					  	}
					    else{
					    	$firstline += 1;
					    	continue;
				    	}
				  	}
				}
				fclose($fp);
				if ($undoIndex > 0) {
					echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
					echo "<script>alert('重複班級為" . $undoClass . " ，其餘已成功新增。');</script>";
					echo "<script>setTimeout(\"location.href = 'account.php';\",300);</script>";
				}else{
					header('Location: account.php');
				}
				break;

			case 'student':
				$temp_SQL = "";
				$firstline = 0;
				$release = date(YmdHi);
				$CSVfile = $_FILES["student"]["tmp_name"];
				$teacherID = $_POST['teacherID'];
				$className = $_POST['className'];
				$undoStudent = "";
				$undoIndex = 0;

				// 解析 CSV 檔之內容，並組成 SQL 字串
				$fp = fopen($CSVfile, "r");
				while ( $ROW = fgetcsv($fp, 0 ) ) {   //(file , length (0 or 忽略表示無上限) , separator , enclosure)
					//CSV 匯出編碼為 BIG5 ，將其轉成 UTF-8
					
					for ($i=0; $i < count($ROW); $i++) { 
						//mb_conbert_encoding(str , 目標編碼 , 現在編碼)
						$ROW[$i] = mb_convert_encoding($ROW[$i], 'UTF-8' , 'big5');
					}
					
				  	// 在資料列有內容時（長度大於 0），才做以下動作
				  	if ( strlen($ROW[0]) ) {
				  		$temp_SQL = "";
				  		//跳過第一行
				  		if ($firstline) {
					  		// 如果 $temp_SQL 已經存有內容的話，與之後的內容間，用逗號隔開來
					   		if ( strlen($temp_SQL) ) $temp_SQL .= ", ";
					   		//檢查帳號
					   		$check = checkStudent($ROW[1]);

					    	if ($check > 0) {
					   			$undoStudent = $undoStudent . ' - ' . $ROW[1];
					   			$undoIndex += 1;
					   		}else{
						    	$temp_SQL .= "('" . $ROW[1] . "', '" . $ROW[2] . "', '" . $ROW[0] . "', '" . $className . "', '" . $teacherID . "') ";
						    	$sql = "INSERT INTO student_data (Sid, Spassword, Sname, Sclass, Steacher) VALUES " . $temp_SQL;
						    	@mysql_query($sql);
					   		}
					  	}
					    else{
					    	$firstline += 1;
					    	continue;
				    	}
				  	}
				}
				fclose($fp);
				if ($undoIndex > 0) {
					echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
					echo "<script>alert('重複學生帳號為" . $undoStudent . " ，其餘已成功新增。');</script>";
					echo "<script>setTimeout(\"location.href = 'account.php';\",300);</script>";
				}else{
					header('Location: account.php');
				}
				break;

			default:
				# code...
				break;
		}
	}else{
		echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
		echo "<script>alert('請上傳CSV檔。');</script>";
		echo "<script>setTimeout(\"location.href = 'account.php';\",200);</script>";
	}

	function checkTeacherID($ID) {
		$sql = "SELECT COUNT(*) FROM admin_data WHERE Aid = '$ID'"; 
		$result = mysql_query($sql);
		$c = mysql_result($result, 0);

		return $c;
	}

	function checkClass($teacherID , $class) {
		$sql = "SELECT COUNT(*) FROM teacher_class WHERE Aid = '$teacherID' AND Aclass = '$class'"; 
		$result = mysql_query($sql);
		$c = mysql_result($result, 0);

		return $c;
	}
	
	function checkStudent($SID) {
		//$sql = "SELECT COUNT(*) FROM student_data WHERE Sid = '$SID' AND Steacher = '$teacherID' AND Sclass = '$className'"; 
		$sql = "SELECT COUNT(*) FROM student_data WHERE Sid = '$SID'"; 
		$result = mysql_query($sql);
		$c = mysql_result($result, 0);

		return $c;
	}

	// function getTID() {
	// 	$count = 1;
	// 	$sql = "SELECT * FROM personnel ORDER BY TID ASC";
	// 	$result = mysql_query($sql) or die('TID error');
	// 	$row_num = mysql_num_rows($result);


	// 	if ($row_num == 0) {
	// 		return $count;
	// 	}else{

	// 		for ($i=0; $i < $row_num; $i++) { 
	// 			$Id = mysql_result($result, $i , 'TID');

	// 			if ($count == $Id) {
	// 				if ($row_num == $Id) {
	// 					$count++;
	// 					return $count;
	// 				}else{
	// 					$count ++;
	// 				}
	// 			}elseif ($count != $Id) {
	// 				return $count;
	// 			}
	// 		}
	// 	}
	// }
?>
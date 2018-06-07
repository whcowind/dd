<?php
	require 'connectdb.php';
?>

<?php
	$type = $_POST['type'];

	switch ($type) {
		case 'newClass':
			$className = $_POST['className'];
			$Aid = $_POST['Aid'];

			$sql = "SELECT COUNT(*) FROM teacher_class WHERE Aid = '$Aid' AND Aclass = '$className'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);

			if ($c) {
				echo $c;
			}else{
				$sql = "INSERT INTO teacher_class (Aid , Aclass)
				VALUES ('$Aid' , '$className')";
				mysql_query($sql) or die('add new class error');
			}
			break;

		case 'editClass':
			$newName = $_POST['newName'];
			$oldName = $_POST['oldName'];
			$Aid = $_POST['Aid'];

			
			$sql = "SELECT COUNT(*) FROM teacher_class WHERE Aid = '$Aid' AND Aclass = '$newName'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);

			if ($c) {
				echo $c;
			}else{
				$sql = "UPDATE teacher_class SET Aclass = '$newName' WHERE Aid = '$Aid' AND Aclass = '$oldName'";
				mysql_query($sql) or die('update class error');
				
				$sql = "UPDATE student_data SET Sclass = '$newName' WHERE Steacher = '$Aid' AND Sclass = '$oldName'";
				mysql_query($sql) or die('update class error');
			}
			break;

		case 'deleteClass':
			$Aid = $_POST['Aid'];
			$className = $_POST['className'];

			$sql = "DELETE FROM teacher_class WHERE Aid = '$Aid' AND Aclass = '$className'";
			mysql_query($sql) or die('del class error');

			$sql = "DELETE FROM student_data WHERE Steacher = '$Aid' AND Sclass = '$className'";
			mysql_query($sql) or die('del class student error');
			break;

		case 'newStudent':
			$Aid = $_POST['Aid'];
			$className = $_POST['className'];
			$name = $_POST['name'];
			$ID = $_POST['ID'];
			$pass = $_POST['pass'];

			//$sql = "SELECT COUNT(*) FROM student_data WHERE Sid = '$ID' AND Sclass = '$className' AND Steacher = '$Aid'"; 
			$sql = "SELECT COUNT(*) FROM student_data WHERE Sid = '$ID'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);

			if ($c) {
				echo $c;
			}else{
				$sql = "INSERT INTO student_data (Sid , Spassword , Sname , Sclass , Steacher)
				VALUES ('$ID' , '$pass' , '$name' , '$className' , '$Aid')";
				mysql_query($sql) or die('add new student error');
			}
			break;

		case 'editStudent':
			$oldID = $_POST['oldID'];
			$className = $_POST['className'];
			$Aid = $_POST['Aid'];
			$name = $_POST['name'];
			$ID = $_POST['ID'];
			$pass = $_POST['pass'];
			$IDChange = $_POST['IDChange'];

			if ($IDChange == 0) {
				$sql = "UPDATE student_data SET Spassword = '$pass' , Sname = '$name' WHERE Sid = '$oldID' AND Sclass = '$className' AND Steacher = '$Aid'";
				mysql_query($sql) or die('update student error');
			}
			else{
				$sql = "SELECT COUNT(*) FROM student_data WHERE Sid = '$ID' AND Sclass = '$className' AND Steacher = '$Aid'"; 
				$result = mysql_query($sql);
				$c = mysql_result($result, 0);

				if ($c) {
					echo $c;
				}else{
					$sql = "UPDATE student_data SET Sid = '$ID' , Spassword = '$pass' , Sname = '$name' WHERE Sid = '$oldID' AND Sclass = '$className' AND Steacher = '$Aid'";
					mysql_query($sql) or die('update student error');
				}
			}
			break;

		case 'deleteStudent':
			$Aid = $_POST['Aid'];
			$className = $_POST['className'];
			$ID = $_POST['ID'];

			$sql = "DELETE FROM student_data WHERE Sid = '$ID' AND Sclass = '$className' AND Steacher = '$Aid'";
			mysql_query($sql) or die('del student error');
			break;
		
		default:
			# code...
			break;
	}

?>
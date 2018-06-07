<?php
	require 'connectdb.php';
?>

<?php
	$type = $_POST['type'];
	date_default_timezone_set('Asia/Taipei');
	$now = date('YmdH');

	switch ($type) {
		case 'newTeacher':
			$name = $_POST['name'];
			$ID = $_POST['ID'];
			$pass = $_POST['pass'];
			$mail = $_POST['mail'];

			$sql = "SELECT COUNT(*) FROM admin_data WHERE Aid = '$ID'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);

			if ($c) {
				echo $c;
			}else{
				$sql = "INSERT INTO admin_data (Aid , Apassword , Aname , Amail , addTime , login)
				VALUES ('$ID' , '$pass' , '$name' , '$mail' , '$now' , '0')";
				mysql_query($sql) or die('add new teacher error');
			}
			break;

		case 'editTeacher':
			$oldID = $_POST['oldID'];
			$name = $_POST['name'];
			$ID = $_POST['ID'];
			$pass = $_POST['pass'];
			$mail = $_POST['mail'];
			$IDChange = $_POST['IDChange'];

			if ($IDChange == 0) {
				$sql = "UPDATE admin_data SET Aid = '$ID' , Apassword = '$pass' , Aname = '$name' , Amail = '$mail' WHERE Aid = '$oldID'";
				mysql_query($sql) or die('update teacher error');
			}
			else{
				$sql = "SELECT COUNT(*) FROM admin_data WHERE Aid = '$ID'"; 
				$result = mysql_query($sql);
				$c = mysql_result($result, 0);

				if ($c) {
					echo $c;
				}else{
					$sql = "UPDATE admin_data SET Aid = '$ID' , Apassword = '$pass' , Aname = '$name' , Amail = '$mail' WHERE Aid = '$oldID'";
					mysql_query($sql) or die('update teacher error');
				}
			}

			break;

		case 'deleteTeacher':
			$ID = $_POST['ID'];

			$sql = "DELETE FROM admin_data WHERE Aid = '$ID'";
			mysql_query($sql) or die('del teacher data error');
			break;

		case 'newClass':
			$name = $_POST['name'];
			$teacherID = $_POST['teacherID'];

			$sql = "SELECT COUNT(*) FROM teacher_class WHERE Aid = '$teacherID' AND Aclass = '$name'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);

			if ($c) {
				echo $c;
			}else{
				$sql = "INSERT INTO teacher_class (Aid , Aclass)
				VALUES ('$teacherID' , '$name')";
				mysql_query($sql) or die('add new class error');
			}
			break;

		case 'editClass':
			$className = $_POST['className'];
			$oldName = $_POST['oldName'];
			$teacherID = $_POST['teacherID'];

			
			$sql = "SELECT COUNT(*) FROM teacher_class WHERE Aid = '$teacherID' AND Aclass = '$className'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);

			if ($c) {
				echo $c;
			}else{
				$sql = "UPDATE teacher_class SET Aclass = '$className' WHERE Aid = '$teacherID' AND Aclass = '$oldName'";
				mysql_query($sql) or die('update class error');
				
				$sql = "UPDATE student_data SET Sclass = '$className' WHERE Steacher = '$teacherID' AND Sclass = '$oldName'";
				mysql_query($sql) or die('update class error');
			}
			break;

		case 'deleteClass':
			$teacherID = $_POST['teacherID'];
			$className = $_POST['className'];

			$sql = "DELETE FROM teacher_class WHERE Aid = '$teacherID' AND Aclass = '$className'";
			mysql_query($sql) or die('del class error');

			$sql = "DELETE FROM student_data WHERE Steacher = '$teacherID' AND Sclass = '$className'";
			mysql_query($sql) or die('del class student error');
			break;

		case 'newStudent':
			$teacherID = $_POST['teacherID'];
			$className = $_POST['className'];
			$name = $_POST['name'];
			$ID = $_POST['ID'];
			$pass = $_POST['pass'];

			//$sql = "SELECT COUNT(*) FROM student_data WHERE Sid = '$ID' AND Sclass = '$className' AND Steacher = '$teacherID'"; 
			$sql = "SELECT COUNT(*) FROM student_data WHERE Sid = '$ID'"; 
			$result = mysql_query($sql);
			$c = mysql_result($result, 0);

			if ($c) {
				echo $c;
			}else{
				$sql = "INSERT INTO student_data (Sid , Spassword , Sname , Sclass , Steacher)
				VALUES ('$ID' , '$pass' , '$name' , '$className' , '$teacherID')";
				mysql_query($sql) or die('add new student error');
			}

			break;

		case 'editStudent':
			$oldID = $_POST['oldID'];
			$className = $_POST['className'];
			$teacherID = $_POST['teacherID'];
			$name = $_POST['name'];
			$ID = $_POST['ID'];
			$pass = $_POST['pass'];
			$IDChange = $_POST['IDChange'];

			if ($IDChange == 0) {
				$sql = "UPDATE student_data SET Spassword = '$pass' , Sname = '$name' WHERE Sid = '$oldID' AND Sclass = '$className' AND Steacher = '$teacherID'";
				mysql_query($sql) or die('update student error');
			}
			else{
				$sql = "SELECT COUNT(*) FROM student_data WHERE Sid = '$ID' AND Sclass = '$className' AND Steacher = '$teacherID'"; 
				$result = mysql_query($sql);
				$c = mysql_result($result, 0);

				if ($c) {
					echo $c;
				}else{
					$sql = "UPDATE student_data SET Sid = '$ID' , Spassword = '$pass' , Sname = '$name' WHERE Sid = '$oldID' AND Sclass = '$className' AND Steacher = '$teacherID'";
					mysql_query($sql) or die('update student error');
				}
			}
			break;

		case 'deleteStudent':
			$teacherID = $_POST['teacherID'];
			$className = $_POST['className'];
			$studentID = $_POST['studentID'];

			$sql = "DELETE FROM student_data WHERE Sid = '$studentID' AND Sclass = '$className' AND Steacher = '$teacherID'";
			mysql_query($sql) or die('del student error');
			break;

		case 'deleteGrade':
			$paperID = $_POST['paperID'];
			$gradeID = $_POST['gradeID'];
			$allocateID = $_POST['studentID'];
			$teacherID = $_POST['teacherID'];
			$className = $_POST['className'];
			$studentID = $_POST['studentID'];

			$sql = "UPDATE student_grade SET grade = 0  WHERE studentID = '$studentID' AND paperID = '$paperID' AND gradeID = '$gradeID' AND allocateID = '$allocateID'";
			mysql_query($sql) or die('update grade error');

			$sql = "UPDATE allocate SET progressing = 0 WHERE studentID = '$studentID' AND paperID = '$paperID' AND class = '$className' AND allocateID = '$allocateID'";
			mysql_query($sql) or die('update grade error');

			// $sql = "DELETE FROM grade_detail WHERE studentID = '$studentID' AND gradeID = '$gradeID' AND paperID = '$paperID'";
			// mysql_query($sql) or die('del grade error');
			break;
		
		default:
			# code...
			break;
	}
?>
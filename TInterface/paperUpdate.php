<?php
	require 'connectdb.php';
?>

<?php
	$paperID = $_POST['paperID'];
	$PTitle = $_POST['PTitle'];
	$PExplan = $_POST['PExplan'];
	$PTFArray = $_POST['PTFArray'];
	$PCHArray = $_POST['PCHArray'];
	$PGPArray = $_POST['PGPArray'];
	$PSAArray = $_POST['PSAArray'];
	$paperID = $_POST['paperID'];

	$sql = "SELECT IF(EXISTS (SELECT paperID FROM allocate WHERE paperID = '$paperID'), 1 , 0)";
	$result_exist = mysql_query($sql) or die('error');
	$exist_paper = mysql_result($result_exist, 0);
	
	switch ($exist_paper) {
		case '1':
			echo "F";
			break;
		
		case '0':
			$sql = "UPDATE paperbase SET PTitle = '$PTitle' , PExplan = '$PExplan' WHERE paperID = '$paperID'";
			mysql_query($sql) or die('update error');


			$sql = "DELETE FROM paperlink WHERE paperID = '$paperID'";
			mysql_query($sql) or die('err');

			paperlinkTF($PTFArray , $paperID);
			paperlinkCH($PCHArray , $paperID);
			paperlinkGP($PGPArray , $paperID , $PSAArray);
			// paperlinkSA($PSAArray , $paperID);

			echo "T";
			break;

		default:
			# code...
			break;
	}

	function paperlinkTF($TF , $PID) {
		if(count($TF) > 0){
			for ($i=0; $i < count($TF); $i++) { 
				$PTFTemp = '';
				$PTFTemp = $TF[$i];

				$sql = "INSERT INTO paperlink (paperID , QID , QType)
				VALUES ('$PID' , '$PTFTemp' , 'TF')";
				mysql_query($sql) or die('insert paperlink with tf error');
			}
		}
	}

	function paperlinkCH($CH , $PID) {
		if (count($CH) > 0) {
			
			for ($j=0; $j < count($CH); $j++) { 
				$PCHTemp = '';
				$PCHTemp = $CH[$j];

				$sql = "INSERT INTO paperlink (paperID , QID , QType)
				VALUES ('$PID' , '$PCHTemp' , 'CH')";
				mysql_query($sql) or die('insert paperlink with ch error');
			}
			
		}
	}

	function paperlinkGP($GP , $PID , $SA) {
		if (count($GP) > 0) {
			
			for ($k=0; $k < count($GP); $k++) { 
				$PGPTemp = '';
				$PGPTemp = $GP[$k];

				$sql = "INSERT INTO paperlink (paperID , QID , QType)
				VALUES ('$PID' , '$PGPTemp' , 'GP')";
				mysql_query($sql) or die('insert paperlink with gp error');
			}
			paperlinkSA($SA , $PID);
		}else{
			paperlinkSA($SA , $PID);
		}
	}

	function paperlinkSA($SA , $PID) {
		if(count($SA) > 0){
			for ($i=0; $i < count($SA); $i++) { 
				$PSATemp = '';
				$PSATemp = $SA[$i];

				$sql = "INSERT INTO paperlink (paperID , QID , QType)
				VALUES ('$PID' , '$PSATemp' , 'SA')";
				mysql_query($sql) or die('insert paperlink with SA error');
			}
		}
	}
?>
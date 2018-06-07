<?php
	require 'connectdb.php'
?>

<?php
	
	$Aid = $_POST['Aid'];
	$PTitle = $_POST['PTitle'];
	$PExplan = $_POST['PExplan'];
	$PTFArray = $_POST['PTFArray'];
	$PCHArray = $_POST['PCHArray'];
	$PGPArray = $_POST['PGPArray'];
	$PSAArray = $_POST['PSAArray'];


	$paperID = getPId();
	$sql = "INSERT INTO paperbase(paperID , PTitle , PExplan , owner)
	VALUES ('$paperID' , '$PTitle' , '$PExplan' , '$Aid')";
	mysql_query($sql) or die('insert paperbase error');

	paperlinkTF($PTFArray , $paperID);
	paperlinkCH($PCHArray , $paperID);
	// paperlinkSA($PSAArray , $paperID);
	paperlinkGP($PGPArray , $paperID , $PSAArray);
	




	function getPId() {
		$count = 1;
		$sql = "SELECT * FROM paperbase ORDER BY paperID ASC";
		$result = mysql_query($sql) or die('paperID error');
		$row_num = mysql_num_rows($result);


		if ($row_num == 0) {
			return $count;
		}else{

			for ($i=0; $i < $row_num; $i++) { 
				$Id = mysql_result($result, $i , 'paperID');

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

	function paperlinkTF($TF , $PID) {
		if (count($TF) > 0) {

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
				mysql_query($sql) or die('insert paperlink with tf error');
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
				mysql_query($sql) or die('insert paperlink with tf error');
			}
			paperlinkSA($SA , $PID);
		}else{
			paperlinkSA($SA , $PID);
		}
	}

	function paperlinkSA($SA , $PID) {
		if (count($SA) > 0) {

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
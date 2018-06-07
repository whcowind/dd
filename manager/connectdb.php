<?php
	connectDatabase("localhost", "root", "root", "my_project");
	function connectDatabase($dbhost, $dbuser, $dbpass, $dbname) {
		mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db($dbname) or die('No DB');
	}
?>
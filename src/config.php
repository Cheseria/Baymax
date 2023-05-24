<?php
	$dbHost = 'localhost';
	$dbUser = 'root';
	$dbPass = '';
	$dbName = 'baymax';

	$connection = mysqli_connect ($dbHost, $dbUser, $dbPass, $dbName);
   	if(!$connection){
		die("Connection failed: " . mysqli_connect_error());
	}
?>

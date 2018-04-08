<?php

	$hostname='185.98.131.94';
	$username='pnfra796140';
	$password='DomTav';
	$dbname='pnfra796140';

	global $db;
	$db = new mysqli($hostname, $username, $password, $dbname);

	// Check connection
	if (mysqli_connect_error()) {
		die("Database connection failed: " . mysqli_connect_error());
	}
	#else{echo "Database connection successful !";}

?>
<?php
$hostname='185.98.131.94';
$username='pnfra796140';
$password='DomTav';
$dbname='pnfra796140';
global $db;
$db = new mysqli($hostname, $username, $password, $dbname);
	
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
};
?>
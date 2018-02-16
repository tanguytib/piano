<?php
	include '../DBconfig.php';

	echo $categories = $db->query('SELECT * FROM Categories');
	


?>
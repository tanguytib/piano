<?php
session_start();
include 'DBconfig.php';

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Liste des records</title>
</head>

<body>

	<div id="container">
			
			
		<?php 
			
				$records = $db->query('SELECT * FROM Records') or die(print_r($db->errorInfo()));
				while($row = $records->fetch_assoc())
				{
					echo "<div id='" . $row['Id'] . "'><h2>" . $row['Intitule'] . "</h2>"  ;
				};
		?>
	
	</div>


</body>
</html>
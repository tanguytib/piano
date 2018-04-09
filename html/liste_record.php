<?php
session_start();
include 'DBconfig.php';
?>

<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Liste des records</title>
</head>

<body>
	<h1>Voici la listes de tous nos champions !</h1>
	<div id="container">
			
		<?php 
				$records = $db->query('SELECT * FROM Records') or die(print_r($db->errorInfo()));

				while($row = $records->fetch_assoc())
				{	
					echo "<div id='" . $row['Id'] . "'><h2>" . $row['intitule'] . "</h2><br>" . "<p>" . $row['detail'] . "</p>"   ;
				};
		?>
	
	</div>


</body>
</html>
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
				$categories = $db->query('SELECT * FROM Categories') or die(print_r($db->errorInfo()));
				while($row = $categories->fetch_assoc())
				{
					echo "<div id='" . $row['Nom'] . "'><h2>" . $row['Nom'] . "</h2>"  ;
				};
		?>
	
	</div>


</body>
</html>
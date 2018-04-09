<?php
	session_start();
	include '../html/DBconfig.php';
?>
<!doctype html>
<html>
<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/styles.css">
		<meta name="viewport" content="width=device-width">
		<title>piano</title>		
</head>

<body>
	<a href="accueil.php">Home</a>
	<h1>Catégorie : 
	<?php
		$Id_categorie=$_GET["Id_categorie"] ;
		$categorieSelectionnee = $db->query('SELECT * FROM Categories WHERE Id="'.$Id_categorie.'"') or die(print_r($db->errorInfo()));
		echo $categorieSelectionnee->fetch_assoc()['nom'];
	?>
	</h1>	
	
	<?php
	$records = $db->query('SELECT * FROM Records WHERE Idcategorie="'.$Id_categorie.'"') 
		or die(print_r($db->errorInfo()));
		while($row = $records->fetch_assoc())
		{	
			echo "<div id='" . $row['Id'] . "'><h2>" . $row['intitule'] . "</h2><br>" . "<p>" . $row['detail'] . "</p>"   ;
		};
	?>
	
	
</body>
</html>

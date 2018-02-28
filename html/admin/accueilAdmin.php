<!doctype HTML>
<?php
	session_start();
	include '../DBconfig.php';
?>

<html>
<head>
<meta charset="UTF-8">
<title>Accueil Admin</title>
</head>

<body>
	<h1>Bienvenu sur l'accueil des Admin</h1>
	
	<h3>Liste des records revendiqués : </h3>
	<?php
		$recordsRevendique = $db->query("SELECT * FROM Records WHERE status='Valide' ") or die(print_r($db->errorInfo()));
				while($row = $recordsRevendique->fetch_assoc())
				{
					echo "<div ><h2>" . $row['intitule'] . "</h2>"  ;
				};	
	
	?>
	
</body>
</html>
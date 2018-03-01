<!doctype HTML>
<?php
	session_start();
	include '../admin/fonctionsPhp/logincheck.php';
	include '../DBconfig.php';
?>

<html>
<head>
	<meta charset="utf-8">
	<title>Admin panel</title>
</head>

<body>
	<h1>Bienvenue sur l'accueil des Admins</h1>
	
	<a href='../admin/FormAdminAccount.php'>Créer un compte admin</a><br>
	
	<?php 
		if (isset($_SESSION['msg'])){
			echo 'INFO : ' . $_SESSION['msg'];
			unset ($_SESSION['msg']); //Une fois le message affiché, on le supprime de la variable session
		}
	?>
	
	<h3>Liste des records revendiqués : </h3>
	<?php
		$recordsRevendique = $db->query("SELECT * FROM Records WHERE statut='revendique' ") or die(print_r($db->errorInfo()));
			while($row = $recordsRevendique->fetch_assoc())
			{
				echo "<div ><h2>" . $row['intitule'] . "</h2>"  ;
				echo "<a href=../admin/modifierRecord.php?Id=" . $row['Id'] . "> Modifier ce record </a>";
			};
	?>
</body>
</html>
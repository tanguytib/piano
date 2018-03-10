<!doctype HTML>
<?php
	session_start();
	include '../admin/fonctionsPhp/logincheck.php';
	include '../DBconfig.php';
?>

<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/css/bootstrap/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src='/js/bootstrap/bootstrap.js'></script>
	<script src='/js/bootstrap/bootstrap-confirmation.js'></script>
	<title>Admin panel</title>
</head>

<body>
	<h1>Bienvenue sur l'accueil des Admins</h1>
	
	<?php 
		if (isset($_SESSION['msg'])){
			echo 'INFO : ' . $_SESSION['msg'];
			unset ($_SESSION['msg']); //Une fois le message affiché, on le supprime de la variable session
		}
	?>
	
	<a href='../admin/FormAdminAccount.php'>Créer un compte admin</a><br>
	
	<h3>Liste des records revendiqués : </h3>
	<?php
		$recordsRevendique = $db->query("SELECT * FROM Records WHERE statut='revendique'") or die(print_r($db->errorInfo()));
			while($row = $recordsRevendique->fetch_assoc()) 
			{
				echo "<div ><h2>" . $row['intitule'] . "</h2>"  ;
				echo "<a href=../admin/modifierRecord.php?Id=" . $row['Id'] . "> Modifier ce record </a> <br>";
				/*echo "<a class='btn btn-default' data-toggle='confirmation' data-title='Supprimer' href='/html/admin/fonctionsPhp/suppressionRecord.php?Id=" . $row['Id'] . "' target='_blank'>Supprimer</a>";*/
			};
	?>
	
	<button class="btn btn-primary" id="btnPopover" title="Test" content="content" data-toggle="popover">Test</button>
	<script>
		$(document).ready(function(){
			$('#btnPopover').popover(); 
		});
	</script>
	
	
	
</body>
</html>
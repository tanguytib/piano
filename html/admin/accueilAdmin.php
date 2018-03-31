<!doctype HTML>
<?php
	session_start();
	include '../admin/fonctionsPhp/logincheck.php';
	include '../DBconfig.php';
?>

<html>
<head>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<!-- Bootstrap confirmation -->
	<script src='https://rawgit.com/mistic100/Bootstrap-Confirmation/master/bootstrap-confirmation.min.js'></script>
	
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
	<br>
	<br>
	<a href='FormAdminAccount.php'>Créer un compte admin</a><br>
	<br>
	<a href='../admin/creerRecord.php'>Créer un record</a><br>
	<br>
	<h3>Liste des évènements non validés : </h3>
	<?php
	#On recherche les évènements non validés
		$recordsRevendique = $db->query("SELECT *, Evenements.Id AS Idevenement FROM Evenements INNER JOIN Records ON Evenements.Idrecord=Records.Id WHERE IsNull(Evenements.date_validation) OR Evenements.date_validation='0000-00-00'") or die(print_r($db->errorInfo()));
			while($row = $recordsRevendique->fetch_assoc()) 
			{
				echo "<div ><h2>" . $row['intitule'] . "</h2>"  ;
				echo "<a href=../admin/modifierRecord.php?Id=" . $row['Idevenement'] . "> Modifier le panier </a> <br>";
				echo "<a href=../admin/modifierEvenement.php?Id=" . $row['Idevenement'] . "> Modifier le piano </a> <br>";
				echo '<button class="btn btn-large btn-danger" data-toggle="confirmation"
						data-btn-ok-label="Eh oui" data-btn-ok-icon="glyphicon glyphicon-share-alt"
						data-btn-ok-class="btn-success"
						data-btn-cancel-label="Nooooon !" data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
						data-btn-cancel-class="btn-danger"
						data-title="Attention" data-content="Supprimer cet événement ?"
						href="/html/admin/fonctionsPhp/suppressionEvenement.php?Id=' . $row['Idevenement'] . '"> Supprimer
					  </button>';
			};
	?>
	<br>

	
	<!-- Javascript popup confirmation-->
	<script>
		$('[data-toggle=confirmation]').confirmation({
		rootSelector: '[data-toggle=confirmation]',
		});
	</script>
</body>
</html>
<!doctype html>
<div w3-include-html='../JSconfig.html'></div>
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
	<title>Modifier un record</title>
</head>

<body>
	
	<?php 
		#On récupère les informations de l'évènement à modifier
		$Id = htmlspecialchars($_GET['Id']);
		$evenements = $db->query('SELECT *, Personnes.nom AS nomPersonne, Promos.nom AS nomPromo FROM Evenements INNER JOIN Personnes ON Evenements.Idpersonne=Personnes.Id INNER JOIN Promos ON Personnes.Idpromo=Promos.Id WHERE Evenements.Id="' . $Id .'"') or die(print_r($db->errorInfo()));
		$evenement = $evenements->fetch_assoc();
	?>
	<h2>Modifier l'événement :</h2>
	<form name='evenement' action="../admin/fonctionsPhp/modificationEvenement.php" method="POST">
		<input type='hidden' name='Idevenement' value=<?php echo "'" . $Id . "'" ?>>
		Nom : <input type='text' name='nom' value=<?php echo $evenement['nomPersonne'] ?> /> 
		Prénom : <input type='text' name='prenom' value=<?php echo $evenement['prenom'] ?> /> 
		Promo : <input type='text' name='promo' value=<?php echo $evenement['nomPromo'] ?> /> <br>
		Lieu : <input type='text' name='lieu' value=<?php echo $evenement['lieu'] ?> /><br>
		Numéro significatif : <input type='number' name='numero_phare' step='0.01' value=<?php echo $evenement['numero_phare'] ?>></input><br>
		Date de revendication : <input type='date' name='date_revendication' value=<?php echo  "'" . $evenement['date_revendication'] . "'" ?>/><br>
		Date de validation : <input type='date' name='date_validation' value=<?php echo "'" . $evenement['date_validation'] . "'" ?></input><br><br>

		<input name='submitevent' type='submit' value='Enregistrer'>
	</form><br>

</body>
</html>
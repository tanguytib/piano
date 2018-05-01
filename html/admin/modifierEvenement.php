<!doctype HTML>
<?php
	session_start();
	include '../admin/fonctionsPhp/logincheck.php';
	include '../DBconfig.php';
?>

<html>
<head>
	<?php
		include '../background.php';
	?>
	<title>Admin panel</title>
</head>

<body>
	<div class="col-lg-12 text-center">
		 <h1 class="title">Attestation d'un événement</h1><br><br>
	</div>
	 <div class="container-fluid col-lg-4 col-lg-offset-4">
		 
	<?php 
		#On récupère les informations de l'évènement à modifier
		$Id = htmlspecialchars($_GET['Id']);
		$evenements = $db->query('SELECT *, Personnes.nom AS nomPersonne, Promos.nom AS nomPromo FROM Evenements INNER JOIN Personnes ON Evenements.Idpersonne=Personnes.Id INNER JOIN Promos ON Personnes.Idpromo=Promos.Id WHERE Evenements.Id="' . $Id .'"') or die(print_r($db->errorInfo()));
		$evenement = $evenements->fetch_assoc();
	?>
	<form name='evenement' action="../admin/fonctionsPhp/modificationEvenement.php" method="POST">
		<input type='hidden' name='Idevenement' value=<?php echo "'" . $Id . "'" ?>>
		Nom : <input type='text' name='nom' value=<?php echo $evenement['nomPersonne'] ?> /> <br><br>
		Prénom : <input type='text' name='prenom' value=<?php echo $evenement['prenom'] ?> /> <br><br>
		Promo : <input type='text' name='promo' value=<?php echo $evenement['nomPromo'] ?> /> <br><br>
		Lieu : <input type='text' name='lieu' value=<?php echo $evenement['lieu'] ?> /><br><br>
		Numéro significatif : <input type='number' name='numero_phare' step='0.01' value=<?php echo $evenement['numero_phare'] ?>></input><br><br>
		Date de revendication : <input type='date' name='date_revendication' value=<?php echo  "'" . $evenement['date_revendication'] . "'" ?>/><br><br>
		Date de validation : <input type='date' name='date_validation' value=<?php echo "'" . $evenement['date_validation'] . "'" ?></input><br><br>

		<input class="btn btn-success" name='submitevent' type='submit' value="J'atteste cet événement">
	</form><br>

</body>
</html>
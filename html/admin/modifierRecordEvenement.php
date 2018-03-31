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
<title>Modifier un record</title>
</head>

<body>
	<?php 
		#On récupère les informations du record à modifier
		$Id = htmlspecialchars($_GET['Id']);
		$records = $db->query('SELECT *, Categories.nom AS nomCategorie, Records.Id AS Idrecord FROM Records INNER JOIN Categories ON Records.Idcategorie=Categories.Id INNER JOIN Evenements ON Evenements.Idrecord=Records.Id WHERE Evenements.Id="' . $Id .'" ') or die(print_r($db->errorInfo()));
		$record = $records->fetch_assoc();
		$ancienneCategorie = $record['nomCategorie'];	
	?>
	
	<h2>Modifier le record :</h2>
	<form name='record' action="../admin/fonctionsPhp/modificationRecord.php" method="POST">
		<input type='hidden' name='Idrecord' value=<?php echo '"' . $record['Idrecord'] . '"'?> />
		Intitulé du panier : <input name='intitule' type='text' value=<?php echo $record['intitule'] ?> /><br>
		Description du panier : <textarea name='detail' records="4" cols="100"><?php echo $record['detail'] ?></textarea><br>
		Catégorie :
			<select name="categorie" size="1">
			<?php 
				$categories = $db->query('SELECT * FROM Categories') or die(print_r($db->errorInfo()));
				while($categorie = $categories->fetch_assoc())
				{
					if ($categorie['nom'] == $ancienneCategorie) {
						echo "<option selected='selected'>" . $categorie['nom'] . "</option>";
					} else {
						echo "<option>" . $categorie['nom'] . "</option>";
					}
				};
			?>
			</select><br>
		<input name='submit' type='submit' value='Enregistrer'>
	</form>
	<br><br>
	
	<?php 
		#On récupère les informations de l'évènement à modifier
		$Id = htmlspecialchars($_GET['Id']);
		$evenements = $db->query('SELECT *, Personnes.nom AS nomPersonne, Promos.nom AS nomPromo FROM Evenements INNER JOIN Personnes ON Evenements.Idpersonne=Personnes.Id INNER JOIN Promos ON Personnes.Idpromo=Promos.Id WHERE Evenements.Id="' . $Id .'"') or die(print_r($db->errorInfo()));
		$evenement = $evenements->fetch_assoc();
	?>
	<h2>Modifier l'évènement :</h2>
	<form name='evenement' action="../admin/fonctionsPhp/modificationEvenement.php" method="POST">
		<input type='hidden' name='Idevenement' value=<?php echo "'" . $Id . "'" ?>>
		Nom : <input type='text' name='nom' value=<?php echo $evenement['nomPersonne'] ?> /> 
		Prénom : <input type='text' name='prenom' value=<?php echo $evenement['prenom'] ?> /> 
		Promo : <input type='text' name='promo' value=<?php echo $evenement['nomPromo'] ?> /> <br>
		Lieu : <input type='text' name='lieu' value=<?php echo $evenement['lieu'] ?> /><br>
		Numéro significatif : <input type='number' name='numero_phare' step='0.01' value=<?php echo $evenement['numero_phare'] ?>></input><br>
		Date de revendication : <input type='date' name='date_revendication' value=<?php echo  "'" . $evenement['date_revendication'] . "'" ?>/><br>
		Date de validation : <input type='date' name='date_validation' value=<?php echo "'" . $evenement['date_validation'] . "'" ?></input><br><br>
		<input name='submit' type='submit' value='Enregistrer'>
	</form><br>
	<input type='button' value='Enregistrer tout' onclick='submitForms()' />
	<script>
		submitForms = function(){
			document.forms["record"].submit();
			document.form["evenement"].submit();
		}
	</script>
</body>
</html>
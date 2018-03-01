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
		#On récupère les informations principales du record à modifier
		$Id = htmlspecialchars($_GET['Id']);
		$records = $db->query('SELECT * FROM Records WHERE Id="' . $Id .'" ') or die(print_r($db->errorInfo()));
		$record = $records->fetch_assoc();
		echo "<h2>" . $record['intitule'] . "</h2><br>";
	
		#On récupère le nom de la catégorie du record à modifier
		$categories = $db->query('SELECT * FROM Categories WHERE Id="' . $record['categorie'] .'" ') or die(print_r($db->errorInfo()));
		$categorie = $categories->fetch_assoc();
		$ancienneCategorie = $categorie['nom'];
	
		#On récupère les informations relatives à la personne détenant le record
		$personnes = $db->query('SELECT * FROM Personnes WHERE Id="' . $record['champion'] . '"' );
		$personne = $personnes->fetch_assoc();
		echo $personne['nom'];
	?>
	
	<form action="../admin/fonctionsPhp/modificationRecord.php" method="POST">		
		Intitulé du panier : 
			<input name='intitule' type='text' value=<?php echo "'". $record['intitule'] . "'" ?>><br>
		Description du panier :
			<textarea name='detail' records="4" cols="100"><?php echo $record['detail'] ?></textarea><br>
		Numéro du panier: 
			<input name="numero_phare" type='number' step='any' value=<?php echo "'" . $record['numero_phare'] . "'" ?>><br>
		Acheteur : 
			Nom : <input name='nom' type='text' value=<?php echo "'" . $personne['nom'] ."'"?>>  
			Prénom : <input name='prenom' type='text' value=<?php echo "'" . $personne['prenom'] ."'"?>>  
			Promo : <input name='promo' type='text' value=<?php echo "'" . $personne['promo'] ."'"?>><br>
		Catégorie :
			<select name="categorie" size="1" selected=<?php echo '"' . $ancienneCategorie . '"'?>>
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
		Record validé : <input name="statut" type='checkbox'><br>
		Date de revendication : <input type='date' name='dateRevendication'><br><br>
		Date de validation : <input type='date' name='dateValidation'><br>
		<input type='submit' value='Enregistrer'></form>
</body>
</html>
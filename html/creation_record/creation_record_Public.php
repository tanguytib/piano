<?php
session_start();
include '../DBconfig.php';
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Nouveau panier</title>
</head>


<body>

	<h2>Créé ici ton propre panier et deviens un champion ! </h2>

	<form action="insertion_record.php" method="POST">		
		Intitulé du panier : 
			<input name='intitule' type='text'><br>
		Description du panier :
			<textarea rows="4" cols="50"></textarea><br>
		Numéro du panier: 
			<input name="numero_phare" type='number' step='any'><br>
		Acheteur : 
			Nom : 
				<input name='nom' type='text'>  
			Prénom : 
				<input name='prenom' type='text'>  
			Promo : 
				<input name='promo' type='text'><br>
		Catégorie :
			<select name="categorie" size="1">
			<?php 
				$categories = $db->query('SELECT * FROM Categories') or die(print_r($db->errorInfo()));
				while($row = $categories->fetch_assoc())
				{
					echo "<option>" . $row['nom'] . "</option>";
				};
			?>
			</select><br>
		<input name="status" type='hidden' size="1" value="Revendiqué">
		<input type='submit' value='Enregistrer'>
	</form>
</body>
</html>
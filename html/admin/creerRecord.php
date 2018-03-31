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
<title>Créer un record</title>
</head>

<body>
	
	<form action="../admin/fonctionsPhp/modificationRecord.php" method="POST">
		<input type='hidden' name='Id'>
		Intitulé du panier : 
			<input name='intitule' type='text'><br>
		Description du panier :
			<textarea name='detail' records="4" cols="100"></textarea><br>
		Numéro du panier: 
			<input name="numero_phare" type='number' step='any' ><br>
		Acheteur : 
			Nom : <input name='nom' type='text'>  
			Prénom : <input name='prenom' type='text'>  
			Promo : <input name='promo' type='text'><br>
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
		Record validé : <input name="statut" type='checkbox'><br>
		Date de revendication : <input type='date' name='dateRevendication'</input><br><br>
		Date de validation : <input type='date' name='dateValidation'><br>
		<input type='submit' value='Enregistrer'></form>
</body>
</html>
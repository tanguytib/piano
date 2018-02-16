
<!doctype html>

<?php include '../DBconfig.php' ?>

<html>
<head>
	<meta charset="utf-8">
	<title>Nouveau record</title>
</head>


<body>

	<h2>Créé ici ton propre record et deviens un champion ! </h2>

	<form action="insertion_record.php" method="post">		
		Intitulé du record : <input name='intitule' type='text'><br>
		Numéro phare : <input name="numero_phare" type='number' step='any'><br>
		Status :
		<select name="status" size="1">
			<option>Etabli</option>
			<option>Revendiqué</option>
		</select><br>
		Champion : Nom : <input name='nom' type='text'>  Prénom : <input name='prenom' type='text'>  Promo : <input name='prenom' type='text'><br>
		Catégorie :
		<select name="categorie" size="1">
			<option> mort </option>
			<?php 
				$categories = $db->query('SELECT * FROM Categories');
				while ($row = $categories->fetch_assoc())
				{
					echo "<option>" . $row['Nom'] . "</option>";
				};
			?>
		</select>
	
		<input type='submit' value='Enregistrer'>
	</form>
</body>
</html>
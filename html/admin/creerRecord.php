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
	
	<h2>Créer un panier :</h2>
	<form name='record' action="../admin/fonctionsPhp/creationRecord.php" method="POST">
		<input type='hidden' name='Idrecord' />
		Intitulé du panier : <input name='intitule' type='text' /><br>
		Description du panier : <textarea name='detail' records="4" cols="100"></textarea><br>
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
		<input name='submitrecord' type='submit' value='Enregistrer'>
	</form>
	<br><br>
	
</body>
</html>
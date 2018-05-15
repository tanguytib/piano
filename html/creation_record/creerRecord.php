<!doctype HTML>
<?php
	session_start();
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
	 <div class="container-fluid center col-lg-10 col-lg-offset-1">
		 <div class="col-lg-12">
		 <h1 class="title">Créer un record</h1><br>
		 </div>
	</div>
	<form class="col-lg-6 col-lg-offset-3" name='record' action="creationRecord.php" method="POST">
		<input type='hidden' name='Idrecord' />
		<b>Intitulé : </b><input name='intitule' type='text' /><br><br>
		<b>Description : </b><textarea name='detail' records="4" cols="100"></textarea><br><br>
		<b>Catégorie :</b>
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
			</select><br><br>
		<b>Tags (séparés d'un espace) : </b><textarea name='tags' records="1" cols="100"></textarea><br><br>
		<input class="btn btn-success" name='submitrecord' type='submit' value='Créer un record'>
	</form>
	<br><br>

</body>
</html>

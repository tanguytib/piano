<!doctype HTML>
<?php
	session_start();
	include '/html/admin/fonctionsPhp/logincheck.php';
	include '/html/DBconfig.php';
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
		 <h1 class="title">Modification du record</h1><br>
	</div>
	 <div class="container-fluid col-lg-4 col-lg-offset-3">
		 
		<?php 
			#On récupère les informations du record à modifier
			$Id = htmlspecialchars($_GET['Id']);
			$records = $db->query('SELECT *, Categories.nom AS nomCategorie, Records.Id AS Idrecord FROM Records INNER JOIN Categories ON Records.Idcategorie=Categories.Id INNER JOIN Evenements ON Evenements.Idrecord=Records.Id WHERE Evenements.Id="' . $Id .'" ') or die(print_r($db->errorInfo()));
			$record = $records->fetch_assoc();
			$ancienneCategorie = $record['nomCategorie'];	
		?>

		<form style="vertical-align: top" name='record' action="../admin/fonctionsPhp/modificationRecord.php" method="POST">
			<input type='hidden' name='Idrecord' value=<?php echo '"' . $record['Idrecord'] . '"'?> />
			<b>Intitulé : </b><input name='intitule' type='text' value=<?php echo $record['intitule'] ?> /><br><br>
			<b>Description : </b><textarea name='detail' records="4" cols="100"><?php echo $record['detail'] ?></textarea><br><br>
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
			<b>Tags (séparés d'un espace) : </b><textarea name='tags' records="1" cols="100"><?php 
				$Idrecord = $record['Idrecord'];
				$query = "SELECT nom FROM Tags INNER JOIN TagsRecords ON TagsRecords.Idtag=Tags.Id WHERE TagsRecords.Idrecord='$Idrecord'";
				$tags = mysqli_query($db, $query);
				$tag = $tags->fetch_assoc();			
				while ($tag <> "") {
					echo $tag['nom'] . " ";
					$tag = $tags->fetch_assoc();	
				}
			?></textarea><br><br>
			<input class="btn btn-success" name='submitrecord' type='submit' value='Enregistrer'>
		</form>
		<br><br>
	</body>
</html>
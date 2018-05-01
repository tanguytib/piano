<?php
	session_start();
	include '../DBconfig.php';

	$Id = mysqli_real_escape_string($db, $_POST['Idrecord']);
	$intitule = mysqli_real_escape_string($db, $_POST['intitule']);
	$detail = mysqli_real_escape_string($db, $_POST['detail']);
	$categorie = mysqli_real_escape_string($db, $_POST['categorie']);
	$tags = mysqli_real_escape_string($db, $_POST['tags']);

	#A quel Id correspond la catégorie sélectionnée ?
	$query="SELECT * FROM Categories WHERE nom='$categorie'";
	$categorieId = mysqli_query($db, $query)->fetch_assoc()['Id'];
	
	#Les tags existent-ils ?
	$listetags = explode(" ", $tags);
	$listeIdtags = array();
	foreach ($listetags as $tag){
		$query = "SELECT * FROM Tags WHERE nom = '$tag'";
		$result = mysqli_query ($db, $query);
		if (mysqli_num_rows($result)==1){
			$Idtag = $result->fetch_assoc()['Id'];
		} else {
			$result = mysqli_query($db, "INSERT INTO Tags(nom) VALUES('$tag')") or trigger_error($db->error);
			$Idtag = mysqli_insert_id($db); #on récupère son Id
		}
		array_push ($listeIdtags, $Idtag);
	}

	#Mise à jour du record dans la table
	$query = "UPDATE Records SET intitule='$intitule', detail='$detail', Idcategorie='$categorieId' WHERE Id='$Id';";

	$result = mysqli_query($db, $query) or trigger_error($db->error);
	
	#Modification des attributions de tags
	#On commence par supprimer les tags associés, puis on les rajoute
	$query = "DELETE FROM TagsRecords WHERE Idrecord='$Id'";
	$result = mysqli_query($db, $query);


	foreach ($listeIdtags as $Idtag){
		mysqli_query($db, "INSERT INTO TagsRecords(Idtag, Idrecord) VALUES('$Idtag', '$Id')");
	}


	if ($result){
		$_SESSION['msg'] = "Le record a bien été modifié !";
	} else {
		$_SESSION['msg'] = "Erreur lors de la modification du record :" . $query;
	};

	header('Location: /html/admin/accueilAdmin.php');
?>

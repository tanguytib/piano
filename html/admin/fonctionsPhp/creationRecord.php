<?php
	session_start();
	include '../DBconfig.php';

	$Id=mysqli_real_escape_string($db, $_POST['Idrecord']);
	$intitule = mysqli_real_escape_string($db, $_POST['intitule']);
	$detail = mysqli_real_escape_string($db, $_POST['detail']);
	$categorie = mysqli_real_escape_string($db, $_POST['categorie']);
	$tags = mysqli_real_escape_string($db, $_POST['tags']);
	#A quel Id correspond la catégorie sélectionnée ?
	$query = "SELECT * FROM Categories WHERE nom='$categorie'";
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
	

	#Insertion du record dans la table
	$query = "INSERT INTO Records (intitule, detail, Idcategorie) VALUES ('$intitule', '$detail', '$categorieId');";

	$result = mysqli_query($db, $query) or trigger_error($db->error);
	$Idrecord = mysqli_insert_id($db);

	if ($result){
		$_SESSION['msg'] = "Le panier a bien été créé !";
	} else {
		$_SESSION['msg'] = "Erreur lors de la création du piano :" . $result;
	};

	#Insertion des liens des tags dans la base de données
	foreach ($listeIdtags as $Idtag){
		mysqli_query($db, "INSERT INTO TagsRecords(Idtag, Idrecord) VALUES('$Idtag', '$Idrecord')");
	}
	header('Location: /html/admin/accueilAdmin.php');
?>

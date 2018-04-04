<?php
	session_start();
	include '../DBconfig.php';

	$Id=mysqli_real_escape_string($db, $_POST['Idrecord']);
	$intitule = mysqli_real_escape_string($db, $_POST['intitule']);
	$detail = mysqli_real_escape_string($db, $_POST['detail']);
	$categorie = mysqli_real_escape_string($db, $_POST['categorie']);

	#A quel Id correspond la catégorie sélectionnée ?
	$query="SELECT * FROM Categories WHERE nom='$categorie'";
	$categorieId = mysqli_query($db, $query)->fetch_assoc()['Id'];
	

	#Mise à jour du record dans la table
	$query = "INSERT INTO Records (intitule, detail, Idcategorie) VALUES ('$intitule', '$detail', '$categorieId');";

	$result = mysqli_query($db, $query) or trigger_error($db->error);
	
	if ($result){
		$_SESSION['msg'] = "Le panier a bien été créé !";
	} else {
		$_SESSION['msg'] = "Erreur lors de la création du piano :" . $result;
	};
	header('Location: /html/admin/accueilAdmin.php');
?>

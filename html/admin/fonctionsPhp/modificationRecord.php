<?php
	session_start();
	include '../DBconfig.php';

	$Id = mysqli_real_escape_string($db, $_POST['Idrecord']);
	$intitule = mysqli_real_escape_string($db, $_POST['intitule']);
	$detail = mysqli_real_escape_string($db, $_POST['detail']);
	$categorie = mysqli_real_escape_string($db, $_POST['categorie']);

	#A quel Id correspond la catégorie sélectionnée ?
	$query="SELECT * FROM Categories WHERE nom='$categorie'";
	$categorieId = mysqli_query($db, $query)->fetch_assoc()['Id'];
	

	#Mise à jour du record dans la table
	$query = "UPDATE Records SET intitule='$intitule', detail='$detail', Idcategorie='$categorieId' WHERE Id='$Id';";

	$result = mysqli_query($db, $query) or trigger_error($db->error);
	
	if ($result){
		$_SESSION['msg'] = "Le panier a bien été modifié !";
	} else {
		$_SESSION['msg'] = "Erreur lors de la modification du piano :" . $query;
	};
	header('Location: /html/admin/accueilAdmin.php');
?>

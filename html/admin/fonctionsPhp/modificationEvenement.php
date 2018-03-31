<?php
	session_start();
	include '../DBconfig.php';

	$Id=mysqli_real_escape_string($db, $_POST['Idevenement']);
	$intitule = mysqli_real_escape_string($db, $_POST['intitule']);
	$detail = mysqli_real_escape_string($db, $_POST['detail']);
	$categorie = mysqli_real_escape_string($db, $_POST['categorie']);
	$statut = mysqli_real_escape_string($db, $_POST['statut']);
	if ($statut=='Validé') $statut='valide'; else $statut='revendique';
	$dateRevendication = mysqli_real_escape_string($db, $_POST['date_revendication']);


	#La personne en question est-elle connue des services d'espionnage ?
	$query1 = "SELECT * FROM Personnes WHERE nom='$nom' AND prenom='$prenom' AND promo='$promo'";
	#Si oui on récupère son Id
	$result1 = mysqli_query($db,$query1) or trigger_error($db->error);
	if (mysqli_num_rows($result1)==1) {
		$champion = $result1->fetch_assoc()['Id'];	
	} else #Sinon on crée une nouvelle personne
	{
		$result = mysqli_query($db, "INSERT INTO Personnes(nom, prenom, promo) VALUES('$nom', '$prenom', '$promo')") or trigger_error($db->error);
		$champion = mysqli_insert_id($db); #et on récupère son Id
	}

	#A quel Id correspond la catégorie sélectionnée ?
	$query2="SELECT * FROM Categories WHERE nom='$categorie'";
	$categorieId = mysqli_query($db, $query2)->fetch_assoc()['Id'];
	

	#Mise à jour du record dans la table
	$query3 = "UPDATE Records SET intitule='$intitule', detail='$detail', statut='$statut', champion='$champion', categorie='$categorieId', numero_phare='$numero_phare', dateRevendication='$dateRevendication', dateValidation='$dateValidation' WHERE Id='$Id';";

	$result = mysqli_query($db, $query3) or trigger_error($db->error);
	
	if ($result){
		$_SESSION['msg'] = "Le panier a bien été modifié !";
	} else {
		$_SESSION['msg'] = "Erreur lors de la modification du panier :" . $result;
	};
	header('Location: /html/admin/accueilAdmin.php');
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
</head>

<body>
</body>
</html>
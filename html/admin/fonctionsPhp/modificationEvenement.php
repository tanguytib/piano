<?php
	session_start();
	include '../../DBconfig.php';
	include 'loginCheck.php';


	$Idevenement=mysqli_real_escape_string($db, $_POST['Idevenement']);
	$nom = mysqli_real_escape_string($db, $_POST['nom']);
	$prenom = mysqli_real_escape_string($db, $_POST['prenom']);
	$promo = mysqli_real_escape_string($db, $_POST['promo']);
	$lieu = mysqli_real_escape_string($db, $_POST['lieu']);
	$numero_phare = mysqli_real_escape_string($db, $_POST['numero_phare']);
	$date_revendication = mysqli_real_escape_string($db, $_POST['date_revendication']);
	$date_validation = mysqli_real_escape_string($db, $_POST['date_validation']);

	#La promo en question est-elle connue des services d'espionnage ?
	$query = "SELECT * FROM Promos WHERE nom='$promo'";
	#Si oui on récupère son Id
	$result = mysqli_query($db,$query) or trigger_error($db->error);
	if (mysqli_num_rows($result)==1) {
		$Idpromo = $result->fetch_assoc()['Id'];	
	} else #Sinon on crée une nouvelle personne
	{
		$result = mysqli_query($db, "INSERT INTO Promos(nom) VALUES('$promo')") or trigger_error($db->error);
		$Idpromo = mysqli_insert_id($db); #et on récupère son Id
	}

	#La personne en question est-elle connue des services d'espionnage ?
	$query = "SELECT * FROM Personnes WHERE nom='$nom' AND prenom='$prenom' AND Idpromo='$Idpromo'";
	#Si oui on récupère son Id
	$result = mysqli_query($db,$query) or trigger_error($db->error);
	if (mysqli_num_rows($result)==1) {
		$Idpersonne = $result->fetch_assoc()['Id'];	
	} else #Sinon on crée une nouvelle personne
	{
		$result = mysqli_query($db, "INSERT INTO Personnes(nom, prenom, Idpromo) VALUES('$nom', '$prenom', '$Idpromo')") or trigger_error($db->error);
		$Idpersonne = mysqli_insert_id($db); #et on récupère son Id
	}


	#Mise à jour de l'évènement dans la table
	$query = "UPDATE Evenements SET Idpersonne='$Idpersonne', lieu='$lieu', numero_phare='$numero_phare', date_revendication='$date_revendication', date_validation='$date_validation' WHERE Id='$Idevenement';";

	$result = mysqli_query($db, $query) or trigger_error($db->error);
	
	if ($result){
		$_SESSION['msg'] = "L'événement' a bien été modifié !";
	} else {
		$_SESSION['msg'] = "Erreur lors de la modification de l'événement :" . $query;
	};
	header('Location: /html/admin/accueilAdmin.php');
?>
test
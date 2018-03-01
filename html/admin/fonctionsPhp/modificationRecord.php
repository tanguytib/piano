<?php
	include '../DBconfig.php';

	$intitule = htmlspecialchars($_POST['intitule']);
	$detail = htmlspecialchars($_POST['detail']);
	$categorie = htmlspecialchars($_POST['categorie']);
	$numero_phare = htmlspecialchars($_POST['numero_phare']);
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$promo = htmlspecialchars($_POST['promo']);
	$statut = htmlspecialchars($_POST['statut']);
	if ($statut) $statut='Validé'; else $statut='Revendiqué';
	$dateRevendication = htmlspecialchars($_POST['dateRevendication']);
	$dateValidation = htmlspecialchars($_POST['dateValidation']);

	#La personne en question est-elle connue des services d'espionnage ?
	$query = "SELECT * FROM Personnes WHERE nom='$nom' AND prenom='$prenom' AND promo='$promo'";
	#Si oui on récupère son Id
	if ($personnes = $db->query($query)) {
		$champion = $personnes->fetch_assoc()['Id'];
	} else #Sinon on crée une nouvelle personne
	{
		$db->query("INSERT INTO Personnes(nom, prenom, promo) VALUES('$nom', '$prenom', '$promo')");
		$champion = $db->insert_id; #et on récupère son Id
	}


	$query = "UPDATE Records(intitule, detail, statut, champion, categorie, numero_phare, dateRevendication, dateValidation) VALUES('$intitule', '$detail', '$statut', '$champion', '$categorie', '$numero_phare', '$dateRevendication', '$dateValidation')";

	$result = mysqli_query($db, $query) or trigger_error($db->error."[ $sql]");
	
	if ($result){
		echo 'ok <br>';
		$_SESSION['msg'] = "Le panier a bien été modifié !";
	} else {
		$_SESSION['msg'] = "Erreur lors de la modification du panier :" . $result;
		echo 'okok' . $result->error . '<br>';
	};
	
	echo $query;
	echo $result;
	//header('Location: /html/admin/accueilAdmin.php');
?>
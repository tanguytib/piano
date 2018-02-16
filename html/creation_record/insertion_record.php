<?php
	include '../DBconfig.php';
	
	

	$requete = $db->prepare('INSERT INTO pnfra796140(nom, prenom, promo, numero_phare, status, categorie) VALUES( :intitule, :numero_phare, :status, :nom, :prenom, :promo, :categorie,)');
	$requete->execute(array(
		'intitule' => $_POST['intitule'],
		'numero_phare' => $_POST['numero_phare'],
		'status' => $_POST['status'],	
		'nom' => $_POST['nom'],	
		'prenom' => $_POST['prenom'],	
		'promo' => $_POST['promo'],	
		'categorie' => $_POST['categorie']
		));
	
	/* Essai de jointure entre la table Records et la table Personnes
	
	$jointure = $db->query('SELECT p.nom AS nom_personne, r.nom AS nom_record
							FROM Personnes AS p
							INNER JOIN Records AS r
							ON r.Id = r.Id
							');
							

	*/
	
	echo  'Ton record à bien été ajouté futur champion !';
	header('location : confirmation.php');

?>







